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

namespace PhpGedcom\Record\Indi;

use PhpGedcom\Record\NoteableTrait;
use PhpGedcom\Record\SourceableTrait;
use PhpGedcom\Record;

/**
 * Class Asso
 * @package PhpGedcom\Record\Indi
 */
class Asso extends Record
{
    use NoteableTrait;
    use SourceableTrait;

    /**
     * @var string
     */
    protected $indi;

    /**
     * @var string
     */
    protected $rela;

    /**
     * @param string $indi
     */
    public function setIndi($indi)
    {
        $this->indi = $indi;
    }

    /**
     * @return string
     */
    public function getIndi()
    {
        return $this->indi;
    }

    /**
     * @param string $rela
     */
    public function setRela($rela)
    {
        $this->rela = $rela;
    }

    /**
     * @return string
     */
    public function getRela()
    {
        return $this->rela;
    }
}
