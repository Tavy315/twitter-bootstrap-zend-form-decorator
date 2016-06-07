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
    protected $types = [ 'info', 'success', 'danger', 'warning' ];

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
        
        if (!is_array($messages)) {
            $messages = [ $messages ];
        }

        $type = strtolower($type);
        $type = in_array($type, $this->types) ? $type : 'info';

        $content = '<div class="alert alert-' . $type . ' fade in">';
        $content .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';

        foreach ($messages as $message) {
            $content .= '<p class="nomargin">' . $message . '</p>';
        }

        $content .= '</div>';

        return $content;
    }
}
