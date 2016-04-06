<?php
/**
 * Form definition
 *
 * @category   Forms
 * @package    Twitter_Bootstrap
 * @subpackage Form
 * @author     Christian Soronellas <csoronellas@emagister.com>
 */

/**
 * Base class for default form style
 *
 * @category   Forms
 * @package    Twitter_Bootstrap
 * @subpackage Form
 * @author     Christian Soronellas <csoronellas@emagister.com>
 */
class Twitter_Bootstrap_Form_Vertical extends Twitter_Bootstrap_Form
{
    /**
     * Class constructor override.
     *
     * @param null $options
     */
    public function __construct($options = null)
    {
        $this->_initializePrefixes();

        parent::__construct($options);

        $this->setElementDecorators([
            [ 'ViewHelper' ],
            [ 'Addon' ],
            [ 'ElementErrors' ],
            [ 'Description', [ 'tag' => 'span', 'class' => 'help-block' ] ],
            [ 'Label' ],
            [ 'Wrapper' ]
        ]);
    }
}
