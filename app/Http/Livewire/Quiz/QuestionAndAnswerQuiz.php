<?php
namespace App\Http\Livewire\Quiz;

use Livewire\Component;
use Illuminate\Support\Arr;

class QuestionAndAnswerQuiz extends Component
{
    public string $question;
    public array $answers = [];

    public string $submitAnswer;
    public bool $showResult = false;

    protected $listeners = ['checkAnswer' => 'checkAnswer'];

    public function mount(string $question, array $answers)
    {
        $this->question = $question;
        $this->answers = $answers;
    }

    public function checkAnswer()
    {
        if(empty($this->submitAnswer)) {
            $this->emitUp('failedValidation', 'Please answer the question.');
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

    private function isCorrectAll(): bool
    {
        return $this->isAnswerCorrect();
    }

    public function isAnswerCorrect(): bool
    {
        return in_array($this->submitAnswer, $this->answers, true);
    }

    public function render()
    {
        return view('livewire.quiz.question-and-answer-quiz');
    }
}
