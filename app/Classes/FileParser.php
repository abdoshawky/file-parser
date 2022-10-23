<?php

namespace App\Classes;

use Illuminate\Support\Collection;
use SplFileObject;

class FileParser
{
    private SplFileObject $file;
    private int $startLine = 0;
    private int $linesCount = 10;

    /**
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->file = new SplFileObject($path, "r");
    }

    /**
     * @return int
     */
    public function getStartLine(): int
    {
        return $this->startLine;
    }

    /**
     * @param $line
     * @return $this
     */
    public function setStartLine($line): FileParser
    {
        $this->startLine = $line;
        return $this;
    }

    /**
     * @return int
     */
    public function getLinesCount(): int
    {
        return $this->linesCount;
    }

    /**
     * @param $count
     * @return $this
     */
    public function setLinesCount($count): FileParser
    {
        $this->linesCount = $count;
        return $this;
    }

    /**
     * @return $this
     */
    public function goToBeginning(): FileParser
    {
        return $this->setStartLine(0);
    }

    /**
     * @return $this
     */
    public function goToEnd(): FileParser
    {
        return $this->setStartLine($this->getFileLinesCount() - $this->linesCount);
    }

    /**
     * @return int
     */
    public function getFileLinesCount(): int
    {
        $this->file->seek(PHP_INT_MAX);
        return $this->file->key() + 1;
    }

    /**
     * @return Collection
     */
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

    /**
     * @return bool
     */
    public function hasNext(): bool
    {
        return !$this->file->eof();
    }

    /**
     * @return bool
     */
    public function hasPrevious(): bool
    {
        return $this->startLine != 0;
    }
}