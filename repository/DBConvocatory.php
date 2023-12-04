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
                VALUES  (@convocatory_id, ".$arrItem[$key]->getItem_baremable_id().", ".$arrItem[$key]->getRequired().", ".$arrItem[$key]->getMin_value().", ".$arrItem[$key]->getMax_value().");");
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

    public static function update(Convocatory $convocatory)
    {
        try {
            $stmt = DB::getConnection()->prepare("UPDATE convocatories SET type = ?, date_start_requests = ?, date_end_requests = ?, date_baremation = ?, 
                                        date_definitive_lists = ?, country = ?, project_id = ? WHERE id = ?");
            $stmt->execute([
                $convocatory->getType(),
                $convocatory->getDateStartRequests(),
                $convocatory->getDateEndRequests(),
                $convocatory->getDateBaremation(),
                $convocatory->getDateDefinitiveLists(),
                $convocatory->getCountry(),
                $convocatory->getProyectId(),
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
