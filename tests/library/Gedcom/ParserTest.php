<?php
/**
 * php-gedcom
 *
 * php-gedcom is a library for parsing, manipulating, importing and exporting
 * GEDCOM 5.5 files in PHP 5.3+.
 *
 * @author          Kristopher Wilson <kristopherwilson@gmail.com>
 * @copyright       Copyright (c) 2010-2013, Kristopher Wilson
 * @package         php-gedcom
 * @license         GPL-3.0
 * @link            http://github.com/mrkrstphr/php-gedcom
 */

namespace PhpGedcomTest;

use PhpGedcom\Parser;

/**
 * Class ParserTest
 * @package PhpGedcomTest
 */
class ParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PhpGedcom\Parser
     */
    protected $parser  = null;
    
    /**
     * @var \PhpGedcom\Gedcom
     */
    protected $gedcom  = null;
    
    /**
     *
     */
    public function setUp()
    {
        $this->parser = new Parser();
        $this->gedcom = $this->parser->parse(TEST_DIR . '/stresstestfiles/TGC551LF.ged');
    }

    /**
     *
     */
    public function testNoErrors()
    {
        $this->assertEquals(1, count($this->parser->getErrors()));
    }

    /**
     *
     */
    public function testRecordCounts()
    {
        $this->assertCount(15, $this->gedcom->getIndi());
        $this->assertCount(7, $this->gedcom->getFam());
        $this->assertCount(2, $this->gedcom->getSour());
        $this->assertCount(33, $this->gedcom->getNote());
        $this->assertCount(1, $this->gedcom->getObje());
        $this->assertCount(1, $this->gedcom->getRepo());
    }

    /**
     *
     */
    public function testHead()
    {
        $head = $this->gedcom->getHead();

        $this->assertEquals('GEDitCOM', $head->getSour()->getSour());
        $this->assertEquals('GEDitCOM', $head->getSour()->getName());
        $this->assertEquals('2.9.4', $head->getSour()->getVers());
        $this->assertEquals('RSAC Software', $head->getSour()->getCorp()->getCorp());
        $this->assertEquals(
            "7108 South Pine Cone Street\nSalt Lake City, UT 84121\nUSA",
            $head->getSour()->getCorp()->getAddr()->getAddr()
        );
        $this->assertEquals('Salt Lake City', $head->getSour()->getCorp()->getAddr()->getCity());
        $this->assertEquals('UT', $head->getSour()->getCorp()->getAddr()->getStae());
        $this->assertEquals('84121', $head->getSour()->getCorp()->getAddr()->getPost());
        $this->assertEquals('USA', $head->getSour()->getCorp()->getAddr()->getCtry());

        $phon = $head->getSour()->getCorp()->getPhon();

        $this->assertEquals('+1-801-942-7768', $phon[0]);
        $this->assertEquals('+1-801-555-1212', $phon[1]);
        $this->assertEquals('+1-801-942-1148 (FAX) (last one!)', $phon[2]);

        $this->assertEquals('Name of source data', $head->getSour()->getData()->getData());
        $this->assertEquals('1 JAN 1998', $head->getSour()->getData()->getDate());
        $this->assertEquals('Copyright of source data', $head->getSour()->getData()->getCopr());

        $this->assertEquals('SUBMITTER', $head->getSubm());
        $this->assertEquals('SUBMISSION', $head->getSubn());

        $this->assertEquals('ANSTFILE', $head->getDest());

        $this->assertEquals('1 JAN 1998', $head->getDate()->getDate());
        $this->assertEquals('13:57:24.80', $head->getDate()->getTime());

        $this->assertEquals('TGC55C.ged', $head->getFile());

        $this->assertEquals('5.5', $head->getGedc()->getVers());
        $this->assertEquals('LINEAGE-LINKED', $head->getGedc()->getForm());

        $this->assertEquals('English', $head->getLang());

        $this->assertEquals('ANSEL', $head->getChar()->getChar());
        $this->assertEquals('ANSI Z39.47-1985', $head->getChar()->getVers());

        $this->assertEquals('City, County, State, Country', $head->getPlac()->getForm());
        $this->assertEquals('SUBMISSION', $head->getSubn());
    }

    /**
     *
     */
    public function testSubn()
    {
        $subn = $this->gedcom->getSubn();

        $this->assertEquals('SUBMISSION', $subn->getSubn());
        $this->assertEquals('SUBMITTER', $subn->getSubm());
        $this->assertEquals('NameOfFamilyFile', $subn->getFamf());
        $this->assertEquals('Abbreviated Temple Code', $subn->getTemp());
        $this->assertEquals('1', $subn->getAnce());
        $this->assertEquals('1', $subn->getDesc());
        $this->assertEquals('yes', $subn->getOrdi());
        $this->assertEquals('1', $subn->getRin());
    }

    /**
     *
     */
    public function testSubm()
    {
        $subm = $this->gedcom->getSubm();

        $this->assertEquals('SUBMITTER', $subm['SUBMITTER']->getSubm());
        $this->assertEquals('John A. Nairn', $subm['SUBMITTER']->getName());
        $this->assertEquals(
            "Submitter address line 1\n" .
            "Submitter address line 2\n" .
            "Submitter address line 3\n" .
            "Submitter address line 4",
            $subm['SUBMITTER']->getAddr()->getAddr()
        );

        $this->assertEquals('Submitter address line 1', $subm['SUBMITTER']->getAddr()->getAdr1());
        $this->assertEquals('Submitter address line 2', $subm['SUBMITTER']->getAddr()->getAdr2());
        $this->assertEquals('Submitter address city', $subm['SUBMITTER']->getAddr()->getCity());
        $this->assertEquals('Submitter address state', $subm['SUBMITTER']->getAddr()->getStae());
        $this->assertEquals('Submitter address ZIP code', $subm['SUBMITTER']->getAddr()->getPost());
        $this->assertEquals('Submitter address country', $subm['SUBMITTER']->getAddr()->getCtry());

        $phon = $subm['SUBMITTER']->getPhon();
        $this->assertEquals('Submitter phone number 1', $phon[0]->getPhon());
        $this->assertEquals('Submitter phone number 2', $phon[1]->getPhon());
        $this->assertEquals('Submitter phone number 3 (last one!)', $phon[2]->getPhon());

        $lang = $subm['SUBMITTER']->getLang();
        $this->assertEquals('English', $lang[0]);
        $this->assertEquals('7 Sep 2000', $subm['SUBMITTER']->getChan()->getDate());
        $this->assertEquals('8:35:36', $subm['SUBMITTER']->getChan()->getTime());
        $this->assertEquals('Submitter Registered RFN', $subm['SUBMITTER']->getRfn());
        $this->assertEquals('1', $subm['SUBMITTER']->getRin());

        $obje = current($subm['SUBMITTER']->getObje());
        $this->assertEquals('jpeg', $obje->getForm());
        $this->assertEquals('Submitter Multimedia File', $obje->getTitl());
        $this->assertEquals('ImgFile.JPG', $obje->getFile());

        $note = current($obje->getNote());
        $this->assertEquals('N1', $note->getNote());


        $this->assertEquals('SM2', $subm['SM2']->getSubm());
        $this->assertEquals('Secondary Submitter', $subm['SM2']->getName());
        $this->assertEquals(
            "Secondary Submitter Address 1\n" .
            "Secondary Submitter Address 2",
            $subm['SM2']->getAddr()->getAddr()
        );

        $lang = $subm['SM2']->getLang();
        $this->assertEquals('English', $lang[0]);
        $this->assertEquals('12 Mar 2000', $subm['SM2']->getChan()->getDate());
        $this->assertEquals('10:38:33', $subm['SM2']->getChan()->getTime());
        $this->assertEquals('2', $subm['SM2']->getRin());


        $this->assertEquals('SM3', $subm['SM3']->getSubm());
        $this->assertEquals('H. Eichmann', $subm['SM3']->getName());
        $this->assertEquals(
            "email: h.eichmann@@mbox.iqo.uni-hannover.de\n" .
            "or: heiner_eichmann@@h.maus.de (no more than 16k!!!!)",
            $subm['SM3']->getAddr()->getAddr()
        );
        $this->assertEquals('13 Jun 2000', $subm['SM3']->getChan()->getDate());
        $this->assertEquals('17:07:32', $subm['SM3']->getChan()->getTime());
        $this->assertEquals('3', $subm['SM3']->getRin());
    }

    /**
     *
     */
    public function testIndi()
    {

    }

    /**
     *
     */
    public function testFam()
    {

    }

    /**
     *
     */
    public function testObje()
    {

    }

    /**
     *
     */
    public function testRepo()
    {

    }

    /**
     * Test that source information is parsed correctly.
     */
    public function testSour()
    {
        $sour = $this->gedcom->getSour();

        $secondSource = $sour['SR2'];

        $this->assertEquals('SR2', $secondSource->getSour());
        $this->assertEquals('All I Know About GEDCOM, I Learned on the Internet', $secondSource->getTitl());
        $this->assertEquals('What I Know About GEDCOM', $secondSource->getAbbr());
        $this->assertEquals('Second Source Author', $secondSource->getAuth());
        $this->assertEquals('11 Jan 2001', $secondSource->getChan()->getDate());
        $this->assertEquals('16:21:39', $secondSource->getChan()->getTime());
        $this->assertEquals('2', $secondSource->getRin());
    }

    /**
     * Test that notes are parsed successfully.
     */
    public function testNote()
    {
        $firstNote = current($this->gedcom->getNote());

        $this->assertEquals(
            'Test link to a graphics file about the main Submitter of this file.',
            $firstNote->getNote()
        );

        $this->assertEquals('24 May 1999', $firstNote->getChan()->getDate());
        $this->assertEquals('16:39:55', $firstNote->getChan()->getTime());
    }
}
