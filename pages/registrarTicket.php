<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <title>Trouble Tickets</title>
  </head>
  <body>
    <?php
      include 'conexion.php';
      date_default_timezone_set('America/Mexico_City');
      if(isset($_POST['registrar']))
      {
        if($_POST["email"] === '' || $_POST["titulo"] === '' || $_POST["solicitud"] === 'selecciona' || $_POST["oficina"] === 'selecciona' || $_POST["descripcion"] === '' || $_POST["departamento"] === 'selecciona') {
          echo "<form style= 'display: flex; flex-direction: column; width: 25%;' method='post' action='form.html'><h2>Ocurrió un problema</h2><img style='width: 50px;height: 50px;' src='../assets/nocheck.png' alt='nocheck' /><p>No se pudo registrar el ticket, asegurese de llenar todos los campos</p><input style='outline: none;border: none;cursor: pointer;width: 50%;height: 60px;border-radius: 25px;font-size: 20px;font-weight: 700;font-family: 'Lato', sans-serif;color: #fff;text-align: center;background: #6799d1;box-shadow: 7px 7px 8px #cbced1,-7px -7px 8px #ffffff;transition: 0.5s;' type='submit' name='regresar' value='Regresar'/></form>";
        } else {
          $idIncremental = 1;
          $marca_temporal = date("Y-m-d H:i:s");
          $status = "PENDIENTE";
          $consultaId = "SELECT MAX(ticket_id) FROM tickets_table";
          try{
            $resultado = $objetoPDO->query($consultaId);
            foreach($resultado as $fila){
              $idIncremental = $fila[0];
            }
            $idIncremental++;
          } catch(PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
          }

          $consultaEjecutar = "INSERT INTO tickets_table (`ticket_id`,`marca_temporal`,`email`,`titulo`,`solicitud`,`oficina`,`descripcion`,`departamento`,`evidencia`,`status`)
            VALUES ($idIncremental,
                    '$marca_temporal',
                    '$_POST[email]', 
                    '$_POST[titulo]', 
                    '$_POST[solicitud]', 
                    '$_POST[oficina]',
                    '$_POST[descripcion]',
                    '$_POST[departamento]',
                    '$_POST[evidencia]',
                    '$status'
            )";
          echo ($consultaEjecutar);		
          try{
            $resultado = $objetoPDO->query($consultaEjecutar);
            echo "<form style= 'display: flex; flex-direction: column; width: 25%;' method='post' action='form.html'><h2>Registro exitoso</h2><img style='width: 50px;height: 50px;' src='../assets/check.png' alt='check' /><p>Tu ticket se ha registrado correctamente y en seguida se le proporcionará seguimiento</p><input style='outline: none;border: none;cursor: pointer;width: 50%;height: 60px;border-radius: 25px;font-size: 20px;font-weight: 700;font-family: 'Lato', sans-serif;color: #fff;text-align: center;background: #6799d1;box-shadow: 7px 7px 8px #cbced1,-7px -7px 8px #ffffff;transition: 0.5s;' type='submit' name='regresar' value='Regresar'/></form>";
          } catch(PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
            echo "<br/>";
            echo "<form style= 'display: flex; flex-direction: column; width: 25%;' method='post' action='form.html'><h2>Ocurrió un problema</h2><img style='width: 50px;height: 50px;' src='../assets/nocheck.png' alt='nocheck' /><p>No se pudo registrar el ticket, inténtelo de nuevo</p><input style='outline: none;border: none;cursor: pointer;width: 50%;height: 60px;border-radius: 25px;font-size: 20px;font-weight: 700;font-family: 'Lato', sans-serif;color: #fff;text-align: center;background: #6799d1;box-shadow: 7px 7px 8px #cbced1,-7px -7px 8px #ffffff;transition: 0.5s;' type='submit' name='regresar' value='Regresar'/></form>";
          }
        }
      } 
      else if(isset($_POST['usuario']))
      {
        if($_POST["nombre"] === '' || $_POST["apellido"] === '' || $_POST["correo"] === '') {
          echo "<form style= 'display: flex; flex-direction: column; width: 25%;' method='post' action='form_usuarios.php'><h2>Ocurrió un problema</h2><img style='width: 50px;height: 50px;' src='../assets/nocheck.png' alt='nocheck' /><p>No se pudo registrar el usuario, asegurese de llenar todos los campos</p><input style='outline: none;border: none;cursor: pointer;width: 50%;height: 60px;border-radius: 25px;font-size: 20px;font-weight: 700;font-family: 'Lato', sans-serif;color: #fff;text-align: center;background: #6799d1;box-shadow: 7px 7px 8px #cbced1,-7px -7px 8px #ffffff;transition: 0.5s;' type='submit' name='regresar' value='Regresar'/></form>";
        } else {
          $idIncremental = 0;
          $sql = "SELECT id_usuario FROM usuarios WHERE id_usuario=(SELECT max(id_usuario) FROM usuarios)";
          
          try{
            $resultado = $objetoPDO->query($sql);
            foreach($resultado as $fila){
              $idIncremental = $fila[0];
            }
            $idIncremental++;
          } catch(PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
          }
          
          $consultaEjecutar = "INSERT INTO `usuarios`(`id_usuario`, `nombre`, `apellido`, `correo`)
              VALUES ($idIncremental,
                      '$_POST[nombre]',
                      '$_POST[apellido]',
                      '$_POST[correo]')";
          echo ($consultaEjecutar);		
          try{
            $resultado = $objetoPDO->query($consultaEjecutar);

            echo "<form style= 'display: flex; flex-direction: column; width: 25%;' method='post' action='form_usuarios.php'><h2>Registro exitoso</h2><img style='width: 50px;height: 50px;' src='../assets/check.png' alt='check' /><p>El usuario se ha registrado correctamente</p><input style='outline: none;border: none;cursor: pointer;width: 50%;height: 60px;border-radius: 25px;font-size: 20px;font-weight: 700;font-family: 'Lato', sans-serif;color: #fff;text-align: center;background: #6799d1;box-shadow: 7px 7px 8px #cbced1,-7px -7px 8px #ffffff;transition: 0.5s;' type='submit' name='regresar' value='Regresar'/></form>";

          } catch(PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
            echo "<br/>";

            echo "<form style= 'display: flex; flex-direction: column; width: 25%;' method='post' action='form_usuarios.php'><h2>Ocurrió un problema</h2><img style='width: 50px;height: 50px;' src='../assets/nocheck.png' alt='nocheck' /><p>No se pudo registrar el usuario, asegurese de llenar todos los campos</p><input style='outline: none;border: none;cursor: pointer;width: 50%;height: 60px;border-radius: 25px;font-size: 20px;font-weight: 700;font-family: 'Lato', sans-serif;color: #fff;text-align: center;background: #6799d1;box-shadow: 7px 7px 8px #cbced1,-7px -7px 8px #ffffff;transition: 0.5s;' type='submit' name='regresar' value='Regresar'/></form>";
          }
        }
      }
    ?>
  </body>
</html>