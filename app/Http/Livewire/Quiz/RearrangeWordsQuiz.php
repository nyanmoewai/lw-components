<?php
namespace App\Http\Livewire\Quiz;

use Illuminate\Support\Arr;
use Livewire\Component;

class RearrangeWordsQuiz extends Component
{
    public string $question;
    public array $answers = [];
    public array $unArrangedWords = [];
    public array $arrangedWords = [];

    public string $submitAnswer;
    public bool $showResult = false;

    protected $listeners = ['checkAnswer' => 'checkAnswer'];

    public function mount(string $question, array $answers)
    {
        $this->question = $question;
        $this->answers = $answers;
        $this->unArrangedWords = Arr::shuffle($answers);
    }

    public function arrange(int $index)
    {
        $this->pushToArrangedWords($index);
        $this->removeFromUnArrangedWords($index);
    }

    public function remove(int $index)
    {
        $this->pushToUnArrangedWords($index);
        $this->removeFromArrangedWords($index);
    }

    public function checkAnswer()
    {
        if (count($this->unArrangedWords) > 0) {
            $this->emitUp('failedValidation', 'Please rearrange all words.');

            return false;
        }

        if ($this->showResult) {
            return false;
        }

        $this->showResult = true;

        $this->emitUp('checkedAnswer', [
            'is_correct_all' => $this->isCorrectAll(),
            'correct_answers' => [implode(' ', $this->answers)]
        ]);
    }

    private function pushToArrangedWords(int $index)
    {
        $this->arrangedWords[] = $this->unArrangedWords[$index];
    }

    private function removeFromArrangedWords(int $index)
    {
        unset($this->arrangedWords[$index]);
    }

    private function pushToUnArrangedWords(int $index)
    {
        $this->unArrangedWords[] = $this->arrangedWords[$index];
    }

    private function removeFromUnArrangedWords(int $index)
    {
        unset($this->unArrangedWords[$index]);
    }

    private function isCorrectAll(): bool
    {
        return $this->isAnswerCorrect();
    }

    public function isAnswerCorrect(): bool
    {
        $correctAnswer = implode(' ', $this->answers);
        $arrangedAnswer = implode(' ', $this->arrangedWords);

        return $correctAnswer === $arrangedAnswer;
    }

    public function render()
    {
        return view('livewire.quiz.rearrange-words-quiz');
    }
}
