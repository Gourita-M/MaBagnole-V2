<?php

    namespace code\models;
    use code\models\user;
    use code\config\database;
    use PDOException;

Class Theme 
{
    private $id;
    private $title;
    private $description;

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    //getThemes()

    public function getThemes()
    {
        try{
            $sql = "SELECT * FROM themes";

            $stmt = DataBase::Connect()->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();

        }catch(PDOException $e){
            return $e;
        }
    }

    //getThemesById()

    public function getThemesById()
    {
        try{
            $sql = "SELECT * FROM themes WHERE id = ?";

            $stmt = DataBase::Connect()->prepare($sql);

            $stmt->execute([
                $this->id
            ]);

            return $stmt->fetchAll();

        }catch(PDOException $e){
            return $e;
        }
    }
}

?>