<!-- タイトル -->
<div>
    <label for="title">タイトル：</label>
    <input type="text" id="title" name="title" 
           value="{{ old('title', $movie->title ?? '') }}" required>
</div>

<!-- 画像URL -->
<div>
    <label for="image_url">画像URL：</label>
    <input type="text" id="image_url" name="image_url" 
           value="{{ old('image_url', $movie->image_url ?? '') }}" required>
</div>

<!-- 公開年 -->
<div>
    <label for="published_year">公開年：</label>
    <input type="number" id="published_year" name="published_year" 
           value="{{ old('published_year', $movie->published_year ?? '') }}" required>
</div>

<!-- 概要 -->
<div>
    <label for="description">概要：</label>
    <textarea id="description" name="description" rows="4" required>{{ old('description', $movie->description ?? '') }}</textarea>
</div>

<!-- 公開中チェックボックス -->
<div>
    <label>
        <input type="checkbox" id="is_showing" name="is_showing" value="1" 
               {{ old('is_showing', $movie->is_showing ?? 0) ? 'checked' : '' }}>
        公開中
    </label>
</div>

<!-- ジャンル -->
<div>
    <label for="genre">ジャンル：</label>
    <input type="text" id="genre" name="genre"
           value="{{ old('genre', $movie->genre->name ?? '') }}" required>
</div>

<div>
    <button type="submit">
        {{ isset($movie) && $movie->exists ? '更新する' : '登録する' }}
    </button>
</div>