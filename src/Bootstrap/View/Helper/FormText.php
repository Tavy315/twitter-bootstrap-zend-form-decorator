<?php
namespace Bootstrap\View\Helper;

/**
 * Class FormText
 *
 * @package Bootstrap\View\Helper
 * @author  Octavian Matei <octav@octav.name>
 * @since   11.11.2016
 */
class FormText extends \Zend_View_Helper_FormText
{
    /**
     * Generates a 'text' element.
     *
     * @param string|array $name    If a string, the element name.  If an
     *                              array, all other parameters are ignored, and the array elements
     *                              are used in place of added parameters
     * @param mixed        $value   The element value
     * @param array        $attribs Attributes for the element tag
     *
     * @return string The element XHTML
     */
    public function formText($name, $value = null, $attribs = null)
    {
        return $this->_formText('text', $name, $value, $attribs);
    }

    /**
     * Generates a custom input element
     *
     * @param string       $type    The element type
     * @param string|array $name    If a string, the element name.  If an
     *                              array, all other parameters are ignored, and the array elements
     *                              are used in place of added parameters
     * @param mixed        $value   The element value
     * @param array        $attribs Attributes for the element tag
     *
     * @return string The element XHTML
     */
    protected function _formText($type, $name, $value = null, $attribs = null)
    {
        $info = $this->_getInfo($name, $value, $attribs);
        extract($info); // name, value, attribs, options, listsep, disable

        // build the element
        $disabled = '';
        if ($disable) {
            // disabled
            $disabled = ' disabled="disabled"';
        }

        $xhtml = '<input'
            . ' type="' . $this->view->escape($type) . '"'
            . ' name="' . $this->view->escape($name) . '"'
            . ' id="' . $this->view->escape($id) . '"'
            . ' value="' . $this->view->escape($value) . '"'
            . $disabled
            . $this->_htmlAttribs($attribs)
            . $this->getClosingBracket();

        return $xhtml;
    }
}
