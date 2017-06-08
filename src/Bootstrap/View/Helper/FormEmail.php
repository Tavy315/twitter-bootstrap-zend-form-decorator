<?php
namespace Bootstrap\View\Helper;

/**
 * Class FormEmail
 *
 * @package Bootstrap\View\Helper
 * @author  Octavian Matei <octav@octav.name>
 * @since   11.11.2016
 */
class FormEmail extends FormText
{
    /**
     * Generates an 'email' element.
     *
     * @param string|array $name    If a string, the element name.  If an
     *                              array, all other parameters are ignored, and the array elements
     *                              are used in place of added parameters
     * @param mixed        $value   The element value
     * @param array        $attribs Attributes for the element tag
     *
     * @return string The element XHTML
     */
    public function formEmail($name, $value = null, $attribs = null)
    {
        return $this->_formText('email', $name, $value, $attribs);
    }
}
