<?php

namespace PhpGedcom\Record;

use PhpGedcom\Record;

/**
 * Class AbstractNoteRef
 * @package PhpGedcom\Record
 */
class AbstractNoteRef extends Record
{
    use SourceableTrait;

    /**
     *
     */
    protected $_isRef   = false;

    /**
     * @var string
     */
    protected $note;

    /**
     *
     */
    public function setIsReference($isReference = true)
    {
        $this->_isRef = $isReference;
    }

    /**
     *
     */
    public function getIsReference()
    {
        return $this->_isRef;
    }

    /**
     * @param string $note
     * @return $this
     */
    public function setNote($note)
    {
        $this->note = $note;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }
}
