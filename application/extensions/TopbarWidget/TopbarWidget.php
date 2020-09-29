<?php

use LimeSurvey\Menu\MenuInterface;

class TopbarWidget extends CWidget
{
    /** @var MenuInterface[] */
    public $buttons = [];

    /** @var Permission */
    public $permissionModel;

    public function run()
    {
        $content = '';
        foreach ($this->buttons as $button) {
            if ($button->hasPermission()) {
                $content .= $this->render(
                    $this->getViewName($button),
                    ['button' => $button],
                    true
                );
            }
        }
        $this->render('layout', ['content' => $content]);
    }

    /**
     * @param MenuInterface $button
     * @return string
     */
    protected function getViewName(MenuInterface $button)
    {
        $parts = explode('\\', get_class($button));
        return strtolower(end($parts));
    }
}
