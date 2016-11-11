<?php
namespace Bootstrap\Form\Decorator;

/**
 * Class Captcha
 *
 * Surrounds <img> with the <label> tag for extra line spacing.
 *
 * @package Bootstrap\Form\Decorator
 * @author  Octavian Matei <octav@octav.name>
 * @since   11.11.2016
 */
class Captcha extends \Zend_Form_Decorator_Captcha
{
    /**
     * Render captcha
     *
     * @param string $content
     *
     * @return string
     */
    public function render($content)
    {
        $element = $this->getElement();
        if (!method_exists($element, 'getCaptcha')) {
            return $content;
        }

        $view = $element->getView();
        if (null === $view) {
            return $content;
        }

        $placement = $this->getPlacement();
        $separator = $this->getSeparator();

        /** @var \Zend_Captcha_Adapter $captcha */
        $captcha = $element->getCaptcha();
        $markup = '<label>' . $captcha->render($view) . '</label>';
        switch ($placement) {
            case 'PREPEND':
                $content = $markup . $separator . $content;
                break;

            case 'APPEND':
            default:
                $content = $content . $separator . $markup;
                break;
        }

        return $content;
    }
}
