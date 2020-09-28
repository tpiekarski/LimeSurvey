<?php

namespace LimeSurvey\Menu;

class SmalltextMenuItem extends MenuItem
{
    public function __construct($options)
    {
        $this->isSmallText = true;
        parent::__construct($options);
    }
}
