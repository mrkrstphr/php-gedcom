<?php

namespace PhpGedcom\Parser;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamWrapper;

/**
 * Class ParserFactoryTest
 * @package PhpGedcom\Parser
 */
class ParserFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test that a parser is property instantiated.
     */
    public function testCreateGedcom55Parser()
    {
        vfsStreamWrapper::register();
        vfsStreamWrapper::setRoot(new vfsStreamDirectory('test'));

        $vfsFile = vfsStream::url('test/file.ged');
        touch($vfsFile);

        $parser = ParserFactory::createParser($vfsFile, ParserFactory::GEDCOM55);

        $this->assertInstanceOf('PhpGedcom\Parser\Gedcom55Parser', $parser);
    }

    /**
     * Test that an exception is thrown if an invalid file type parser is requested.
     *
     * @expectedException \Exception
     */
    public function testCreateInvalidParser()
    {
        vfsStreamWrapper::register();
        vfsStreamWrapper::setRoot(new vfsStreamDirectory('test'));

        $vfsFile = vfsStream::url('test/file.ged');
        touch($vfsFile);

        $parser = ParserFactory::createParser($vfsFile, 'foo');
    }
}
