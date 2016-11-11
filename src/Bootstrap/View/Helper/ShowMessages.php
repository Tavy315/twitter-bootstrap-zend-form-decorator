<?php
namespace Bootstrap\View\Helper;

/**
 * Class ShowMessages
 *
 * @package Bootstrap\View\Helper
 * @author  Octavian Matei <octav@octav.name>
 * @since   11.11.2016
 */
class ShowMessages extends \Zend_View_Helper_Abstract
{
    /**
     * Type of alert messages
     *
     * @var array
     */
    protected $types = [ 'info', 'success', 'danger', 'warning' ];

    /**
     * Helper to generate a message alert
     *
     * @param string|array|\Zend_Exception $messages
     * @param string                       $type
     *
     * @return string
     */
    public function showMessages($messages = '', $type = 'info')
    {
        $content = '';

        if (!empty($messages)) {
            if (!is_array($messages)) {
                $messages = [ $messages ];
            }

            $type = strtolower($type);

            $content = '<div class="alert alert-' . (in_array($type, $this->types) ? $type : 'info') . ' fade in">';
            $content .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';

            foreach ($messages as $message) {
                $content .= '<p class="nomargin">' . $message . '</p>';
            }

            $content .= '</div>';
        }

        return $content;
    }
}
