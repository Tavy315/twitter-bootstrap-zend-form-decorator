<?php
namespace Bootstrap\View\Helper;

/**
 * Class FormUrl
 *
 * @package Bootstrap\View\Helper
 * @author  Octavian Matei <octav@octav.name>
 * @since   11.11.2016
 */
class FormUrl extends FormText
{
    /**
     * Generates an 'url' element.
     *
     * @param string|array $name    If a string, the element name.  If an
     *                              array, all other parameters are ignored, and the array elements
     *                              are used in place of added parameters
     * @param mixed        $value   The element value
     * @param array        $attribs Attributes for the element tag
     *
     * @return string The element XHTML.
     */
    public function formUrl($name, $value = null, $attribs = null)
    {
        return $this->_formText('url', $name, $value, $attribs);
    }
}
