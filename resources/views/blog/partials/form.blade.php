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
    <textarea id="content" class="admin-blog-rich-editor" name="content" rows="18" placeholder="Write the full blog content..." required>{{ old('content', optional($blog)->content) }}</textarea>
    <p class="admin-blog-editor-help">Use the rich text editor for headings, formatted text, links, tables, code, and images. Images inserted in the editor are uploaded to Cloudinary.</p>
    <x-input-error class="mt-2" :messages="$errors->get('content')" />
</div>

<script src="https://cdn.tiny.cloud/1/apc4ph2mry4ugfyrjy5d50h1nyxm94l41hx0n7a7l6dkpcfk/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (!window.tinymce || !document.getElementById('content')) {
            return;
        }

        tinymce.init({
            selector: '#content',
            height: 600,
            menubar: 'file edit view insert format tools table help',
            plugins: 'image link media table lists code fullscreen wordcount autosave searchreplace visualblocks codesample',
            toolbar: 'undo redo | blocks | bold italic underline strikethrough forecolor | alignleft aligncenter alignright alignjustify | bullist numlist blockquote | link image media table codesample hr | searchreplace visualblocks code fullscreen',
            block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4',
            branding: false,
            promotion: false,
            automatic_uploads: true,
            paste_data_images: true,
            images_upload_credentials: true,
            image_caption: true,
            image_advtab: true,
            file_picker_types: 'image',
            relative_urls: false,
            remove_script_host: false,
            convert_urls: false,
            browser_spellcheck: true,
            contextmenu: 'link image table',
            paste_as_text: false,
            paste_data_images: true,
            paste_merge_formats: true,
            paste_webkit_styles: 'all',
            smart_paste: true,
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_retention: '20m',
            content_style: 'body{font-family:Arial,Helvetica,sans-serif;font-size:16px;line-height:1.75;color:#303030;padding:18px;} h1,h2,h3,h4{color:#050a1e;line-height:1.25;} blockquote{border-left:4px solid #971736;margin:18px 0;padding:12px 18px;background:#f8eef1;color:#233e50;} img{max-width:100%;height:auto;border-radius:8px;} table{border-collapse:collapse;width:100%;} th,td{border:1px solid #d9dde2;padding:10px;}',
            images_upload_handler: function (blobInfo, progress) {
                return new Promise(function (resolve, reject) {
                    var formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());

                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', '{{ route('blog-data.tinymce-image') }}');
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                    xhr.upload.onprogress = function (event) {
                        if (event.lengthComputable) {
                            progress(event.loaded / event.total * 100);
                        }
                    };
                    xhr.onload = function () {
                        if (xhr.status < 200 || xhr.status >= 300) {
                            reject('Image upload failed. Please try again.');
                            return;
                        }

                        var json = JSON.parse(xhr.responseText || '{}');

                        if (!json.location) {
                            reject('Invalid upload response.');
                            return;
                        }

                        resolve(json.location);
                    };
                    xhr.onerror = function () {
                        reject('Image upload failed. Please check your connection.');
                    };
                    xhr.send(formData);
                });
            },
            setup: function (editor) {
                editor.on('change keyup undo redo', function () {
                    editor.save();
                });
                editor.on('init', function () {
                    editor.save();
                });
            }
        });
    });
</script>
