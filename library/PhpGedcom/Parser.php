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

namespace PhpGedcom;

use zpt\anno\Annotations;

/**
 * Class Parser
 * @package PhpGedcom
 */
class Parser
{
    /**
     * Stores a resource pointer to the file being parsed.
     *
     * @var Resource
     */
    protected $file = null;
    
    /**
     * Stores the GEDCOM objecting being built.
     *
     * @var \PhpGedcom\Record\Gedcom
     */
    protected $gedcom;
    
    /**
     * Stores a list of errors encountered during the parsing process.
     *
     * @var array
     */
    protected $errors = array();
    
    /**
     * @var integer
     */
    protected $linesParsed = 0;
    
    /**
     * @var string
     */
    protected $line;
    
    /**
     * @var array
     */
    protected $lineRecord;
    
    /**
     * @var string
     */
    protected $returnedLine;

    /**
     * A stack to keep track of the current path through the GEDCOM file during parsing.
     *
     * @var array
     */
    protected $path = array();

    /**
     *
     */
    public function __construct(\PhpGedcom\Gedcom $gedcom = null)
    {
        if (!is_null($gedcom)) {
            $this->gedcom = $gedcom;
        } else {
            $this->gedcom = new \PhpGedcom\Gedcom();
        }
    }
    
    /**
     *
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
            $this->lineRecord = null;
            $this->linesParsed++;
        }
        
        return $this;
    }
    
    /**
     *
     */
    public function back()
    {
        // our parser object encountered a line it wasn't meant to parse
        // store this line for the previous parser to analyze
        
        $this->returnedLine = $this->line;
        
        return $this;
    }
    
    /**
     *
     */
    public function getGedcom()
    {
        return $this->gedcom;
    }
    
    /**
     *
     */
    public function eof()
    {
        return feof($this->file);
    }
    
    /**
     *
     * @return string
     */
    public function parseMultiLineRecord()
    {
        $record = $this->getCurrentLineRecord();
        
        $depth = (int)$record[0];
        $data = isset($record[2]) ? trim($record[2]) : '';
        
        $this->forward();
        
        while (!$this->eof()) {
            $record = $this->getCurrentLineRecord();
            $recordType = strtoupper(trim($record[1]));
            $currentDepth = (int)$record[0];
            
            if ($currentDepth <= $depth) {
                $this->back();
                break;
            }
            
            switch ($recordType) {
                case 'CONT':
                    $data .= "\n";
                    
                    if (isset($record[2])) {
                        $data .= trim($record[2]);
                    }
                    break;
                case 'CONC':
                    if (isset($record[2])) {
                        $data .= ' ' . trim($record[2]);
                    }
                    break;
                default:
                    $this->back();
                    break 2;
            }
            
            $this->forward();
        }
        
        return $data;
    }
    
    /**
     * 
     * @return string The current line
     */
    public function getCurrentLine()
    {
        return $this->line;
    }
    
    /**
     *
     */
    public function getCurrentLineRecord($pieces = 3)
    {
        if (!is_null($this->lineRecord)) {
            return $this->lineRecord;
        }
        
        if (empty($this->line)) {
            return false;
        }
        
        $line = trim($this->line);
        
        $this->lineRecord = explode(' ', $line, $pieces);
        
        return $this->lineRecord;
    }
    
    /**
     *
     */
    protected function logError($error)
    {
        $this->errors[] = $error;
    }
    
    /**
     *
     */
    public function logUnhandledRecord($additionalInfo = '')
    {
        $this->logError(
            $this->linesParsed . ': (Unhandled) ' . trim(implode('|', $this->getCurrentLineRecord())) .
            (!empty($additionalInfo) ? ' - ' . $additionalInfo : '')
        );
    }
    
    /**
     *
     */
    public function getErrors()
    {
        return $this->errors;
    }
    
    /**
     *
     */
    public function normalizeIdentifier($identifier)
    {
        $identifier = trim($identifier);
        $identifier = trim($identifier, '@');
        
        return $identifier;
    }
    
    /**
     *
     * @param string $fileName
     * @return Gedcom
     */
    public function parse($fileName)
    {
        $this->file = fopen($fileName, 'r'); #explode("\n", mb_convert_encoding($contents, 'UTF-8'));
        
        if (!$this->file) {
            return null;
        }
        
        $this->forward();
        
        while (!$this->eof()) {
            $record = $this->getCurrentLineRecord();
            
            if ($record === false) {
                continue;
            }

            $depth = (int)$record[0];

            // We only process 0 level records here. Sub levels are processed
            // in methods for those data types (individuals, sources, etc)
            
            if ($depth == 0) {
                if (trim($record[1]) == 'HEAD') {
                    $this->gedcom->setHead($this->parseRecord());
                } elseif (isset($record[2]) && trim($record[2]) == 'SUBN') {
                    $this->gedcom->setSubn($this->parseRecord());
                } elseif (isset($record[2]) && trim($record[2]) == 'SUBM') {
                    $this->gedcom->addSubm($this->parseRecord());
                } elseif (isset($record[2]) && $record[2] == 'SOUR') {
                    $this->gedcom->addSour($this->parseRecord());
                } elseif (isset($record[2]) && $record[2] == 'INDI') {
                    Parser\Indi::parse($this);
                } elseif (isset($record[2]) && $record[2] == 'FAM') {
                    Parser\Fam::parse($this);
                } elseif (isset($record[2]) && substr(trim($record[2]), 0, 4) == 'NOTE') {
                    Parser\Note::parse($this);
                } elseif (isset($record[2]) && $record[2] == 'REPO') {
                    Parser\Repo::parse($this);
                } elseif (isset($record[2]) && $record[2] == 'OBJE') {
                    $this->gedcom->addObje($this->parseRecord());
                } elseif (trim($record[1]) == 'TRLR') {
                    // EOF
                    break;
                } else {
                    $this->logUnhandledRecord(get_class() . ' @ ' . __LINE__);
                }
            } else {
                $this->logUnhandledRecord(get_class() . ' @ ' . __LINE__);
            }

            $this->forward();
        }

        return $this->getGedcom();
    }

