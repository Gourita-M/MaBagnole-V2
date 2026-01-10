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

    //addTheme()

    public function addTheme(): bool
    {
        try{
            $sql = "INSERT INTO themes(title, description)
                    VALUES(?, ?)";

            $stmt = DataBase::Connect()->prepare($sql);

            $stmt->execute([
                $this->title,
                $this->description
            ]);
            return true;
        }catch(pdoexception $e){
            return false;
        }
    }

    //editThemes()

    public function editThemes(){
        try{
            $sql = "UPDATE themes SET
                    title = ? , description = ? 
                    WHERE id = ? ";

            $stmt = DataBase::Connect()->prepare($sql);

            $stmt->execute([
                $this->title,
                $this->description,
                $this->id,
            ]);
            return true;
        }catch(pdoexception $e){
            return false;
        }
    }

    //deleteTheme()

    public function deleteTheme(): bool
    {
        try{
            $sql = "DELETE FROM themes
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