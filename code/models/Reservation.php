<?php

namespace code\models;
use code\config\database;
use PDOException;

Class Reservation
{
    private $vehicleid;
    private $start_date;
    private $end_date;
    private $location;

    public function __set($prop , $value)
    {
        $this->$prop = $value;
    }

    public function __get($pro)
    {
        return $this->$pro;
    }

//createReservation

    public function createReservation($userid):bool
    {
        try{
        $sql = "INSERT INTO reservations
                (user_id, vehicle_id, start_date, end_date, pickup_location)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = DataBase::Connect()->prepare($sql);

        $stmt->execute([
            $userid,
            $this->vehicleid,
            $this->start_date,
            $this->end_date,
            $this->location
        ]);
            return true;

        }catch(pdoexception $e){
            return false;
        }
    }

//aditReservation

    public function aditReservation($id):bool
    {
        try{
        $sql = "UPDATE reservations SET
                vehicle_id = ?,
                'start_date' = ?, 
                end_date = ?, 
                pickup_location = ?
                WHERE reservation_id = ?";

        $stmt = DataBase::Connect()->prepare($sql);

        $stmt->execute([
            $this->vehicleid,
            $this->start_date,
            $this->end_date,
            $this->location,
            $id
        ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

//abortReservation



//getReservation

    public function getReservation():array
    {
        $sql = "SELECT * FROM reservations";
        $stmt = DataBase::Connect()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

//getReservation&Review

    public function getReservationReview($userid)
    {
        $sql = "SELECT
                    v.Vehicle_image,
                    v.model,
                    c.cate_name,
                    r.start_date,
                    r.end_date,
                    r.reservation_id,
                    rr.reviews_comment,
                    v.vehicle_id,
                    rr.reviews_id,
                    rr.rating
                FROM reservations r
                JOIN vehicles v ON v.vehicle_id = r.vehicle_id
                JOIN categories c ON c.id = v.category_id
                JOIN users u ON u.user_id = r.user_id
                LEFT JOIN reviews rr 
                    ON rr.vehicle_id = v.vehicle_id
                    AND rr.user_id = u.user_id
                    AND rr.deleted_at IS NULL
                WHERE u.user_id = ?;
                ";

        $stmt = DataBase::Connect()->prepare($sql);

        $stmt->execute([
            $userid
        ]);

        return $stmt->fetchAll();
    }

//findReservationByUserId

//getReservationByVehicle
    public function getReservationByVehicle()
    {
        $sql = "SELECT * 
                FROM reservations r 
                LEFT JOIN vehicles v 
                ON v.vehicle_id = r.vehicle_id;";

        $stmt = DataBase::Connect()->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }
}
?>