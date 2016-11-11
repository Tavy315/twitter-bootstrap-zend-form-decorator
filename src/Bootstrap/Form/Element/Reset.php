<?php
namespace Bootstrap\Form\Element;

/**
 * Class Reset
 *
 * @package Bootstrap\Form\Element
 * @author  Octavian Matei <octav@octav.name>
 * @since   11.11.2016
 */
class Reset extends \Zend_Form_Element_Reset
{
    const BUTTON_DANGER = 'danger';
    const BUTTON_INFO = 'info';
    const BUTTON_INVERSE = 'inverse';
    const BUTTON_LINK = 'link';
    const BUTTON_PRIMARY = 'primary';
    const BUTTON_SUCCESS = 'success';
    const BUTTON_WARNING = 'warning';

    protected $_buttons = [
        self::BUTTON_DANGER,
        self::BUTTON_INFO,
        self::BUTTON_INVERSE,
        self::BUTTON_LINK,
        self::BUTTON_PRIMARY,
        self::BUTTON_SUCCESS,
        self::BUTTON_WARNING,
    ];

    /**
     * Class constructor
     *
     * @param string|array|\Zend_Config $spec
     * @param array                     $options
     */
    public function __construct($spec, $options = null)
    {
        if (!isset($options['class'])) {
            $options['class'] = '';
        }

        $classes = explode(' ', $options['class']);
        $classes[] = 'btn';
        $classes[] = 'btn-default';

        if (isset($options['buttonType']) && in_array($options['buttonType'], $this->_buttons)) {
            $classes[] = 'btn-' . $options['buttonType'];
            unset($options['buttonType']);
        }

        if (isset($options['disabled'])) {
            $classes[] = 'disabled';
        }

        $classes = array_unique($classes);

        $options['class'] = trim(implode(' ', $classes));

        parent::__construct($spec, $options);
    }
}
