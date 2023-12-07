<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>



    <form action="http://serverpedroerasmus/pruebas/fichero.php" method="post">
        <label for="item1">Item primero</label>
        <input type="checkbox" name="baremable[]" value="1">
        <label for="item2">Item segundo</label>
        <input type="checkbox" name="baremable[]" value="2">
        <label for="item3">Item tercero</label>
        <input type="checkbox" name="baremable[]" value="3">
        
        <input type="submit" value="ENVIAR">
    </form>

</body>
</html>
