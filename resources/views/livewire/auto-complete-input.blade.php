<div class="position-relative">
    <input type="hidden" name="{{ $inputName }}" wire:model="selectedValue">
    <input type="text" class="form-control" wire:model="input">

    <ul class="dropdown-menu mt-2 border-0 shadow-sm w-100 overflow-auto {{ $isResultBoxShow ? 'show' : '' }}" style="max-height: 150px;">
        @if(empty($result))
            <li class="text-center text-muted small">{{ $noResultText }}</li>
        @else
            @foreach($result as $value => $label)
                <li>
                    <a href="#" class="dropdown-item" wire:click="selectOption('{{ $value }}', '{{ $label }}')">
                        {{ $label }}
                    </a>
                </li>
            @endforeach
            @if($hasLoadMore)
                <li class="text-center text-muted small" wire:click="loadMore">...</li>
            @endif
        @endif
    </ul>
</div>
