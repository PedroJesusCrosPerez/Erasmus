<?php

class DBConvocatory_has_item_baremable
{

    public static function findByConvocatoryId($id)
    {
        try {
            $stmt = DB::getConnection()->prepare("SELECT * FROM convocatory_has_item_baremable WHERE convocatory_id = ?");
            $stmt->execute([$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                return null;
            }

            return new Convocatory_has_item_baremable(
                $result['convocatory_id'],
                $result['item_baremable_id'],
                $result['required'],
                $result['min_value'],
                $result['max_value']
            );
        } catch (PDOException $e) {
            die("Error during selection: " . $e->getMessage());
        }
    }

    public static function findByItemBaremableId($id)
    {
        try {
            $stmt = DB::getConnection()->prepare("SELECT * FROM convocatory_has_item_baremable WHERE item_baremable_id = ?");
            $stmt->execute([$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                return null;
            }

            return new Convocatory_has_item_baremable(
                $result['convocatory_id'],
                $result['item_baremable_id'],
                $result['required'],
                $result['min_value'],
                $result['max_value']
            );
        } catch (PDOException $e) {
            die("Error during selection: " . $e->getMessage());
        }
    }

}

?>