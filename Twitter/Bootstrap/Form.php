<?php
/**
 * Base form class definition
 *
 * @category   Forms
 * @package    Twitter
 * @subpackage Bootstrap
 * @author     Christian Soronellas <csoronellas@emagister.com>
 */

/**
 * This is the base abstract form for the Twitter's Bootstrap UI
 *
 * @category   Forms
 * @package    Twitter
 * @subpackage Bootstrap
 * @author     Christian Soronellas <csoronellas@emagister.com>
 */
abstract class Twitter_Bootstrap_Form extends Zend_Form
{
    /**
     * Class constants
     */
    const DISPOSITION_HORIZONTAL = 'horizontal';
    const DISPOSITION_INLINE = 'inline';
    const DISPOSITION_SEARCH = 'search';

    protected $_prefixesInitialized = false;

    protected $_labelColSize = 2;
    protected $_fieldColSize = 3;

    public $_allowedColType = [ 'xs', 'sm', 'md', 'lg' ];
    protected $_colType = 'lg';

    /**
     * Override the base form constructor.
     *
     * @param null $options
     */
    public function __construct($options = null)
    {
        $this->_initializePrefixes();

        $this->setDecorators([
            'FormElements',
            'Form'
        ]);

        parent::__construct($options);

        $this->_initializeFieldColSize();
    }

    protected function _initializeFieldColSize()
    {
        foreach ($this->getElements() as $element) {
            if (!$element instanceof Zend_Form_Element_Submit
                and !$element instanceof Zend_Form_Element_Button
                and !$element instanceof Zend_Form_Element_Image
                and !$element instanceof Zend_Form_Element_Checkbox
                and !$element instanceof Zend_Form_Element_MultiCheckbox
                and !$element instanceof Zend_Form_Element_Radio
            ) {
                $this->_addClassNames([
                    'form-control',
                    'col-' . $this->_getColType() . '-' . $this->_getFieldColSize()
                ], $element);
            }
        }
    }

    protected function _initializePrefixes()
    {
        if (!$this->_prefixesInitialized) {
            /** @var Zend_View $view */
            $view = $this->getView();
            if (null !== $view) {
                $view->addHelperPath(
                    'Twitter/Bootstrap/View/Helper',
                    'Twitter_Bootstrap_View_Helper'
                );
            }

            $this->addPrefixPath(
                'Twitter_Bootstrap_Form_Element',
                'Twitter/Bootstrap/Form/Element',
                'element'
            );

            $this->addElementPrefixPath(
                'Twitter_Bootstrap_Form_Decorator',
                'Twitter/Bootstrap/Form/Decorator',
                'decorator'
            );

            $this->addDisplayGroupPrefixPath(
                'Twitter_Bootstrap_Form_Decorator',
                'Twitter/Bootstrap/Form/Decorator'
            );

            $this->setDefaultDisplayGroupClass('Twitter_Bootstrap_Form_DisplayGroup');

            $this->_prefixesInitialized = true;
        }
    }

    /**
     * @param string $disposition
     */
    public function setDisposition($disposition)
    {
        if (in_array($disposition, [
            self::DISPOSITION_HORIZONTAL,
            self::DISPOSITION_INLINE,
            self::DISPOSITION_SEARCH
        ])) {
            $this->_addClassNames('form-' . $disposition);
        }
    }

    /**
     * Adds a class name to a Zend_Form_Element if given or to the base form
     *
     * @param string            $classNames
     * @param Zend_Form_Element $element
     */
    protected function _addClassNames($classNames, Zend_Form_Element $element = null)
    {
        if (null !== $element) {
            $classes = $this->_getClassNames($element);
        } else {
            $element = $this;
            $classes = $this->_getClassNames();
        }

        foreach ((array) $classNames as $className) {
            $classes[] = $className;
        }

        $classes = array_unique($classes);

        $element->setAttrib('class', trim(implode(' ', $classes)));
    }

    /**
     * Removes a class name
     *
     * @param string $classNames
     */
    protected function _removeClassNames($classNames)
    {
        $classes = array_diff($this->_getClassNames(), (array) $classNames);
        $this->setAttrib('class', trim(implode(' ', $classes)));
    }

    /**
     * Extract the class names from a Zend_Form_Element if given or from the
     * base form
     *
     * @param  Zend_Form_Element $element
     *
     * @return array
     */
    protected function _getClassNames(Zend_Form_Element $element = null)
    {
        if (null !== $element) {
            return explode(' ', $element->getAttrib('class'));
        }

        return explode(' ', $this->getAttrib('class'));
    }

    /**
     * Render form
     *
     * @param  Zend_View_Interface $view
     *
     * @return string
     */
    public function render(Zend_View_Interface $view = null)
    {
        /**
         * Getting elements.
         */
        $elements = $this->getElements();

        /** @var Zend_Form_Element $eachElement */
        foreach ($elements as $eachElement) {

            /**
             * Add required attribute to required elements
             * https://github.com/manticorp
             */
            if ($eachElement->isRequired()) {
                $eachElement->setAttrib('required', '');
            }

            /**
             * Removing label from buttons before render.
             */
            if ($eachElement instanceof Zend_Form_Element_Submit) {
                $eachElement->removeDecorator('Label');
            }

            /**
             * No decorators for hidden elements
             */
            if ($eachElement instanceof Zend_Form_Element_Hidden) {
                $eachElement->clearDecorators()->addDecorator('ViewHelper');
            }

            /**
             * No decorators for hash elements
             */
            if ($eachElement instanceof Zend_Form_Element_Hash) {
                $eachElement->clearDecorators()->addDecorator('ViewHelper');
            }
        }

        /**
         * Rendering.
         */

        return parent::render($view);
    }

    protected function _getLabelColSize()
    {
        return $this->_labelColSize;
    }

    protected function _getFieldColSize()
    {
        return $this->_fieldColSize;
    }

    protected function _getColType()
    {
        return $this->_colType;
    }

    public function setLabelColSize($size)
    {
        $this->_labelColSize = intval($size);
    }

    public function setFieldColSize($size)
    {
        $this->_fieldColSize = intval($size);
    }

    public function setColType($type)
    {
        if (in_array($type, $this->_allowedColType)) {
            $this->_colType = $type;
        }
    }
}
