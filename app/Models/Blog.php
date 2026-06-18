<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'banner_image_url',
        'banner_public_id',
        'status',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getSafeContentAttribute(): string
    {
        return self::sanitizeHtmlContent($this->content ?? '');
    }

    public static function sanitizeHtmlContent(string $content): string
    {
        $content = preg_replace('/^[ \t]*<?\/?(?:!doctype[ \t]+html|html|head|body)\b[^>\r\n]*(?:>)?[ \t]*$/im', '', $content);

        $allowedTags = '<h1><h2><h3><h4><h5><h6><p><br><strong><b><em><i><u><ul><ol><li><blockquote><a><img>';
        $content = strip_tags($content, $allowedTags);
        $content = preg_replace('/\s+on[a-z]+\s*=\s*(".*?"|\'.*?\'|[^\s>]+)/i', '', $content);
        $content = preg_replace('/\s+style\s*=\s*(".*?"|\'.*?\'|[^\s>]+)/i', '', $content);
        $content = preg_replace('/\s+(?:id|class)\s*=\s*(".*?"|\'.*?\'|[^\s>]+)/i', '', $content);
        $content = preg_replace('/(href\s*=\s*["\'])\s*javascript:[^"\']*(["\'])/i', '$1#$2', $content);
        $content = preg_replace('/(src\s*=\s*["\'])\s*javascript:[^"\']*(["\'])/i', '$1#$2', $content);

        return trim($content);
    }
}
