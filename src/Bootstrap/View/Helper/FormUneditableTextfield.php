<?php
namespace Bootstrap\View\Helper;

/**
 * Class FormUneditableTextfield
 *
 * @package Bootstrap\View\Helper
 * @author  Octavian Matei <octav@octav.name>
 * @since   11.11.2016
 */
class FormUneditableTextfield extends \Zend_View_Helper_FormElement
{
    /**
     * Generates a 'text' element, that cannot be edited.
     *
     * @param string|array $name    If a string, the element name.  If an
     *                              array, all other parameters are ignored, and the array elements
     *                              are used in place of added parameters.
     * @param mixed        $value   The element value.
     * @param array        $attribs Attributes for the element tag.
     *
     * @return string The element XHTML.
     */
    public function formUneditableTextfield($name, $value = null, $attribs = null)
    {
        $attribs['class'] .= ' uneditable-input';
        $attribs['class'] = trim($attribs['class']);

        return '<span ' . $this->_htmlAttribs($attribs) . '>' . $this->view->escape($value) . '</span>';
    }
}
