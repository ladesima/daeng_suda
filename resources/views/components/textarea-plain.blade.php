@props(['name' => '', 'value' => '', 'label' => null, 'placeholder' => '', 'rows' => 3, 'disabled' => false])

@if($label)
  <label class="block text-sm font-medium text-slate-700 mb-1">{{ $label }}</label>
@endif
<textarea name="{{ $name }}" rows="{{ $rows }}" placeholder="{{ $placeholder }}"
    {{ $disabled ? 'disabled' : '' }}
    {{ $attributes->merge(['class' => 'border border-slate-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500']) }}>{{ $slot->isNotEmpty() ? $slot : $value }}</textarea>
