<div class="position-relative">
    <input type="hidden" name="{{ $inputName }}" wire:model="selectedValue">
    <input type="text"
        class="form-control"
        wire:model="input"
        wire:keydown.arrow-down="arrowDown"
        wire:keydown.arrow-up="arrowUp"
        wire:keydown.enter.prevent="selectOption('{{ $hoveringIndex }}')"
    >

    <ul class="dropdown-menu mt-2 border-0 shadow-sm w-100 overflow-auto {{ $isResultBoxShow ? 'show' : '' }}" style="max-height: 150px;">
        @if(empty($result))
            <li class="text-center text-muted small">{{ $noResultText }}</li>
        @else
            @foreach($result as $index => $item)
                <li>
                    <a
                        href="#"
                        class="dropdown-item {{ $index === $hoveringIndex ? 'hovering' : '' }}"
                        wire:click="selectOption('{{ $index }}')"
                    >
                        {{ $item['label'] }}
                    </a>
                </li>
            @endforeach
            @if($hasLoadMore)
                <li class="text-center text-muted small" wire:click="loadMore">...</li>
            @endif
        @endif
    </ul>
</div>
