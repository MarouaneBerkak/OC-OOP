<?php
namespace Ask;

use Ask\App\User;
use Ask\App\Question;
use \PDO;

class QuestionManager extends Manager
{
    public function __construct()
    {
        $this->db = $this->dbConnect();
    }
    public function create(Question $question)
    {
        $req = $this->db->prepare('INSERT INTO question (question, published, userId, date) VALUES (:question, :published, :userId, NOW()) ');

        $req->bindValue(':question', $question->getQuestion(), PDO::PARAM_STR);
        $req->bindValue(':published', $question->getPublished(), PDO::PARAM_INT);
        $req->bindValue(':userId', $question->getUserId(), PDO::PARAM_INT);

        $req->execute();
        $question->hydrate(array(
            'id' => $this->db->lastInsertId('question'),
            'date' => date('Y-m-d H:i:s')
        ));

    }
    public function read()
    {
        $req = $this->db->query('SELECT question.id AS id, question, date, firstName, surname FROM question INNER JOIN user ON user.id=question.userId WHERE published = 1 ORDER BY date DESC');
        return $req;
    }
    public function update(array $info)
    {
        $req = $this->db->prepare('UPDATE question SET published = :published WHERE id = :id');
        $req->bindValue(':published', $info['pub'], PDO::PARAM_INT);
        $req->bindValue(':id', $info['id'], PDO::PARAM_INT);
        $req->execute();
    }
    public function delete(int $id)
    {
        $req = $this->db->prepare('DELETE FROM question WHERE id = :id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
    }
    public function exists(Question $question)
    {
        $req = $this->db->prepare('SELECT COUNT(*) FROM question INNER JOIN user ON question.userId = user.id WHERE question = :question AND user.id = :id');
        $req->bindValue(':question', $question->getQuestion(), PDO::PARAM_STR);
        $req->bindValue(':id', $question->getUserId(), PDO::PARAM_INT);
        $req->execute();
        return (bool) $req->fetchColumn();
    }
    public function countPubQuestions(User $user)
    {
        $req = $this->db->prepare('SELECT COUNT(*) FROM question WHERE published= 1 AND userId = :id');
        $req->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        $req->execute();
        return $req->fetchColumn();
    }
    public function countUnpubQuestions(User $user)
    {
        $req = $this->db->prepare('SELECT COUNT(*) FROM question WHERE published= 0 AND userId = :id');
        $req->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        $req->execute();
        return $req->fetchColumn();
    }
    public function countQuestions(User $user)
    {
        $req = $this->db->prepare('SELECT COUNT(*) FROM question WHERE userId = :id');
        $req->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        $req->execute();
        return $req->fetchColumn();
    }
    public function readUserPubQuestions(User $user)
    {
        $req = $this->db->prepare('SELECT * FROM question WHERE userId = :id AND published = 1');
        $req->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        $req->execute();
        return $req;
    }
    public function readUserUnpubQuestions(User $user)
    {
        $req = $this->db->prepare('SELECT * FROM question WHERE userId = :id AND published = 0');
        $req->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        $req->execute();
        return $req;
    }
}