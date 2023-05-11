<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="{{ asset('sitemap.xsl') }}"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($products as $product)
        <url>
            <loc>{{ route('product', $product) }}</loc>
            <lastmod>{{ $product->updated_at?->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
            @if ($product->image)
                <image:image>
                    <image:loc>{{ Storage::url($product->image) }}</image:loc>
                </image:image>
            @endif
        </url>
    @endforeach
</urlset>
