<?php

namespace PhpGedcom\Record\Fam;

use PhpGedcom\Record\AbstractEven;
use PhpGedcom\Record\Fam\Even\AbstractHusb;
use PhpGedcom\Record\Fam\Even\AbstractWife;

/**
 * Class AbstractFamEven
 * @package PhpGedcom\Record\Fam
 */
abstract class AbstractFamEven extends AbstractEven
{
    /**
     * @var AbstractHusb
     */
    protected $husb;

    /**
     * @var AbstractWife
     */
    protected $wife;

    /**
     * @param AbstractHusb $husb
     */
    public function setHusb(AbstractHusb $husb)
    {
        $this->husb = $husb;
    }

    /**
     * @return AbstractHusb
     */
    public function getHusb()
    {
        return $this->husb;
    }

    /**
     * @param AbstractWife $wife
     */
    public function setWife(AbstractWife $wife)
    {
        $this->wife = $wife;
    }

    /**
     * @return AbstractWife
     */
    public function getWife()
    {
        return $this->wife;
    }
}
