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

namespace PhpGedcom\Record;

/**
 *
 */
class RepoRef extends \PhpGedcom\Record implements Noteable
{
    /**
     * @var string
     */
    protected $repo;

    /**
     * @var array
     * @of Caln
     */
    protected $caln = array();

    /**
     * @var array
     * @of Note
     */
    protected $note = array();

    /**
     *
     */
    public function addNote(\PhpGedcom\Record\NoteRef $note)
    {
        $this->_note[] = $note;
    }

    /**
     * @param string $repo
     * @return $this
     */
    public function setRepo($repo)
    {
        $this->repo = $repo;
        return $this;
    }

    /**
     * @return string
     */
    public function getRepo()
    {
        return $this->repo;
    }

    /**
     * @param Caln $caln
     * @return $this
     */
    public function addCaln(Caln $caln)
    {
        $this->caln[] = $caln;
        return $this;
    }

    /**
     * @return array
     */
    public function getCaln()
    {
        return $this->caln;
    }
}
