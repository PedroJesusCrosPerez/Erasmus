<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="http://serverpedroerasmus/pruebas/fichero.php" method="post" enctype="multipart/form-data">
        <label for="file1">Item primero</label>
        <input type="file" name="file[]">
        <br>
        <label for="file2">Item segundo</label>
        <input type="file" name="file[]">
        <br>
        <label for="file3">Item tercero</label>
        <input type="file" name="file[]">
        <br>
        
        <input type="submit" value="ENVIAR">
    </form>

</body>
</html>
