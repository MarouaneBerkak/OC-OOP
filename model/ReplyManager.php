<?php

class ReplyManager extends Manager
{
    public function __construct()
    {
        $this->db = $this->dbConnect();
    }

    public function create(Reply $reply)
    {
        $req = $this->db->prepare('INSERT INTO reply (reply, questionId, userId, date) VALUES (:reply, :questionId, :userId, NOW()) ');

        $req->bindValue(':reply', $reply->getReply(), PDO::PARAM_STR);
        $req->bindValue(':questionId', $reply->getQuestionId(), PDO::PARAM_INT);
        $req->bindValue(':userId', $reply->getUserId(), PDO::PARAM_INT);

        $req->execute();
        $reply->hydrate(array(
            'id' => $this->db->lastInsertId('reply'),
            'date' => date('Y-m-d H:i:s')
        ));
    }
    public function read($info)
    {
        $req = $this->db->query('SELECT reply, date, firstName, surname FROM reply INNER JOIN user ON user.id=reply.userId WHERE questionId = '.$info.'  ORDER BY date DESC');
        return $req;
    }
    public function Last($questionId)
    {
        $req = $this->db->prepare('SELECT * FROM reply WHERE questionId = :id ORDER BY id DESC LIMIT 0, 1');
        $req->bindValue(':id', $questionId, PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    public function countAnsweredQuestions(User $user)
    {
        $req = $this->db->prepare('SELECT COUNT(*) FROM reply WHERE userId = :id');
        $req->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        $req->execute();
        return $req->fetchColumn();
    }
}