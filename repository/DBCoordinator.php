<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/repository/DB.php";

class DBNews
{

    // ############################################################################################
    // ################################## INSERT ##################################################
    // ############################################################################################
   
    public static function insert(News $news)
    {
        try {
            $db = DB::getConnection();
    
            $stmt = $db->prepare("INSERT INTO news (date_start, date_end, duration, priority, profile, name, source) VALUES (:date_start, :date_end, :duration, :priority, :profile, :name, :source)");
    
            $date_start = $news->getDate_start();
            $date_end = $news->getDate_end();
            $duration = $news->getDuration();
            $priority = $news->getPriority();
            $profile = $news->getProfile();
            $name = $news->getName();
            $source = $news->getSource();
    
            $stmt->bindParam(':date_start', $date_start);
            $stmt->bindParam(':date_end', $date_end);
            $stmt->bindParam(':duration', $duration);
            $stmt->bindParam(':priority', $priority);
            $stmt->bindParam(':profile', $profile);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':source', $source);
    
            $stmt->execute();
    
            return $db->lastInsertId();
        } catch (PDOException $e) {
            die("Error al insertar datos en la tabla news: " . $e->getMessage());
        }
    }
    




    // ############################################################################################
    // ################################## SELECT ##################################################
    // ############################################################################################

    public static function findAll()
    {
        try {
            $db = DB::getConnection();
    
            $arrNews = [];
            $sql = "SELECT * FROM news"; // Corregido el nombre de la tabla a "news"
            $result = $db->query($sql);
    
            // Proceso
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
            {
                $arrNews[] = new News(
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
    
            return $arrNews;
        } catch (PDOException $e) {
            // Log the error or handle it in an appropriate way
            error_log("Error retrieving data from the news table: " . $e->getMessage());
    
            // Propagate the exception or return an appropriate response
            throw new Exception("Error retrieving data from the news table", 500);
        }
    }




    // ############################################################################################
    // ################################# FIND BY ################################################
    // ############################################################################################

    public static function findById($id)
    {
        try {
            $db = DB::getConnection();

            $stmt = $db->prepare("SELECT * FROM news WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error al obtener datos de la tabla news: " . $e->getMessage());
        }
    }

    // public static function findByProfile($profile)
    // {
    //     try {
    //         $db = DB::getConnection();

    //         $stmt = $db->prepare("SELECT * FROM news WHERE profile = :profile");
    //         $stmt->bindParam(':profile', $profile);
    //         $stmt->execute();

    //         return $stmt->fetch(PDO::FETCH_ASSOC);
    //     } catch (PDOException $e) {
    //         die("Error al obtener datos de la tabla news: " . $e->getMessage());
    //     }
    // }
    public static function findByProfile($profile)
    {
        try {
            $db = DB::getConnection();
    
            $arrNews = [];
            $sql = "SELECT * FROM news WHERE `profile` = '" . $profile . "';";
            $result = $db->query($sql);
    
            // Proceso
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
            {
                $arrNews[] = new News(
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
    
            return $arrNews;
        } catch (PDOException $e) {
            // Log the error or handle it in an appropriate way
            error_log("Error retrieving data from the news table: " . $e->getMessage());
    
            // Propagate the exception or return an appropriate response
            throw new Exception("Error retrieving data from the news table", 500);
        }
    }




    // ############################################################################################
    // ################################## UPDATE ##################################################
    // ############################################################################################

    public static function update(News $news)
    {
        try {
            $db = DB::getConnection();

            $stmt = $db->prepare("UPDATE news 
                                SET date_start = :date_start, date_end = :date_end, duration = :duration,
                                    priority = :priority, profile = :profile, name = :name, source = :source 
                                WHERE id = :id");

            $stmt->bindParam(':date_start', $news->getDate_start());
            $stmt->bindParam(':date_end', $news->getDate_end());
            $stmt->bindParam(':duration', $news->getDuration());
            $stmt->bindParam(':priority', $news->getPriority());
            $stmt->bindParam(':profile', $news->getProfile());
            $stmt->bindParam(':name', $news->getName());
            $stmt->bindParam(':source', $news->getSource());
            $stmt->bindParam(':id', $news->getId());

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            die("Error al actualizar datos en la tabla news: " . $e->getMessage());
        }
    }

    
    public static function updateSourceById($id, String $source)
    {
        try {
            $db = DB::getConnection();

            $stmt = $db->prepare("UPDATE news 
                                SET source = :source
                                WHERE id = :id");

            $stmt->bindParam(':source', $source);
            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            die("Error al actualizar datos en la tabla news: " . $e->getMessage());
        }
    }




    // ############################################################################################
    // ################################## DELETE ##################################################
    // ############################################################################################
    
    public static function delete($id)
    {
        try {
            $db = DB::getConnection();

            $stmt = $db->prepare("DELETE FROM news WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            die("Error al eliminar datos en la tabla news: " . $e->getMessage());
        }
    }
}

?>
