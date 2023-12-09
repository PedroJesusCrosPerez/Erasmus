<?php

class DBBaremacion
{

    // ############################################################################################
    // ################################## INSERT ##################################################
    // ############################################################################################
    public static function insert(
        int     $request_id, // ID solicitud
        int     $baremacion_has_item_baremable_baremacion_id, // ID convocatoria
        int     $baremacion_has_item_baremable_item_baremable_id, // ID item baremable
        string  $file_url // URL del recurso subido al servidor
    )
    {
        try 
        {
            $db = DB::getConnection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Inicio transacción
            $db->beginTransaction();
    
            // INSERT tabla convocatoria
            $stmt = $db->prepare("  INSERT INTO request (request_id, baremacion_has_item_baremable_baremacion_id, baremacion_has_item_baremable_item_baremable_id, file_url)
                                    VALUES (?, ?, ?, ?)");
            $stmt->execute([
                $request_id, 
                $baremacion_has_item_baremable_baremacion_id, 
                $baremacion_has_item_baremable_item_baremable_id, 
                $file_url
            ]);
    
            // COMMIT si todo está bien
            $db->commit();
        } 
        catch (Exception $e) 
        {
            // Sino, rollback y vuelvo al estado inicial antes de comenzar la transacción
            $db->rollBack();
            echo "Fallo: " . $e->getMessage();
        }
    }




    // ############################################################################################
    // ################################## SELECT ##################################################
    // ############################################################################################
    public static function findAll()
    {
        try {
            $stmt = DB::getConnection()->prepare("SELECT * FROM baremacion");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $arrBaremacion = [];
    
            if (!$result) {
                return null;
            }
    
            foreach ($result as $row) {
                $arrBaremacion = [
                    'request_id' => $row['request_id'],
                    'baremacion_has_item_baremable_baremacion_id' => $row['baremacion_has_item_baremable_baremacion_id'],
                    'baremacion_has_item_baremable_item_baremable_id' => $row['baremacion_has_item_baremable_item_baremable_id'],
                    'file_url' => $row['file_url']
                ];
            }
    
            return $arrBaremacion;
        } catch (PDOException $e) {
            die("Error during selection: " . $e->getMessage());
        }
    }
    



    // ############################################################################################
    // ################################## FIND BY #################################################
    // ############################################################################################
    // // find baremacion by id
    // public static function findById($id)
    // {
    //     try {
    //         $stmt = DB::getConnection()->prepare("SELECT * FROM baremacion WHERE id = ?");
    //         $stmt->execute([$id]);
    //         $result = $stmt->fetch(PDO::FETCH_ASSOC);

    //         if (!$result) {
    //             return null;
    //         }

    //         return new Baremacion(
    //             $result['id'],
    //             $result['type'],
    //             $result['date_start_requests'],
    //             $result['date_end_requests'],
    //             $result['date_baremation'],
    //             $result['date_definitive_lists'],
    //             $result['country'],
    //             $result['project_id']
    //         );
    //     } catch (PDOException $e) {
    //         die("Error during selection: " . $e->getMessage());
    //     }
    // }

    // // find baremacion_has_group by group_id
    // public static function findByGroupId($group_id)
    // {
    //     try {
    //         $stmt = DB::getConnection()->prepare("SELECT *
    //                                               FROM `group`AS g
    //                                                 INNER JOIN baremacion_has_group AS cg
    //                                                 ON g.id = cg.group_id
    //                                                 INNER JOIN baremacion AS c
    //                                                 ON cg.baremacion_id = c.id
    //                                               WHERE g.id = ?;");
    //         $stmt->execute([$group_id]);
    //         $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //         $arrBaremacion = [];
    
    //         if (!$result) {
    //             return null;
    //         }
    
    //         foreach ($result as $row) {
    //             $arrBaremacion[] = new Baremacion(
    //                 $row['id'],
    //                 $row['type'],
    //                 $row['date_start_requests'],
    //                 $row['date_end_requests'],
    //                 $row['date_baremation'],
    //                 $row['date_definitive_lists'],
    //                 $row['country'],
    //                 $row['project_id']
    //             );
    //         }
    
    //         return $arrBaremacion;
    //     } catch (PDOException $e) {
    //         die("Error during selection: " . $e->getMessage());
    //     }
    // }




    // ############################################################################################
    // ################################## UPDATE ##################################################
    // ############################################################################################
    // public static function update(Baremacion $baremacion)
    // {
    //     try {
    //         $stmt = DB::getConnection()->prepare("UPDATE baremacion SET type = ?, date_start_requests = ?, date_end_requests = ?, date_baremation = ?, 
    //                                     date_definitive_lists = ?, country = ?, project_id = ? WHERE id = ?");
    //         $stmt->execute([
    //             $baremacion->getType(),
    //             $baremacion->getDate_start_requests(),
    //             $baremacion->getDate_end_requests(),
    //             $baremacion->getDate_baremation(),
    //             $baremacion->getDate_definitive_lists(),
    //             $baremacion->getCountry(),
    //             $baremacion->getProject_id(),
    //             $baremacion->getId()
    //         ]);
    //     } catch (PDOException $e) {
    //         die("Error during update: " . $e->getMessage());
    //     }
    // }

    // public static function delete($id)
    // {
    //     try {
    //         $stmt = DB::getConnection()->prepare("DELETE FROM baremacion WHERE id = ?");
    //         $stmt->execute([$id]);
    //     } catch (PDOException $e) {
    //         die("Error during deletion: " . $e->getMessage());
    //     }
    // }
}

?>
