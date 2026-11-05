@props(['name' => '', 'value' => '', 'placeholder' => '', 'rows' => 3, 'disabled' => false])

<textarea name="{{ $name }}" rows="{{ $rows }}" placeholder="{{ $placeholder }}"
    {{ $disabled ? 'disabled' : '' }}
    {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full']) }}>{{ $value }}</textarea>
