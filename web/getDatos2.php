<?php
// Conectando y seleccionado la base de datos  
$dbconn = pg_connect("host=localhost dbname=moc user=postgres password=root")
    or die('No se ha podido conectar: ' . pg_last_error());
    
$file = 'datos.json';

$consulta = "select h_movimiento.lugar_pk as zone_id, dim_lugar.nombre as zona, h_movimiento.poblacion as habitantes, sum(".$_POST['criterio'].") as value,
	dim_rubro.rubro as nombre_rubro
from h_movimiento
join dim_lugar
on  h_movimiento.lugar_pk = dim_lugar.lugar_pk
join dim_rubro
on h_movimiento.rubro_pk = dim_rubro.rubro_pk
where periodo_id like '".$_POST['anio']."%' 
and h_movimiento.rubro_pk = ".$_POST['rubro']."
group by h_movimiento.lugar_pk, dim_lugar.nombre, h_movimiento.poblacion, dim_rubro.rubro
order by h_movimiento.lugar_pk";
$rs = pg_query($consulta);
$arreglo = "";
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

include_once("new.php");
?>