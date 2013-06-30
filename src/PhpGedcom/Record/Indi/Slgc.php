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

/**
 * Class Slgc
 * @package PhpGedcom\Record\Indi
 */
class Slgc extends Lds
{
    /**
     * @var string
     */
    protected $famc;

    /**
     * @param mixed $famc
     */
    public function setFamc($famc)
    {
        $this->famc = $famc;
    }

    /**
     * @return mixed
     */
    public function getFamc()
    {
        return $this->famc;
    }
}
