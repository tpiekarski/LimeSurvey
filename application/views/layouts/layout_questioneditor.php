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
