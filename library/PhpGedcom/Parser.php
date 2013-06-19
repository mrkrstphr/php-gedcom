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
 *
 */
class Parser
{
    /**
     *
     */
    protected $_file            = null;
    
    /**
     *
     */
    protected $_gedcom          = null;
    
    /**
     *
     */
    protected $_errorLog        = array();
    
    /**
     *
     */
    protected $_linesParsed     = 0;
    
    /**
     *
     */
    protected $_line            = '';
    
    /**
     *
     */
    protected $_lineRecord      = null;
    
    /**
     *
     */
    protected $_returnedLine    = '';

    protected $path = array();

    /**
     *
     */
    public function __construct(\PhpGedcom\Gedcom $gedcom = null)
    {
        if (!is_null($gedcom)) {
            $this->_gedcom = $gedcom;
        } else {
            $this->_gedcom = new \PhpGedcom\Gedcom();
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
        
        if (!empty($this->_returnedLine)) {
            $this->_line = $this->_returnedLine;
            $this->_returnedLine = '';
        } else {
            $this->_line = fgets($this->_file);
            $this->_lineRecord = null;
            $this->_linesParsed++;
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
        
        $this->_returnedLine = $this->_line;
        
        return $this;
    }
    
    /**
     *
     */
    public function getGedcom()
    {
        return $this->_gedcom;
    }
    
    /**
     *
     */
    public function eof()
    {
        return feof($this->_file);
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
        return $this->_line;
    }
    
    /**
     *
     */
    public function getCurrentLineRecord($pieces = 3)
    {
        if (!is_null($this->_lineRecord)) {
            return $this->_lineRecord;
        }
        
        if (empty($this->_line)) {
            return false;
        }
        
        $line = trim($this->_line);
        
        $this->_lineRecord = explode(' ', $line, $pieces);
        
        return $this->_lineRecord;
    }
    
    /**
     *
     */
    protected function logError($error)
    {
        $this->_errorLog[] = $error;
    }
    
    /**
     *
     */
    public function logUnhandledRecord($additionalInfo = '')
    {
        $this->logError(
            $this->_linesParsed . ': (Unhandled) ' . trim(implode('|', $this->getCurrentLineRecord())) .
            (!empty($additionalInfo) ? ' - ' . $additionalInfo : '')
        );
    }
    
    /**
     *
     */
    public function getErrors()
    {
        return $this->_errorLog;
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
        $this->_file = fopen($fileName, 'r'); #explode("\n", mb_convert_encoding($contents, 'UTF-8'));
        
        if (!$this->_file) {
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
                // Although not always an identifier (HEAD,TRLR):
                $identifier = $this->normalizeIdentifier($record[1]);
               
                if (trim($record[1]) == 'HEAD') {
                    $this->_gedcom->setHead($this->parseRecord());
                } else if (isset($record[2]) && trim($record[2]) == 'SUBN') {
                    $this->_gedcom->setSubn($this->parseRecord());
                } else if (isset($record[2]) && trim($record[2]) == 'SUBM') {
                    $this->_gedcom->addSubm($this->parseRecord());
                    //Parser\Subm::parse($this);
                } else if (isset($record[2]) && $record[2] == 'SOUR') {
                    Parser\Sour::parse($this);
                } else if (isset($record[2]) && $record[2] == 'INDI') {
                    Parser\Indi::parse($this);
                } else if (isset($record[2]) && $record[2] == 'FAM') {
                    Parser\Fam::parse($this);
                } else if (isset($record[2]) && substr(trim($record[2]), 0, 4) == 'NOTE') {
                    Parser\Note::parse($this);
                } else if (isset($record[2]) && $record[2] == 'REPO') {
                    Parser\Repo::parse($this);
                } else if (isset($record[2]) && $record[2] == 'OBJE') {
                    Parser\Obje::parse($this);
                } else if (trim($record[1]) == 'TRLR') {
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
                                call_user_func(array($object, 'set' . $recordType), $this->prepareData($record[2]));
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
