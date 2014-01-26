<?php

namespace PhpGedcom\Parser;

use zpt\anno\Annotations;
use PhpGedcom\Gedcom;

/**
 * Class Gedcom55Parser
 * @package PhpGedcom\Parser
 */
class Gedcom55Parser extends AbstractFileParser
{
    /**
     * @var array
     */
    protected $fileMap = array();

    /**
     * A stack to keep track of the current path through the GEDCOM file during parsing.
     *
     * @var array
     */
    protected $path = array();

    /**
     * Parses the current line into the lineRecord variable.
     *
     * @return array
     */
    public function getCurrentLineRecord()
    {
        if (!is_null($this->lineRecord)) {
            return $this->lineRecord;
        }

        if (empty($this->line)) {
            return false;
        }

        $pieces = 3;

        if (substr($this->line, 0, 1) == '0') {
            $pieces = 4;
        }

        $line = trim($this->line);

        $this->lineRecord = explode(' ', $line, $pieces);

        return $this->lineRecord;
    }

    /**
     * Logs a line in the file that couldn't be parsed.
     *
     * @param string $additionalInfo
     */
    public function logUnhandledRecord($additionalInfo = '')
    {
        $this->logError(
            $this->linesParsed . ': (Unhandled) ' . trim(implode('|', $this->getCurrentLineRecord())) .
            (!empty($additionalInfo) ? ' - ' . $additionalInfo : '')
        );
    }

    /**
     * Normalizes a Gedcom 5.5 identifier, which is wrapped by @'s.
     *
     * @param string $identifier
     * @return string
     */
    public function normalizeIdentifier($identifier)
    {
        $identifier = trim($identifier);
        $identifier = trim($identifier, '@');

        return $identifier;
    }

