<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <title>Trouble Tickets</title>
  </head>
  <body>
    <?php
      include 'conexion.php';
      if(isset($_POST["consulta"])){
        $consultaReadAll = "SELECT * FROM tickets_table";
        try{
          $resultado = $objetoPDO->query($consultaReadAll);
              echo "<table id='table_id' class='display'>";
              echo  '<thead>
                      <tr>
                        <th>TICKET ID</th>
                        <th>MARCA TEMPORAL</th>
                        <th>CORREO</th>
                        <th>TITULO</th>
                        <th>SOLICITUD</th>
                        <th>OFICINA</th>
                        <th>DESCRIPCION</th>
                        <th>DEPARTAMENTO</th>
                        <th>EVIDENCIA</th>
                        <th>STATUS</th>
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
                        '<td>' . $fila[3].'</td>' .
                        '<td>' . $fila[4].'</td>' .
                        '<td>' . $fila[5].'</td>' .
                        '<td>' . $fila[6].'</td>' .
                        '<td>' . $fila[7].'</td>' .
                        '<td>' . $fila[8].'</td>' .
                        '<td>' . $fila[9].'</td></tr>';
                    $opcion = false;
                  }
                  else{
                    echo '<tr>
                        <td>' . $fila[0] . '</td>' .
                        '<td>' . $fila[1].'</td>' .
                        '<td>' . $fila[2].'</td>' .
                        '<td>' . $fila[3].'</td>' .
                        '<td>' . $fila[4].'</td>' .
                        '<td>' . $fila[5].'</td>' .
                        '<td>' . $fila[6].'</td>' .
                        '<td>' . $fila[7].'</td>' .
                        '<td>' . $fila[8].'</td>' .
                        '<td>' . $fila[9].'</td></tr>';
                    $opcion = true;
                  }
                }
            echo '</tbody></table>';
            echo "<form style= 'display: flex; flex-direction: column; width: 25%;' method='post' action='form.html'><input style='outline: none;border: none;cursor: pointer;width: 50%;height: 60px;border-radius: 25px;font-size: 20px;font-weight: 700;font-family: 'Lato', sans-serif;color: #fff;text-align: center;background: #6799d1;box-shadow: 7px 7px 8px #cbced1,-7px -7px 8px #ffffff;transition: 0.5s;' type='submit' name='regresar' value='Regresar'/></form>";
            echo "<script>$(document).ready( function () { $('#table_id').DataTable(); } );</script>";
        } catch(PDOException $e) {
          echo 'Falló la conexión: ' . $e->getMessage();
          echo "<br/>";
          echo "<div><h2>Ocurrió un problema</h2><p>No se pudo cargar la informacion</p><img src='../assets/nocheck.png' alt='nocheck' /></div>";
        }
      } else {
        echo <<<EOT
          <link rel="stylesheet" type="text/css" href="../CSS/form-style.css" />
          <form
          class="frame__container--form"
          method="post"
          action="registrarTicket.php"
          style="align-items: center"
          >
            <h3>Llenar los datos del nuevo usuario</h3>
            <h4>Todos los campos son necesarios*</h4>
            <input class="input" type="text" name="nombre" placeholder="Nombre*" />
            <input
              class="input"
              type="text"
              name="apellido"
              placeholder="Apellido paterno*"
            />
            <input class="input" type="text" name="correo" placeholder="correo*" />
            <input
              class="levantartTicket"
              type="submit"
              name="usuario"
              value="Registrar usuario"
            />
          </form>
          <form
            class="frame__container--form"
            method="post"
            action="consultarUsuarios.php"
            style="align-items: center"
          >
            <input
              class="levantartTicket"
              type="submit"
              name="consulta_usuarios"
              value="Consultar todos los usuarios"
            />
          </form>
          <form style= 'display: flex; flex-direction: column; width: 25%;' method='post' action='form.html'><input class='levantartTicket' type='submit' name='regresar' value='Regresar'/></form>
        EOT;
      }
    ?>
  </body>
</html>