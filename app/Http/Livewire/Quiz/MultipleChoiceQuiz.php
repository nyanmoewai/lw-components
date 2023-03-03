<?php
namespace App\Http\Livewire\Quiz;

use Livewire\Component;

class MultipleChoiceQuiz extends Component
{
    public string $question;
    public array $answers = [];
    public array $correctAnswers = [];

    public array $selectedAnswers = [];
    public bool $showResult = false;
    public bool $isCorrectAll = false;

    protected $listeners = ['checkAnswer' => 'checkAnswer'];

    public function mount(string $question, array $answers)
    {
        $this->question = $question;
        $this->answers = $answers;
        $this->correctAnswers = $this->getCorrectAnswers($answers);
    }

    public function toggleAnswer(string $answer)
    {
        if($this->showResult) {
            return false;
        }

        if($this->isSelectedAnswer($answer)) {
            unset($this->selectedAnswers[$answer]);
        } else {
            $result = $this->answers[$answer];
            $this->selectedAnswers[$answer] = $result;
        }
    }

    public function checkAnswer()
    {
        if(false === $this->isAnsweredAll()) {
            return false;
        }

        if($this->showResult) {
            return false;
        }

        $this->showResult = true;

        $this->isCorrectAll = count(
            array_filter($this->selectedAnswers, function($result) {
                return false === $result;
            }
        )) <= 0;
    }

    public function isSelectedAnswer(string $answer): bool
    {
        return isset($this->selectedAnswers[$answer]);
    }

    public function isAnsweredAll(): bool
    {
        return count($this->selectedAnswers) >= $this->getRequiredAnswerCount();
    }

    public function getRequiredAnswerCount(): int
    {
        return count($this->correctAnswers);
    }

    private function getCorrectAnswers(array $answers): array
    {
        return array_filter($answers, function($result) {
            return $result;
        });
    }

    public function render()
    {
        return view('livewire.quiz.multiple-choice-quiz');
    }
}
