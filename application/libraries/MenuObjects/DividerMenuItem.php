<?php

namespace LimeSurvey\Menu;

class DividerMenuItem extends MenuItem
{
    public function __construct($options)
    {
        $this->isDivider = true;
        parent::__construct($options);
    }
}
