<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    <url>
        <loc>{{ url('/') }}</loc>
            <lastmod>{{ now()->toAtomString() }}</lastmod>
            <priority>1.00</priority>
    </url>

     {{-- <url>
        <loc>{{ url('/register') }}</loc>
            <lastmod>{{ now()->toAtomString() }}</lastmod>
            <priority>0.8</priority>
    </url> --}}


     
    {{-- @foreach ($pages as $page)
        <url>
            <loc>{{ route('page', ['id' => $page->id, 'slug' => page_slug($page->name)])}}</loc>
            <lastmod>{{ $page->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <priority>0.8</priority>
        </url>
    @endforeach --}}
    
    
</urlset>