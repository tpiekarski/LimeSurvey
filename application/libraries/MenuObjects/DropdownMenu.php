<?php

namespace LimeSurvey\Menu;

class DropdownMenu extends Menu
{
    public function __construct($options)
    {
        $this->isDropDown = true;
        parent::__construct($options);
    }
}
