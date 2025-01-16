@props(['disabled' => false, 'placeholder' => 0, 'type' => 'number'])

<input 
    id="integer-input"
    {{ $disabled ? 'disabled' : '' }}
    type="{{ $type }}" 
    {!! $attributes->merge(['class' => 'w-64 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!} 
    placeholder="{{ $placeholder }}" 
    oninput="this.value = this.value.replace(/[^0-9]/g, '');">
