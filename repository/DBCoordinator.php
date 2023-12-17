<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/repository/DB.php";

class DBCoordinator
{

    // ############################################################################################
    // ################################## INSERT ##################################################
    // ############################################################################################
   
    public static function insert(Coordinator $coordinator)
    {
        try {
            $db = DB::getConnection();
    
            $stmt = $db->prepare("INSERT INTO coordinator (name, password) VALUES (:name, :password)");
    
            $name = $coordinator->getName();
            $password = $coordinator->getPassword();
    
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':password', $password);
    
            $stmt->execute();
    
            return $db->lastInsertId();
        } catch (PDOException $e) {
            die("Error al insertar datos en la tabla coordinator: " . $e->getMessage());
        }
    }
    




    // ############################################################################################
    // ################################## SELECT ##################################################
    // ############################################################################################

    public static function findAll()
    {
        try {
            $db = DB::getConnection();
    
            $arrCoordinator = [];
            $sql = "SELECT * FROM coordinator";
            $result = $db->query($sql);
    
            // Proceso
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
            {
                $arrCoordinator[] = 
                new Coordinator(
                    $row["id"],
                    $row["name"],
                    $row["passowrd"]
                );
            }
    
            return $arrCoordinator;
        } catch (PDOException $e) {
            // Log the error or handle it in an appropriate way
            error_log("Error retrieving data from the coordinator table: " . $e->getMessage());
    
            // Propagate the exception or return an appropriate response
            throw new Exception("Error retrieving data from the coordinator table", 500);
        }
    }




    // ############################################################################################
    // ################################### FIND BY ################################################
    // ############################################################################################
    // find by coordinator_id
    public static function findById($id)
    {
        try {
            $db = DB::getConnection();
    
            $stmt = $db->prepare("SELECT * FROM coordinator WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
    
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if (!$row) {
                return null;
            }
    
            return new Coordinator(
                $row["id"],
                $row["name"],
                $row["password"]
            );
        } catch (PDOException $e) {
            // Log the error or handle it in an appropriate way
            error_log("No se ha encontrado un corrdinador con el siguiente ID: $id: " . $e->getMessage());
    
            // Propagate the exception or return an appropriate response
            throw new Exception("Se ha producido un error para encontrar el coordinador con ID: $id", 500);
        }
    }
    
    // find by coordinator name
    public static function findByName($name)
    {
        try {
            $db = DB::getConnection();
    
            $stmt = $db->prepare("SELECT * FROM coordinator WHERE name = :name");
            $stmt->bindParam(':name', $name);
            $stmt->execute();
    
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if (!$row) {
                // El coordinador no fue encontrado
                return null;
            }
    
            return new Coordinator(
                $row["id"],
                $row["name"],
                $row["password"]
            );
        } catch (PDOException $e) {
            // Log the error or handle it in an appropriate way
            error_log("No se ha encontrado un corrdinador con el siguiente nombre: $name: " . $e->getMessage());
    
            // Propagate the exception or return an appropriate response
            throw new Exception("e ha producido un error para encontrar el coordinador con nombre: $name", 500);
        }
    }
    
    // find by coordinator name
    public static function findByName_Password($name, $password)
    {
        try {
            $db = DB::getConnection();
    
            $stmt = $db->prepare("SELECT * FROM coordinator WHERE name = :name AND password = :password");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
    
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if (!$row) {
                // El coordinador no fue encontrado
                return null;
            }
    
            return new Coordinator(
                $row["id"],
                $row["name"],
                $row["password"]
            );
        } catch (PDOException $e) {
            // Log the error or handle it in an appropriate way
            error_log("No se ha encontrado un corrdinador con el siguiente nombre: $name: " . $e->getMessage());
    
            // Propagate the exception or return an appropriate response
            throw new Exception("e ha producido un error para encontrar el coordinador con nombre: $name", 500);
        }
    }
    




    // ############################################################################################
    // ################################## UPDATE ##################################################
    // ############################################################################################
    // Actualizar coordinador
    public static function update(Coordinator $coordinator)
    {
        try {
            $db = DB::getConnection();

            $stmt = $db->prepare("UPDATE coordinator 
                                SET name = :name, password = :password 
                                WHERE id = :id");

            $stmt->bindParam(':name', $coordinator->getName());
            $stmt->bindParam(':password', $coordinator->getPassword());
            $stmt->bindParam(':id', $coordinator->getId());

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            die("Error al actualizar datos en la tabla coordinator: " . $e->getMessage());
        }
    }

    // update by coordinator id
    public static function updateById($id, Coordinator $coordinator)
    {
        try {
            $db = DB::getConnection();

            $stmt = $db->prepare("UPDATE coordinator 
                                SET name = :name, password = :password 
                                WHERE id = :id");

            $stmt->bindParam(':name', $coordinator->getName());
            $stmt->bindParam(':password', $coordinator->getPassword());
            $stmt->bindParam(':id', $coordinator->getId());

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            die("Error al actualizar datos en la tabla coordinator: " . $e->getMessage());
        }
    }




    // ############################################################################################
    // ################################## DELETE ##################################################
    // ############################################################################################
    // delebe by coordinator id
    public static function delete($id)
    {
        try {
            $db = DB::getConnection();

            $stmt = $db->prepare("DELETE FROM coordinator WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            die("Error al eliminar datos en la tabla coordinator: " . $e->getMessage());
        }
    }
}

?>
