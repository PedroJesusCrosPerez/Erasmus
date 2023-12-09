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


    // WHERE id = ?
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


    // WHERE contributes_student IS null
    public static function findContributesStudent($convocatory_id)
    {
        try {
            $db = DB::getConnection();
    
            $arrItem_baremable = [];
            $sql = "SELECT * FROM convocatory_has_item_baremable WHERE convocatory_id = :convocatory_id AND contributes_student IS null;";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':convocatory_id', $convocatory_id, PDO::PARAM_INT);
            $stmt->execute();
    
            // Process
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $arrItem_baremable[] = DBItem_baremable::findById( $row["item_baremable_id"] );
            }
    
            return $arrItem_baremable;
        } catch (PDOException $e) {
            throw new Exception("Error retrieving data from the convocatory_has_item_baremable table " . $e->getMessage(), 500);
        }
    }
    
}

?>