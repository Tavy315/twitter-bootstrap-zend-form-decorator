<?php
/**
 * Decorator definition for the submit buttons
 *
 * @category   Forms
 * @package    Twitter_Bootstrap_Form
 * @subpackage Decorator
 * @author     Christian Soronellas <csoronellas@emagister.com>
 */

/**
 * A decorator to render the submit form buttons
 *
 * @category   Forms
 * @package    Twitter_Bootstrap_Form
 * @subpackage Decorator
 * @author     Christian Soronellas <csoronellas@emagister.com>
 */
class Twitter_Bootstrap_Form_Decorator_Actions extends Zend_Form_Decorator_Abstract
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
            if ($element !== null && $element instanceof Zend_Form_Element) {
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
