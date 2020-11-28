<!DOCTYPE html>
<html slick-uniqueid="3"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<head>

<style>
#container {
height: 530px; width: 600px; margin: 0 ; float: left; position: absolute; top: 0; meft: 200;
	opacity: 0.8;
}
.loading {

    text-align: center;
    color: gray;
}

</style>
</head>
<body>
 <script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/maps/modules/data.js"></script>

<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://code.highcharts.com/maps/modules/offline-exporting.js"></script>

<script src="mapa.json"></script>
<script src="datos.json"></script>
<script >
 
	  
$(function (data) {
var data= moc;

    // Make codes uppercase to match the map data
   // data.forEach(function (p) {
    //    p.zona_id = p.code.toUpperCase();
   // });

    // Instantiate the map
    Highcharts.mapChart('container', {

        chart: {
            map: 'countries/us/us-all',
            borderWidth: 1
        },

        title: {
            text:'<?php echo strtoupper($_POST['criterio']);?> - <?php echo strtoupper($_POST['anio']);?> - <?php echo $rubro;?>',
        },

        exporting: {
            sourceWidth: 600,
            sourceHeight: 500
        },

        legend: {
            layout: 'horizontal',
            borderWidth: 0,
            backgroundColor: 'rgba(255,255,255,0.85)',
            floating: true,
            verticalAlign: 'top',
            y: 25
        },

        mapNavigation: {
            enabled: true
        },

        colorAxis: {
            min: 1,
            type: 'logarithmic',
            minColor: '#EEEEFF',
            maxColor: '#000022',
            stops: [
                [0, '#EFEFFF'],
                [0.67, '#4444FF'],
                [1, '#000022']
            ]
        },


        series: [{
            animation: {
                duration: 1000
            },
            data: data,

            joinBy: ['zone_id', 'zona'],
            dataLabels: {
                enabled: true,
                color: '#FFFFFF',
                format: '{point.zona}'
            },
            name: '<?php echo strtoupper($_POST['criterio']);?>',
            tooltip: {
                pointFormat: 'Cantidad: {point.value} <br> Zona: {point.nombre} <br> Habitantes: {point.habitantes}'
            }


        }]
    });
});



</script>
<table>
<tr><td>
<div><img src="caba2.png" style="width: 670px; height: 530px; "/></div>
<div id="container"></div></td><td border=1>
<div id="panel" style=" margin: 0 ; float: right; position: absolute; top: 0; meft: 200; display:none; ">
Zona: <input type=text id="zonapanel"/> <br>
Población: <input type=text id="poblacion"/> <br>
Cierre: <br>
Apertura:
</div>
</td></tr></table>

Criterio:
<form action="getDatos2.php" method="post">
<select NAME="criterio">
  <option value="aperturas">Aperturas</option>
  <option value="Cierres">Cierres</option>
  <option value="nivel_riesgo">Nivel de Riesgo</option>
</select>
<select NAME="anio">
  <option value="2016">2016</option>
  <option value="2017">2017</option>
  <option value="2018">2018</option>
</select>
<select NAME="rubro">
  <option value="1">Bares y Cafés</option>
  <option value="2">Carnes y Verduras</option>
  <option value="3">Comidas al paso</option>
    <option value="4">Ferretería y Construcción</option>
	<option value="5">Fiambrerías y Dietéticas</option>
	<option value="6">Heladerías</option>
	<option value="7">Indumentaria</option>
	<option value="8">Instituciones Deportivas</option>
<option value="9">Insumos para el hogar</option>
  <option value="10">Kioscos y Loterias</option>
  <option value="11">Música y Librería</option>
  <option value="12">Óptica y Joyerías</option>
    <option value="13">Panaderías</option>
	<option value="14">Restaurantes</option>
	<option value="15">Salud y Cosmética</option>
	<option value="16">Supermercados y Almacenes</option>
	<option value="17">Tratamientos estéticos</option>
	<option value="18">Veterinaria</option>		
</select>
  <input type="submit" value="Submit">
</form>
Transparencia
<input type=text onblur="document.getElementById('container').style.opacity=this.value;">
<input type = button value="cambiar">

</body>