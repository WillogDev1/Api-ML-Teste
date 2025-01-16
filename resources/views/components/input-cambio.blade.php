@props(['disabled' => false, 'placeholder' => 0])

<input 
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge(['class' => 'w-64 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!} 
    placeholder="{{ $placeholder }}" />