    /**
     *
     */
    public function parseRecord()
    {
        $record = $this->getCurrentLineRecord();
        $depth = (int)$record[0];
        $identifier = $this->normalizeIdentifier($record[1]);

        // The nodeType is the piece of data we are trying to store (NAME, DATE, SOUR, etc).
        $nodeType = trim($record[1]);

        $data = null;

        // At 0 level depth, the identifier comes after the nodeType (except for HEAD);
        if ($depth == 0 && $identifier !== 'HEAD') {
            $nodeType = trim($record[2]);
            $data = $this->prepareData($record[1]);
        } elseif ($depth > 0 && isset($record[2])) {
            $data = $this->prepareData($record[2]);
        }

        // Keep track of the previous (non CONT or CONC) node for concatenated values:s
        $previousNode = '';

        // Push this node onto the stack of our namespace path:
        array_push($this->path, ucfirst(strtolower($nodeType)));

        // Implode the stack to find the fully qualified namespace of the node:
        $className = '\\PhpGedcom\Record\\' . implode('\\', $this->path);

        if (!class_exists($className, true)) {
            throw new \Exception('Unknown object type: ' . $className);
        }

        // Create the object from our fully qualified namespace we've built:
        $object = new $className();
        $classReflector = new \ReflectionClass(get_class($object));

        if (isset($record[2]) && $classReflector->hasProperty(strtolower($nodeType))) {
            $property = $classReflector->getProperty(strtolower($nodeType));
            $annotations = new Annotations($property);

            if ($annotations->hasAnnotation('var')) {
                $param = explode(' ', $annotations['var']);
                if (in_array($param[0], array('string', 'integer', 'float'))) {
                    if ($classReflector->hasMethod('set' . ucfirst(strtolower($nodeType)))) {
                        call_user_func(array($object, 'set' . $nodeType), $data);
                    }

                    // if we actually have content here, make sure to mark it as the previous node for
                    // concatenation sake
                    $previousNode = ucfirst(strtolower($nodeType));
                }
            } else {

            }
        }

        $this->forward();

        while (!$this->eof()) {
            $record = $this->getCurrentLineRecord();
            $currentDepth = (int)$record[0];
            $recordType = ucwords(strtolower(trim($record[1])));

            if ($currentDepth <= $depth) {
                $this->back();
                break;
            }

            if ($recordType == 'Cont' || $recordType == 'Conc') {
                if (!empty($previousNode)) {
                    $currentValue = call_user_func(array($object, 'get' . $previousNode)) . "\n";

                    if (!empty($record[2])) {
                        $currentValue .= $this->prepareData($record[2]);
                    }

                    call_user_func(array($object, 'set' . $previousNode), $currentValue);
                }
            } else {
                if ($classReflector->hasProperty(strtolower($recordType))) {
                    $property = $classReflector->getProperty(strtolower($recordType));
                    $annotations = new Annotations($property);

                    if ($annotations->hasAnnotation('var')) {
                        $param = explode(' ', $annotations['var']);

                        if (in_array($param[0], array('string', 'integer', 'float'))) {
                            if ($classReflector->hasMethod('set' . $recordType)) {
                                if (isset($record[2])) {
                                    call_user_func(array($object, 'set' . $recordType), $this->prepareData($record[2]));
                                }
                            } else {
                                throw new \Exception('Missing setter for ' . $classReflector->getName() . '::' . $property->getName());
                            }
                        } elseif ($param[0] == 'array') {
                            if ($annotations->hasAnnotation('of')) {
                                if ($classReflector->hasMethod('add' . $recordType)) {
                                    call_user_func(array($object, 'add' . $recordType), $this->parseRecord());
                                } else {
                                    throw new \Exception('Missing adder for ' . $classReflector->getName() . '::' . $property->getName());
                                }
                            } else {
                                if ($classReflector->hasMethod('add' . $recordType) && isset($record[2])) {
                                    call_user_func(array($object, 'add' . $recordType), $this->prepareData($record[2]));
                                } else {
                                    throw new \Exception('Missing adder for ' . $classReflector->getName() . '::' . $property->getName());
                                }
                            }
                        } else {
                            if ($classReflector->hasMethod('set' . $recordType)) {
                                call_user_func(array($object, 'set' . $recordType), $this->parseRecord());
                            } else {
                                throw new \Exception('Missing adder for ' . $classReflector->getName() . '::' . $property->getName());
                            }
                        }
                    } else {
                        throw new \Exception('Missing @var docblock for ' . $classReflector->getName() . '::' . $recordType);
                    }
                } else {
                    $this->logUnhandledRecord(get_class() . ' @ ' . __LINE__);
                }
            }

            $this->forward();

            // For anything but CONC and CONT, store the current node in previousNode to allow for concatenation:
            if (!in_array($recordType, array('Conc', 'Cont'))) {
                $previousNode = $recordType;
            }
        }

        // Now that we're done parsing this node, pop it off our namespace path:
        array_pop($this->path);

        return $object;
    }

    /**
     * @param string $value
     * @return string
     */
    protected function prepareData($value)
    {
        if (substr($value, 0, 1) == '@' && substr($value, strlen($value) - 1) == '@') {
            return $this->normalizeIdentifier($value);
        }

        return $value;
    }
}
