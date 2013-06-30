<?php

namespace PhpGedcom\Record;

use PhpGedcom\Record;

/**
 * Class AbstractEven
 * @package PhpGedcom\Record
 */
abstract class AbstractEven extends Record
{
    use NoteableTrait;
    use ObjectableTrait;
    use SourceableTrait;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $date;

    /**
     * @var AbstractPlac
     */
    protected $plac;

    /**
     * @var string
     */
    protected $caus;

    /**
     * @var integer
     */
    protected $age;

    /**
     * @var AbstractAddr
     */
    protected $addr;

    /**
     * @var array
     * @of Phon
     */
    protected $phon = array();

    /**
     * @var string
     */
    protected $agnc;

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
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
     * @param AbstractPlac $plac
     */
    public function setPlac(AbstractPlac $plac)
    {
        $this->plac = $plac;
    }

    /**
     * @return AbstractPlac
     */
    public function getPlac()
    {
        return $this->plac;
    }

    /**
     * @param string $caus
     */
    public function setCaus($caus)
    {
        $this->caus = $caus;
    }

    /**
     * @return string
     */
    public function getCaus()
    {
        return $this->caus;
    }

    /**
     * @param int $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param AbstractAddr $addr
     */
    public function setAddr(AbstractAddr $addr)
    {
        $this->addr = $addr;
    }

    /**
     * @return AbstractAddr
     */
    public function getAddr()
    {
        return $this->addr;
    }

    /**
     * @param array $phon
     */
    public function setPhon($phon)
    {
        $this->phon = $phon;
    }

    /**
     * @param Phon $phon
     */
    public function addPhon($phon)
    {
        $this->phon[] = $phon;
    }

    /**
     * @return array
     */
    public function getPhon()
    {
        return $this->phon;
    }

    /**
     * @param string $agnc
     */
    public function setAgnc($agnc)
    {
        $this->agnc = $agnc;
    }

    /**
     * @return string
     */
    public function getAgnc()
    {
        return $this->agnc;
    }
}
