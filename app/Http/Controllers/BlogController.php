<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use App\Models\Category;
use App\Models\Filter;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'filter' => [
                'nullable',
                'integer',
                'exists:filter,filter_id',
            ],
        ]);
        $filterId = $request->query('filter');
        $blogs = Blog::query()
                ->with(['category', 'author', 'filters'])
                ->when(
                    $filterId,
                    fn ($query) => $query->whereHas(
                        'filters',
                        fn ($q) => $q->whereKey($filterId)
                    )
                ) ->orderByDesc('dt_created')
        ->paginate(6)
        ->withQueryString();$filters = Filter::pluck('filter_name', 'filter_id');
        return view('blog.index', compact(
    'blogs','filters','filterId'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog.create', [
            'categories' => Category::orderBy('category_name')
                ->pluck('category_name', 'category_id'),
            'filters' => Filter::pluck('filter_name', 'filter_id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        $data = $request->validated();
        $blog = Blog::create([
            ...(\illuminate\Support\Arr::except($data, ['filters'])),
            'user_id' => auth()->id(),
        ]);
        $blog->filters()->sync($data['filters']??[]);
        return redirect()->route('blog.show', $blog);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('blog.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $blog->load('filters');
        return view('blog.edit', [
            'blog' => $blog,
            'categories' => Category::pluck(
                'category_name',
                'category_id'
            ),
            'filters' => Filter::pluck(
                'filter_name',
                'filter_id'
            ),
            'selected' => $blog->filters
                ->pluck('filter_id')
                ->all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        $data = $request->validated();
        $blog->update(
            \Illuminate\Support\Arr::except(
                $data,
                ['filters']
            )
        );
        $blog->filters()->sync(
            $data['filters'] ?? []
        );
        return redirect()->route('blog.show', $blog);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blog.index');
    }

    public function admin()
    {
        $blogs = Blog::with('category')
            ->orderByDesc('dt_created')
            ->paginate(10);
        return view('blog.admin', compact('blogs'));
    }
    public function tags(Blog $blog)
    {
        $blog->load('filters');
        return view('blog.tags', [
            'blog' => $blog,
            'filters' => Filter::pluck(
                'filter_name',
                'filter_id'
            ),
            'selected' => $blog->filters
                ->pluck('filter_id')->all(),
        ]);
    }
    public function tagsStore(Request $request, Blog $blog)
    {
        $data = $request->validate([
            'filters' => ['sometimes', 'array'],
            'filters.*' => [
                'integer',
                'distinct',
                'exists:filter,filter_id',
            ],
        ]);
        $blog->filters()->sync($data['filters'] ?? []);
        return redirect()->route('blog.show', $blog);
    }
}
