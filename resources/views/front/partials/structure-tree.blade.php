<div class="space-y-6">
  @foreach($nodes as $n)
    <div class="relative">
      {{-- Card Node Pegawai --}}
      <div class="flex items-center gap-4 p-4 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:shadow-md hover:border-emerald-300 transition duration-200 max-w-md group">
        {{-- Foto Avatar --}}
        <div class="relative flex-shrink-0 w-14 h-14 rounded-2xl overflow-hidden bg-slate-100 border border-slate-200">
          <img
            src="{{ $n['photo'] ?? asset('images/no-image.png') }}"
            alt="Foto {{ $n['name'] }}"
            class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
            onerror="this.src='{{ asset('images/no-image.png') }}'"
            loading="lazy"
          >
        </div>

        {{-- Detail Informasi --}}
        <div class="min-w-0 flex-1">
          <span class="inline-block px-2.5 py-0.5 rounded-md bg-emerald-50 text-emerald-700 text-xs font-semibold tracking-wide border border-emerald-200/60 mb-1">
            {{ $n['title'] }}
          </span>
          <h4 class="text-sm sm:text-base font-bold text-slate-900 truncate">
            {{ $n['name'] }}
          </h4>
          @if(!empty($n['nip']))
            <p class="text-xs text-slate-500 font-mono mt-0.5">
              NIP: {{ $n['nip'] }}
            </p>
          @endif
        </div>
      </div>

      {{-- Subordinates (Children) --}}
      @if(!empty($n['children']))
        <div class="pl-6 sm:pl-8 mt-4 ml-7 border-l-2 border-emerald-300 space-y-4">
          @include('front.partials.structure-tree', ['nodes' => $n['children']])
        </div>
      @endif
    </div>
  @endforeach
</div>
