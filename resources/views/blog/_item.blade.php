<article>
    <h2>
        <a href="{{ route('blog.show', $blog) }}">
            {{ $blog->title }}
        </a>
    </h2>
    <p>{{ $blog->description }}</p></article>
@once
    <style>
        .blog-card {
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .08);
            color: #1f2937;
            transition: box-shadow .2s ease, transform .2s ease;
        }

        .blog-card:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, .12);
            transform: translateY(-2px);
        }

        .blog-card__image {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            min-height: 180px;
            background: linear-gradient(135deg, #6366f1, #06b6d4);
            color: rgba(255, 255, 255, .85);
            font-size: 64px;
            font-weight: 700;
            line-height: 1;
            text-transform: uppercase;
            user-select: none;
        }

        .blog-card__body {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 16px 20px 20px;
            min-width: 0;
        }

        .blog-card__category {
            align-self: flex-start;
            padding: 3px 10px;
            background: #eef2ff;
            border-radius: 999px;
            color: #4338ca;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .02em;
        }

        .blog-card__title {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            line-height: 1.3;
            overflow-wrap: anywhere;
        }

        .blog-card__description {
            margin: 0;
            color: #4b5563;
            font-size: 15px;
            line-height: 1.55;
            overflow-wrap: anywhere;
        }

        .blog-card__meta {
            display: flex;
            flex-wrap: wrap;
            gap: 6px 16px;
            margin-top: auto;
            padding-top: 12px;
            border-top: 1px solid #f3f4f6;
            color: #6b7280;
            font-size: 13px;
        }

        .blog-card__meta-item {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        @media (min-width: 640px) {
            .blog-card {
                flex-direction: row;
            }

            .blog-card__image {
                width: 220px;
                min-height: 100%;
            }

            .blog-card__body {
                flex: 1;
                padding: 20px 24px;
            }
        }
    </style>
@endonce

<article class="blog-card">
    <img class="blog-card__image"
         src="{{ asset('images/blog-placeholder.jfif') }}"
         alt="{{ $blog->title }}"
         loading="lazy">

    <div class="blog-card__body">
        @if ($blog->category)
            <span class="blog-card__category">{{ $blog->category->name }}</span>
        @endif

        <h3 class="blog-card__title">{{ $blog->title }}</h3>

        @if ($blog->description)
            <p class="blog-card__description">
                {{ \Illuminate\Support\Str::limit($blog->description, 160) }}
            </p>
        @endif

        <div class="blog-card__meta">
            @if ($blog->author)
                <span class="blog-card__meta-item">
                    <span aria-hidden="true">👤</span>
                    {{ $blog->author->name }}
                </span>
            @endif

            @if ($blog->dt_created)
                <span class="blog-card__meta-item">
                    <span aria-hidden="true">📅</span>
                    <time datetime="{{ \Illuminate\Support\Carbon::parse($blog->dt_created)->toDateString() }}">
                        {{ \Illuminate\Support\Carbon::parse($blog->dt_created)->format('d.m.Y') }}
                    </time>
                </span>
            @endif
        </div>
    </div>
</article>
