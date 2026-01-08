<?php

namespace code\models;
use code\config\database;
use PDOException;

Class Comments
{
    private $id;
    private $content;
    private $deleted;


    public function __set($name, $value)
    {
        $this->$name = $value ;
    }

    public function __get($name)
    {
        return $this->$name ;
    }

// addComments()

    public function addComments($articleid, $userid)
    {
        try{
            $sql = "INSERT INTO 
                    comments(article_id, author_id, content) 
                    VALUES(?, ?, ?)";
            
            $stmt = DataBase::Connect()->prepare($sql);

            $stmt->execute([
                $articleid,
                $userid,
                $this->content
            ]);

            return true;

        }catch(pdoexception $e){

            return false;

        }
    }

//getComments()

    public function getCommentsById()
    {
        try{
            $sql = "SELECT * FROM comments
                    WHERE id = ? ";

            $stmt = DataBase::Connect()->prepare($sql);

            $stmt->execute([
                $this->id
            ]);

            return $stmt->fetchAll();

        }catch(pdoexception $e){

            return $e;

        }
    }

// getCommentUserName()

    public function getCommentUserName()
    {
        try{
            $sql = "SELECT
                    c.id,
                    c.content,
                    c.creation_date,
                    c.deleted,
                    u.user_name,
                    u.user_id
                    FROM comments c
                    RIGHT JOIN users u ON u.user_id = c.author_id
                    WHERE article_id = ? ";

            $stmt = DataBase::Connect()->prepare($sql);

            $stmt->execute([
                $this->id
            ]);

            return $stmt->fetchAll();

        }catch(pdoexception $e){

            return $e;

        }
    }

//softDelete

    public function softDelete(): bool
    {
        try{

            $sql = "UPDATE comments SET deleted = 1 
                    WHERE id = ? ";

            $stmt = DataBase::Connect()->prepare($sql);

            $stmt->execute([
                $this->id
            ]);

            return true;
        }catch(pdoexception $e){
            return false;
        }
    }

//editComment 

    public function editComment(): bool
    {
        try{
            $sql = "UPDATE comments
                    SET content = ?
                    WHERE id = ? ";

            $stmt = DataBase::Connect()->prepare($sql);

            $stmt->execute([
                $this->content,
                $this->id
            ]);

            return true;

        }catch(pdoexception $e){

            return false;

        }
    }

}

?>