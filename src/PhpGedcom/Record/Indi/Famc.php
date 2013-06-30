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
use PhpGedcom\Record;

/**
 * Class Famc
 * @package PhpGedcom\Record\Indi
 */
class Famc extends Record
{
    use NoteableTrait;

    /**
     * @var string
     */
    protected $famc;

    /**
     * @var string
     */
    protected $pedi;

    /**
     * @param string $famc
     */
    public function setFamc($famc)
    {
        $this->famc = $famc;
    }

    /**
     * @return string
     */
    public function getFamc()
    {
        return $this->famc;
    }

    /**
     * @param string $pedi
     */
    public function setPedi($pedi)
    {
        $this->pedi = $pedi;
    }

    /**
     * @return string
     */
    public function getPedi()
    {
        return $this->pedi;
    }
}
