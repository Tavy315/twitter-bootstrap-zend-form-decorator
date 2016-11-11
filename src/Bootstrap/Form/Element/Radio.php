<?php
namespace Bootstrap\Form\Element;

/**
 * Class Radio
 *
 * @package Bootstrap\Form\Element
 * @author  Octavian Matei <octav@octav.name>
 * @since   11.11.2016
 */
class Radio extends \Zend_Form_Element_Radio
{
    /**
     * The default separator (Changed to be nothing for bootstrap)
     *
     * @var string
     */
    protected $_separator = '';

    /**
     * Remove all the default decorator for this element
     *
     * @return $this
     */
    public function loadDefaultDecorators()
    {
        return $this;
    }
}
