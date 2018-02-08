<?php
namespace Ask;
use Ask\App\User;
class UserManager extends Manager
{
    public function __construct()
    {
        $this->db = $this->dbConnect();
    }
    public function create(User $user)
    {
        $req = $this->db->prepare('INSERT INTO user (emailAddress, password, firstName, surname) VALUES (:emailAddress, :password, :firstName, :surname)');

        $req->bindValue(':emailAddress', $user->getEmailAddress(), \PDO::PARAM_STR);
        $req->bindValue(':password', $user->getPassword(), \PDO::PARAM_STR);
        $req->bindValue(':firstName', $user->getFirstName(), \PDO::PARAM_STR);
        $req->bindValue(':surname', $user->getSurname(), \PDO::PARAM_STR);

        $req->execute();

        $user->hydrate(array(
            'id' => $this->db->lastInsertId('user')
        ));
    }
    public function read($info)
    {
        if(is_string($info))
        {
            $req = $this->db->prepare('SELECT * FROM user WHERE emailAddress = :emailAddress');
            $req->bindValue(':emailAddress', $info, \PDO::PARAM_STR);
            $req->execute();
            $data = $req->fetch(\PDO::FETCH_ASSOC);
            $user = new User($data);
            return $user;
        }
    }
    public function exists($info)
    {
        if(is_string($info))
        {
            $req = $this->db->prepare('SELECT COUNT(*) FROM user WHERE emailAddress =:emailAddress');
            $req->bindValue(':emailAddress', $info, \PDO::PARAM_STR);
            $req->execute();
            return (bool) $req->fetchColumn();
        }
    }

}