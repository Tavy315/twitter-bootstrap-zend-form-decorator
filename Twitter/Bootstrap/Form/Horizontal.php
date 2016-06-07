<?php
/**
 * An "horizontal" Twitter Bootstrap's UI form
 *
 * @package Twitter_Bootstrap
 * @author  Christian Soronellas <csoronellas@emagister.com>
 */
class Twitter_Bootstrap_Form_Horizontal extends Twitter_Bootstrap_Form
{
    public function __construct($options = null)
    {
        $this->_initializePrefixes();

        $this->setDisposition(self::DISPOSITION_HORIZONTAL);

        parent::__construct($options);

        $this->setElementDecorators([
            [ 'ViewHelper' ],
            [ 'Addon' ],
            [ 'ElementErrors' ],
            [ 'Description', [ 'tag' => 'span', 'class' => 'help-block' ] ],
            [ 'HtmlTag', [ 'tag' => 'div', 'class' => 'col-' . $this->_getColType() . '-' . $this->_getFieldColSize() ] ],
            [ 'Label', [ 'class' => 'col-' . $this->_getColType() . '-' . $this->_getLabelColSize() . ' control-label' ] ],
            [ 'Wrapper' ],
        ]);

        foreach ($this->getElements() as $element) {
            if ($element instanceof Zend_Form_Element_Checkbox) {
                $decorators = $element->getDecorators();

                /** @var Zend_Form_Decorator_HtmlTag $htmlTagDecorator */
                $htmlTagDecorator = $decorators['Zend_Form_Decorator_HtmlTag'];
                $class = $htmlTagDecorator->getOption('class');
                $htmlTagDecorator->setOption('class', 'checkbox ' . $class);

                $element->addDecorator($htmlTagDecorator);
            } elseif ($element instanceof Zend_Form_Element_Submit || $element instanceof Zend_Form_Element_Button) {
                $decorators = $element->getDecorators();

                /** @var Zend_Form_Decorator_HtmlTag $htmlTagDecorator */
                $htmlTagDecorator = $decorators['Zend_Form_Decorator_HtmlTag'];
                $class = $htmlTagDecorator->getOption('class');
                $htmlTagDecorator->setOption('class', 'col-' . $this->_getColType() . '-offset-' . $this->_getLabelColSize() . ' ' . $class);

                $element->addDecorator($htmlTagDecorator);
                $element->removeDecorator('Label');
            } elseif ($element instanceof Zend_Form_Element_File) {
                $decorators = $element->getDecorators();

                $element->setDecorators(array_merge([ 'File' ], $decorators));
                $element->removeDecorator('ViewHelper');
            } elseif ($element instanceof Zend_Form_Element_Image) {
                $decorators = $element->getDecorators();

                $element->setDecorators(array_merge([ 'Image' ], $decorators));
                $element->removeDecorator('ViewHelper');
            }
        }

        $this->_displayConsecutiveButtonsOnTheSameLine();
    }

    protected function _displayConsecutiveButtonsOnTheSameLine()
    {
        $elements = $this->getElements();

        $previousElement = null;
        foreach ($elements as $element) {
            if (null !== $previousElement) {
                $this->_manageDecoratorsForButtons($previousElement, $element);
            }

            $previousElement = $element;
        }
    }

    protected function _manageDecoratorsForButtons($current, $next)
    {
        if ($current instanceof Zend_Form_Element_Submit || $current instanceof Zend_Form_Element_Button) {
            if ($next instanceof Zend_Form_Element_Submit || $next instanceof Zend_Form_Element_Button) {
                $currentHtmlTagDecorator = $current->getDecorator('Zend_Form_Decorator_HtmlTag');
                if (!$currentHtmlTagDecorator->getOption('closeOnly')) {
                    $currentHtmlTagDecorator->setOption('openOnly', true);
                    $current->addDecorator($currentHtmlTagDecorator);
                    $currentWrapperTagDecorator = $current->getDecorator('Twitter_Bootstrap_Form_Decorator_Wrapper');
                    $currentWrapperTagDecorator->setOption('openOnly', true);
                    $current->addDecorator($currentHtmlTagDecorator);
                } else {
                    $current->removeDecorator('Zend_Form_Decorator_HtmlTag');
                    $current->removeDecorator('Twitter_Bootstrap_Form_Decorator_Wrapper');
                }

                $nextHtmlTagDecorator = $next->getDecorator('Zend_Form_Decorator_HtmlTag');
                if ($nextHtmlTagDecorator) {
                    $nextHtmlTagDecorator->setOption('closeOnly', true);
                    $next->addDecorator($nextHtmlTagDecorator);
                    $nextWrapperDecorator = $next->getDecorator('Twitter_Bootstrap_Form_Decorator_Wrapper');
                    $nextWrapperDecorator->setOption('closeOnly', true);
                    $next->addDecorator($nextHtmlTagDecorator);
                }
            }
        }
    }
}
