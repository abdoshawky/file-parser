<?php

namespace App\Classes;

use Illuminate\Support\Collection;
use SplFileObject;

class FileParser
{
    private SplFileObject $file;
    private int $startLine = 0;
    private int $linesCount = 10;

    public function __construct(string $path)
    {
        $this->file = new SplFileObject($path, "r");
    }

    public function getStartLine(): int
    {
        return $this->startLine;
    }

    public function setStartLine($line): FileParser
    {
        $this->startLine = $line;
        return $this;
    }

    public function getLinesCount(): int
    {
        return $this->linesCount;
    }

    public function setLinesCount($count): FileParser
    {
        $this->linesCount = $count;
        return $this;
    }

    public function goToBeginning(): FileParser
    {
        return $this->setStartLine(0);
    }

    public function goToEnd(): FileParser
    {
        return $this->setStartLine($this->getFileLinesCount() - $this->linesCount);
    }

    public function getFileLinesCount(): int
    {
        $this->file->seek(PHP_INT_MAX);
        return $this->file->key() + 1;
    }

    public function getLines(): Collection
    {
        $startLine = $this->startLine;
        $endLine = $startLine + $this->linesCount;
        $result = collect();
        $this->file->seek($startLine);
        while (!$this->file->eof() && $startLine != $endLine) {
            $this->file->seek($startLine);
            $result->push($this->file->current());
            $startLine++;
        }

        return $result;
    }

    public function hasNext(): bool
    {
        return !$this->file->eof();
    }

    public function hasPrevious(): bool
    {
        return $this->startLine != 0;
    }
}