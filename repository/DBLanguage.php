<?php

class DBLanguage
{

    // ############################################################################################
    // ################################## SELECT ##################################################
    // ############################################################################################
    // Select *
    public static function findAll()
    {
        try {
            $db = DB::getConnection();
    
            $arrLanguage = [];
            $sql = "SELECT id FROM languages;";
            $result = $db->query($sql);
    
            // Proceso
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
            {
                $arrLanguage[] = new Language( $row["id"] );
            }
    
            return $arrLanguage;
        } catch (PDOException $e) {
            throw new Exception("Error retrieving data from the language table " . $e->getMessage(), 500);
        }
    }
}


?>