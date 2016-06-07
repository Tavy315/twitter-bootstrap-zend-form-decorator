<?php
/**
 * Defines a decorator to wrap all the Bootstrap form elements
 *
 * @package Twitter_Bootstrap
 * @author  Christian Soronellas <csoronellas@emagister.com>
 */
class Twitter_Bootstrap_Form_Decorator_Wrapper extends Zend_Form_Decorator_HtmlTag
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
            $classes = [ ];
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
