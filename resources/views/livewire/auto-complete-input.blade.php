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
            @if($result->isEmpty())
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
                    <li class="load-more d-none" wire:click="loadMore"></li>
                    <li class="text-center text-muted small load-more" wire:loading.block wire:target="loadMore">...</li>
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

        var list_ele = document.getElementById('{{ $listElementId }}');

        window.addEventListener('click', function(e){
            if (false === list_ele.contains(e.target)){
                list_ele.classList.remove('show');
            }
        });

        list_ele.addEventListener("scroll", function(e) {
            if (list_ele.offsetHeight + list_ele.scrollTop >= list_ele.scrollHeight) {
                var load_more = list_ele.querySelector('li.load-more');

                if(load_more) {
                    load_more.click();
                }
            }
        });
    </script>
</div>
