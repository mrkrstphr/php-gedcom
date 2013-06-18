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

namespace PhpGedcom\Record\Head;

/**
 * Class Sour
 * @package PhpGedcom\Record\Head
 */
class Sour extends \PhpGedcom\Record
{
    /**
     * @var string
     */
    protected $sour;
    
    /**
     * @var string
     */
    protected $vers;
    
    /**
     * @var string
     */
    protected $name;
    
    /**
     * @var Sour\Corp
     */
    protected $corp;
    
    /**
     * @var Sour\Data
     */
    protected $data;

    /**
     *
     * @param Sour\Corp $corp
     */
    public function setCorp(Sour\Corp $corp)
    {
        $this->corp = $corp;
    }
    
    /**
     *
     * @return Sour\Corp
     */
    public function getCorp()
    {
        return $this->corp;
    }
    
    /**
     * 
     * @param Sour\Data $data
     */
    public function setData(Sour\Data $data)
    {
        $this->data = $data;
    }
    
    /**
     *
     * @return Sour\Data
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $sour
     */
    public function setSour($sour)
    {
        $this->sour = $sour;
    }

    /**
     * @return string
     */
    public function getSour()
    {
        return $this->sour;
    }

    /**
     * @param string $vers
     */
    public function setVers($vers)
    {
        $this->vers = $vers;
    }

    /**
     * @return string
     */
    public function getVers()
    {
        return $this->vers;
    }
}
