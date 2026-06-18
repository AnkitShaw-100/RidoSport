<div class="admin-blog-grid">
    <div class="admin-blog-field">
        <label for="title">Blog Title</label>
        <input id="title" name="title" type="text" value="{{ old('title', optional($blog)->title) }}" placeholder="Enter blog title" required autofocus>
        <x-input-error class="mt-2" :messages="$errors->get('title')" />
    </div>

    <div class="admin-blog-field">
        <label for="status">Status</label>
        <select id="status" name="status" required>
            @php($selectedStatus = old('status', optional($blog)->status ?? 'published'))
            <option value="published" @selected($selectedStatus === 'published')>Published</option>
            <option value="draft" @selected($selectedStatus === 'draft')>Draft</option>
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('status')" />
    </div>
</div>

@if ($blog && $blog->banner_image_url)
    <div class="admin-blog-field">
        <label>Current Banner</label>
        <img src="{{ $blog->banner_image_url }}" alt="{{ $blog->title }}" class="admin-blog-current-image">
    </div>
@endif

<div class="admin-blog-upload">
    <label for="banner_image">{{ $blog ? 'Change Banner Image (Optional)' : 'Banner Image' }}</label>
    <input id="banner_image" name="banner_image" type="file" accept="image/png,image/jpeg,image/jpg,image/webp" @required(! $blog)>
    <p>Upload JPG, PNG, or WebP up to 10MB. The image will be stored on Cloudinary.</p>
    <x-input-error class="mt-2" :messages="$errors->get('banner_image')" />
</div>

<div class="admin-blog-field">
    <label for="content">Blog Content</label>
    <textarea id="content" name="content" rows="12" placeholder="Write the full blog content..." required>{{ old('content', optional($blog)->content) }}</textarea>
    <x-input-error class="mt-2" :messages="$errors->get('content')" />
</div>
