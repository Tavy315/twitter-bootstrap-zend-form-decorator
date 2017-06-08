<?php
namespace Bootstrap\Form\Decorator;

/**
 * Class ViewHelper
 *
 * Defines a decorator to wrap all the Bootstrap form elements
 *
 * @package Bootstrap\Form\Decorator
 * @author  Octavian Matei <octav@octav.name>
 * @since   11.11.2016
 */
class ViewHelper extends \Zend_Form_Decorator_ViewHelper
{
    /**
     * Get value
     *
     * If element type is one of the button types, returns the label.
     *
     * @param \Zend_Form_Element $element
     *
     * @return string|null
     */
    public function getValue($element)
    {
        if (!$element instanceof \Zend_Form_Element) {
            return;
        }

        foreach ($this->_buttonTypes as $type) {
            if ($element instanceof $type) {
                if (stristr($type, 'submit')) {
                    $element->content = $element->getLabel();

                    return $element->getValue();
                }

                if (stristr($type, 'button')) {
                    $element->content = $element->getLabel();

                    return $element->getValue();
                }

                return $element->getLabel();
            }
        }

        return $element->getValue();
    }

    /**
     * Renders a form element decorating it with the Twitter's Bootstrap markup
     *
     * @param string $content
     *
     * @throws \Zend_Form_Decorator_Exception
     * @return string
     */
    public function render($content)
    {
        $element = $this->getElement();

        $view = $element->getView();
        if (null === $view) {
            throw new \Zend_Form_Decorator_Exception('ViewHelper decorator cannot render without a registered view object');
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
        if (isset($attributes['listsep']) && in_array($helper, [ 'formMultiCheckbox', 'formRadio', 'formSelect' ])) {
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
