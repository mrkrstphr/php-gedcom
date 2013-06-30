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
     * @var boolean
     */
    protected $isRef = false;

    /**
     * @var string
     */
    protected $note;

    /**
     * @param bool $isReference
     */
    public function setIsReference($isReference = true)
    {
        $this->isRef = $isReference;
    }

    /**
     * @return bool
     */
    public function getIsReference()
    {
        return $this->isRef;
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
