<?php

namespace code\models;
use code\config\database;
use PDOException;

Class Tags
{
    private $name;

    public function getTags()
    {
        try{
            
            $sql = "SELECT * FROM tags";

            $stmt = DataBase::Connect()->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();

        }catch(pdoexception $e){

            return $e;
        }
    }

    public function getTagsById($artid)
    {
        try{
            
            $sql = "SELECT * FROM tags";

            $stmt = DataBase::Connect()->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();

        }catch(pdoexception $e){

            return $e;
        }
    }

    
}
?>