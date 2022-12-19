<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <title>Usuarios registrados</title>
  </head>
  <body>
    <?php
      include 'conexion.php';
      // phpinfo();
      $consultaReadAll = "SELECT * FROM usuarios";
        try{
          $resultado = $objetoPDO->query($consultaReadAll);
              echo "<table id='tabla_usuarios' class='display'>";
              echo  '<thead>
                      <tr>
                        <th>USUARIO ID</th>
                        <th>NOMBRE</th>
                        <th>APELLIDO</th>
                        <th>CORREO</th>
                      </tr>
                    </thead>
                    <tbody>';
                $opcion = true;
                foreach ($resultado as $fila) {
                  if ($opcion){
                    echo '<tr>
                        <td>' . $fila[0] . '</td>' .
                        '<td>' . $fila[1].'</td>' .
                        '<td>' . $fila[2].'</td>' .
                        '<td>' . $fila[3].'</td></tr>';
                    $opcion = false;
                  }
                  else{
                    echo '<tr>
                        <td>' . $fila[0] . '</td>' .
                        '<td>' . $fila[1].'</td>' .
                        '<td>' . $fila[2].'</td>' .
                        '<td>' . $fila[3].'</td></tr>';
                    $opcion = true;
                  }
                }
            echo '</tbody></table>';
            echo "<form style= 'display: flex; flex-direction: column; width: 25%;' method='post' action='form_usuarios.php'><input style='outline: none;border: none;cursor: pointer;width: 50%;height: 60px;border-radius: 25px;font-size: 20px;font-weight: 700;font-family: 'Lato', sans-serif;color: #fff;text-align: center;background: #6799d1;box-shadow: 7px 7px 8px #cbced1,-7px -7px 8px #ffffff;transition: 0.5s;' type='submit' name='regresar' value='Regresar'/></form>";
            echo "<script>$(document).ready( function () { $('#tabla_usuarios').DataTable(); } );</script>";
        } catch(PDOException $e) {
          echo 'Falló la conexión: ' . $e->getMessage();
          echo "<br/>";
          echo "<div><h2>Ocurrió un problema</h2><p>No se pudo cargar la informacion</p><img src='../assets/nocheck.png' alt='nocheck' /></div>";
        }
    ?>
</body>
</html>