<?php

class TopbarWidget extends CWidget
{
    public $buttons = [];

    public function run()
    {
        $content = '';
        foreach ($this->buttons as $button) {
            $content .= $this->render(
                $this->getViewName($button),
                ['button' => $button],
                true
            );
        }
        $this->render('layout', ['content' => $content]);
    }

    /**
     * @param MenuItemInterface|MenuInterface $button
     * @return string
     */
    protected function getViewName($button)
    {
        $parts = explode('\\', get_class($button));
        return strtolower(end($parts));
    }
}
