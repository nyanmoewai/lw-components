<?php
namespace App\Http\Livewire;

use Livewire\Component;

class MultipleChoiceQuiz extends Component
{
    public array $quiz = [];
    public int $currentQuizIndex = 0;
    public array $currentQuiz;
    public int $totalQuiz = 0;
    public $showResult = false;

    public array $resultReport = [];

    public array $selectedAnswers = [];
    public int $totalCorrectQuiz = 0;

    public function mount(array ...$data)
    {
        $this->quiz = $data;
        $this->currentQuiz = $this->quiz[$this->currentQuizIndex];
        $this->totalQuiz = count($data);

        foreach($data as $index => $item) {
            $this->selectedAnswers[$index] = [];
        }
    }

    public function toggleAnswer(string $answer)
    {
        if($this->showResult) {
            return false;
        }
        $indexOf = array_search($answer, $this->selectedAnswers[$this->currentQuizIndex], true);

        if(false === $indexOf) {
            $this->selectedAnswers[$this->currentQuizIndex][] = $answer;
        } else {
            unset($this->selectedAnswers[$this->currentQuizIndex][$indexOf]);
        }
    }

    public function checkAnswer()
    {
        if(false === $this->isAnsweredAll()) {
            return false;
        }

        $this->showResult = true;

        $selectedAnswers = $this->selectedAnswers[$this->currentQuizIndex];

        $quizAnswers = $this->currentQuiz['answers'];

        $resultReport = [];
        $resultReport['question'] = $this->currentQuiz['question'];
        $resultReport['selected_answers'] = [];

        foreach($quizAnswers as $quizAnswer => $result) {
            if(in_array($quizAnswer, $selectedAnswers, true)) {
                $resultReport['selected_answers'][$quizAnswer] = $result;
            }
        }

        $resultReport['is_correct'] = count(array_filter($resultReport['selected_answers'], function($result) {
            return false === $result;
        })) <= 0;

        $resultReport['correct_answers'] = $this->getCorrectAnswers();

        $this->resultReport[$this->currentQuizIndex] = $resultReport;

        $this->totalCorrectQuiz += $resultReport['is_correct'] ? 1 : 0;
    }

    public function isSelectedAnswer(string $answer): bool
    {
        $selectedAnswers = $this->selectedAnswers[$this->currentQuizIndex];

        return in_array($answer, $selectedAnswers, true);
    }

    public function isAnsweredAll(): bool
    {
        return count($this->selectedAnswers[$this->currentQuizIndex]) >= $this->getRequiredAnswerCount();
    }

    public function hasNextQuiz(): bool
    {
        return $this->totalQuiz > ($this->currentQuizIndex + 1);
    }

    public function render()
    {
        return view('livewire.multiple-choice-quiz');
    }

    public function nextQuiz()
    {
        if($this->currentQuizIndex >= ($this->totalQuiz - 1)) {
            return false;
        }

        $this->currentQuizIndex = $this->currentQuizIndex + 1;
        $this->currentQuiz = $this->quiz[$this->currentQuizIndex];
        $this->showResult = false;
    }

    public function completeQuiz()
    {
        // Implement here
    }

    public function getRequiredAnswerCount(): int
    {
        return count($this->getCorrectAnswers());
    }

    public function getCorrectAnswers(): array
    {
        return array_filter($this->currentQuiz['answers'], function($result) {
            return $result;
        });
    }
}
