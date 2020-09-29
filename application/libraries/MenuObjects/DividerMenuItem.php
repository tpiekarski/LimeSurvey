<?php

namespace LimeSurvey\Menu;

class DividerMenuItem extends MenuItem
{
    public function __construct()
    {
        $this->isDivider = true;
    }
}
