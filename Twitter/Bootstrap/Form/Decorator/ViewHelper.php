<?php
/**
 * Form decorator definition
 *
 * @category   Forms
 * @package    Twitter_Bootstrap_Form
 * @subpackage Decorator
 * @author     Christian Soronellas <csoronellas@emagister.com>
 */

/**
 * Defines a decorator to wrap all the Bootstrap form elements
 *
 * @category   Forms
 * @package    Twitter_Bootstrap_Form
 * @subpackage Decorator
 * @author     Christian Soronellas <csoronellas@emagister.com>
 */
class Twitter_Bootstrap_Form_Decorator_ViewHelper extends Zend_Form_Decorator_ViewHelper
{
    /**
     * Renders a form element decorating it with the Twitter's Bootstrap markup
     *
     * @param string $content
     *
     * @return string
     * @throws \Zend_Form_Decorator_Exception
     */
    public function render($content)
    {
        $element = $this->getElement();

        $view = $element->getView();
        if (null === $view) {
            require_once 'Zend/Form/Decorator/Exception.php';
            throw new Zend_Form_Decorator_Exception('ViewHelper decorator cannot render without a registered view object');
        }

        if (method_exists($element, 'getMultiOptions')) {
            $element->getMultiOptions();
        }

        $helper = $this->getHelper();
        $separator = $this->getSeparator();
        $value = $this->getValue($element);
        $attributes = $this->getElementAttribs();
        $name = $element->getFullyQualifiedName();
        $id = $element->getId();
        $attributes['id'] = $id;

        // we make sure we remove prepend and append when rendering text inputs
        if ($helper == 'formText') {
            unset($attributes['prepend'], $attributes['append']);
        }

        $helperObject = $view->getHelper($helper);
        if (method_exists($helperObject, 'setTranslator')) {
            $helperObject->setTranslator($element->getTranslator());
        }

        // Check list separator
        if (isset($attributes['listsep']) && in_array($helper, [ 'formMulticheckbox', 'formRadio', 'formSelect' ])) {
            $listsep = $attributes['listsep'];
            unset($attributes['listsep']);

            $elementContent = $view->$helper($name, $value, $attributes, $element->options, $listsep);
        } else {
            $elementContent = $view->$helper($name, $value, $attributes, $element->options);
        }

        switch ($this->getPlacement()) {
            case self::APPEND:
                return $content . $separator . $elementContent;

            case self::PREPEND:
                return $elementContent . $separator . $content;
            
            default:
                return $elementContent;
        }
    }
}
