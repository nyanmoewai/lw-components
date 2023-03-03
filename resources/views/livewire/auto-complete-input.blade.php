<div>
    <div class="position-relative">
        <input type="hidden" name="{{ $inputName }}" wire:model="selectedValue">
        <input type="text"
            class="form-control"
            wire:model="input"
            wire:keydown.arrow-down="arrowDown"
            wire:keydown.arrow-up="arrowUp"
            wire:keydown.enter.prevent="selectOption('{{ $hoveringIndex }}')"
        >

        <ul class="dropdown-menu mt-2 border-0 shadow-sm w-100 overflow-auto {{ $isResultBoxShow ? 'show' : '' }}" style="max-height: 150px;" id="{{ $listElementId }}">
            @if(empty($result))
                <li class="text-center text-muted small">{{ $noResultText }}</li>
            @else
                @foreach($result as $index => $item)
                    <li>
                        <a
                            href="#"
                            class="dropdown-item {{ $index === $hoveringIndex ? 'selected' : '' }}"
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

    <script>
        Livewire.on("scroll-{{ $listElementId }}", function(data) {
            var selected = data.hovering_index;
            var list_ele = document.getElementById(data.id);
            var item_ele = list_ele.querySelector('.selected');

            var ele_height = item_ele.clientHeight;
            var scroll_top = list_ele.scrollTop;
            var viewport = scroll_top + list_ele.clientHeight;
            var ele_offset = ele_height * selected;

            if (ele_offset < scroll_top || (ele_offset + ele_height) > viewport) {
                list_ele.scrollTo({
                    top: ele_offset,
                    left: 0,
                    behavior: "smooth",
                });
            }
        });

        window.addEventListener('click', function(e){
            var element = document.getElementById('{{ $listElementId }}');
            if (false === element.contains(e.target)){
                element.classList.remove('show');
            }
        });
    </script>
</div>
