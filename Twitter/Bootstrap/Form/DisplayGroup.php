<?php
/**
 * Displays the fieldsets the Bootstrap's way
 *
 * @package Twitter_Bootstrap
 * @author  Christian Soronellas <csoronellas@emagister.com>
 */
class Twitter_Bootstrap_Form_DisplayGroup extends Zend_Form_DisplayGroup
{
    /**
     * Override the default decorators
     *
     * @return $this
     * @throws \Zend_Form_Exception
     */
    public function loadDefaultDecorators()
    {
        if ($this->loadDefaultDecoratorsIsDisabled()) {
            return $this;
        }

        $decorators = $this->getDecorators();
        if (empty($decorators)) {
            $this->addDecorator('FormElements')
                 ->addDecorator('Fieldset');
        }

        return $this;
    }
}
