<?php

namespace PhpGedcom\Parser;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamWrapper;

/**
 * Class AbstractFileParserTest
 * @package PhpGedcom\Parser
 */
class AbstractFileParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AbstractFileParser
     */
    protected $tester;

    /**
     * Setup a mock file parser for testing of the core functionality.
     */
    public function setUp()
    {
        vfsStreamWrapper::register();
        vfsStreamWrapper::setRoot(new vfsStreamDirectory('test'));

        $vfsFile = vfsStream::url('test/file.ged');
        file_put_contents($vfsFile, "0 HEAD\n1 SOUR PhpGedcom\n0 TRLF\n");

        $this->tester = $this->getMockForAbstractClass(
            'PhpGedcom\Parser\AbstractFileParser',
            array(
                $vfsFile
            )
        );
    }

    /**
     * Test that there are no errors, initially.
     */
    public function testNoErrors()
    {
        $this->assertCount(0, $this->tester->getErrors());
    }

    /**
     * Test that error logging works properly.
     */
    public function testErrorLogging()
    {
        $this->tester->logError('Error message');

        $this->assertCount(1, $this->tester->getErrors());
    }

    /**
     * Test that the current line is empty without advancing.
     */
    public function testEmptyLine()
    {
        $this->assertNull($this->tester->getCurrentLine());
    }

    /**
     * Test that going forward in the file works.
     */
    public function testForward()
    {
        $this->tester->forward();

        $this->assertEquals("0 HEAD\n", $this->tester->getCurrentLine());
    }

    /**
     * Test that going forward, back, and forward again lands on the correct line of the file.
     */
    public function testForwardBackForward()
    {
        $this->tester->forward()->back()->forward();

        $this->assertEquals("0 HEAD\n", $this->tester->getCurrentLine());
    }

    /**
     * Test that EOF condition is met properly.
     */
    public function testEof()
    {
        $this->assertFalse($this->tester->eof());

        $this->tester->forward()->forward()->forward();

        $this->assertTrue($this->tester->eof());
    }
}
