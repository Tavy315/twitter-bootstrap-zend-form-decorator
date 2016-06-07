<?php
/**
 * Helper to generate a "number" element
 *
 * @package    Twitter_Bootstrap
 * @author     Ilya Serdyuk <ilya.serdyuk@youini.org>
 */
class Twitter_Bootstrap_View_Helper_FormNumber extends Twitter_Bootstrap_View_Helper_FormText
{
    /**
     * Generates a 'number' element.
     *
     * @access public
     *
     * @param string|array $name    If a string, the element name.  If an
     *                              array, all other parameters are ignored, and the array elements
     *                              are used in place of added parameters.
     *
     * @param mixed        $value   The element value.
     *
     * @param array        $attribs Attributes for the element tag.
     *
     * @return string The element XHTML.
     */
    public function formNumber($name, $value = null, $attribs = null)
    {
        return $this->_formText('number', $name, $value, $attribs);
    }
}
