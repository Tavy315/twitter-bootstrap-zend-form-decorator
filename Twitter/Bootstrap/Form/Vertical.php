<?php
/**
 * Base class for default form style
 *
 * @package Twitter_Bootstrap
 * @author  Christian Soronellas <csoronellas@emagister.com>
 */
class Twitter_Bootstrap_Form_Vertical extends Twitter_Bootstrap_Form
{
    /**
     * Class constructor override.
     *
     * @param null $options
     */
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
            if ($element instanceof Zend_Form_Element_Submit || $element instanceof Zend_Form_Element_Button) {
                $element->removeDecorator('Label');
            }
        }
    }
}
