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

    public function getFormattedContentAttribute(): string
    {
        $content = $this->safe_content;

        if ($content !== strip_tags($content)) {
            return $content;
        }

        return self::formatPlainTextContent($content);
    }

    public static function sanitizeHtmlContent(string $content): string
    {
        $content = preg_replace('/^[ \t]*<?\/?(?:!doctype[ \t]+html|html|head|body)\b[^>\r\n]*(?:>)?[ \t]*$/im', '', $content);

        $allowedTags = '<h1><h2><h3><h4><h5><h6><p><br><strong><b><em><i><u><s><strike><span><div><ul><ol><li><blockquote><a><img><figure><figcaption><table><thead><tbody><tfoot><tr><th><td><caption><colgroup><col><pre><code><hr><iframe>';
        $content = strip_tags($content, $allowedTags);
        $content = preg_replace('/\s+on[a-z]+\s*=\s*(".*?"|\'.*?\'|[^\s>]+)/i', '', $content);
        $content = preg_replace('/\s+(?:id|class)\s*=\s*(".*?"|\'.*?\'|[^\s>]+)/i', '', $content);
        $content = preg_replace_callback('/\s+style\s*=\s*(["\'])(.*?)\1/is', function (array $matches) {
            $style = preg_replace('/expression\s*\(|javascript\s*:|behavior\s*:|url\s*\(\s*[\'"]?\s*javascript\s*:/i', '', $matches[2]);
            $style = trim($style ?? '');

            return $style === '' ? '' : ' style="'.$style.'"';
        }, $content);
        $content = preg_replace('/(href\s*=\s*["\'])\s*javascript:[^"\']*(["\'])/i', '$1#$2', $content);
        $content = preg_replace('/(src\s*=\s*["\'])\s*javascript:[^"\']*(["\'])/i', '$1#$2', $content);

        return trim($content);
    }

    public static function formatPlainTextContent(string $content): string
    {
        $content = trim(str_replace(["\r\n", "\r"], "\n", $content));

        if ($content === '') {
            return '';
        }

        $blocks = preg_split("/\n{2,}/", $content) ?: [];
        $html = [];

        foreach ($blocks as $block) {
            $block = trim($block);

            if ($block === '') {
                continue;
            }

            $lines = array_values(array_filter(array_map('trim', explode("\n", $block)), fn ($line) => $line !== ''));

            if (count($lines) === 0) {
                continue;
            }

            if (count($lines) === 1) {
                $line = $lines[0];

                if (preg_match('/^(#{1,3})\s+(.+)$/', $line, $matches)) {
                    $level = strlen($matches[1]) + 1;
                    $html[] = '<h'.$level.'>'.e(trim($matches[2])).'</h'.$level.'>';
                    continue;
                }

                if (self::looksLikePlainHeading($line)) {
                    $html[] = '<h2>'.e($line).'</h2>';
                    continue;
                }
            }

            if (self::allLinesMatch($lines, '/^[-*]\s+.+/')) {
                $items = array_map(fn ($line) => '<li>'.e(preg_replace('/^[-*]\s+/', '', $line)).'</li>', $lines);
                $html[] = '<ul>'.implode('', $items).'</ul>';
                continue;
            }

            if (self::allLinesMatch($lines, '/^\d+[.)]\s+.+/')) {
                $items = array_map(fn ($line) => '<li>'.e(preg_replace('/^\d+[.)]\s+/', '', $line)).'</li>', $lines);
                $html[] = '<ol>'.implode('', $items).'</ol>';
                continue;
            }

            $paragraph = implode('<br>', array_map(fn ($line) => e($line), $lines));
            $html[] = '<p>'.$paragraph.'</p>';
        }

        return implode("\n", $html);
    }

    private static function looksLikePlainHeading(string $line): bool
    {
        $trimmed = trim($line);

        if (strlen($trimmed) > 95 || preg_match('/[.!?]$/', $trimmed)) {
            return false;
        }

        return preg_match('/[A-Za-z]/', $trimmed)
            && preg_match('/^[A-Z0-9][A-Za-z0-9\s:&,\-\'’]+$/', $trimmed);
    }

    private static function allLinesMatch(array $lines, string $pattern): bool
    {
        foreach ($lines as $line) {
            if (! preg_match($pattern, $line)) {
                return false;
            }
        }

        return true;
    }
}