    /**
     * Parses the GEDCOM file and returns a PHP Object representation of its contents.
     *
     * @return Gedcom|bool
     */
    public function parse()
    {
        $gedcom = new Gedcom();

        if (!$this->file) {
            return false;
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
                    $gedcom->setHead($this->parseRecord());
                } elseif (isset($record[2]) && trim($record[2]) == 'SUBN') {
                    $gedcom->setSubn($this->parseRecord());
                } elseif (isset($record[2]) && trim($record[2]) == 'SUBM') {
                    $gedcom->addSubm($this->parseRecord());
                } elseif (isset($record[2]) && $record[2] == 'SOUR') {
                    $gedcom->addSour($this->parseRecord());
                } elseif (isset($record[2]) && $record[2] == 'INDI') {
                    $gedcom->addIndi($this->parseRecord());
                } elseif (isset($record[2]) && $record[2] == 'FAM') {
                    $gedcom->addFam($this->parseRecord());
                } elseif (isset($record[2]) && substr(trim($record[2]), 0, 4) == 'NOTE') {
                    $gedcom->addNote($this->parseRecord());
                } elseif (isset($record[2]) && $record[2] == 'REPO') {
                    $gedcom->addRepo($this->parseRecord());
                } elseif (isset($record[2]) && $record[2] == 'OBJE') {
                    $gedcom->addObje($this->parseRecord());
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

        return $gedcom;
    }

    public function scan()
    {
        if (!$this->file) {
            return false;
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

            if (trim($record[1]) == 'TRLR') {
                break;
            }

            if ($depth == 0) {
                $this->scanRecord();
            } else {
                $this->logUnhandledRecord(get_class() . ' @ ' . __LINE__);
            }

            $this->forward();
        }

        //print_r($this->fileMap);

        return $this;
    }

    public function scanRecord()
    {
        $record = $this->getCurrentLineRecord();
        $depth = (int)$record[0];
        $identifier = ($record[1]);

        //echo '-- Scanning: ' . implode('::', $record) . " @ line #" . $this->linesParsed . "\n";

        // The nodeType is the piece of data we are trying to store (NAME, DATE, SOUR, etc).
        $nodeType = trim($record[1]);

        $data = null;
        $extraData = null; // silly notes

        // At 0 level depth, the identifier comes after the nodeType (except for HEAD);
        if ($depth == 0 && $identifier !== 'HEAD' && $identifier !== 'TRLR') {
            $nodeType = trim($record[2]);
            $data = $record[1];
        } elseif ($depth > 0 && isset($record[2])) {
            $data = $record[2];
        }

        $this->fileMap[$nodeType][$this->linesParsed - 1] = [
            'id' => $this->normalizeIdentifier($data)
        ];

        // Push this node onto the stack of our namespace path:
        array_push($this->path, ucfirst(strtolower($nodeType)));

        $this->forward();

        while (!$this->eof()) {
            $record = $this->getCurrentLineRecord();
            $currentDepth = (int)$record[0];

            if ($currentDepth <= $depth) {
                $this->back();
                break;
            }

            $this->forward();
        }

        // Now that we're done parsing this node, pop it off our namespace path:
        array_pop($this->path);
    }

    public function hasCachedMap($path)
    {
        if (file_exists($path . '/scan-map.json')) {
            return true;
        }

        return false;
    }

    public function cacheMap($path)
    {
        file_put_contents($path . '/scan-map.json', json_encode($this->fileMap));

        return $this;
    }

    public function loadCachedMap($path)
    {
        if (!$this->hasCachedMap($path)) {
            return false;
        }

        $map = json_decode(file_get_contents($path . '/scan-map.json'), true);

        if ($map) {
            $this->fileMap = $map;
            return true;
        }

        return false;
    }


    public function seekLine($lineNumber)
    {
        $this->linesParsed = $lineNumber;
        $this->file->seek($lineNumber);
        $this->forward();
    }

    /**
     * @param int $start
     * @param int $length
     * @return \Generator
     */
    public function getIndi($start = 0, $length = null)
    {
        if (isset($this->fileMap['INDI'])) {
            $map = array_slice($this->fileMap['INDI'], $start, $length, true);

            foreach ($map as $line => $indi) {
                $this->seekLine($line - 1);
                $indi = $this->parseRecord();

                yield $indi;
            }
        }
    }

    /**
     * Parses an individual record within the GEDCOM file.
     *
     * @return AbstractRecord
     */
    public function parseRecord()
    {
        $record = $this->getCurrentLineRecord();

        $depth = (int)$record[0];
        $identifier = ($record[1]);

        // The nodeType is the piece of data we are trying to store (NAME, DATE, SOUR, etc).
        $nodeType = trim($record[1]);

        $data = null;
        $extraData = null; // silly notes

        // At 0 level depth, the identifier comes after the nodeType (except for HEAD);
        if ($depth == 0 && $identifier !== 'HEAD') {
            $nodeType = trim($record[2]);
            $data = $record[1];
        } elseif ($depth > 0 && isset($record[2])) {
            $data = $record[2];
        }

        if (isset($record[3])) {
            // AFAIK this only applies to notes...
            $extraData = $record[3];
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

        if (!empty($data)) {
            if ($depth === 0 && $this->isIdentifier($data)) {
                $data = $this->normalizeIdentifier($data);
                $this->attemptDataStorage($object, $classReflector, 'id', $data);
            } elseif ($classReflector->hasProperty(strtolower($nodeType))) {
                $this->attemptDataStorage($object, $classReflector, $nodeType, $data);
                // if we actually have content here, make sure to mark it as the previous node for
                // concatenation sake
            }

            $previousNode = ucfirst(strtolower($nodeType));
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
                    if (method_exists($object, 'get' . $previousNode)) {
                        $currentValue = call_user_func(array($object, 'get' . $previousNode)) .
                            ($recordType == 'Cont' ? "\n" : "");
                    } else {
                        throw new \Exception('No getter defined for ' . get_class($object) . '::' . $previousNode);
                    }

                    if (!empty($record[2])) {
                        $currentValue .= $record[2];
                    }

                    call_user_func(array($object, 'set' . $previousNode), $currentValue);
                }
            } else {
                $this->attemptDataStorage(
                    $object,
                    $classReflector,
                    $recordType,
                    !isset($record[2]) ? null : $record[2]
                );
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
     * Determines if the value passed as a GEDCOM identifier.
     *
     * @param string $value
     * @return bool
     */
    public function isIdentifier($value)
    {
        return preg_match('/^@(.*)@$/', trim($value)) == 1;
    }

    /**
     * Attempts to store the value in the proper location of the GEDCOM record tree.
     * 
     * @param object $object
     * @param \ReflectionClass $reflector
     * @param string $property
     * @param string $value
     * @throws \Exception
     */
    public function attemptDataStorage($object, \ReflectionClass $reflector, $property, $value)
    {
        // First ensure that the object has this property
        if ($reflector->hasProperty(strtolower($property))) {
            // Grab it and any DocBlock annotations
            $propertyReflector = $reflector->getProperty(strtolower($property));
            $annotations = new Annotations($propertyReflector);

            // If it has a variable type declaration, we can work with it
            if ($annotations->hasAnnotation('var')) {
                // Explode the pieces (type $varname description)
                $param = explode(' ', $annotations['var']);

                // If the type is a scalar value:
                if (in_array($param[0], array('string', 'integer', 'float'))) {
                    if ($this->isIdentifier($value)) {
                        $value = $this->normalizeIdentifier($value);
                    }

                    // Call the set{$property} method to set the value, if such a method exists
                    if ($reflector->hasMethod('set' . $property)) {
                        if (isset($value)) {
                            call_user_func(array($object, 'set' . $property), $value);
                        }
                    } else {
                        throw new \Exception(
                            'Missing setter for ' . $reflector->getName() . '::' . $propertyReflector->getName()
                        );
                    }
                } elseif ($param[0] == 'array') {
                    // If the type is an array, and their is an @of annotation, the value is expected to be an object
                    if ($annotations->hasAnnotation('of')) {
                        // If we have an add($property) method:
                        if ($reflector->hasMethod('add' . $property)) {
                            call_user_func(array($object, 'add' . $property), $this->parseRecord());
                        } else {
                            throw new \Exception(
                                'Missing adder for ' . $reflector->getName() . '::' . $propertyReflector->getName()
                            );
                        }
                    } else {
                        // If we don't have an @of, we assume this is a scalar type we are adding to the array:
                        if ($reflector->hasMethod('add' . $property) && !empty($value)) {
                            call_user_func(array($object, 'add' . $property), $value);
                        } else {
                            throw new \Exception(
                                'Missing adder for ' . $reflector->getName() . '::' . $propertyReflector->getName()
                            );
                        }
                    }
                } else {
                    // If not scalar, or an array, it must be an object, so attempt to parse it and call the
                    // set($property) method, if it exists:
                    if ($reflector->hasMethod('set' . $property)) {
                        call_user_func(array($object, 'set' . $property), $this->parseRecord());
                    } else {
                        throw new \Exception(
                            'Missing adder for ' . $reflector->getName() . '::' . $property->getName()
                        );
                    }
                }
            } else {
                // If there's no DocBlock defining the variable type, we can't intelligently do anything
                throw new \Exception(
                    'Missing @var docblock for ' . $reflector->getName() . '::' . $property
                );
            }
        } else {
            // No matching property was found on the object
            $this->logUnhandledRecord(get_class() . ' @ ' . __LINE__);
        }
    }
}
