<?php

class DBGroup
{
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