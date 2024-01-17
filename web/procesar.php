<?php
// Conectando y seleccionado la base de datos
try {
    # completar con los datos reales
    $usuario = 'user';
    $contrasena = 'password';
    $base = 'database';
    $host = 'localhost';
    $puerto = '5432'; // El puerto predeterminado de PostgreSQL es 5432

    $dbconn = pg_connect("host=$host port=$puerto dbname=$base user=$usuario password=$contrasena");

    if (!$dbconn) {
        throw new Exception("Error de conexión");
    }

    echo "Conexión exitosa";
} catch (Exception $e) {
    echo "Error de conexión: " . $e->getMessage();
}
$file = 'datos.json';

$criterio = "aperturas";
$anio = 2018 . '%';
$rubro = 1;

$consulta = "
    SELECT
        h_movimiento.lugar_pk AS zone_id,
        dim_lugar.nombre AS zona,
        h_movimiento.poblacion AS habitantes,
        SUM($criterio) AS value,
        dim_rubro.rubro AS nombre_rubro
    FROM
        h_movimiento
    JOIN
        dim_lugar ON h_movimiento.lugar_pk = dim_lugar.lugar_pk
    JOIN
        dim_rubro ON h_movimiento.rubro_pk = dim_rubro.rubro_pk
    WHERE
        periodo_id LIKE '$anio'
        AND h_movimiento.rubro_pk = $rubro
    GROUP BY
        h_movimiento.lugar_pk, dim_lugar.nombre, h_movimiento.poblacion, dim_rubro.rubro
    ORDER BY
        h_movimiento.lugar_pk
";

$rs = pg_query($dbconn, $consulta);
if (!$rs) {
    die('Error en la consulta:!!! ATENCION ' . pg_last_error());
}

$arreglo = [];
if (pg_num_rows($rs) != 0) {
    $jump = "\r\n";
    $separator = "\t";
    $fp = fopen($file, 'w');
    $registro = 'var moc=['. $separator . $jump;
    fwrite($fp, $registro);
    while($row = pg_fetch_array($rs)) {
        $n = strval("\"".$row['zona']."\"");
		if ($row['value']==0) $row['value']=0.1;
        $registro = "{" 
                        . "\"zona\": " . $row['zone_id'] 
                        . ", \"value\": " . $row['value'] 
                        . ", \"habitantes\": " . $row['habitantes'] 
                        . ", \"nombre\": " . $n 
                    . "},". $jump;
        $arreglo = $arreglo . $registro;
        //fwrite($fp, $registro);
		$rubro=$row['nombre_rubro'];
    }
    $arreglo = substr($arreglo, 0, -3);
    $arreglo = $arreglo . "]";
    fwrite($fp, $arreglo);
}
fclose($fp);
chmod($file, 0777);

// Cerrar la conexión a la base de datos
pg_close($dbconn);
?>