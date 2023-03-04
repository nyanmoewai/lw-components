<?php
namespace App\Http\Livewire\Quiz;

use Livewire\Component;

class MultipleChoiceQuiz extends Component
{
    public string $question;
    public array $choices = [];
    public array $answers = [];

    public array $selectedAnswers = [];
    public bool $showResult = false;
    public bool $isCorrectAll = false;

    protected $listeners = ['checkAnswer' => 'checkAnswer'];

    public function mount(string $question, array $choices, array $answers)
    {
        $this->question = $question;
        $this->choices = $choices;
        $this->answers = $answers;
    }

    public function toggleAnswer(string $answer)
    {
        if($this->showResult) {
            return false;
        }

        if($this->isSelectedAnswer($answer)) {
            $index = array_search($answer, $this->selectedAnswers, true);

            if(false !== $index) {
                unset($this->selectedAnswers[$index]);
            }
        } else {
            $this->selectedAnswers[] = $answer;
        }
    }

    public function checkAnswer()
    {
        if(false === $this->isAnsweredAll()) {
            $this->emitUp('failedValidation', 'Please select all correct answers.');
            return false;
        }

        if($this->showResult) {
            return false;
        }

        $this->showResult = true;

        $incorrectAnswers = array_filter(
            array_unique($this->selectedAnswers),
            function($answer) { return false === in_array($answer, $this->answers, true); }
        );

        $this->emitUp('checkedAnswer', [
            'show_result' => $this->showResult,
            'is_correct_all' => count($incorrectAnswers) <= 0,
            'correct_answers' => $this->answers
        ]);
    }

    public function isSelectedAnswer(string $answer): bool
    {
        return in_array($answer, $this->selectedAnswers, true);
    }

    public function isAnsweredAll(): bool
    {
        return count($this->selectedAnswers) >= $this->getRequiredAnswerCount();
    }

    public function getRequiredAnswerCount(): int
    {
        return count($this->answers);
    }

    public function isCorrectChoice(string $choice): bool
    {
        return in_array($choice, $this->answers, true);
    }

    public function render()
    {
        return view('livewire.quiz.multiple-choice-quiz');
    }
}
