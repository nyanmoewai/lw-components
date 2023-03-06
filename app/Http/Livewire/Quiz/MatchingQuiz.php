<?php
namespace App\Http\Livewire\Quiz;

use Illuminate\Support\Arr;
use Livewire\Component;

class MatchingQuiz extends Component
{
    public string $question;
    public array $matches = [];
    public array $shuffledMatches = [];

    public array $submitMatchings = [];
    public bool $showResult = false;

    public ?string $chooseColumnA = null;
    public ?string $chooseColumnB = null;

    protected $listeners = ['checkAnswer' => 'checkAnswer'];

    public function mount(string $question, array $matches)
    {
        $this->question = $question;
        $this->matches = $matches;
        $this->shuffledMatches = $this->shuffleMatches($matches);
    }

    public function checkAnswer()
    {
        if (count($this->submitMatchings) < count($this->matches)) {
            $this->emitUp('failedValidation', 'Please match all.');

            return false;
        }

        if ($this->showResult) {
            return false;
        }

        $this->showResult = true;

        $this->emitUp('checkedAnswer', [
            'is_correct_all' => $this->isCorrectAll(),
            'correct_answers' => $this->getCorrectAnswers()
        ]);
    }

    private function isCorrectAll(): bool
    {
        foreach ($this->submitMatchings as $columnA => $columnB) {
            if (false === $this->isMatchingCorrectA($columnA)) {
                return false;
            }
        }

        return true;
    }

    public function isMatchingCorrectA(string $columnA): bool
    {
        if (false === isset($this->submitMatchings[$columnA])) {
            return true;
        }

        $submitColumnB = $this->submitMatchings[$columnA];
        $correctColumnB = $this->matches[$columnA];

        return $submitColumnB === $correctColumnB;
    }

    public function isMatchingCorrectB(string $columnB): bool
    {
        $columnA = array_search($columnB, $this->submitMatchings, true);

        if (false === $columnA) {
            return true;
        }

        return $this->isMatchingCorrectA($columnA);
    }

    public function chooseColumnA(string $value)
    {
        if ($this->showResult) {
            return false;
        }

        if (array_key_exists($value, $this->submitMatchings)) {
            $this->removeMatching($value);

            return false;
        }

        if (is_null($this->chooseColumnA)) {
            $this->chooseColumnA = $value;
        } else {
            $this->chooseColumnA = null;
        }
    }

    public function chooseColumnB(string $value)
    {
        if ($this->showResult) {
            return false;
        }

        if (is_null($this->chooseColumnA)) {
            return false;
        }

        $this->chooseColumnB = $value;

        $this->emit('draw-mathching-line', [
            'start' => "column-A-{$this->chooseColumnA}",
            'end' => "column-B-{$this->chooseColumnB}"
        ]);

        $this->submitMatchings[$this->chooseColumnA] = $this->chooseColumnB;
        $this->chooseColumnA = $this->chooseColumnB = null;
    }

    public function removeMatching(string $value)
    {
        $this->emit('remove-matching-line', [
            'identifier' => 'column-A-'.$value . '_' . 'column-B-'.$this->submitMatchings[$value]
        ]);

        unset($this->submitMatchings[$value]);
    }

    private function shuffleMatches(array $matches)
    {
        $shuffledMatches = [];

        $columnA = Arr::shuffle(array_keys($matches));
        $columnB = Arr::shuffle(array_values($matches));

        foreach ($columnA as $index => $value) {
            $shuffledMatches[$value] = $columnB[$index];
        }

        return $shuffledMatches;
    }

    private function getCorrectAnswers(): array
    {
        $result = [];

        foreach ($this->shuffledMatches as $columnA => $columnB) {
            $result[] = $columnA . ' = ' . $this->matches[$columnA];
        }

        return $result;
    }

    public function render()
    {
        return view('livewire.quiz.matching-quiz');
    }
}
