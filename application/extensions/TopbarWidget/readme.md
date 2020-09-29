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

## Files

Folder `buttons/` contains short-hand classes to reduce code duplication.

Folder `views/` contains a Yii view file for each supported button class. The purpose is to separate data from HTML.
