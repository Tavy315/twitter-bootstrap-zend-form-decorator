<?php
namespace Bootstrap\Form\Element;

/**
 * Class Button
 *
 * @package Bootstrap\Form\Element
 * @author  Octavian Matei <octav@octav.name>
 * @since   11.11.2016
 */
class Button extends Submit
{
    const ICON_POSITION_LEFT = 'left';
    const ICON_POSITION_RIGHT = 'right';

    /**
     * Use formButton view helper by default
     *
     * @var string
     */
    public $helper = 'formButton';

    /**
     * The icon class, that will be added if needed
     *
     * @var string
     */
    private $_icon;

    /** @var string */
    private $_iconPosition = self::ICON_POSITION_LEFT;

    public function __construct($spec, $options = null)
    {
        if (isset($options['icon']) && !empty($options['icon'])) {
            // Disable automatic label escaping
            $options['escape'] = false;

            $this->_icon = $options['icon'];
            unset($options['icon']);

            if (isset($options['whiteIcon']) && true === $options['whiteIcon']) {
                $this->_icon .= ' icon-white';
                unset($options['whiteIcon']);
            }

            if (isset($options['iconPosition'])) {
                if (strcmp($options['iconPosition'], self::ICON_POSITION_RIGHT) === 0) {
                    $this->_iconPosition = self::ICON_POSITION_RIGHT;
                }
                unset($options['iconPosition']);
            }
        }

        parent::__construct($spec, $options);
    }

    /**
     * Renders the icon tag
     *
     * @return string
     */
    private function _renderIcon()
    {
        return !empty($this->_icon) ? '<i class="' . $this->_icon . '"></i>' : '';
    }

    /**
     * Gets the button label
     *
     * @return string
     */
    public function getLabel()
    {
        // Render the icon on either side
        return strcasecmp($this->_iconPosition, self::ICON_POSITION_LEFT) === 0
            ? $this->_renderIcon() . PHP_EOL . parent::getLabel()
            : parent::getLabel() . PHP_EOL . $this->_renderIcon();
    }

    public function getValue()
    {
        return parent::getLabel();
    }
}
