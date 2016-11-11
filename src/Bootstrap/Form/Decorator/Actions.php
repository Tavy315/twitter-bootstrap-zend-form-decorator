<?php
namespace Bootstrap\Form\Decorator;

/**
 * Class Actions
 *
 * A decorator to render the submit form buttons
 *
 * @package Bootstrap\Form\Decorator
 * @author  Octavian Matei <octav@octav.name>
 * @since   11.11.2016
 */
class Actions extends \Zend_Form_Decorator_Abstract
{
    /**
     * Render all the buttons
     *
     * @return string
     */
    public function buildButtons()
    {
        $output = '';
        foreach ($this->getElement() as $element) {
            if ($element !== null && $element instanceof \Zend_Form_Element) {
                $element->setDecorators([ [ 'ViewHelper' ] ]);
                $output .= $element->render();
            }
        }

        return $output;
    }

    /**
     * Renders the content
     *
     * @param string $content
     *
     * @return string
     */
    public function render($content)
    {
        $class = $this->getElement()->getAttrib('class');

        if (null === $class) {
            $class = '';
        }

        return '<div class="form-actions">'
        . '<div class="row">'
        . '<div class="' . $class . '">'
        . $this->buildButtons()
        . '</div>'
        . '</div>'
        . '</div>';
    }
}
