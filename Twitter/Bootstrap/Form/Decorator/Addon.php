<?php

/**
 * Defines a decorator to render the form field addons
 *
 * @category   Form
 * @package    Twitter_Bootstrap_Form
 * @subpackage Decorator
 * @author     Christian Soronellas <csoronellas@emagister.com>
 */

/**
 * Renders an form field with an add on (appended or prepended)
 *
 * @category   Form
 * @package    Twitter_Bootstrap_Form
 * @subpackage Decorator
 * @see        http://twitter.github.com/bootstrap/base-css.html#forms
 * @author     Christian Soronellas <csoronellas@emagister.com>
 */
class Twitter_Bootstrap_Form_Decorator_Addon extends Zend_Form_Decorator_Abstract
{
    /**
     *
     * @param  string $content
     *
     * @return string
     */
    public function render($content)
    {
        $element = $this->getElement();

        $prepend = $element->getAttrib('prepend');
        $append = $element->getAttrib('append');

        if (null === $prepend && null === $append) {
            return $content;
        }

        $classes = [ ];

        // Prepare the prepend
        if (null !== $prepend) {
            $classes[] = 'input-group';

            $this->_prepareAddon($prepend);
        }

        // Prepare the append
        if (null !== $append) {
            $classes[] = 'input-group';

            $this->_prepareAddon($append);
        }

        // Unset the prepend and append data
        $element->setAttribs([
            'prepend' => null,
            'append'  => null,
        ]);

        $classes = array_unique($classes);

        // Return the rendered input field
        return '<div class="' . trim(implode(' ', $classes)) . '">'
        . ((null !== $prepend) ? $prepend : '')
        . trim($content)
        . ((null !== $append) ? $append : '')
        . '</div>';
    }

    /**
     * Prepares and renders the item to be appended or prepended
     *
     * @param mixed $addon
     */
    protected function _prepareAddon(&$addon)
    {
        if ($addon instanceof Zend_Form_Element_Checkbox) {
            $addon = '<span class="input-group-addon">' . $this->_renderElement($addon) . '</span>';
        } elseif ($addon instanceof Zend_Form_Element_Submit) {
            //removing DtDdWrapper for case when using button addon for an input
            $addon->removeDecorator('DtDdWrapper');

            $addon = '<div class="input-group-btn">' . $addon . '</div>';
        } elseif (is_array($addon)) {
            $elements = '<div class="input-group-btn">';
            foreach ($addon as $addonElement) {
                if ($addonElement instanceof Zend_Form_Element_Submit || $addonElement instanceof Zend_Form_Element_Checkbox) {
                    $elements .= $this->_renderElement($addonElement);
                }
            }
            $elements .= '</div>';

            $addon = $elements;
        } else {
            $addon = '<span class="input-group-addon">' . $addon . '</span>';
        }
    }

    /**
     * Renders an element with only the view helper decorator
     *
     * @param \Zend_Form_Element $element
     *
     * @return string
     */
    protected function _renderElement(Zend_Form_Element $element)
    {
        $element->setDecorators([ 'ViewHelper' ]);

        return trim($element->render($element->getView()));
    }
}
