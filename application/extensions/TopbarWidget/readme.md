## TopbarWidget

Small widget to render the LimeSurvey top-bar.

This widget use classes based on the `Menu` and `MenuItem` classes found in `application/libraries/MenuObjects`.

It works by looping the object list and render the view with the same name as the class name.

## Usage

Small example:

    <?php $this->widget('ext.TopbarWidget.TopbarWidget', ['buttons' => $controller->getTopbarButtons()]); ?>

where `getTopbarButtons` is a method for each admin controller with a top-bar.

Without autoloading, to use the special button classes, you need to run:

    Yii::import('ext.TopbarWidget.buttons.*');

Example:

    /**
     * @return MenuInterface[]
     */
    public function getTopbarButtons()
    {
        Yii::import('ext.TopbarWidget.buttons.*');
        $iSurveyID = $this->aData['oSurvey']->sid;

        $buttons = [];
        $buttons[] = new ActivateSurveyButton(
            [
                'href'          => $this->createUrl("surveyAdministration/activate/", ['iSurveyID' => $this->aData['oSurvey']->sid]),
                'hasPermission' => Permission::model()->hasSurveyPermission($iSurveyID, 'surveyactivation', 'update')
            ]
        );
        return $buttons;
    }

## Files

Folder `buttons/` contains short-hand classes to reduce code duplication.

Folder `views/` contains a Yii view file for each supported button class. The purpose is to separate data from HTML.

## Comments

> I think to following should be achieved:
>
> (1) make it easy to add/change a button
> 
> (2) find a place where to but the topbar buttons (alsways the same structure like conrtoller function getTopBarButtons()
> 
> (3) where to store the html (should be in a view)

Changing which buttons are shown for a controller are done in `getTopbarButtons()`.

To add a new button, use the `Menu` class or a subclass.

To add a new _type_ of button, add a new class in `buttons/` and a new view file in `views/`.

All HTML is stored in `views/`.
