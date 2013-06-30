<?php

namespace PhpGedcom\Parser;

/**
 * Class ParserFactory
 * @package PhpGedcom\Parser
 */
class ParserFactory
{
    const GEDCOM55 = 'GEDCOM5.5';

    /**
     * Build a parser based on the passed fileType, passing the file to the newly created parser.
     *
     * @param string $file
     * @param string $fileType
     * @return AbstractFileParser
     * @throws \Exception
     */
    public static function createParser($file, $fileType)
    {
        switch ($fileType) {
            case self::GEDCOM55:
                return new Gedcom55Parser($file);
                break;
            default:
                throw new \Exception('Unknown file type: ' . $fileType);
        }
    }
}
