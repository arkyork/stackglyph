<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($posts as $post)
        <?php
        $dateTime = new DateTime($post->updated_at);
        $w3cDatetime = $dateTime->format('Y-m-d\TH:i:sP');
        ?>
        <url>
            <loc>{{ route('quiz.show',$post->id) }}</loc>
            <lastmod>{{ $w3cDatetime}}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.5</priority>
        </url>
    @endforeach
</urlset>