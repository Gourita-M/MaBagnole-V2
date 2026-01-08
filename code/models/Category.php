<?php

namespace code\models;
use code\config\database;
use PDOException;

Class Category
{

    private $cate_name;

    public function setCategoryName($name)
    {  
        $this->cate_name = $name;
    }

    public function getCategoryName()
    {
        return $this->cate_name;
    }

    //addCategory

    public function addCategory():bool
    {
        try{
        $sql = "INSERT INTO categories(cate_name)
                VALUES ( ? )";

        $stmt = DataBase::Connect()->prepare($sql);

        $stmt->execute([
            $this->cate_name
        ]); 
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    //editCategory

    public function editCategory($id):bool
    {
        try{
        $sql = "UPDATE categories
                SET cate_name = ?
                WHERE id = ? ";
        
        $stmt = DataBase::Connect()->prepare($sql);

        $stmt->execute([
            $this->cate_name,
            $id
        ]);
            return true;

        }catch(pdoexception $e){
            return false;
        }
    }

    //deleteCategory

    public function deleteCategory($id):bool
    {
        try{
        $sql = "DELETE FROM categories
                WHERE id = ? ";
        
        $stmt = DataBase::Connect()->prepare($sql);

        $stmt->execute([
            $id
        ]);
            return true;

        }catch(pdoexception $e){
            return false;
        }
    }

    //getCategories

    public function getCategories():array
    {
        $sql = "SELECT * FROM categories";
        $stmt = DataBase::Connect()->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }
}
?>