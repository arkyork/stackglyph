<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>{{ route("sitemap.quiz") }}</loc>
    </sitemap>
    <sitemap>
        <loc>{{ route('sitemap.word') }}</loc>
    </sitemap>
    @for ($i = 2; $i <= $pages; $i++)
        <sitemap>
            <loc>{{ route('sitemap.word.page', ['page' => $i]) }}</loc>
        </sitemap>
    @endfor

</sitemapindex>