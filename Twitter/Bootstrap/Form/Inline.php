<?php
/**
 * Base form class definition for inline forms
 *
 * @category   Forms
 * @package    Twitter_Bootstrap
 * @subpackage Form
 * @author     Christian Soronellas <csoronellas@emagister.com>
 */

/**
 * Base form class for inline forms. The inline form displays the form elements as
 * "inline-blocks", and there is no wrapper for themselves.
 *
 * @category   Forms
 * @package    Twitter_Bootstrap
 * @subpackage Form
 * @author     Christian Soronellas <csoronellas@emagister.com>
 */
class Twitter_Bootstrap_Form_Inline extends Twitter_Bootstrap_Form
{
    public function __construct($options = null)
    {
        $this->_initializePrefixes();

        $this->setDisposition(self::DISPOSITION_INLINE);

        parent::__construct($options);

        $this->setElementDecorators([
            [ 'ViewHelper' ],
            [ 'Description', [ 'tag' => 'span', 'class' => 'help-block' ] ],
            [ 'Addon' ],
            [ 'ElementErrors' ],
            [ 'Label', [ 'class' => 'sr-only' ] ],
            [ 'Wrapper' ]
        ]);
    }

    public function render(Zend_View_Interface $view = null)
    {
        /** @var Zend_Form_Element $element */
        foreach ($this->getElements() as $element) {
            $label = $element->getLabel();
            if (!empty($label)) {
                $element->setAttrib('placeholder', $label);
            }
        }

        return parent::render($view);
    }
}
