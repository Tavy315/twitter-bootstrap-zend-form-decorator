<?php
namespace Bootstrap\Form;

/**
 * Class DisplayGroup
 *
 * Displays the fieldsets the Bootstrap's way
 *
 * @package Bootstrap\Form
 * @author  Octavian Matei <octav@octav.name>
 * @since   11.11.2016
 */
class DisplayGroup extends \Zend_Form_DisplayGroup
{
    /**
     * Override the default decorators
     *
     * @throws \Zend_Form_Exception
     * @return $this
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
