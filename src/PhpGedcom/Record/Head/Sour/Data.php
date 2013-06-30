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
namespace PhpGedcom\Record\Head\Sour;

/**
 * Class Data
 * @package PhpGedcom\Record\Head\Sour
 */
class Data extends \PhpGedcom\Record
{
    /**
     * @var string
     */
    protected $data;

    /**
     * @var string
     */
    protected $date;

    /**
     * @var string
     */
    protected $copr;

    /**
     * @param string $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $copr
     */
    public function setCopr($copr)
    {
        $this->copr = $copr;
    }

    /**
     * @return string
     */
    public function getCopr()
    {
        return $this->copr;
    }
}
