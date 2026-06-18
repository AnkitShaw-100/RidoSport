<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use RuntimeException;

class CloudinaryUploadService
{
    public function uploadBlogBanner(UploadedFile $image, string $title): array
    {
        $cloudName = config('services.cloudinary.cloud_name');
        $apiKey = config('services.cloudinary.api_key');
        $apiSecret = config('services.cloudinary.api_secret');
        $folder = config('services.cloudinary.folder', 'ridosports/blogs');

        if (! $cloudName || ! $apiKey || ! $apiSecret) {
            throw new RuntimeException('Cloudinary credentials are not configured.');
        }

        $timestamp = time();
        $publicId = Str::slug($title).'-'.$timestamp;
        $signature = sha1("folder={$folder}&public_id={$publicId}&timestamp={$timestamp}{$apiSecret}");

        $response = Http::attach(
            'file',
            file_get_contents($image->getRealPath()),
            $image->getClientOriginalName()
        )->post("https://api.cloudinary.com/v1_1/{$cloudName}/image/upload", [
            'api_key' => $apiKey,
            'folder' => $folder,
            'public_id' => $publicId,
            'timestamp' => $timestamp,
            'signature' => $signature,
        ]);

        if ($response->failed()) {
            $errorMessage = $response->json('error.message')
                ?? $response->body()
                ?? 'Cloudinary upload failed. Please check the image and credentials.';

            throw new RuntimeException('Cloudinary upload failed: '.$errorMessage);
        }

        return [
            'url' => $response->json('secure_url'),
            'public_id' => $response->json('public_id'),
        ];
    }

    public function delete(string $publicId): void
    {
        $cloudName = config('services.cloudinary.cloud_name');
        $apiKey = config('services.cloudinary.api_key');
        $apiSecret = config('services.cloudinary.api_secret');

        if (! $cloudName || ! $apiKey || ! $apiSecret) {
            return;
        }

        $timestamp = time();
        $signature = sha1("public_id={$publicId}&timestamp={$timestamp}{$apiSecret}");

        Http::asForm()->post("https://api.cloudinary.com/v1_1/{$cloudName}/image/destroy", [
            'api_key' => $apiKey,
            'public_id' => $publicId,
            'timestamp' => $timestamp,
            'signature' => $signature,
        ]);
    }
}
