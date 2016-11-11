<?php
namespace Bootstrap;

/**
 * Class SearchForm
 *
 * Base form class for search forms.
 *
 * @package Bootstrap
 * @author  Octavian Matei <octav@octav.name>
 * @since   11.11.2016
 */
final class SearchForm extends InlineForm
{
    public function __construct($options = null)
    {
        $this->_initializePrefixes();

        $this->setDisposition(self::DISPOSITION_SEARCH);

        $renderButton = true;
        if (isset($options['renderInNavBar']) && true === $options['renderInNavBar']) {
            $this->_removeClassNames('form-search');
            $classes = [ 'navbar-search' ];
            if (isset($options['pullItRight']) && true === $options['pullItRight']) {
                $classes[] = 'pull-right';
                unset($options['pull-right']);
            }

            $this->_addClassNames($classes);
            unset($options['renderInNavBar']);
            $renderButton = false;
        }

        // Add the search input
        $inputName = isset($options['inputName']) ? $options['inputName'] : 'searchQuery';
        $placeholder = isset($options['placeholder']) ? $options['placeholder'] : null;
        $this->addElement('text', $inputName, [
            'class'       => 'search-query',
            'placeholder' => $placeholder,
        ]);

        if ($renderButton) {
            $buttonLabel = isset($options['submitLabel']) ? $options['submitLabel'] : 'Submit';
            $this->addElement('submit', 'submit', [
                'class' => 'btn btn-default',
                'label' => $buttonLabel,
            ]);
        }

        parent::__construct($options);
    }
}
