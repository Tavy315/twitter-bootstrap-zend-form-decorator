<?php
namespace Bootstrap\Form\Element;

/**
 * Class Note
 *
 * @package Bootstrap\Form\Element
 * @author  Octavian Matei <octav@octav.name>
 * @since   11.11.2016
 */
class Note extends \Zend_Form_Element_Note
{
    /**
     * Default form view helper to use for rendering
     *
     * @var string
     */
    public $helper = 'formNote';
}
