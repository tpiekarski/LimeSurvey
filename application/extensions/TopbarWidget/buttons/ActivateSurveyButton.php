<?php

use LimeSurvey\Menu\MenuItem;

class ActivateSurveyButton extends MenuItem
{
    /**
     * @param array $options href required
     */
    public function __construct($options)
    {
        $this->label = gT('Activate this survey');
        $this->href = $options['href'];
    }
}
