document.addEventListener("DOMContentLoaded", function () {
    // Función para cambiar la transparencia
    window.cambiarTransparencia = function () {
        const transparenciaInput = document.getElementById("transparenciaInput");
        const valorTransparencia = parseFloat(transparenciaInput.value);

        if (!isNaN(valorTransparencia) && valorTransparencia >= 1 && valorTransparencia <= 10) {
            document.getElementById('container').style.opacity = valorTransparencia / 10;
        } else {
            alert("Ingresa un valor de transparencia válido entre 1 y 10.");
        }
    };

    const form = document.getElementById("formulario");
    // Función para obtener el texto de la opción según su valor
    function obtenerTextoDeRubro(valor) {
        const selectElement = document.getElementById("rubro");
        const opcion = Array.from(selectElement.options).find(option => option.value === valor);
        return opcion ? opcion.text : null;
    }

    form.addEventListener("submit", function(event){
        event.preventDefault();
        
        const criterio = document.getElementById("criterio").value;
        const anio = document.getElementById("anio").value;
        const rubroValor = document.getElementById("rubro").value;

        const rubroTexto = obtenerTextoDeRubro(rubroValor);

        // fetch('datos.json')
        //     .then(response => response.json())
        //     .then(data => {
        //         console.log('Contenido del archivo datos.json:', data);
        //         // Aquí puedes realizar operaciones adicionales con los datos obtenidos
            
        //         // Configuración de Highcharts
        //         Highcharts.mapChart('container', {
        //             chart: {
        //                 map: 'countries/us/us-all',
        //                 borderWidth: 1
        //             },
        //             title: {
        //                 text: `${criterio} - ${anio} - ${rubroTexto}`,
        //             },
        //             exporting: {
        //                 sourceWidth: 600,
        //                 sourceHeight: 500
        //             },
        //             legend: {
        //                 layout: 'horizontal',
        //                 borderWidth: 0,
        //                 backgroundColor: 'rgba(255,255,255,0.85)',
        //                 floating: true,
        //                 verticalAlign: 'top',
        //                 y: 25
        //             },
        //             mapNavigation: {
        //                 enabled: true
        //             },
        //             colorAxis: {
        //                 min: 1,
        //                 type: 'logarithmic',
        //                 minColor: '#EEEEFF',
        //                 maxColor: '#000022',
        //                 stops: [
        //                     [0, '#EFEFFF'],
        //                     [0.67, '#4444FF'],
        //                     [1, '#000022']
        //                 ]
        //             },
        //             series: [{
        //                 animation: {
        //                     duration: 1000
        //                 },
        //                 data: data,
        //                 joinBy: ['zone_id', 'zona'],
        //                 dataLabels: {
        //                     enabled: true,
        //                     color: '#FFFFFF',
        //                     format: '{point.zona}'
        //                 },
        //                 name: `${criterio}`,
        //                 tooltip: {
        //                     pointFormat: `Cantidad: {point.value} <br> Zona: {point.nombre} <br> Habitantes: {point.habitantes}`
        //                 }
        //             }]
        //         });
        //     })
        //     .catch(error => {
        //         console.error('Error al abrir el archivo datos.json:', error);
        //     });
    });
});