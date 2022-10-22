<?php

namespace Tests\Unit;

use App\Classes\FileParser;
use PHPUnit\Framework\TestCase;

class FileParserTest extends TestCase
{
    private FileParser $fileParser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->fileParser = new FileParser('public/countries.txt');
    }

    /**
     * @test
     */
    public function it_can_get_start_line()
    {
        $this->assertEquals(0, $this->fileParser->getStartLine());
    }

    /**
     * @test
     */
    public function it_can_set_start_line()
    {
        $this->fileParser->setStartLine(5);
        $this->assertEquals(5, $this->fileParser->getStartLine());
    }

    /**
     * @test
     */
    public function it_can_get_lines_count()
    {
        $this->assertEquals(10, $this->fileParser->getLinesCount());
    }

    /**
     * @test
     */
    public function it_can_set_lines_count()
    {
        $this->fileParser->setLinesCount(5);
        $this->assertEquals(5, $this->fileParser->getLinesCount());
        $this->assertCount(5, $this->fileParser->getLines());
    }

    /**
     * @test
     */
    public function it_can_go_to_the_beginning_of_the_file()
    {
        $this->fileParser->goToBeginning();
        $this->assertEquals(0, $this->fileParser->getStartLine());
    }

    /**
     * @test
     */
    public function it_can_go_to_the_end_of_the_file()
    {
        $this->fileParser->goToEnd();
        $this->assertEquals(10, $this->fileParser->getStartLine()); // file lines count is 20
    }

    /**
     * @test
     */
    public function it_can_get_file_lines_count()
    {
        $this->assertEquals(20, $this->fileParser->getFileLinesCount());
    }

    /**
     * @test
     */
    public function it_can_get_lines()
    {
        $lines = $this->fileParser->getLines();
        $this->assertIsArray($lines->toArray());
        $this->assertCount(10, $lines);
    }

    /**
     * @test
     */
    public function it_can_tell_if_there_is_still_lines_to_read()
    {
        $this->fileParser->goToBeginning();
        $this->assertTrue($this->fileParser->hasNext());
    }

    /**
     * @test
     */
    public function it_can_tell_if_there_is_no_more_lines_to_read()
    {
        $this->fileParser->goToEnd();
        $this->assertFalse($this->fileParser->hasNext());
    }
}
