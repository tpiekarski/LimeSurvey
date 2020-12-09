<?php

/** @var Survey $oSurvey */

$this->renderPartial(
    'topbars/' . $this->aData['renderSpecificTopbar'],
    [
        'closeBtnUrl'=> $this->createUrl(
            'surveyAdministration/view/',
            ['surveyid' => $oSurvey->sid]
        ),
        'surveyId' => $oSurvey->sid,
        'question' => $question,
    ]
);

?>

<style>
/* TODO: Move where? */
.scoped-unset-pointer-events {
    pointer-events: none;
}
</style>

<!-- Create form for question -->
<div class="side-body">

    <!-- Test modal as Vue app -->
    <div id="save-as-label-set-vue-component" class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span >&times;</span></button>
                <h4 class="modal-title">
                    {{ l10n.saveAsLabelSet }}
                </h4>

            </div>

            <div class="modal-body">
                <p>
                    <input type="radio" name="savelabeloption" id="newlabel" value="new" v-model="newOrReplace">
                    <label for="newlabel">{{ l10n.newLabelSet }}</label>
                </p>
                <p>
                    <input type="radio" name="savelabeloption" id="replacelabel" value="replace" v-model="newOrReplace">
                    <label for="replacelabel">{{ l10n.replaceExistingRecord }}</label>
                </p>
            </div>

            <!-- "New" input -->
            <div v-if="newOrReplace === 'new'">
                <p id="lasets" class="label-name-wrapper">
                    <label for="laname">{{ l10n.labelSetNameInput }}</label>
                    <input type="text" name="laname" id="laname">
                 </p>
            </div>
            <!-- "Replace" input -->
            <div v-if="newOrReplace === 'replace'">
                <p id="laname" class="label-name-wrapper">
                    <label-set-select/>
                </p>
            </div>

            <div class="modal-footer button-list">
                <button id='btnsavelabelset' class='btn btn-default' type='button'>{{ l10n.save }}</button>
                <button class='btn btn-warning' id='btnlacancel' type='button'  data-dismiss="modal">{{ l10n.cancel }}</button>
            </div>
        </div>
    </div>
    <script>
        // Register component replace-input globally.
        // Can also be imported as a module.
        // Web component ~= Yii widget.
        // Vue template ~= Twig + reactivity.
        Vue.component('label-set-select', {
            data: () => {
                return {
                    options: []
                };
            },
            template: `
                <select name="laname">
                    <option value=""></option>
                    <option v-for="(option, index) in this.options" value="index">
                        {{ option }}
                    </option>
                </select>
            `,
            created: async function() {
                const url = '<?= Yii::app()->createUrl("/admin/labels/sa/getAllSets"); ?>';
                this.options = await $.getJSON(url);
            }
        });
        const app = new Vue({
            el: '#save-as-label-set-vue-component',
            data: {
                newOrReplace: null,
                l10n: {
                    saveAsLabelSet: '<?= gT("Save as label set"); ?>',
                    labelSetNameInput: 'Label set name:',
                    newLabelSet: '<?= gT("New label set"); ?>',
                    replaceExistingRecord: '<?= gT("Replace the existing record"); ?>',
                    save: '<?= gT("Save"); ?>',
                    cancel: '<?= gT("Cancel"); ?>',
                }
            }
        })
    </script>
</div>
