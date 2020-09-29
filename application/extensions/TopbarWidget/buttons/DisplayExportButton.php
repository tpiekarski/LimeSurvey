<?php

use LimeSurvey\Menu\MenuItem;

class DisplayExportButton extends MenuItem
{
    /**
     * @param array $options
     */
    public function __construct($options)
    {
        $this->label = gT('Display/Export');
        $this->iconClass = 'fa fa-folder-open';
        parent::__construct($options);
    }
}
