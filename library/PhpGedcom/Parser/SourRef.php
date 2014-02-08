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

namespace PhpGedcom\Parser;

/**
 *
 *
 */
class SourRef extends \PhpGedcom\Parser\Component
{

    /**
     *
     *
     */
    public static function parse(\PhpGedcom\Parser $parser)
    {
        $record = $parser->getCurrentLineRecord();
        $depth = (int)$record[0];

        $sour = new \PhpGedcom\Record\SourRef();

        if(preg_match('/^@.*@$/',$record[2])){
            $isReference = true;
            $sour->setIsReference(true);
            $identifier = $parser->normalizeIdentifier($record[2]);
            $sour->setSour($identifier);
        }else{
            $isReference = false;
            $sour->setIsReference(false);
            $sour->setSour($record[2]);
        }


        $parser->forward();

        while (!$parser->eof()) {
            $record = $parser->getCurrentLineRecord();
            $recordType = strtoupper(trim($record[1]));
            $currentDepth = (int)$record[0];

            if ($currentDepth <= $depth) {
                $parser->back();
                break;
            }

            if($isReference){
                switch ($recordType) {
                case 'NOTE': 
                    $note = \PhpGedcom\Parser\NoteRef::parse($parser);
                    $sour->addNote($note);
                    break;
                case 'DATA':
                    $sour->setData(\PhpGedcom\Parser\Sour\Data::parse($parser));
                    break;
                case 'QUAY':
                    $sour->setQuay(trim($record[2]));
                    break;
                case 'PAGE':
                    $sour->setPage(trim($record[2]));
                    break;
                case 'EVEN':
                    $even = \PhpGedcom\Parser\SourRef\Even::parse($parser);
                    $sour->setEven($even);
                    break;
                case 'OBJE':
                    $obje = \PhpGedcom\Parser\ObjeRef::parse($parser);
                    $sour->addObje($obje);
                    break;
                default:
                    $parser->logUnhandledRecord(get_class() . ' @ ' . __LINE__);
                }
            } else {
                switch ($recordType) {
                case 'CONT': 
                    $sour->setSour($sour->getSour() . "\n");
                    if (isset($record[2])) {
                        $sour->setSour($sour->getSour() . $record[2]);
                    }
                    break;
                case 'CONC':
                    if (isset($record[2])) {
                        $sour->setSour($sour->getSour() . $record[2]);
                    }
                    break;
                case 'TEXT':
                    $sour->setText($parser->parseMultiLineRecord());
                    break;
                case 'NOTE':
                    $note = \PhpGedcom\Parser\NoteRef::parse($parser);
                    $sour->addNote($note);
                    break;
                default:
                    $parser->logUnhandledRecord(get_class() . ' @ ' . __LINE__);
                }
            }

            $parser->forward();
        }

        return $sour;
    }
}
