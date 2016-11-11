<?php
namespace Bootstrap;

/**
 * Class InlineForm
 *
 * Base form class for inline forms. The inline form displays the form elements as
 * "inline-blocks", and there is no wrapper for themselves.
 *
 * @package Bootstrap
 * @author  Octavian Matei <octav@octav.name>
 * @since   11.11.2016
 */
class InlineForm extends Form
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
            [ 'Wrapper' ],
        ]);
    }

    public function render(\Zend_View_Interface $view = null)
    {
        /** @var \Zend_Form_Element $element */
        foreach ($this->getElements() as $element) {
            $label = $element->getLabel();
            if (!empty($label)) {
                $element->setAttrib('placeholder', $label);
            }
        }

        return parent::render($view);
    }
}
