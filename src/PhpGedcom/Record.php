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

/**
 * Class Record
 * @package PhpGedcom
 */
abstract class Record
{
    /**
     * An array of values for custom tags.
     *
     * @var array
     */
    protected $customTagValues = array();

    /**
     * Checks if this GEDCOM object has the provided attribute (ie, if the provided
     * attribute exists below the current object in its tree).
     * 
     * @param string $var The name of the attribute
     * @return bool True if this object has the provided attribute
     */
    public function hasAttribute($var)
    {
        return property_exists($this, '_' . $var) || property_exists($this, $var);
    }

    /**
     * Return a custom tag value, or false if none is found.
     *
     * @param string $tag
     * @return bool|string
     */
    public function getCustomTagValue($tag)
    {
        if (isset($this->customTagValues[strtolower($tag)])) {
            return $this->customTagValues[strtolower($tag)];
        }

        return false;
    }

    /**
     * Store a custom tag value.
     *
     * @param string $tag
     * @param string $value
     * @return $this
     */
    public function addCustomTagValue($tag, $value)
    {
        $this->customTagValues[strtolower($tag)] = $value;

        return $this;
    }
}
