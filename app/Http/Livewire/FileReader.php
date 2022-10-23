<?php

namespace App\Http\Livewire;

use App\Classes\FileParser;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class FileReader extends Component
{
    public string $path = '';
    public array $lines = [];
    public int $startLine = 0;
    public int $linesCount = 10;
    public int $fileLinesCount;
    public bool $hasPrevious = false;
    public bool $hasNext = false;
    public ?string $error = null;

    public function render(): View
    {
        return view('livewire.file-reader');
    }

    public function getLines()
    {
        try {
            $this->error = null;
            $fileParser = new FileParser($this->path);
            $fileParser->setStartLine($this->startLine)->setLinesCount($this->linesCount);

            $this->startLine = $fileParser->getStartLine();
            $this->linesCount = $fileParser->getLinesCount();
            $this->fileLinesCount = $fileParser->getFileLinesCount();
            $this->lines = $fileParser->getLines()->toArray();
            $this->hasPrevious = $fileParser->hasPrevious();
            $this->hasNext = $fileParser->hasNext();
        } catch (\Exception $exception) {
            $this->error = $exception->getMessage();
        }
    }

    public function goToBeginning()
    {
        $this->startLine = 0;
        $this->getLines();
    }

    public function goToEnd()
    {
        $this->startLine = $this->fileLinesCount - $this->linesCount;
        $this->getLines();
    }

    public function previous()
    {
        $this->startLine -= $this->linesCount;
        $this->getLines();
    }

    public function next()
    {
        $this->startLine += $this->linesCount;
        $this->getLines();
    }
}
