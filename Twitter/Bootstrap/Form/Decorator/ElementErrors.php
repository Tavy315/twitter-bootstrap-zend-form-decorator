<?php
/**
 * A decorator to render the form element errors
 *
 * @package Twitter_Bootstrap
 * @author  Christian Soronellas <csoronellas@emagister.com>
 */
class Twitter_Bootstrap_Form_Decorator_ElementErrors extends Zend_Form_Decorator_Abstract
{
    /**
     * @param string $content
     *
     * @return string
     */
    public function render($content)
    {
        $element = $this->getElement();
        if (!$element->hasErrors()) {
            return $content;
        }

        $options = $this->getOptions();
        $escape = true;
        if (isset($options['escape'])) {
            $escape = (bool) $options['escape'];
        }

        $errors = $element->getMessages();
        if ($escape) {
            /** @var Zend_View $view */
            $view = $element->getView();
            foreach ($errors as $key => $message) {
                $errors[$key] = $view->escape($message);
            }
        }

        $errorMessage = trim(implode('. ', $errors));

        return $content . '<span class="help-block">' . $errorMessage . '</span>';
    }
}
