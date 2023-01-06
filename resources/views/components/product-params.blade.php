<div {{ $attributes }}>
    @foreach ($product->params_parsed as $key => $value)
    <div>{{ $key }}: {{ $value }}</div>
    @endforeach
</div>
