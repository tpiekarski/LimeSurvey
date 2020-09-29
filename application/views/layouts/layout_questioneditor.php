<?php

use LimeSurvey\Datavalueobjects\ActivateSurveyButton;
use LimeSurvey\Datavalueobjects\DisplayExportButton;
use LimeSurvey\Menu\Menu;
use LimeSurvey\Menu\DropdownMenu;
use LimeSurvey\Menu\MenuItem;
use LimeSurvey\Menu\DividerMenuItem;
use LimeSurvey\Menu\SmalltextMenuItem;

Yii::import('application.helpers.common_helper', true);
Yii::import('application.helpers.globalsettings_helper', true);

$aData = App()->getController()->aData;

$layoutHelper = new LayoutHelper();

//All paths relative from /application/views

$layoutHelper->showHeaders($aData, false);

$layoutHelper->showadminmenu($aData);

echo "<!-- BEGIN LAYOUT_INSURVEY -->";
// Needed to evaluate EM expressions in question summary
// See bug #11845
LimeExpressionManager::StartProcessingPage(false, true);
$aData['debug'] = $aData;
//$this->_titlebar($aData);
$layoutHelper->rendertitlebar($aData);

//The load indicator for pjax
echo ' <div id="pjax-file-load-container" class="ls-flex-row col-12"><div style="height:2px;width:0px;"></div></div>';

// echo "<pre>".print_r($aData, true)."</pre>";

//The container to hold the vuejs application
echo ' <!-- Survey page, started in Survey_Common_Action::render_wrapped_template() -->
        <div id="vue-apps-main-container" '
    . 'class="ls-flex-row align-items-flex-begin align-content-flex-end col-12" '
    . '>';

$layoutHelper->renderSurveySidemenu($aData);


echo '<div '
    . 'class="ls-flex-column align-items-flex-start align-content-flex-start col-11 ls-flex-item transition-animate-width main-content-container" '
    . '>';
//New general top bar (VueComponent)
//$this->_generaltopbar($aData);
//$layoutHelper->renderGeneraltopbar($aData);
$buttons = [
    new ActivateSurveyButton(
        [
            'href' => $this->createUrl("surveyAdministration/activate/", ['iSurveyID' => $aData['oSurvey']->sid])
        ]
    ),
    new DropdownMenu(
        [
            'label' => gT('Preview survey'),
            'iconClass' => 'fa fa-cog icon',
            'menuItems' => [
                new MenuItem([])
            ]
        ]
    ),
    new DropdownMenu(
        [
            'label' => gT('Tools'),
            'iconClass' => 'icon-tools icon',
            'menuItems' => [
                new MenuItem([]),
                new DividerMenuItem([]),
                new SmalltextMenuItem([]),
                new MenuItem([])
            ]
        ]
    ),
    new Menu(
        [
            'label' => gT('Survey participants'),
            'href' => '#',
            'iconClass' => 'fa fa-user icon'
        ]
    ),
    new Menu(
        [
            'label' => gT('Responses'),
            'href' => '#',
            'disabled' => true,
            'tooltip' => 'This survey is not active - no responses are available.',
            'iconClass' => 'icon-responses icon'
        ]
    ),
    new DisplayExportButton()
];
$this->widget('ext.TopbarWidget.TopbarWidget', ['buttons' => $buttons]);

?>
<div class="container-fluid vue-general-topbar" style="width: 100%;">
    <div class="topbarpanel">
        <nav class="navbar navbar-default scoped-topbar-nav" style="border: none;">
            <div class="ls-flex ls-flex-row ls-space padding top-5">
<?php
$this->widget('zii.widgets.CMenu', [
    'htmlOptions' => [
        'class' => 'nav navbar-nav scoped-topbar-nav ls-flex-item ls-flex-row grow-2 text-left'
    ],
    'items' => [
        [
            'label'       => 'Activate survey',
            'url'         => ['site/index'],
            'template'    => '<div class="topbarbutton">{menu}</div>',
            'linkOptions' => ['class' => 'btn btn-primary topbarbutton' ]
        ],
        [
            'label' => 'Preview survey',
            'url'   => ['product/index'],
            'template' => '<div class="topbarbutton"><div class="btn btn-default"><i class="fa fa-cog"></i>&nbsp;{menu}</div></div>',
            'items' => [
                [
                    'label' => 'New Arrivals',
                    'url'   => ['product/new', 'tag'=>'new']
                ],
                [
                    'label' => 'Most Popular',
                    'url'   => ['product/index', 'tag' => 'popular']
                ],
            ]
        ],
        [
            'label' => 'Login',
            'url'   => ['site/login']
        ]
    ]
]);
?>
            </div>
        </nav>
    </div>
</div>
<?php

echo '<div id="pjax-content" class="col-12">';

echo '<div id="in_survey_common" '
    . 'class="container-fluid ls-flex-column fill col-12"'
    . '>';

//Rendered through /admin/update/_update_notification
$layoutHelper->updatenotification();
$layoutHelper->notifications();

echo $content;

//$this->_generaltopbarAdditions($aData);
$layoutHelper->renderGeneralTopbarAdditions($aData);
echo "</div>\n";
echo "</div>\n";
echo "</div>\n";
echo "</div>\n";
echo "<!-- END LAYOUT_INSURVEY -->";

// Footer
if (!isset($aData['display']['endscripts']) || $aData['display']['endscripts'] !== false) {
    //Yii::app()->getController()->_loadEndScripts();
    $layoutHelper->loadEndScripts();
}

if (!Yii::app()->user->isGuest) {
    if (!isset($aData['display']['footer']) || $aData['display']['footer'] !== false) {
        //Yii::app()->getController()->_getAdminFooter('http://manual.limesurvey.org', gT('LimeSurvey online manual'));
        $layoutHelper->getAdminFooter('http://manual.limesurvey.org');
    }
} else {
    echo '</body>
    </html>';
}
