@props(['disabled' => false, 'options' => [], 'nullable' => false, 'value' => null])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block py-1 px-0 pr-7 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer']) !!}>
    @if($nullable)
    <option value="">[показать все]</option>
    @endif
    @foreach ($options as $key => $option)
    <option value="{{ $key }}" @selected($key == $value)>{{ $option }}</option>
    @endforeach
</select>
