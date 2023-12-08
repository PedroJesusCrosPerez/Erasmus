<?php

class DBGroup
{

    // ############################################################################################
    // ################################## SELECT ##################################################
    // ############################################################################################
    // Select *
    public static function findAll()
    {
        try {
            $db = DB::getConnection();
    
            $arrGroup = [];
            $sql = "SELECT * FROM `group`;";
            $result = $db->query($sql);
    
            // Proceso
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
            {
                $arrGroup[] = 
                new Group(
                    $row["id"],
                    $row["name"]
                );
            }
    
            return $arrGroup;
        } catch (PDOException $e) {
            throw new Exception("Error retrieving data from the group table "+$e, 500);
        }
    }

    public static function findById($id)
    {
        try {
            $stmt = DB::getConnection()->prepare("SELECT * FROM `group` WHERE id = ?");
            $stmt->execute([$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                return null;
            }

            return new Group(
                $result['id'],
                $result['name']
            );
        } catch (PDOException $e) {
            die("Error during selection: " . $e->getMessage());
        }
    }
}


?>