<div {{ $attributes }}>
    @foreach ($product->paramsParsed as $key => $value)
    <div>{{ $key }}: {{ $value }}</div>
    @endforeach
</div>
