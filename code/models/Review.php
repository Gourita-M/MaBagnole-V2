<?php

namespace code\models;
use code\config\database;
use PDOException;

Class Review
{
    private $review_id;
    private $user_id;
    private $vehicle_id;
    private $rating;
    private $reviews_comment;
    private $deleted_at = NULL;
    
    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

//softDelete

    public function softDelete():bool
    {
        try{
        $sql = "UPDATE reviews r
                SET r.deleted_at = NOW()
                WHERE r.reviews_id = ? ;
                ";

        $stmt = DataBase::Connect()->prepare($sql);

        $stmt->execute([
            $this->review_id
        ]);

            return true;

        }catch(pdoexception $e){
            return false;
        }
    }

//addReview

    public function addReview():bool
    {
        try{
        $sql = "INSERT INTO reviews(user_id, vehicle_id, rating, reviews_comment, deleted_at)
                VALUES(?, ?, ?, ?, ?)";

        $stmt = DataBase::Connect()->prepare($sql);

        $stmt->execute([
            $this->user_id,
            $this->vehicle_id,
            $this->rating,
            $this->reviews_comment,
            $this->deleted_at
        ]);
            return true;
        } catch(PDOException $e){
            
            return false;
        }
    }

//getReviewsById

    public function getReviewsById()
    {
        try{
            
            $sql = "SELECT * FROM reviews r
                    WHERE r.reviews_id = ? ";
            $stmt = DataBase::Connect()->prepare($sql);

            $stmt->execute([
                $this->review_id
            ]);

            return $stmt->fetch();

        }catch(pdoexception $e){

            return $e;
        }
    }

//editReview

    public function editReview(): bool
    {
        try{

            $sql = "UPDATE reviews 
                    SET rating = ? , reviews_comment = ? 
                    WHERE reviews_id = ? ";
            
            $stmt = DataBase::Connect()->prepare($sql);

            $stmt->execute([
                $this->rating,
                $this->reviews_comment,
                $this->review_id
            ]);

                return true;

        }catch(pdoexception $e){

                return false;
        }
    }

//getByVehicleid

    public function getByVehicleid($id)
    {
        try{
            $sql = "SELECT 
                    v.model, 
                    v.price_day, 
                    v.vehicle_status,
                    v.Vehicle_image,
                    r.reviews_comment,
                    u.user_name
                    FROM vehicles v
                    LEFT JOIN reviews r 
                    ON v.vehicle_id = r.vehicle_id
                    LEFT JOIN users u
                    ON r.user_id = u.user_id
                    WHERE v.vehicle_id = ? ";

            $stmt = DataBase::Connect()->prepare($sql);

            $stmt->execute([
                $id
            ]);

            return $stmt->fetchAll();

        }catch(pdoexception $e){
            return $e;
        }
    }

//getReviewsWithVehicles

    public function getReviewsWithVehicles()
    {
        try{
            $sql = "SELECT 
                    v.model, 
                    v.price_day, 
                    v.vehicle_status,
                    v.Vehicle_image,
                    r.reviews_comment,
                    u.user_name,
                    r.deleted_at,
                    r.reviews_id
                    FROM vehicles v
                    LEFT JOIN reviews r 
                    ON v.vehicle_id = r.vehicle_id
                    LEFT JOIN users u
                    ON r.user_id = u.user_id ";

            $stmt = DataBase::Connect()->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();

        }catch(pdoexception $e){
            return $e;
        }
    }
}
?>