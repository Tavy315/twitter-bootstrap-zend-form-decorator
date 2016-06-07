<?php
/**
 * Helper to generate a message alert
 *
 * @package Twitter_Bootstrap
 * @author  Marcel Araujo <admin@marcelaraujo.me>
 */
class Twitter_Bootstrap_View_Helper_ShowMessages extends Zend_View_Helper_Abstract
{
    /**
     * Type of alert messages
     *
     * @var array
     */
    protected $types = [ 'info', 'success', 'error' ];

    /**
     *
     * @param string|array|Zend_Exception $messages
     * @param string                      $type
     *
     * @return string
     */
    public function showMessages($messages = null, $type = 'info')
    {
        if (empty($messages)) {
            return '';
        }

        $type = strtolower($type);
        $type = in_array($type, $this->types) ? $type : 'info';

        $content = '<div class="alert alert-' . $type . ' fade in">'
            . '<button type="button" class="close" data-dismiss="alert">&times;</button>';

        if ($messages instanceof Zend_Exception) {
            $content .= '<p class="nomargin">' . $messages->getMessage() . '</p>';
        } elseif (is_array($messages) && count($messages) > 0) {
            foreach ($messages as $message) {
                $content .= '<p class="nomargin">' . $message . '</p>';
            }
        } else {
            $content .= '<p class="nomargin">' . $messages . '</p>';
        }

        return $content . '</div>';
    }
}
