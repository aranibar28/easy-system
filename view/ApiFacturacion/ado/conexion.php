<?php

try {
    $manejador = 'mysql';
    $servidor = 'localhost';
    $puerto = '3306';
    $base = 'prueba';
    $usuario = 'root';
    $pass = '';

    $cadena = "$manejador:host=$servidor;dbname=$base";
    $cnx = new PDO($cadena, $usuario, $pass, array(
                PDO::ATTR_PERSISTENT	=> TRUE,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
            )
        );

    //EJEMPLO DE CRUD
    // //INSERTAR
    // $sql = 'INSERT INTO cliente(tipodoc, nrodoc, razon_social, direccion) 
    // VALUES(:tipodoc, :nrodoc, :razon_social, :direccion)';
    // $parametros = array(
    //     ':tipodoc'  =>  '6',
    //     ':nrodoc'    =>  '10123456789',
    //     ':razon_social' =>  'LAPÍCITO MONGOL',
    //     ':direccion'    =>  'LIMA CERCADO'
    // );
    // $pre = $cnx->prepare($sql);
    // $pre->execute($parametros);
    // echo 'CLIENTE REGISTRADO';

    // //UPDATE
    // $sql = "UPDATE cliente 
    //         SET direccion = :direccion
    //         WHERE id = :id";
    // $parametros = array(
    //     ':direccion' => 'CALLE ESPAÑA 123',
    //     ':id' => 10
    // );
    // $pre = $cnx->prepare($sql);
    // $pre->execute($parametros);
    // echo 'CLIENTE ACTUALIZADO';

    // //DELETE
    // $sql = "DELETE FROM cliente WHERE id=:id";
    // $parametros = array(
    //     ':id'   =>  9
    // );
    // $pre = $cnx->prepare($sql);
    // $pre->execute($parametros);
    // echo 'CLIENTE ELIMINADO';

    //SELECT
    // $sql = "SELECT * FROM cliente";
    // $res = $cnx->query($sql);

    // while ($fila = $res->fetch(PDO::FETCH_NAMED)) {
    //     echo $fila['nrodoc'] . ' - ' . $fila['razon_social'] . '</br>';
    // }

    // $sql = "SELECT * FROM cliente";
    // $res = $cnx->query($sql);
    // $res = $res->fetchAll(PDO::FETCH_NAMED);

    // foreach ($res as $key => $fila) {
    //     echo $fila['nrodoc'] . ' - ' . $fila['razon_social'] . '</br>';
    // }


} catch (\Throwable $th) {
    //throw $th;
    echo $th;
}

?>