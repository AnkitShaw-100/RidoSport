<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Services\CloudinaryUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use RuntimeException;

class BlogController extends Controller
{
    public function __construct(private CloudinaryUploadService $cloudinaryUploadService)
    {
    }

    /**
     * Show the blog creation landing page.
     */
    public function index()
    {
        return $this->create();
    }

    /**
     * Display a listing of the resource.
     */
    public function history()
    {
        $blogs = Blog::latest()->paginate(6);

        return view('blog.index', compact('blogs'));
    }

    public function add(): RedirectResponse
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return redirect()->route('blog-data.create');
        }

        return redirect()->guest(route('admin.login'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'banner_image' => ['nullable', 'file', 'extensions:jpg,jpeg,png,webp', 'max:10240'],
            'status' => ['required', 'in:published,draft'],
        ]);

        $banner = [
            'url' => asset('images/bg/blog-box.png'),
            'public_id' => null,
        ];

        if ($request->hasFile('banner_image')) {
            try {
                $banner = $this->cloudinaryUploadService->uploadBlogBanner(
                    $request->file('banner_image'),
                    $validated['title']
                );
            } catch (RuntimeException $exception) {
                return back()->withInput()->with('failure', $exception->getMessage());
            }
        }

        Blog::create([
            'title' => $validated['title'],
            'slug' => $this->uniqueSlug($validated['title']),
            'content' => Blog::sanitizeHtmlContent($validated['content']),
            'banner_image_url' => $banner['url'],
            'banner_public_id' => $banner['public_id'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('blog-data.history')->with('success', 'Blog created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog = Blog::findOrFail($id);

        return view('blog.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = Blog::findOrFail($id);

        return view('blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $blog = Blog::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'banner_image' => ['nullable', 'file', 'extensions:jpg,jpeg,png,webp', 'max:10240'],
            'status' => ['required', 'in:published,draft'],
        ]);

        $banner = null;

        if ($request->hasFile('banner_image')) {
            try {
                $banner = $this->cloudinaryUploadService->uploadBlogBanner(
                    $request->file('banner_image'),
                    $validated['title']
                );
            } catch (RuntimeException $exception) {
                return back()->withInput()->with('failure', $exception->getMessage());
            }
        }

        $oldBannerPublicId = $blog->banner_public_id;
        $blog->title = $validated['title'];
        $blog->content = Blog::sanitizeHtmlContent($validated['content']);
        $blog->status = $validated['status'];

        if ($blog->isDirty('title')) {
            $blog->slug = $this->uniqueSlug($validated['title'], $blog->id);
        }

        if ($banner) {
            $blog->banner_image_url = $banner['url'];
            $blog->banner_public_id = $banner['public_id'];
        }

        $blog->save();

        if ($banner && $oldBannerPublicId) {
            $this->cloudinaryUploadService->delete($oldBannerPublicId);
        }

        return redirect()->route('blog-data.history')->with('success', 'Blog updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);
        $oldBannerPublicId = $blog->banner_public_id;
        $blog->delete();

        if ($oldBannerPublicId) {
            $this->cloudinaryUploadService->delete($oldBannerPublicId);
        }

        return redirect()->route('blog-data.history')->with('success', 'Blog deleted successfully.');
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title) ?: 'blog';
        $slug = $baseSlug;
        $counter = 1;

        while (Blog::where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        return $slug;
    }

}
