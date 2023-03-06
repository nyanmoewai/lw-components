<div>
    <div class="fs-2 mb-5">{{ $question }}</div>

    <div>
        @foreach($shuffledMatches as $columnA => $columnB)
            <div class="row mb-2">
                <div
                    class="
                        col-4 col-lg-3 border rounded p-0
                        {{ $chooseColumnA === $columnA ? 'border-info' : '' }}
                    "
                >
                    <a
                        href="#"
                        class="d-flex justify-content-center align-items-center p-3 text-decoration-none text-black btn-column-A
                            @if($showResult)
                                {{ $this->isMatchingCorrectA($columnA) ? 'bg-success-subtle' : 'bg-danger-subtle' }}
                            @endif
                        "
                        id="column-A-{{ $columnA }}"
                        wire:click="chooseColumnA('{{ $columnA }}')"
                    >
                        {{ $columnA }}
                    </a>
                </div>

                <div class="col-4 col-lg-6"></div>

                <div
                    class="
                        col-4 col-lg-3 border rounded p-0
                        {{ $chooseColumnB === $columnB ? 'border-info' : '' }}
                    "
                >
                    <a
                        href="#"
                        class="d-flex justify-content-center align-items-center p-3 text-decoration-none text-black btn-column-B
                            @if($showResult)
                                {{ $this->isMatchingCorrectB($columnB) ? 'bg-success-subtle' : 'bg-danger-subtle' }}
                            @endif
                        "
                        id="column-B-{{ $columnB }}"
                        wire:click="chooseColumnB('{{ $columnB }}')"
                    >
                        {{ $columnB }}
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('script')
<script>
    var matching_lines = [];

    Livewire.on('draw-mathching-line', function(data) {
        matching_lines.push({
            'identifier': data.start + '_' + data.end,
            'instance': new LeaderLine(
                document.getElementById(data.start),
                document.getElementById(data.end)
            )
        });
    });

    Livewire.on('remove-matching-line', function(data) {
        var index = matching_lines.findIndex(function(item) {
            return item.identifier === data.identifier;
        });

        matching_lines[index].instance.remove();
    });
</script>
@endpush
