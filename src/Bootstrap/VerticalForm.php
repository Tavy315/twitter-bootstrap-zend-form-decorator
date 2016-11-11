<?php
namespace Bootstrap;

/**
 * Class VerticalForm
 *
 * Base class for default form style
 *
 * @package Bootstrap
 * @author  Octavian Matei <octav@octav.name>
 * @since   11.11.2016
 */
class VerticalForm extends Form
{
    public function __construct($options = null)
    {
        $this->_initializePrefixes();

        parent::__construct($options);

        $this->setElementDecorators([
            [ 'ViewHelper' ],
            [ 'Addon' ],
            [ 'ElementErrors' ],
            [ 'Description', [ 'tag' => 'span', 'class' => 'help-block' ] ],
            [ 'Label' ],
            [ 'Wrapper' ],
        ]);

        foreach ($this->getElements() as $element) {
            if ($element instanceof \Zend_Form_Element_Submit || $element instanceof \Zend_Form_Element_Button) {
                $element->removeDecorator('Label');
            }
        }
    }
}
