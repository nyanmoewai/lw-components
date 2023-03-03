<?php

namespace App\Http\Livewire;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Livewire\Component;
use Illuminate\Support\Str;

class AutoCompleteInput extends Component
{
    public Collection $passedData;
    public bool $hasSource = false;
    public ?object $sourceInstance = null;
    public array $options;
    public string $inputName;

    public Collection $result;
    public string $input;
    public string $noResultText = 'No Result Found.';
    public bool $isResultBoxShow = false;
    public string $selectedValue = '';

    private array $defaultOptions = [
        'source_method' => 'filter',
        'min_chars' => 3,
        'limit' => 20
    ];
    public ?int $prevOffset = null;
    public bool $hasLoadMore = false;

    public ?int $hoveringIndex = null;

    public function mount(string $input_name, mixed $source, array $options = []) {
        if(is_array($source)) {
            $this->passedData = collect($source);
        } elseif (is_object($source)) {
            $this->passedData = collect([]);
            $this->hasSource = true;
            $this->sourceInstance = $source;
        } else {
            throw new Exception("Source must be array or object instance.");
        }

        $this->inputName = $input_name;
        $this->result = collect([]);
        $this->setOptions($options);
    }

    public function updatedInput($input)
    {
        $this->resetPrevOffset();
        $this->resetHoveringIndex();

        if(strlen($input) < $this->getOption('min_chars')) {
            $this->hideResultBox();
            return false;
        }

        $this->filterResult($input);
        $this->showResultBox();
    }

    public function arrowDown()
    {
        $total_result_index = $this->result->count() - 1;

        if(is_null($this->hoveringIndex)) {
            $this->hoveringIndex = 0;
        } elseif ($total_result_index > $this->hoveringIndex)  {
            $this->hoveringIndex = $this->hoveringIndex + 1;
        }
    }

    public function arrowUp()
    {
        if($this->hoveringIndex === 0) {
            $this->hoveringIndex = 0;
        } else {
            $this->hoveringIndex = $this->hoveringIndex - 1;
        }
    }

    public function render()
    {
        return view('livewire.auto-complete-input');
    }

    public function selectOption(?int $index)
    {
        if(is_null($index)) {
            return false;
        }

        $this->input = $this->result[$index]['label'];
        $this->selectedValue = $this->result[$index]['value'];
        $this->hideResultBox();
    }

    public function loadMore()
    {
        if(false === $this->hasSource) {
            return false;
        }

        $input = $this->input;
        $class = $this->sourceInstance;
        $method = $this->getOption('source_method');
        $limit = $this->getOption('limit');
        $offset = $this->getCurrentOffest();

        $result = collect($class->$method($input, $limit, $offset))
        ->map(function($lable, $value) {
            return [
                'label' => $lable,
                'value' => $value
            ];
        })->values();

        $this->hasLoadMore = $result->isNotEmpty();
        $this->result = $this->result->merge($result);
        $this->setPrevOffset($offset);
    }

    private function showResultBox()
    {
        $this->isResultBoxShow = true;
    }

    private function hideResultBox()
    {
        $this->isResultBoxShow = false;
    }

    private function filterResult(string $input)
    {
        if($this->hasSource) {
            $class = $this->sourceInstance;
            $method = $this->getOption('source_method');
            $limit = $this->getOption('limit');
            $offset = $this->getCurrentOffest();
            $result = collect($class->$method($input, $limit, $offset))
            ->map(function($lable, $value) {
                return [
                    'label' => $lable,
                    'value' => $value
                ];
            })->values();

            $this->hasLoadMore = $result->isNotEmpty();
            $this->result = $result;
            $this->setPrevOffset($offset);
        } else {
            $this->result = $this->passedData
            ->filter(function($label) use ($input) {
                return Str::contains($label, $input);
            })->map(function($lable, $value) {
                return [
                    'label' => $lable,
                    'value' => $value
                ];
            })->values();
        }
    }

    private function getOption(string $key)
    {
        return data_get($this->options, $key);
    }

    private function setOptions(array $options): void
    {
        foreach($this->defaultOptions as $key => $value) {
            $this->options[$key] = data_get($options, $key, $value);
        }
    }

    private function getCurrentOffest(): int
    {
        if(is_null($this->prevOffset)) {
            return 0;
        }

        return $this->prevOffset + $this->getOption('limit');
    }

    private function setPrevOffset(int $offset): void
    {
        $this->prevOffset = $offset;
    }

    private function resetPrevOffset(): void
    {
        $this->prevOffset = null;
    }

    private function resetHoveringIndex(): void
    {
        $this->hoveringIndex = null;
    }
}
