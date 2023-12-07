<?php


class DBRequest 
{

    // ############################################################################################
    // ################################## SELECT ##################################################
    // ############################################################################################
    // Select *
    static function findAll()
    {
        $cn = DB::getConnection();
        // Variables
        $arrRequests = [];
        //$nameFields;
        $sql = "SELECT * FROM request";
        $result = $cn->query($sql);

        // Proceso
        while ($row = $result->fetch_assoc()) 
        {
            $arrRequests[$row["id"]] = 
            new Request(
                $row["id"],
                $row["dni"],
                $row["name"],
                $row["surname"],
                $row["birthdate"],
                $row["group"],
                $row["phone"],
                $row["email"],
                $row["address"],
                $row["photo"],
                $row["convocatory_id"]
            );
        }
        $cn->close();
        
        // Return
        return $arrRequests;
    }




    // ############################################################################################
    // ################################## INSERT ##################################################
    // ############################################################################################
    public static function insert(Request $request): bool
    {
        $cn = DB::getConnection();
        $reached = false;
    
        // Using placeholders and prepared statements
        $sql = "INSERT INTO your_table_name (dni, name, surname, birthdate, group, phone, email, address, photo, convocatory_id)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        $stmt = $cn->prepare($sql);
    
        // Check if the statement was prepared successfully
        if ($stmt) {
            // Bind parameters
            $stmt->bind_param("sssssssssi",
                $request->getDni(),
                $request->getName(),
                $request->getSurname(),
                $request->getBirthdate(),
                $request->getGroup(),
                $request->getPhone(),
                $request->getEmail(),
                $request->getAddress(),
                $request->getPhoto(),
                $request->getConvocatoryId()
            );
    
            // Execute the statement
            if ($stmt->execute()) {
                echo "Inserción exitosa";
                $reached = true;
            } else {
                echo "Error al insertar datos: " . $stmt->error;
            }
    
            // Close the statement
            $stmt->close();
        } else {
            echo "Error al preparar la declaración: " . $cn->error;
        }
    
        // Close the connection | no es necesario ya que 'DB->getConnection();' es genérico
        // $cn->close();
        
        return $reached;
    }
    


    // ############################################################################################
    // ################################## UPDATE ##################################################
    // ############################################################################################
    static function update($field, $value, $field_id, $value_id) : bool
    {
        $cn = new DB();
        $sql = "UPDATE request SET {$field} = '{$value}' WHERE {$field_id} = '{$value_id}'";
        
        if ($cn->query($sql) == true) {
            // Cerrar la conexión
            $cn->close();
            return true;
        } else {
            // Cerrar la conexión
            $cn->close();
            return false;
        }
    }


    static function updateRequest($request_id, $request) : int
    {
        $cn = new DB();
        //$sql = "UPDATE request SET {$field} = '{$value}' WHERE id = '{$request_id}'";
        $sql = "UPDATE request SET name = '{$request->getName()}', role = '{$request->getRole()}' WHERE id = {$request_id};";
        
        if ($cn->query($sql) == true) {
            // Cerrar la conexión
            $cn->close();
            return true;
        } else {
            // Cerrar la conexión
            $cn->close();
            return false;
        }
    }

    static function updateById($request_id, $name, $role) : int
    {
        $cn = new DB();
        //$sql = "UPDATE request SET {$field} = '{$value}' WHERE id = '{$request_id}'";
        $sql = "UPDATE request SET name = '{$name}', role = '{$role}' WHERE id = {$request_id};";
        
        if ($cn->query($sql) == true) {
            // Cerrar la conexión
            $cn->close();
            return true;
        } else {
            // Cerrar la conexión
            $cn->close();
            return false;
        }
    }



    // ############################################################################################
    // ################################## DELETE ##################################################
    // ############################################################################################
    static function delete($id): bool
    {
        $cn = new DB(); // TODO quitar en el futuro
        // Variables
        $tuples = 0;
        // Consulta SQL
        $sql = "DELETE FROM request WHERE id = ?";
        $stmt = $cn->prepare($sql);
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute()) {
            echo "Eliminación exitosa";
            $tuples = $stmt->affected_rows;
        } else {
            echo "Error al eliminar: " . $stmt->error;
        }
    
