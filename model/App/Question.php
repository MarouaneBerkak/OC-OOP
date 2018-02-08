<?php
namespace Ask\App;
class Question extends App
{
    private $question;
    private $published;
    private $userId;
    private $date;

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
    public function setQuestion(string $question)
    {
        $this->question = $question;
    }
    public function setPublished(int $published)
    {
        $this->published = $published;
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
    public function getQuestion()
    {
        return $this->question;
    }
    public function getPublished()
    {
        return $this->published;
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