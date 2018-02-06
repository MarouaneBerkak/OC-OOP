<?php

class Reply
{
    protected $id;
    protected $reply;
    protected $questionId;
    protected $userId;
    protected $date;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }
    public function hydrate(array $data)
    {
        foreach($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if(method_exists($this,  $method))
            {
                $this->$method($value);
            }
        }
    }

    public function setID(int $id)
    {
        $this->id = $id;
    }
    public function setReply(string $reply)
    {
        $this->reply = $reply;
    }
    public function setQuestionId(int $questionId)
    {
        $this->questionId = $questionId;
    }
    public function setUserId(int $userId)
    {
        $this->userId = $userId;
    }
    public function setDate(string $date)
    {
        $this->date = $date;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getReply()
    {
        return $this->reply;
    }
    public function getQuestionId()
    {
        return $this->questionId;
    }
    public function getUserId()
    {
        return $this->userId;
    }
    public function getDate()
    {
        return $this->date;
    }
}