        // Cerrar la conexión
        $stmt->close();
        $cn->close();
    
        // Return
        return $tuples;
    }

    static function deleteByName($name): bool
    {
        $cn = new DB();
        // Variables
        $tuples = 0;
        
        // Consulta SQL para desactivar temporalmente las claves externas
        $sqlDisableFK = "SET foreign_key_checks = 0;";
        $cn->query($sqlDisableFK);
    
        // Consulta SQL para eliminar el usuario por nombre
        $sqlDeleteRequest = "DELETE FROM request WHERE name = ?;";
        $stmt = $cn->prepare($sqlDeleteRequest);
        $stmt->bind_param("s", $name);
    
        if ($stmt->execute()) {
            echo "Eliminación exitosa";
            $tuples = $stmt->affected_rows;
        } else {
            echo "Error al eliminar: " . $stmt->error;
        }
    
        // Cerrar la conexión
        $stmt->close();
    
        // Consulta SQL para reactivar las claves externas
        $sqlEnableFK = "SET foreign_key_checks = 1;";
        $cn->query($sqlEnableFK);
    
        $cn->close();
    
        // Return
        return $tuples;
    }
    

    static function deleteByName2($name): bool
    {
        $cn = new DB(); // TODO quitar en el futuro
        // Variables
        $tuples = 0;
        // Consulta SQL
        $sql = "DELETE FROM request WHERE name = ?;";
        $sql1 = "SET foreign_key_checks = 0;";
        $sql1 = "SET foreign_key_checks = 1;";
        $stmt = $cn->prepare($sql);
        $stmt->bind_param("s", $name);
    
        if ($stmt->execute()) {
            echo "Eliminación exitosa";
            $tuples = $stmt->affected_rows;
        } else {
            echo "Error al eliminar: " . $stmt->error;
        }
    
        // Cerrar la conexión
        $stmt->close();
        $cn->close();
    
        // Return
        return $tuples;
    }
    

    static function deleteById($id) : bool
    {
        $cn = new DB(); // TODO quitar en el futuro
        // Variables
        $tuples = 0;
        // Consulta SQL
        $sql = "DELETE FROM request WHERE id = ?";
        $stmt = $cn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "Eliminación exitosa";
            $tuples = $stmt->affected_rows;
        } else {
            echo "Error al eliminar: " . $stmt->error;
        }

        // Cerrar la conexión
        $stmt->close();
        $cn->close();
        
        // Return
        return $tuples;
    }


    // ############################################################################################
    // ################################# FIND BY ##################################################
    // ############################################################################################
    // Find by name and password
    static function findByName_Password($name, $password) 
    {
        $cn = new DB(); // TODO quitar en el futuro
        // Variables
        $request = null;
        $sql = "SELECT * FROM request WHERE name = '$name' AND password = '$password';";
        $result = $cn->query($sql);

        // Process
        if ($result == true) 
        {
            //$nameFields = ["id", "name", "password", "role"];
            while ($row = $result->fetch_assoc()) 
            {
                $request = new Request($row["id"],$row["name"],$row["password"],$row["role"]);
            }
            $cn->close();
        }
        else
        {
            echo "Error en consulta<br>";
        }

        return $request;
    }
    
    // Find by name
    static function findByName($name) 
    {
        $cn = new DB(); // TODO quitar en el futuro
        // Variables
        $request = null;
        $sql = "SELECT * FROM request WHERE name = '$name';";
        $result = $cn->query($sql);

        // Process
        if ($result == true) 
        {
            //$nameFields = ["id", "name", "password", "role"];
            while ($row = $result->fetch_assoc()) 
            {
                $request = new Request($row["id"],$row["name"],$row["password"],$row["role"]);
            }
            $cn->close();
        }
        else
        {
            echo "Error en consulta<br>";
        }

        return $request;
    }


    static function findByRole($role)
    {
        $cn = new DB(); // TODO quitar en el futuro
        // Variables
        $arrRequests = [];
        //$nameFields;
        if ($role == "notnull") { 
            $sql = "SELECT * FROM request WHERE role IS NOT NULL"; 
            //$sql = "SELECT * FROM request WHERE role != 'null' role = 'null';"; 
        } elseif ( $role == "null" ) { 
            $sql = "SELECT * FROM request WHERE role IS NULL || role = 'null'"; 
        } else { 
            $sql = "SELECT * FROM request WHERE role = '$role'"; 
        }
        $result = $cn->query($sql);

        // Proceso
        while ($row = $result->fetch_assoc()) 
        {
            $arrRequests[$row["name"]] = new Request($row["id"],$row["name"], $row["password"], $row["role"]);
        }
        $cn->close();
        
        // Return
        return $arrRequests;
    }
}


























