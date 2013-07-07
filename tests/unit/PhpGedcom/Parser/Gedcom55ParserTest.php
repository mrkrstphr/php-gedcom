<?php

namespace PhpGedcom\Parser;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamWrapper;

/**
 * Class Gedcom55Parser
 * @package PhpGedcom\Parser
 */
class Gedcom55ParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Gedcom55Parser
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
            'PhpGedcom\Parser\Gedcom55Parser',
            array(
                $vfsFile
            )
        );
    }

    /**
     * @dataProvider identifierProvider
     * @param string $identifier
     * @param string $parsed
     */
    public function testNormalizeIdentifier($identifier, $parsed)
    {
        $this->assertEquals($parsed, $this->tester->normalizeIdentifier($identifier));
    }

    /**
     * @dataProvider identifierProvider
     * @param string $identifier
     * @param string $parsed
     * @param boolean $result
     */
    public function testIsIdentifier($identifier, $parsed, $result)
    {
        $this->assertEquals($result, $this->tester->isIdentifier($identifier));
    }

    /**
     * Test logging an unhandled record.
     */
    public function testLogUnhandledRecord()
    {
        $this->tester->forward();
        $this->tester->logUnhandledRecord('info');

        $this->assertCount(1, $this->tester->getErrors());
        $this->assertEquals('1: (Unhandled) 0|HEAD - info', current($this->tester->getErrors()));
    }

    /**
     * @return array
     */
    public function identifierProvider()
    {
        // potentialIdentifier, parsedResult, isIdentifier

        return array(
            array('@I001@', 'I001', true),
            array('@FAM0013@', 'FAM0013', true),
            array('@SOURCE1@', 'SOURCE1', true),
            array('@SOURCE1', 'SOURCE1', false),
            array('SOURCE1@', 'SOURCE1', false),
            array('SOURCE1', 'SOURCE1', false),
        );
    }
}
