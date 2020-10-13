<?php


namespace LimeSurvey\Datavalueobjects;


class Field
{
    /**
     * @var string
     */
    private string $name;
    /**
     * @var string
     */
    private string $type;
    /**
     * @var int
     */
    private int $surveyid;

    /**
     * @var int
     */
    private int $questionid;

    /**
     * @var int
     */
    private int $questiongroupid;

    /**
     * @var int
     */
    private int $aid; // TODO: WAS IST DAS
    /**
     * @var string
     */
    private string $answerTableDefinition;

    /**
     * @var string
     */
    private string $title;

    /**
     * @var string
     */
    private string $question;

    /**
     * @var string
     */
    private string $groupName;

    /**
     * @var mixed|string
     */
    private string $mandatory;

    /**
     * @var mixed|string
     */
    private string $encrypted;

    /**
     * @var mixed|string
     */
    private string $hasConditions;

    /**
     * @var mixed|string
     */
    private string $usedInConditions;

    /**
     * @var int
     */
    private int $questionSequence;

    /**
     * @var int|mixed
     */
    private int $groupSequence;

    /**
     * @var mixed|string
     */
    private string $relevance;

    /**
     * @var mixed|string
     */
    private string $grelevance;

    /**
     * @var mixed|string
     */
    private string $preg;

    /**
     * @var mixed|string
     */
    private string $other;

    /**
     * @var mixed|string
     */
    private string $help;

    /**
     * @var int
     */
    private int $randomGroupID;

    /**
     * @return int
     */
    public function getRandomGroupID(): int
    {
        return $this->randomGroupID;
    }

    /**
     * @param int $randomGroupID
     */
    public function setRandomGroupID(int $randomGroupID): void
    {
        $this->randomGroupID = $randomGroupID;
    }

    /**
     * Field constructor.
     * @param array $item
     */
    public function __construct(array $item)
    {
        $this->name = $item['fieldname'];
        $this->title = $item['title'];
        $this->surveyid = (int) $item['sid'];
        $this->questiongroupid = (int) $item['gid'];
        $this->questionid = (int) $item['qid'];
        $this->aid = (int) $item['aid'];
        $this->question = $item['question'];
        $this->groupName = $item['group_name'];
        $this->type = $item['type'];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getSurveyid(): int
    {
        return $this->surveyid;
    }

    /**
     * @param int $surveyid
     */
    public function setSurveyid(int $surveyid): void
    {
        $this->surveyid = $surveyid;
    }

    /**
     * @return int
     */
    public function getQuestionid(): int
    {
        return $this->questionid;
    }

    /**
     * @param int $questionid
     */
    public function setQuestionid(int $questionid): void
    {
        $this->questionid = $questionid;
    }

    /**
     * @return int
     */
    public function getQuestiongroupid(): int
    {
        return $this->questiongroupid;
    }

    /**
     * @param int $questiongroupid
     */
    public function setQuestiongroupid(int $questiongroupid): void
    {
        $this->questiongroupid = $questiongroupid;
    }

    /**
     * @return int
     */
    public function getAid(): int
    {
        return $this->aid;
    }

    /**
     * @param int $aid
     */
    public function setAid(int $aid): void
    {
        $this->aid = $aid;
    }

    /**
     * @return string
     */
    public function getAnswerTableDefinition(): string
    {
        return $this->answerTableDefinition;
    }

    /**
     * @param string $answerTableDefinition
     */
    public function setAnswerTableDefinition(string $answerTableDefinition): void
    {
        $this->answerTableDefinition = $answerTableDefinition;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * @param string $question
     */
    public function setQuestion(string $question): void
    {
        $this->question = $question;
    }

    /**
     * @return string
     */
    public function getGroupName(): string
    {
        return $this->groupName;
    }

    /**
     * @param string $groupName
     */
    public function setGroupName(string $groupName): void
    {
        $this->groupName = $groupName;
    }

    /**
     * @return mixed|string
     */
    public function getMandatory()
    {
        return $this->mandatory;
    }

    /**
     * @param mixed|string $mandatory
     */
    public function setMandatory($mandatory): void
    {
        $this->mandatory = $mandatory;
    }

    /**
     * @return mixed|string
     */
    public function getEncrypted()
    {
        return $this->encrypted;
    }

    /**
     * @param mixed|string $encrypted
     */
    public function setEncrypted($encrypted): void
    {
        $this->encrypted = $encrypted;
    }

    /**
     * @return mixed|string
     */
    public function getHasConditions()
    {
        return $this->hasConditions;
    }

    /**
     * @param mixed|string $hasConditions
     */
    public function setHasConditions($hasConditions): void
    {
        $this->hasConditions = $hasConditions;
    }

    /**
     * @return mixed|string
     */
    public function getUsedInConditions()
    {
        return $this->usedInConditions;
    }

    /**
     * @param mixed|string $usedInConditions
     */
    public function setUsedInConditions($usedInConditions): void
    {
        $this->usedInConditions = $usedInConditions;
    }

    /**
     * @return int|mixed
     */
    public function getQuestionSequence()
    {
        return $this->questionSequence;
    }

    /**
     * @param int|mixed $questionSequence
     */
    public function setQuestionSequence($questionSequence): void
    {
        $this->questionSequence = $questionSequence;
    }

    /**
     * @return int|mixed
     */
    public function getGroupSequence()
    {
        return $this->groupSequence;
    }

    /**
     * @param int|mixed $groupSequence
     */
    public function setGroupSequence($groupSequence): void
    {
        $this->groupSequence = $groupSequence;
    }

    /**
     * @return mixed|string
     */
    public function getRelevance()
    {
        return $this->relevance;
    }

    /**
     * @param mixed|string $relevance
     */
    public function setRelevance($relevance): void
    {
        $this->relevance = $relevance;
    }

    /**
     * @return mixed|string
     */
    public function getGrelevance()
    {
        return $this->grelevance;
    }

    /**
     * @param mixed|string $grelevance
     */
    public function setGrelevance($grelevance): void
    {
        $this->grelevance = $grelevance;
    }

    /**
     * @return mixed|string
     */
    public function getPreg()
    {
        return $this->preg;
    }

    /**
     * @param mixed|string $preg
     */
    public function setPreg($preg): void
    {
        $this->preg = $preg;
    }

    /**
     * @return mixed|string
     */
    public function getOther()
    {
        return $this->other;
    }

    /**
     * @param mixed|string $other
     */
    public function setOther($other): void
    {
        $this->other = $other;
    }

    /**
     * @return mixed|string
     */
    public function getHelp()
    {
        return $this->help;
    }

    /**
     * @param mixed|string $help
     */
    public function setHelp($help): void
    {
        $this->help = $help;
    }
}
