<div class="form-group">
     <input type="file" name="thumbnail" id="thumbnail">
    @error('thumbnail')
    <div class="text-danger mt-2">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') ?? $post->title }}">
    @error('title')
    <div class="text-danger mt-2">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="category">category</label>
    <select name="category" id="category" class="form-control">
        <option disabled selected>Choose one</option>
        @foreach($categories as $category)
        <option {{ $category->id == $post->category_id ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach

    </select>
    @error('category')
    <div class="text-danger mt-2">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="tags">tags</label>
    <select name="tags[]" id="tags" class="form-control select2" multiple>
        @foreach($tags as $tags)
        <option value="{{ $tags->id }}">{{ $tags->name }}</option>
        @endforeach

        @foreach($post->tags as $tags)
        <option selected value="{{ $tags->id }}">{{ $tags->name }}</option>
        @endforeach

    </select>
    @error('tags')
    <div class="text-danger mt-2">
        {{ $message }}
    </div>
    @enderror
</div>



<div class="form-group">
    <label for="body">Body</label>
    <textarea type="text" name="body" id="body" class="form-control">{{ old('body') ?? $post->body }}</textarea>
    @error('body')
    <div class="text-danger mt-2">
        {{ $message }}
    </div>
    @enderror
</div>

<button type="submit" class="btn btn-primary">{{ $submit ?? 'Update'}}</button>