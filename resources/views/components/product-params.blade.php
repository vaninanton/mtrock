<div {{ $attributes }}>
    @foreach ($paramsParsed as $key => $value)
    <div>{{ $key }}: {{ $value }}</div>
    @endforeach
</div>
