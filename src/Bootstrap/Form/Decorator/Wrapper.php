<?php
namespace Bootstrap\Form\Decorator;

/**
 * Class Wrapper
 *
 * Defines a decorator to wrap all the Bootstrap form elements
 *
 * @package Bootstrap\Form\Decorator
 * @author  Octavian Matei <octav@octav.name>
 * @since   11.11.2016
 */
class Wrapper extends \Zend_Form_Decorator_HtmlTag
{
    /**
     * Renders a form element decorating it with the Twitter's Bootstrap markup
     *
     * @param $content
     *
     * @return string
     */
    public function render($content)
    {
        $class = $this->getOption('class');

        if (null === $class) {
            $classes = [];
        } else {
            $classes = explode(' ', $class);
        }

        $classes[] = 'form-group';

        if ($this->getElement()->hasErrors()) {
            $classes[] = 'has-error';
        }

        $this->setOption('class', trim(implode(' ', $classes)));

        return parent::render($content);
    }
}
