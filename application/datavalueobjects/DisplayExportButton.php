<?php

namespace LimeSurvey\Datavalueobjects;

use LimeSurvey\Menu\MenuItem;

class DisplayExportButton extends MenuItem
{
    /**
     * @param array $options
     */
    public function __construct()
    {
        $this->label = gT('Display/Export');
        $this->iconClass = 'fa fa-folder-open';
        parent::__construct([]);
    }
}
