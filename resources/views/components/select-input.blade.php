@props(['disabled' => false, 'options' => [], 'nullable' => false, 'value' => null])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}>
    @if($nullable)
    <option value="">[выберите вариант]</option>
    @endif
    @foreach ($options as $key => $option)
    <option value="{{ $key }}" @selected($key==$value)>{{ $option }}</option>
    @endforeach
</select>
