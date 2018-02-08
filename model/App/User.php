<?php
namespace Ask\App;
class User extends App
{
    protected $firstName;
    protected $surname;
    protected $emailAddress;
    protected $password;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }
    public function hydrate(array $data)
    {
        foreach ($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if(method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

    public function setID(int $id)
    {
        $this->id = $id;
    }
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }
    public function setSurname(string $surname)
    {
        $this->surname = $surname;
    }
    public function setEmailAddress(string $emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getFirstName()
    {
        return $this->firstName;
    }
    public function getSurname()
    {
        return $this->surname;
    }
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }
    public function getPassword()
    {
        return $this->password;
    }
}