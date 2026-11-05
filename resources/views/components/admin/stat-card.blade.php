@props(['title'=>'', 'value'=>0, 'icon'=>null, 'tone'=>'emerald'])

@php
$tones = [
  'emerald' => ['bg'=>'bg-emerald-50', 'fg'=>'text-emerald-700'],
  'blue'    => ['bg'=>'bg-blue-50',    'fg'=>'text-blue-700'],
  'amber'   => ['bg'=>'bg-amber-50',   'fg'=>'text-amber-700'],
  'rose'    => ['bg'=>'bg-rose-50',    'fg'=>'text-rose-700'],
];
$c = $tones[$tone] ?? $tones['emerald'];
@endphp

<div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-sm">
  <div class="flex items-center justify-between">
    <div>
      <div class="text-sm text-slate-500">{{ $title }}</div>
      <div class="mt-1 text-3xl font-semibold tracking-tight">{{ $value }}</div>
    </div>
    <div class="h-12 w-12 rounded-xl grid place-content-center {{ $c['bg'] }} {{ $c['fg'] }}">
      {{ $icon }}
    </div>
  </div>
</div>
