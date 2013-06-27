<?php

namespace PhpGedcom\Record;

use PhpGedcom\Record;

/**
 * Class AbstractPlac
 * @package PhpGedcom\Record
 */
abstract class AbstractPlac extends Record
{
    use NoteableTrait;
    use SourceableTrait;

    /**
     * @var string
     */
    protected $plac;

    /**
     * @var string
     */
    protected $form;

    /**
     * @param string $form
     * @return $this
     */
    public function setForm($form)
    {
        $this->form = $form;
        return $this;
    }

    /**
     * @return string
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param string $plac
     * @return $this
     */
    public function setPlac($plac)
    {
        $this->plac = $plac;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlac()
    {
        return $this->plac;
    }

    /**
     * @return array
     */
    public function getNote()
    {
        return $this->note;
    }
}
