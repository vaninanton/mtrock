<div {{ $attributes }}>
    @foreach ($values as $key => $value)
    <div>{{ $key }}: {{ $value }}</div>
    @endforeach
</div>
