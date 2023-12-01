<?php

class DBItem_baremable
{

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