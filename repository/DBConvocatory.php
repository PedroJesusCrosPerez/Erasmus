<?php

require_once $_SERVER["DOCUMENT_ROOT"]."/helpers/Autoload.php";

class DBConvocatory
{

    public static function insert(Convocatory $con, Group $group, $arrItem)
    {
        try 
        {
            $db = DB::getConnection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $db->beginTransaction();
            $db->exec("START TRANSACTION");

            $db->exec("INSERT INTO convocatory (type, date_start_requests, date_end_requests, date_baremation, date_definitive_lists, country, project_id)
            VALUES ('".$con->getType()."', '".$con->getDate_start_requests()."', '".$con->getDate_end_requests()."', '".$con->getDate_baremation()."', '".$con->getDate_definitive_lists()."', '".$con->getCountry()."', ".$con->getProject_id().");");

            $db->exec("SET @convocatory_id = LAST_INSERT_ID();");
            
            $db->exec("INSERT INTO convocatory_has_group (convocatory_id, group_id)
            VALUES (@convocatory_id, '".$group->getId()."');");
            
            // $db->exec("INSERT INTO convocatory_has_item_baremable (convocatory_id, item_baremable_id, required, min_value, max_value)
            // VALUES (@convocatory_id, 1, 1, 10, 100), (@convocatory_id, 2, 0, 0, 50);)";
            foreach ($arrItem as $key => $value) 
            {
                $db->exec("INSERT INTO convocatory_has_item_baremable (convocatory_id, item_baremable_id, required, min_value, max_value)
                            VALUES (@convocatory_id, ".$arrItem[$key]->getItem_baremable_id().", ".$arrItem[$key]->getRequired().", ".$arrItem[$key]->getMin_value().", ".$arrItem[$key]->getMax_value().");");
            }
            
            $db->commit();
        } 
        catch (Exception $e) 
        {
            $db->rollBack();
            echo "Fallo: " . $e->getMessage();
        }
    }

    public static function insertConvocatory(Convocatory $convocatory)
    {
        try {
            $stmt = DB::getConnection()->prepare("INSERT INTO convocatories (id, type, date_start_requests, date_end_requests, date_baremation, date_definitive_lists, country, project_id) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                null,
                $convocatory->getType(),
                $convocatory->getDateStartRequests(),
                $convocatory->getDateEndRequests(),
                $convocatory->getDateBaremation(),
                $convocatory->getDateDefinitiveLists(),
                $convocatory->getCountry(),
                $convocatory->getProyectId()
            ]);
        } catch (PDOException $e) {
            die("Error during insertion: " . $e->getMessage());
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
                    $row['project_id']
                );
            }
    
            return $arrConvocatory;
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
                $result['project_id']
            );
        } catch (PDOException $e) {
            die("Error during selection: " . $e->getMessage());
        }
    }

    // find convocatory_has_group by group_id
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
                    $row['project_id']
                );
            }
    
            return $arrConvocatory;
        } catch (PDOException $e) {
            die("Error during selection: " . $e->getMessage());
        }
    }
    
    // static function createArrCon_has_group($group, $arrConvocatory) {
    //     $arrCon_has_group = array(
    //         "group" => $group,
    //         "convocatories" => $arrConvocatory
    //     );
        
    //     return $arrCon_has_group;
    // }
    static function createArrCon_has_group($arrGroup) {
        $arrConvocatory = null;
        $arrCon_has_group = array();

        foreach ($arrGroup as $value) {
            $arrConvocatory = DBConvocatory::findByGroupId($value->getId());
            $arrCon_has_group[] = array(
                "group" => $value,
                "convocatories" => $arrConvocatory
            );
        }
        
        return $arrCon_has_group;
    }
    
    static function createArrCon_has_groupByGroup_id($group_id) {
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
    public static function update(Convocatory $convocatory)
    {
        try {
            $stmt = DB::getConnection()->prepare("UPDATE convocatories SET type = ?, date_start_requests = ?, date_end_requests = ?, date_baremation = ?, 
                                        date_definitive_lists = ?, country = ?, project_id = ? WHERE id = ?");
            $stmt->execute([
                $convocatory->getType(),
                $convocatory->getDate_start_requests(),
                $convocatory->getDate_end_requests(),
                $convocatory->getDate_baremation(),
                $convocatory->getDate_definitive_lists(),
                $convocatory->getCountry(),
                $convocatory->getProject_id(),
                $convocatory->getId()
            ]);
        } catch (PDOException $e) {
            die("Error during update: " . $e->getMessage());
        }
    }

    public static function delete($id)
    {
        try {
            $stmt = DB::getConnection()->prepare("DELETE FROM convocatory WHERE id = ?");
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            die("Error during deletion: " . $e->getMessage());
        }
    }
}

?>
