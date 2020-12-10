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
    <div id="save-as-label-set-vue-app" class="modal-dialog" role="document">
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
        // It's possible to have multiple apps on one page.
        const app = new Vue({
            el: '#save-as-label-set-vue-app',
            data: {
                newOrReplace: null,
                l10n: {
                    saveAsLabelSet: '<?= gT("Save as label set (Vue version)"); ?>',
                    labelSetNameInput: 'Label set name:',
                    newLabelSet: '<?= gT("New label set"); ?>',
                    replaceExistingRecord: '<?= gT("Replace the existing record"); ?>',
                    save: '<?= gT("Save"); ?>',
                    cancel: '<?= gT("Cancel"); ?>',
                }
            }
        })
    </script>

    <!-- Test modal as React component. -->
    <div id="save-as-label-set-react-app" class="modal-dialog" role="document"></div>

    <!-- Notice type "text/babel" to compile with Babel in browser (not recommended prod setup). -->
    <script type="text/babel">
        class LabelSetSelect extends React.Component {
            constructor(props) {
                super(props);
                this.state = {
                    options: null
                };
            }

            /**
             * Triggered at each mount.
             *
             * @see <https://stackoverflow.com/questions/27192621/reactjs-async-rendering-of-components>
             */
            async componentDidMount() {
                const url = '<?= Yii::app()->createUrl("/admin/labels/sa/getAllSets"); ?>';
                const options = await $.getJSON(url);
                this.setState({options});
            }

            render() {
                if (this.state.options === null) {
                    return <p>Loading...</p>;
                } else {
                    return (
                        <select name="laname-react">
                            <option value=""></option>
                            {Object.entries(this.state.options).map(
                                (item) => <option key={item[0]} value={item[0]}>{item[1]}</option>
                            )}
                        </select>
                    );
                }
            }
        }

        // Class-based components (React also supports function-based components, as does Vue).
        class SaveAsLabelSetModal extends React.Component {
            constructor(props) {
                super(props);

                // Mixing JS and PHP, would not work in separate file.
                this.l10n = {
                    saveAsLabelSet: '<?= gT("Save as label set (React version)"); ?>',
                    newLabelSet: '<?= gT("New label set"); ?>',
                    labelSetNameInput: '<?= gT("Label set name:"); ?>',
                    replaceExistingRecord: '<?= gT("Replace the existing record"); ?>',
                    save: '<?= gT("Save"); ?>',
                    cancel: '<?= gT("Cancel"); ?>',
                }

                // State-changes trigger re-rendering.
                this.state = {
                    showInputValue: null
                };

                // If using ES6 class functions, might need to bind "this":
                // this.showInputChange = this.showInputChange.bind(this);
            }

            /**
             * Problem with "this is undefined" with ES6 class function.
             *
             * @see <https://babeljs.io/blog/2015/07/07/react-on-es6-plus#arrow-functions>
             */
            showInputChange = (event) => {
                this.setState({showInputValue: event.target.value});
            }

            /**
             * This method returns an JSX object (not HTML string).
             */
            render() {
                // Conditional rendering, mixing JS and JSX.
                let inputToShow = null;
                if (this.state.showInputValue === 'replace') {
                    inputToShow = <LabelSetSelect/>;
                } else if (this.state.showInputValue === 'new') {
                    inputToShow = (
                        <div>
                            <p className="label-name-wrapper">
                                <label htmlFor="laname">{this.l10n.labelSetNameInput}</label>
                                <input type="text" name="laname" id="laname"/>
                             </p>
                        </div>
                    );
                } else {
                    inputToShow = null;
                }

                // Looks like HTML but is in fact JSX. Couple of differences.
                //   - class attribute becomes className.
                //   - for attribute becomes htmlFor.
                //   - No HTML comments
                return (
                    <div className="modal-content">
                        <div className="modal-header">
                            <button type="button" className="close" data-dismiss="modal" aria-label="Close"><span >&times;</span></button>
                            <h4 className="modal-title">
                                {this.l10n.saveAsLabelSet}
                            </h4>

                        </div>

                        <div className="modal-body">
                            <p>
                                <input type="radio" name="showInput" value="new" onClick={this.showInputChange} />
                                <label>{this.l10n.newLabelSet}</label>
                            </p>
                            <p>
                                <input type="radio" name="showInput" value="replace" onClick={this.showInputChange} />
                                <label>{this.l10n.replaceExistingRecord}</label>
                            </p>
                        </div>

                        {inputToShow}

                        <div className="modal-footer button-list">
                            <button id='btnsavelabelset' className='btn btn-default' type='button'>{this.l10n.save}</button>
                            <button className='btn btn-warning' id='btnlacancel' type='button'  data-dismiss="modal">{this.l10n.cancel}</button>
                        </div>
                    </div>
                );
            }
        }
        ReactDOM.render(
          <SaveAsLabelSetModal />,
          document.getElementById('save-as-label-set-react-app')
        );
    </script>
</div>
