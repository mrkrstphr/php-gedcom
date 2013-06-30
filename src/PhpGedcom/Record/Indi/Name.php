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
 * Class Name
 * @package PhpGedcom\Record\Indi
 */
class Name extends Record
{
    use NoteableTrait;
    use SourceableTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $npfx;

    /**
     * @var string
     */
    protected $givn;

    /**
     * @var string
     */
    protected $nick;

    /**
     * @var string
     */
    protected $spfx;

    /**
     * @var string
     */
    protected $surn;

    /**
     * @var string
     */
    protected $nsfx;

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
     * @param string $npfx
     */
    public function setNpfx($npfx)
    {
        $this->npfx = $npfx;
    }

    /**
     * @return string
     */
    public function getNpfx()
    {
        return $this->npfx;
    }

    /**
     * @param string $givn
     */
    public function setGivn($givn)
    {
        $this->givn = $givn;
    }

    /**
     * @return string
     */
    public function getGivn()
    {
        return $this->givn;
    }

    /**
     * @param string $nick
     */
    public function setNick($nick)
    {
        $this->nick = $nick;
    }

    /**
     * @return string
     */
    public function getNick()
    {
        return $this->nick;
    }

    /**
     * @param string $nsfx
     */
    public function setNsfx($nsfx)
    {
        $this->nsfx = $nsfx;
    }

    /**
     * @return string
     */
    public function getNsfx()
    {
        return $this->nsfx;
    }

    /**
     * @param string $surn
     */
    public function setSurn($surn)
    {
        $this->surn = $surn;
    }

    /**
     * @return string
     */
    public function getSurn()
    {
        return $this->surn;
    }

    /**
     * @param string $spfx
     */
    public function setSpfx($spfx)
    {
        $this->spfx = $spfx;
    }

    /**
     * @return string
     */
    public function getSpfx()
    {
        return $this->spfx;
    }
}
