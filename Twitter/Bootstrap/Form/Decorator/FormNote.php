<?php
/**
 * Helper to generate a "note" text element
 *
 * @package Twitter_Bootstrap
 * @author  Octavian Matei <octav@octav.name>
 */
class Twitter_Bootstrap_View_Helper_FormNote extends Zend_View_Helper_FormNote
{
    /**
     * Helper to show an HTML note.
     *
     * @access public
     *
     * @param string|array $name    If a string, the element name.  If an
     *                              array, all other parameters are ignored, and the array elements
     *                              are extracted in place of added parameters.
     * @param array        $value   The note to display.  HTML is *not* escaped; the
     *                              note is displayed as-is.
     * @param array        $attribs Attributes for the element tag.
     *
     * @return string The element XHTML.
     */
    public function formNote($name, $value = null, $attribs = null)
    {
        $info = $this->_getInfo($name, $value, $attribs);
        extract($info); // name, value, attribs, options, listsep, disable

        return '<div class="note" ' . $this->_htmlAttribs($attribs) . '>' . $value . '</div>';
    }
}
