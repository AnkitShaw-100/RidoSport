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

@if ($blog && (! empty($blog->banner_public_id) || (! empty($blog->banner_image_url) && ! str_contains($blog->banner_image_url, 'images/bg/blog-box.png'))))
    <div class="admin-blog-field">
        <label>Current Banner</label>
        <img src="{{ $blog->banner_image_url }}" alt="{{ $blog->title }}" class="admin-blog-current-image">
    </div>
@endif

<div class="admin-blog-upload">
    <label for="banner_image">{{ $blog ? 'Change Banner Image (Optional)' : 'Banner Image (Optional)' }}</label>
    <input id="banner_image" name="banner_image" type="file" accept="image/png,image/jpeg,image/jpg,image/webp">
    <p>Upload JPG, PNG, or WebP up to 10MB. If left empty, a default blog banner will be used.</p>
    <x-input-error class="mt-2" :messages="$errors->get('banner_image')" />
</div>

<div class="admin-blog-field">
    <label for="content">Blog Content</label>
    <div class="admin-blog-editor-toolbar" aria-label="Blog formatting tools">
        <button type="button" data-before="<h2>" data-after="</h2>">Heading</button>
        <button type="button" data-before="<h3>" data-after="</h3>">Subheading</button>
        <button type="button" data-before="<p>" data-after="</p>">Paragraph</button>
        <button type="button" data-before="<strong>" data-after="</strong>">Bold</button>
        <button type="button" data-before="<em>" data-after="</em>">Italic</button>
        <button type="button" data-before="<ul><li>" data-after="</li></ul>">Bullet List</button>
        <button type="button" data-before="<ol><li>" data-after="</li></ol>">Number List</button>
        <button type="button" data-before="<blockquote>" data-after="</blockquote>">Quote</button>
        <button type="button" data-link="true">Link</button>
        <button type="button" data-image="true">Image Link</button>
    </div>
    <textarea id="content" name="content" rows="12" placeholder="Write the full blog content..." required>{{ old('content', optional($blog)->content) }}</textarea>
    <p class="admin-blog-editor-help">HTML is supported. Use headings, subheadings, paragraphs, lists, quotes, links, bold, and italic text to format the public blog page.</p>
    <x-input-error class="mt-2" :messages="$errors->get('content')" />
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var textarea = document.getElementById('content');
        var toolbar = document.querySelector('.admin-blog-editor-toolbar');

        if (!textarea || !toolbar) {
            return;
        }

        toolbar.addEventListener('click', function (event) {
            var button = event.target.closest('button');

            if (!button) {
                return;
            }

            var start = textarea.selectionStart;
            var end = textarea.selectionEnd;
            var selected = textarea.value.slice(start, end) || 'Your text here';
            var replacement;

            if (button.dataset.link) {
                var url = window.prompt('Enter link URL', 'https://');
                if (!url) {
                    textarea.focus();
                    return;
                }
                replacement = '<a href="' + url.replace(/"/g, '&quot;') + '">' + selected + '</a>';
            } else if (button.dataset.image) {
                var imageUrl = window.prompt('Enter image URL', 'https://');
                if (!imageUrl) {
                    textarea.focus();
                    return;
                }
                var imageAlt = window.prompt('Enter image alt text', selected === 'Your text here' ? '' : selected) || '';
                replacement = '<img src="' + imageUrl.replace(/"/g, '&quot;') + '" alt="' + imageAlt.replace(/"/g, '&quot;') + '">';
            } else {
                replacement = (button.dataset.before || '') + selected + (button.dataset.after || '');
            }

            textarea.value = textarea.value.slice(0, start) + replacement + textarea.value.slice(end);
            textarea.focus();
            textarea.selectionStart = start;
            textarea.selectionEnd = start + replacement.length;
        });
    });
</script>
