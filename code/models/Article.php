<?php

namespace code\models;
use code\config\database;
use PDOException;

Class Article
{
    private $id;
    private $title;
    private $content;
    private $urlmedia;
    private $status;
    private $publishdate;

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    //addArticle()

    public function addArticle($userid, $themeid): bool
    {
        try{
            $sql = "INSERT 
                    INTO articles(theme_id, title_art, content, author_id, art_media)
                    VALUES(?, ?, ?, ?, ?)";
            
            $stmt = DataBase::Connect()->prepare($sql);

            $stmt->execute([
                $themeid,
                $this->title,
                $this->content,
                $userid,
                $this->urlmedia
            ]);

            return true;

        }catch(PDOEXCEPTION $e){
            return false;
        }
    }

    //getArticlesAndThemeName()

    public function getArticlesAndThemeName()
    {
        try{

            $sql = "SELECT a.id, a.title_art, a.content, a.publish_date
                    , t.title, a.theme_id
                    FROM articles a
                    LEFT JOIN themes t ON t.id = a.theme_id         
                    WHERE a.theme_id = ?" ;
            $stmt = DataBase::Connect()->prepare($sql);

            $stmt->execute([
                $this->id
            ]);

            return $stmt->fetchAll();

        }catch(pdoexception $e){

            return $e;
        }
    }

    //getArticlesComments()

    public function getArticles()
    {
        try{
            $sql = "SELECT * FROM articles a
                    WHERE a.id = ? ";

            $stmt = DataBase::Connect()->prepare($sql);

            $stmt->execute([
                $this->id
            ]);

            return $stmt->fetchAll();

        }catch(pdoexception $e){
            echo $e;
        }
    }

    //addArtcleTag()

    public function addArtcleTag($articleid, $tagid)
    {
        try{
            $sql = "INSERT INTO article_tags(article_id, tag_id)
                    VALUES(?, ?)";

            $stmt = DataBase::Connect()->prepare($sql);

            $stmt->execute([
                $articleid,
                $tagid
            ]);

            return true;
        }catch(pdoexception $e){
            return false;
        }
    }

    //getLastArticle()

    public function getLastArticle(){
        try{

            $sql = "SELECT * FROM articles a
                    ORDER BY a.id DESC
                    LIMIT 1 ";

            $stmt = DataBase::Connect()->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();

        }catch(pdoexception $e){
            return $e;
        }
    }
}

?>