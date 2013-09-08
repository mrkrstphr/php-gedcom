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
     * @var string
     */
    protected $vfsFile;

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

        $this->vfsFile = vfsStream::url('test/file.ged');
        file_put_contents($this->vfsFile, "0 HEAD\n1 SOUR PhpGedcom\n0 TRLF\n");

        $this->tester = $this->getMockForAbstractClass(
            'PhpGedcom\Parser\Gedcom55Parser',
            array($this->vfsFile)
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
     * Tests registering a simple custom tag.
     */
    public function testRegisterSimpleCustomTag()
    {
        $this->tester->registerCustomTag(
            'PhpGedcom\Record\Subm',
            'Email'
        );

        $tags = $this->tester->getCustomTags();

        $this->assertCount(1, $tags);
        $this->assertEquals(
            array(
                'PhpGedcom\Record\Subm' => array(
                    'email' => array(
                        'nodeClass' => 'PhpGedcom\Record\Subm', 'tag' => 'Email', 'valueObject' => null
                    )
                )
            ),
            $tags
        );
    }

    /**
     * Tests registering a custom tag with a value object.
     */
    public function testRegisterCustomTagWithValueObject()
    {
        $this->tester->registerCustomTag(
            'PhpGedcom\Record\Indi',
            'Map',
            'PhpGedcomTest\Parser\TestCustomTag'
        );

        $tags = $this->tester->getCustomTags();

        $this->assertCount(1, $tags);
        $this->assertEquals(
            array(
                'PhpGedcom\Record\Indi' => array(
                    'map' => array(
                        'nodeClass' => 'PhpGedcom\Record\Indi',
                        'tag' => 'Map',
                        'valueObject' => 'PhpGedcomTest\Parser\TestCustomTag'
                    )
                )
            ),
            $tags
        );
    }

    /**
     * Test parsing a simple custom tag.
     */
    public function testParsingSimpleCustomTag()
    {
        file_put_contents(
            $this->vfsFile,
            "0 HEAD\n1 SOUR PhpGedcom\n0 @SUBMITTER@ SUBM\n" .
            "1 NAME John A. Nairn\n1 EMAIL john.a.nairn@gedcom.com\n0 TRLF"
        );

        $parser = new Gedcom55Parser($this->vfsFile);
        $parser->registerCustomTag(
            'PhpGedcom\Record\Subm',
            'Email'
        );

        $gedcom = $parser->parse();
        $subm = current($gedcom->getSubm());

        $this->assertEquals('john.a.nairn@gedcom.com', $subm->getCustomTagValue('email'));
    }

    /**
     * Tests parsing a custom tag with a value object.
     */
    public function testParsingCustomTagWithValueObject()
    {
        $this->markTestIncomplete();
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
