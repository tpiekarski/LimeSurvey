<?php


namespace LimeSurvey\Datavalueobjects;

use LimeSurvey\Datavalueobjects\Field as Field;
use Question;

class FieldMap
{
    /**
     * @var Field
     */
    private $currentField;
    /**
     * @var array
     */
    private array $list;


    /**
     * FieldMap constructor.
     *
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        foreach ($items as $item) {
            var_dump($item);
            $this->currentField = new Field($item);

            $answerTableExists = isset($item['answertabledefinition']);
            $mandatoryExists   = isset($item['mandatory']);
            $encryptedExists   = isset($item['encrypted']);

            $hasConditionsExists    = isset($item['hasconditions']);
            $usedInConditionsExists = isset($item['usedinconditions']);
            $questionSequenceExists = isset($item['questionSeq']);

            $groupSequenceExists = isset($item['groupSeq']);
            $relevanceExists     = isset($item['relevance']);
            $grelevanceExists    = isset($item['grelevance']);

            $pregExists  = isset($item['preg']);
            $otherExists = isset($item['other']);
            $helpExists  = isset($item['help']);

            $randomGroupIdExists = isset($item['random_gid']);

            if ($answerTableExists) {
                $this->currentField->setAnswerTableDefinition($item['answertabledefinition']);
            } else {
                $this->currentField->setAnswerTableDefinition('');
            }
            if ($mandatoryExists) {
                $this->currentField->setMandatory($item['mandatory']);
            } else {
                $this->currentField->setMandatory('');
            }
            if ($encryptedExists) {
                $this->currentField->setEncrypted($item['encrypted']);
            } else {
                $this->currentField->setEncrypted('');
            }
            if ($hasConditionsExists) {
                $this->currentField->setHasConditions($item['hasconditions']);
            } else {
                $this->currentField->setHasConditions('');
            }
            if ($usedInConditionsExists) {
                $this->currentField->setUsedInConditions($item['usedinconditions']);
            } else {
                $this->currentField->setUsedInConditions('');
            }
            if ($questionSequenceExists) {
                $this->currentField->setQuestionSequence($item['questionSeq']);
            } else {
                $this->currentField->setQuestionSequence(0);
            }
            if ($groupSequenceExists) {
                $this->currentField->setGroupSequence($item['groupSeq']);
            } else {
                $this->currentField->setGroupSequence(0);
            }
            if ($relevanceExists) {
                $this->currentField->setRelevance($item['relevance']);
            } else {
                $this->currentField->setRelevance('');
            }
            if ($grelevanceExists) {
                $this->currentField->setGrelevance($item['grelevance']);
            } else {
                $this->currentField->setGrelevance('');
            }
            if ($pregExists) {
                $this->currentField->setPreg($item['preg']);
            } else {
                $this->currentField->setPreg('');
            }
            if ($otherExists) {
                $this->currentField->setOther($item['other']);
            } else {
                $this->currentField->setOther('');
            }
            if ($helpExists) {
                $this->currentField->setHelp($item['help']);
            } else {
                $this->currentField->setHelp('');
            }
            if ($randomGroupIdExists) {
                $this->currentField->setRandomGroupId($item['random_gid']);
            } else {
                $this->currentField->setRandomGroupID(0);
            }
            $this->list[$this->currentField->getName()] = $this->currentField;
        }
    }

    /**
     * @param Field $field
     */
    public function addField(Field $field) {
        $this->list[$field->getName()] = $$this->currentField;
    }

    /**
     * @param string $name
     * @return Field
     */
    public function getField(string $name) : Field
    {
        return $this->list[$name];
    }

    /**
     * @return array
     */
    public function getList(): array
    {
        return $this->list;
    }
}
