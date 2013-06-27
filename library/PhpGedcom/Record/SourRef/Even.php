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

namespace PhpGedcom\Record\SourRef;

use PhpGedcom\Record;

/**
 * Class Even
 * @package PhpGedcom\Record\SourRef
 */
class Even extends Record
{
    /**
     * @var string
     */
    protected $even;

    /**
     * @var string
     */
    protected $role;

    /**
     * @param string $even
     */
    public function setEven($even)
    {
        $this->even = $even;
    }

    /**
     * @return string
     */
    public function getEven()
    {
        return $this->even;
    }

    /**
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }
}
