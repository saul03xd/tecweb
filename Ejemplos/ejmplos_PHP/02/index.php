<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo2</title>
</head>
<body>
    <?php
        require_once __DIR__ . '/Menu.php';

        $menu1 = new Menu;
        $menu1->cargar_opcion('htpps://www.facebook.com', 'facebook');
        $menu1->cargar_opcion('htpps://www.x.com', 'x');
        $menu1->cargar_opcion('htpps://www.instagram.com', 'instagram');

        $menu1->mostrar();
    ?>
</body>
</html>