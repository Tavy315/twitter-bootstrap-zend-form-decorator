<?php
/**
 * Twitter's Bootstrap multi checkboxes
 *
 * @package Twitter_Bootstrap
 * @author  Christian Soronellas <csoronellas@emagister.com>
 */
class Twitter_Bootstrap_Form_Element_MultiCheckbox extends Zend_Form_Element_MultiCheckbox
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
