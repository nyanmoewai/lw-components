<?php
namespace App\Http\Livewire\Quiz;

use Livewire\Component;
use Illuminate\Support\Arr;

class FillInBlankQuiz extends Component
{
    public array $question_chunks;
    public array $answers = [];

    public array $filledAnswers = [];
    public bool $showResult = false;

    protected $listeners = ['checkAnswer' => 'checkAnswer'];

    public function mount(string $question, array $answers)
    {
        $this->question_chunks = $this->chunkByBlank($question);
        $this->answers = $answers;
    }

    private function chunkByBlank(string $question): array
    {
        $question = str_replace('{___}', '%begin_blank%{___}%end_blank%', $question);

        return preg_split('/(%begin_blank%|%end_blank%)/', $question);
    }

    public function checkAnswer()
    {
        if(false === $this->isAnsweredAll()) {
            $this->emitUp('failedValidation', 'Please fill all blank.');
            return false;
        }

        if($this->showResult) {
            return false;
        }

        $this->showResult = true;

        $this->emitUp('checkedAnswer', [
            'is_correct_all' => $this->isCorrectAll(),
            'correct_answers' => $this->answers
        ]);
    }

    public function isAnsweredAll(): bool
    {
        return count($this->filledAnswers) >= $this->getRequiredAnswerCount();
    }

    private function getRequiredAnswerCount(): int
    {
        return count($this->answers);
    }

    private function isCorrectAll(): bool
    {
        return $this->answers === $this->filledAnswers;
    }

    public function isAnswerCorrect($index): bool
    {
        return $this->answers[$index] === $this->filledAnswers[$index];
    }

    public function render()
    {
        return view('livewire.quiz.fill-in-blank-quiz');
    }
}
