<?php

namespace LimeSurvey\Datavalueobjects;

use LimeSurvey\Menu\MenuItem;

class ActivateSurveyButton extends MenuItem
{
    /** @var string */
    protected $href = "#";
    /** @var string */
    protected $label;
    /** @var string */
    protected $iconClass = "";

    public function __construct($options)
    {
        $this->label = gT('Activate this survey');
        parent::__construct($options);
    }
}
