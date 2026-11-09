<label for="category_id">Категорія</label><select id="category_id" name="category_id">
    <option value="">— Без категорії —</option>
    @foreach ($categories as $id => $name)
        <option
            value="{{ $id }}"
            @selected(
            old('category_id', $blog->category_id ?? '') == $id
            )
        >
            {{ $name }}
        </option>
    @endforeach
</select>
@error('category_id')
<p class="error">{{ $message }}</p>
@enderror
<label for="title">Заголовок</label>
<input
    type="text"
    id="title"
    name="title"
    value="{{ old('title', $blog->title ?? '') }}"
>
@error('title')
<p class="error">{{ $message }}</p>
@enderror
<label for="filters">Мітки</label>
<select id="filters" name="filters[]" multiple>
    @foreach ($filters as $id => $name)
        <option
            value="{{ $id }}"
            @selected(
            in_array(
            $id,old('filters', $selected ?? [])
            )
            )
        >
            {{ $name }}
        </option>
    @endforeach
</select>
@error('filters')
<p class="error">{{ $message }}</p>
@enderror
