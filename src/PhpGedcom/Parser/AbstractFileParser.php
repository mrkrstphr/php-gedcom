<?php

namespace PhpGedcom\Parser;

/**
 * Class AbstractFileParser
 * @package PhpGedcom\Parser
 */
abstract class AbstractFileParser
{
    /**
     * Stores a resource pointer to the file being parsed.
     *
     * @var Resource
     */
    protected $file;

    /**
     * Stores a list of errors encountered during the parsing process.
     *
     * @var array
     */
    protected $errors = array();

    /**
     * Keeps track of the number of lines parsed (and the current line, as well).
     *
     * @var integer
     */
    protected $linesParsed = 0;

    /**
     * Stores the current line of the file being parsed.
     *
     * @var string
     */
    protected $line;

    /**
     * An implementation specific line record.
     *
     * @var array
     */
    protected $lineRecord;

    /**
     * Used to keep track of a line as forward() and back() are called.
     *
     * @var string
     */
    protected $returnedLine;

    /**
     * Open the passed file for reading.
     *
     * @param string $file
     */
    public function __construct($file)
    {
        $this->file = fopen($file, 'r');
    }

    /**
     * Moves forward to the next line in the file for parsing. If back() was previously called, the previous
     * line is used.
     *
     * @return $this
     */
    public function forward()
    {
        // if there was a returned line by back(), set that as our current
        // line and blank out the returnedLine variable, otherwise grab
        // the next line from the file

        if (!empty($this->returnedLine)) {
            $this->line = $this->returnedLine;
            $this->returnedLine = '';
        } else {
            $this->line = fgets($this->file);
            $this->linesParsed++;
            $this->lineRecord = null;
        }

        return $this;
    }

    /**
     * Jumps back a line in the file and stores the line for use again by forward(). This is useful for a multi-part
     * file parser that needs to pass off the work to other works, and have those workers only parse lines meant
     * for them.
     *
     * @return $this
     */
    public function back()
    {
        // our parser object encountered a line it wasn't meant to parse
        // store this line for the previous parser to analyze

        $this->returnedLine = $this->line;

        return $this;
    }

    /**
     * Returns if the end of file has been reached.
     *
     * @return bool
     */
    public function eof()
    {
        return feof($this->file);
    }

    /**
     * Returns the current line being parsed.
     *
     * @return string
     */
    public function getCurrentLine()
    {
        return $this->line;
    }

    /**
     * Logs an error to the internal logger.
     *
     * @param string $error
     * @return $this
     */
    protected function logError($error)
    {
        $this->errors[] = $error;
        return $this;
    }

    /**
     * Returns all errors logged.
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * The abstract parse() method needs to be implemented by the extending child class to actually parse the file.
     *
     * @return mixed
     */
    abstract public function parse();
}
