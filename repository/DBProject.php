<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/repository/DB.php";

class DBProject
{

    // ############################################################################################
    // ################################## INSERT ##################################################
    // ############################################################################################
   
    // public static function insert(Project $project)
    // {
    //     try {
    //         $db = DB::getConnection();
    
    //         $stmt = $db->prepare("INSERT INTO project (date_start, date_end, duration, priority, profile, name, source) VALUES (:date_start, :date_end, :duration, :priority, :profile, :name, :source)");
    
    //         $date_start = $project->getDate_start();
    //         $date_end = $project->getDate_end();
    //         $duration = $project->getDuration();
    //         $priority = $project->getPriority();
    //         $profile = $project->getProfile();
    //         $name = $project->getName();
    //         $source = $project->getSource();
    
    //         $stmt->bindParam(':date_start', $date_start);
    //         $stmt->bindParam(':date_end', $date_end);
    //         $stmt->bindParam(':duration', $duration);
    //         $stmt->bindParam(':priority', $priority);
    //         $stmt->bindParam(':profile', $profile);
    //         $stmt->bindParam(':name', $name);
    //         $stmt->bindParam(':source', $source);
    
    //         $stmt->execute();
    
    //         return $db->lastInsertId();
    //     } catch (PDOException $e) {
    //         die("Error al insertar datos en la tabla project: " . $e->getMessage());
    //     }
    // }
    




    // ############################################################################################
    // ################################## SELECT ##################################################
    // ############################################################################################

    public static function findAll()
    {
        try {
            $db = DB::getConnection();
    
            $arrProject = [];
            $sql = "SELECT * FROM project";
            $result = $db->query($sql);
    
            // Proceso
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
            {
                $arrProject[] = 
                new Project(
                    $row["id"],
                    $row["name"],
                    $row["code"],
                    $row["date_start"],
                    $row["date_end"]
                );
            }
    
            return $arrProject;
        } catch (PDOException $e) {
            // Log the error or handle it in an appropriate way
            error_log("Error retrieving data from the project table: " . $e->getMessage());
    
            // Propagate the exception or return an appropriate response
            throw new Exception("Error retrieving data from the project table", 500);
        }
    }




    // ############################################################################################
    // ################################# FIND BY ################################################
    // ############################################################################################

    public static function findById($id)
    {
        try {
            $db = DB::getConnection();

            $stmt = $db->prepare("SELECT * FROM project WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error al obtener datos de la tabla project: " . $e->getMessage());
        }
    }

    // public static function findByProfile($profile)
    // {
    //     try {
    //         $db = DB::getConnection();

    //         $stmt = $db->prepare("SELECT * FROM project WHERE profile = :profile");
    //         $stmt->bindParam(':profile', $profile);
    //         $stmt->execute();

    //         return $stmt->fetch(PDO::FETCH_ASSOC);
    //     } catch (PDOException $e) {
    //         die("Error al obtener datos de la tabla project: " . $e->getMessage());
    //     }
    // }
    public static function findByProfile($profile)
    {
        try {
            $db = DB::getConnection();
    
            $arrProject = [];
            $sql = "SELECT * FROM project WHERE `profile` = '" . $profile . "';";
            $result = $db->query($sql);
    
            // Proceso
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
            {
                $arrProject[] = new Project(
                    $row["id"],
                    $row["date_start"],
                    $row["date_end"],
                    $row["duration"],
                    $row["priority"],
                    $row["profile"],
                    $row["name"],
                    $row["source"]
                );
            }
    
            return $arrProject;
        } catch (PDOException $e) {
            // Log the error or handle it in an appropriate way
            error_log("Error retrieving data from the project table: " . $e->getMessage());
    
            // Propagate the exception or return an appropriate response
            throw new Exception("Error retrieving data from the project table", 500);
        }
    }




    // ############################################################################################
    // ################################## UPDATE ##################################################
    // ############################################################################################

    public static function update(Project $project)
    {
        try {
            $db = DB::getConnection();

            $stmt = $db->prepare("UPDATE project 
                                SET date_start = :date_start, date_end = :date_end, duration = :duration,
                                    priority = :priority, profile = :profile, name = :name, source = :source 
                                WHERE id = :id");

            $stmt->bindParam(':date_start', $project->getDate_start());
            $stmt->bindParam(':date_end', $project->getDate_end());
            $stmt->bindParam(':duration', $project->getDuration());
            $stmt->bindParam(':priority', $project->getPriority());
            $stmt->bindParam(':profile', $project->getProfile());
            $stmt->bindParam(':name', $project->getName());
            $stmt->bindParam(':source', $project->getSource());
            $stmt->bindParam(':id', $project->getId());

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            die("Error al actualizar datos en la tabla project: " . $e->getMessage());
        }
    }

    
    public static function updateSourceById($id, String $source)
    {
        try {
            $db = DB::getConnection();

            $stmt = $db->prepare("UPDATE project 
                                SET source = :source
                                WHERE id = :id");

            $stmt->bindParam(':source', $source);
            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            die("Error al actualizar datos en la tabla project: " . $e->getMessage());
        }
    }




    // ############################################################################################
    // ################################## DELETE ##################################################
    // ############################################################################################
    
    public static function delete($id)
    {
        try {
            $db = DB::getConnection();

            $stmt = $db->prepare("DELETE FROM project WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            die("Error al eliminar datos en la tabla project: " . $e->getMessage());
        }
    }
}

?>