/* TODO DBUSER EN UN FUTURO SI ES NECESARIO */



/*     // Select *
    function findAll2()
    {
        try {

            $cn = new DB();
            if ($cn->connect_error) 
            {
                throw new Exception("Error de conexión: " . $cn->connect_error);
            }
        } catch (Exception $e) {
            echo "Ha ocurrido un error: " . $e->getMessage();
        }

        // Comprobación y/o creación de conexión
        if (!$cn->isConnected()) 
            { $cn = new DB(); }
        
        // Variables a utilizar
        $arrRequests = [];
        //$nameFields;
        $sql = "SELECT * FROM request";
        $result = $cn->query($sql);

        // Proceso
        if ($result == true) 
        {
            //$nameFields = DB::getNameFields("request");
            $nameFields = $cn->getNameFields("request");
            while ($row = $result->fetch_assoc()) 
            {
                $arrRequests[] = new Request($row["id"],$row["name"], $row["password"], $row["role"]);
            }
            $cn->close();
        }
        else
        {
            die("Error de consulta: " . $cn->error);
        }
        
        // Return
        return $arrRequests;
    }


    // Select *
    function findAllAssoc ()
    {
        // Comprobación y/o creación de conexión
        if (!DB::isConnected()) 
            $cn = new DB();
        
        // Variables a utilizar
        $arRequests;
        $nameFields;
        $sql = "SELECT * FROM requests";
        $result = $connection->query($sql);

        // Proceso
        $nameFields = DB::getNameFields();
        while ($row = $result->fetch_assoc()) 
        {
            $arrRequests[$row["name"]] = new Request($row["id"],$row["name"], $row["password"], $row["role"]);
        }
        $connection->close();
        // Return
        return $arRequests;
    }

    

    // Find by role
    static function findByRole2($role)
    {
        $cn = new DB(); // TODO quitar en el futuro

        // Consulta segura utilizando prepared statements
        $sql = "SELECT * FROM request WHERE role = ?";
        $stmt = $cn->prepare($sql);
        $stmt->bind_param("s", $role);
        $stmt->execute();

        // Manejo de errores
        if ($stmt->error) {
            // Aquí puedes manejar el error de acuerdo a tus necesidades
            $cn->close();
            return null;
        }

        // Asignación de resultados directamente a variables
        $stmt->bind_result($id=null, $name, $password, $requestRole);

        // Variables
        $arrRequests = [];

        // Proceso
        while ($stmt->fetch()) {
            $arrRequests[] = new Request($id, $name, $password, $requestRole);
        }

        $cn->close();

        // Return temprano si no hay resultados
        if (empty($arrRequests)) {
            return null;
        }

        // Return
        return $arrRequests;
    }

    static function update3($field, $value, $field_id, $value_id) : int
    {
        $cn = new DB(); // TODO quitar en el futuro
        // Variables
        $tuples = 0;
        $sql = 'UPDATE request SET {$field} = "{$value}" WHERE {$field_id} = "{$value_id}";';
        $stmt = $cn->prepare($sql);
        $stmt->bind_param("sss", $name, $password, $role);
        
        if ($cn->query($sql) === TRUE) {
            echo "Record updated successfully";
          } else {
            echo "Error updating record: " . $cn->error;
          }
        
        // Cerrar la conexión
        $stmt->close();
        $cn->close();
        
        // Return
        return $tuples;
    } */
?>