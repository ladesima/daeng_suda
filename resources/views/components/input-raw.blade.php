@props(['type' => 'text', 'name' => '', 'value' => '', 'placeholder' => '', 'disabled' => false])

<input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}"
    {{ $disabled ? 'disabled' : '' }}
    {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }} />
