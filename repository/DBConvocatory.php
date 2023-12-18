<?php

class DBConvocatory
{

    public static function insert(Convocatory $con, Group $group, $arrItem)
    {
        try 
        {
            $db = DB::getConnection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Inicio transacción
            $db->beginTransaction();
    
            // INSERT tabla convocatoria
            $stmt = $db->prepare("  INSERT INTO convocatory (type, date_start_requests, date_end_requests, date_baremation, date_definitive_lists, country, movilities, project_id)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $con->getType(), 
                $con->getDate_start_requests(), 
                $con->getDate_end_requests(), 
                $con->getDate_baremation(), 
                $con->getDate_definitive_lists(), 
                $con->getCountry(), 
                $con->getMovilities(), 
                $con->getProject_id()
            ]);
    
            // Obtengo el ID de la convocatoria
            $convocatory_id = $db->lastInsertId();
            
            // INSERT tabla group
            $stmt = $db->prepare("  INSERT INTO convocatory_has_group (convocatory_id, group_id)
                                    VALUES (?, ?)");
            $stmt->execute([$convocatory_id, $group->getId()]);
            
            // INSERT tabla convocatory_has_item_baremable
            $stmt = $db->prepare("  INSERT INTO convocatory_has_item_baremable (convocatory_id, item_baremable_id, required, min_value, max_value, contributes_student)
                                    VALUES (?, ?, ?, ?, ?, ?)");
            foreach ($arrItem as $item) 
            {
                if ($item instanceof Convocatory_has_item_baremable && $item->getItem_baremable_id() != 4) {             
                    $required = $item->getRequired() ? 1 : 0;
                    $contributes_strudent = $item->getContributes_student() ? 1 : 0;
                    $max_value = is_numeric($item->getMax_value()) ? $item->getMax_value() : null;

                    $stmt->execute([
                        $convocatory_id, 
                        $item->getItem_baremable_id(), 
                        $required, 
                        $item->getMin_value(), 
                        $max_value, 
                        $contributes_strudent
                    ]);
                }
            }

            // Si existe la clave 'languages'
            // INSERT tabla convocatory_has_item_baremable_has_language
            if ( isset($arrItem["languages"]) ) {
                $stmt = $db->prepare("  INSERT INTO convocatory_has_item_baremable_has_languages (convocatory_has_item_baremable_convocatory_id, languages_id, score)
                VALUES (?, ?, ?)");

                foreach ($arrItem["languages"] as $key => $value) {
                    $stmt->execute([
                        $convocatory_id, 
                        $key, 
                        $value
                    ]);
                }
            }
            
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
            $stmt = DB::getConnection()->prepare("SELECT * FROM convocatory");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $arrConvocatory = [];
    
            if (!$result) {
                return null;
            }
            
            foreach ($result as $row) {
                $arrConvocatory[] = new Convocatory(
                    $row['id'],
                    $row['type'],
                    $row['date_start_requests'],
                    $row['date_end_requests'],
                    $row['date_baremation'],
                    $row['date_definitive_lists'],
                    $row['country'],
                    $row['movilities'],
                    $row['project_id']
                );
            }
    
            return $arrConvocatory;
        } catch (PDOException $e) {
            die("Error during selection: " . $e->getMessage());
        }
    }

    public static function findAllAll()
    {
        try {
            $stmt = DB::getConnection()->prepare("SELECT * FROM convocatory;");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $arrConvocatoryAssociative = [];
    
            if (!$result) {
                return null;
            }
    
            foreach ($result as $convocatory) {
                $arrConvocatoryAssociative[] = array(
                    'convocatory' => DBConvocatory::findById($convocatory["id"]),
                    'project' => DBProject::findById($convocatory["project_id"]),
                    'requests' => DBRequest::findByConvocatoryId($convocatory["id"])
                );
            }
    
            return $arrConvocatoryAssociative;
        } catch (PDOException $e) {
            die("Error during selection: " . $e->getMessage());
        }
    }
    
    



    // ############################################################################################
    // ################################## FIND BY #################################################
    // ############################################################################################
    // find convocatory by id
    public static function findById($id)
    {
        try {
            $stmt = DB::getConnection()->prepare("SELECT * FROM convocatory WHERE id = ?");
            $stmt->execute([$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                return null;
            }

            return new Convocatory(
                $result['id'],
                $result['type'],
                $result['date_start_requests'],
                $result['date_end_requests'],
                $result['date_baremation'],
                $result['date_definitive_lists'],
                $result['country'],
                $result['movilities'],
                $result['project_id']
            );
        } catch (PDOException $e) {
            die("Error during selection: " . $e->getMessage());
        }
    }

    // find convocatory_has_group by group_id
    //c.id, c.type, c.date_start_requests, c.date_end_requests, c.date_baremation, date_definitive_lists, country, movilities, project_id
    public static function findByGroupId($group_id)
    {
        try {
            $stmt = DB::getConnection()->prepare("SELECT *
                                                  FROM `group`AS g
                                                    INNER JOIN convocatory_has_group AS cg
                                                    ON g.id = cg.group_id
                                                    INNER JOIN convocatory AS c
                                                    ON cg.convocatory_id = c.id
                                                  WHERE g.id = ?;");
            $stmt->execute([$group_id]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $arrConvocatory = [];
    
            if (!$result) {
                return null;
            }
    
            foreach ($result as $row) {
                $arrConvocatory[] = new Convocatory(
                    $row['id'],
                    $row['type'],
                    $row['date_start_requests'],
                    $row['date_end_requests'],
                    $row['date_baremation'],
                    $row['date_definitive_lists'],
                    $row['country'],
                    $row['movilities'],
                    $row['project_id']
                );
            }
    
            return $arrConvocatory;
        } catch (PDOException $e) {
            die("Error during selection: " . $e->getMessage());
        }
    }
    
    // public static function createArrCon_has_group($group, $arrConvocatory) {
    //     $arrCon_has_group = array(
    //         "group" => $group,
    //         "convocatories" => $arrConvocatory
    //     );
        
    //     return $arrCon_has_group;
    // }
    public static function createArrCon_has_group($arrGroup) {
        $arrConvocatory = null;
        $arrCon_has_group = array();

        foreach ($arrGroup as $value) {
            $arrConvocatory = DBConvocatory::findByGroupId($value->getId());
            if ( $arrConvocatory != null ) {
                $arrCon_has_group[] = array(
                    "group" => $value,
                    "convocatories" => $arrConvocatory
                );
            }
        }
        
        return $arrCon_has_group;
    }

    static function createArrCon_has_group2($arrGroup)
    {
        $arrCon_has_group = array();

        foreach ($arrGroup as $value) {
            $arrCon_has_group[] = array(
                "group" => $value,
                "convocatories" => DBConvocatory::findByGroupId($value->getId())
            );
        }

        return $arrCon_has_group;
    }

    
    public static function createArrCon_has_groupByGroup_id($group_id) {
        $group = DBGroup::findById($group_id);
        $arrCon = DBConvocatory::findByGroupId($group_id);
        
        $arrCon_has_group = array(
            "group" => $group,
            "convocatories" => $arrCon
        );
        
        return $arrCon_has_group;
    }




    // ############################################################################################
    // ################################## UPDATE ##################################################
    // ############################################################################################
    // update tables convocatory, convocatory_has_group, convocatory_has_item_baremable
    public static function update(Convocatory $con, Group $group, $arrItem, $convocatoryIdToUpdate)
    {
        try 
        {
            $db = DB::getConnection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Inicio transacción
            $db->beginTransaction();
    
            // Actualizar tabla convocatory
            $stmt = $db->prepare("UPDATE convocatory SET type=?, date_start_requests=?, date_end_requests=?, date_baremation=?, date_definitive_lists=?, country=?, movilities=?, project_id=? WHERE id=?");
            $stmt->execute([
                $con->getType(), 
                $con->getDate_start_requests(), 
                $con->getDate_end_requests(), 
                $con->getDate_baremation(), 
                $con->getDate_definitive_lists(), 
                $con->getCountry(), 
                $con->getMovilities(), 
                $con->getProject_id(),
                $convocatoryIdToUpdate
            ]);
    
            // Actualizar tabla convocatory_has_group
            $stmt = $db->prepare("UPDATE convocatory_has_group SET group_id=? WHERE convocatory_id=?");
            $stmt->execute([$group->getId(), $convocatoryIdToUpdate]);
    
            // Actualizar tabla convocatory_has_item_baremable
            $stmt = $db->prepare("UPDATE convocatory_has_item_baremable SET required=?, min_value=?, max_value=?, contributes_student=? WHERE convocatory_id=? AND item_baremable_id=?");
            foreach ($arrItem as $item) 
            {
                if ($item instanceof Convocatory_has_item_baremable && $item->getItem_baremable_id() != 4) {             
                    $required = $item->getRequired() ? 1 : 0;
                    $contributes_strudent = $item->getContributes_student() ? 1 : 0;
                    $max_value = is_numeric($item->getMax_value()) ? $item->getMax_value() : null;
    
                    $stmt->execute([
                        $required, 
                        $item->getMin_value(), 
                        $max_value, 
                        $contributes_strudent,
                        $convocatoryIdToUpdate,
                        $item->getItem_baremable_id()
                    ]);
                }
            }
    
            // Si existe la clave 'languages'
            // Actualizar tabla convocatory_has_item_baremable_has_language
            if ( isset($arrItem["languages"]) ) {
                $stmt = $db->prepare("UPDATE convocatory_has_item_baremable_has_languages SET score=? WHERE convocatory_has_item_baremable_convocatory_id=? AND languages_id=?");
    
                foreach ($arrItem["languages"] as $key => $value) {
                    $stmt->execute([
                        $value,
                        $convocatoryIdToUpdate, 
                        $key
                    ]);
                }
            }
            
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
    // ################################## DELETE ##################################################
    // ############################################################################################
    public static function delete($convocatory_id)
    {
        try 
        {
            $db = DB::getConnection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Inicio transacción
            $db->beginTransaction();
    
            // Eliminar de la tabla convocatory_has_item_baremable_has_languages
            $stmt = $db->prepare("DELETE FROM convocatory_has_item_baremable_has_languages WHERE convocatory_has_item_baremable_convocatory_id = ?");
            $stmt->execute([$convocatory_id]);
    
            // Eliminar de la tabla convocatory_has_item_baremable
            $stmt = $db->prepare("DELETE FROM convocatory_has_item_baremable WHERE convocatory_id = ?");
            $stmt->execute([$convocatory_id]);
    
            // Eliminar de la tabla convocatory_has_group
            $stmt = $db->prepare("DELETE FROM convocatory_has_group WHERE convocatory_id = ?");
            $stmt->execute([$convocatory_id]);
    
            // Eliminar de la tabla convocatory
            $stmt = $db->prepare("DELETE FROM convocatory WHERE id = ?");
            $stmt->execute([$convocatory_id]);
    
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
    
}

?>
