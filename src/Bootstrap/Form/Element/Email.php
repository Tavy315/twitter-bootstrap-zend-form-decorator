<?php
namespace Bootstrap\Form\Element;

/**
 * Class Email
 *
 * @package Bootstrap\Form\Element
 * @author  Octavian Matei <octav@octav.name>
 * @since   11.11.2016
 */
class Email extends \Zend_Form_Element_Text
{
    /**
     * Default form view helper to use for rendering
     *
     * @var string
     */
    public $helper = 'formEmail';
}
