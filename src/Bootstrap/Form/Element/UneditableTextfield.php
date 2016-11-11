<?php
namespace Bootstrap\Form\Element;

/**
 * Class UneditableTextfield
 *
 * @package Bootstrap\Form\Element
 * @author  Octavian Matei <octav@octav.name>
 * @since   11.11.2016
 */
class UneditableTextfield extends \Zend_Form_Element_Text
{
    /**
     * Use formButton view helper by default
     *
     * @var string
     */
    public $helper = 'formUneditableTextfield';
}
