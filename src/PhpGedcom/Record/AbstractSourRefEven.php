<?php

namespace PhpGedcom\Record;

use PhpGedcom\Record;

/**
 * Class AbstractSourRefEven
 * @package PhpGedcom\Record
 */
class AbstractSourRefEven extends Record
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
