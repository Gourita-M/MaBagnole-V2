<?php 

namespace code\models;
use code\config\database;
use PDOException;
 
class Vehicles
{
    private $model;
    private $price_day;
    private $vehicle_status;
    private $category_id;
    private $Vehicle_image;

    public function __set($name , $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

//addVehicle

    public function addVehicle():bool
    {
        try{
        $sql = "INSERT INTO vehicles(model, price_day, vehicle_status, category_id, Vehicle_image)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = DataBase::Connect()->prepare($sql);
        $stmt->execute([
            $this->model,
            $this->price_day,
            $this->vehicle_status,
            $this->category_id,
            $this->Vehicle_image
        ]);
            return true;
        } catch(PDOException $e){
            return false;
        }
    }

//editVehicle

    public function editVehicle($id):bool
    {
        try{
        $sql = "UPDATE FROM vehicles SET
                model = ?,
                price_day = ?, 
                vehicle_status = ?, 
                category_id = ?, 
                Vehicle_image = ?
                WHERE vehicle_id = ?
                ";
        $stmt = DataBase::Connect()->prepare($sql);
        $stmt->execute([
            $this->model,
            $this->price_day,
            $this->vehicle_status,
            $this->category_id,
            $this->Vehicle_image,
            $id
        ]);
            return true;
        }catch(pdoexception $e){
            return false;
        }
    }

//deleteVehicle

    public function deleteVehicle($id):bool
    {
        try{
        $sql = "DELETE FROM vehicles
                WHERE vehicle_id = ? ";
        $stmt = DataBase::Connect()->prepare($sql);
        $stmt->execute([
            $id
        ]);
            return true;
        }catch(pdoexception $e){
            return false;
        }
    }

//getVehicle 

    public function getVehicle():array
    {
        $sql = "SELECT * FROM vehicles";
        $stmt = DataBase::Connect()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

//findVehicleById

    public function findVehicleById($id):array
    {
        $sql = "SELECT * 
                FROM vehicles
                WHERE vehicle_id = ? ";

        $stmt = DataBase::Connect()->prepare($sql);
        $stmt->execute([
            $id
        ]);
        return $stmt->fetch();
    }

//getVehicleCategory

    public function getVehicleCategory()
    {
        try{
            $sql = "SELECT * FROM vehicles v
                    LEFT JOIN categories c 
                    ON c.id = v.category_id;";

            $stmt = DataBase::Connect()->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();

        }catch(pdoexception $e){
            return $e;
        }
    }
//vehicleStatus


}

?>