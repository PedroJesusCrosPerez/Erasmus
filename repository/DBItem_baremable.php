<?php

class DBItem_baremable
{
    
    // ############################################################################################
    // ################################## SELECT ##################################################
    // ############################################################################################
    // Select *
    public static function findAll()
    {
        try {
            $db = DB::getConnection();
    
            $arrItem_baremable = [];
            $sql = "SELECT * FROM item_baremable;";
            $result = $db->query($sql);
    
            // Proceso
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
            {
                $arrItem_baremable[] = 
                new Item_baremable(
                    $row["id"],
                    $row["name"]
                );
            }
    
            return $arrItem_baremable;
        } catch (PDOException $e) {
            throw new Exception("Error retrieving data from the group table "+$e, 500);
        }
    }


    public static function findById($id)
    {
        try {
            $stmt = DB::getConnection()->prepare("SELECT * FROM item_baremable WHERE id = ?");
            $stmt->execute([$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                return null;
            }

            return new Item_baremable(
                $result['id'],
                $result['name']
            );
        } catch (PDOException $e) {
            die("Error during selection: " . $e->getMessage());
        }
    }

}

?>