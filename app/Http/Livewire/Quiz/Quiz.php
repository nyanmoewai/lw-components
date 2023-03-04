<?php
namespace App\Http\Livewire\Quiz;

use Livewire\Component;

class Quiz extends Component
{
    public array $quizzes = [];

    public int $currentQuizIndex = 0;
    public array $currentQuiz = [];

    public bool $isCheckedAnswer = false;
    public array $checkedAnswerData;
    public ?string $failedValidationMessage = null;

    public bool $isCheckingAnswer = false;

    protected $listeners = [
        'failedValidation' => 'failedValidation',
        'checkedAnswer' => 'checkedAnswer'
    ];

    public function mount(array ...$quizzes)
    {
        $this->quizzes = $quizzes;
        $this->currentQuizIndex = 0;
        $this->currentQuiz = $quizzes[$this->currentQuizIndex];
    }

    public function checkAnswer()
    {
        $this->isCheckingAnswer = true;
        $this->emit('checkAnswer');
    }

    public function failedValidation(string $message)
    {
        $this->failedValidationMessage = $message;
        $this->isCheckingAnswer = false;
    }

    public function checkedAnswer(array $data)
    {
        $this->isCheckedAnswer = true;
        $this->checkedAnswerData = $data;
        $this->isCheckingAnswer = false;
        $this->clearFailedValidationMessage();
    }

    public function hasNext(): bool
    {
        return count($this->quizzes) > ($this->currentQuizIndex + 1);
    }

    public function goNext()
    {
        if(false === $this->hasNext()) {
            return false;
        }

        $this->currentQuizIndex = $this->currentQuizIndex + 1;
        $this->currentQuiz = $this->quizzes[$this->currentQuizIndex];

        $this->isCheckedAnswer = false;
        $this->checkedAnswerData = [];
        $this->isCheckingAnswer = false;
        $this->clearFailedValidationMessage();
    }

    public function clearFailedValidationMessage()
    {
        $this->failedValidationMessage = null;
    }

    public function render()
    {
        return view('livewire.quiz.quiz');
    }
}
