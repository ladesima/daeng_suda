@props(['type' => 'text', 'name' => '', 'value' => '', 'placeholder' => '', 'disabled' => false])

<input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}"
    {{ $disabled ? 'disabled' : '' }}
    {{ $attributes->merge(['class' => 'border rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500']) }} />
