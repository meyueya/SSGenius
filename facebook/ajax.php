

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<button type="button" class="btn btn-primary btn-label-left" onClick="GenerarGraficos()">
    <span><i class="fa fa-clock-o"></i></span>
        Generar
</button>

<script>
$(function () {
    // Create the chart
    $('#container').highcharts({
    chart: {
        zoomType: 'xy'
    },
    title: {
        text: 'Histórico de Likes vs likes perdidos'
    },
   /* subtitle: {
        text: 'Source: WorldClimate.com'
    },*/
    xAxis: [{
        categories: ['Ene', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        crosshair: true
    }],
    yAxis: [{ // Primary yAxis
        labels: {
            format: '{value}%',
            style: {
                color: '#CA0D0D'
            }
        },
        title: {
            text: 'Likes Perdidos',
            style: {
                color: '#CA0D0D'
            }
        },
        opposite: true

    }, { // Secondary yAxis
        gridLineWidth: 0,
        title: {
            text: 'Likes a la fecha',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        labels: {
            format: '{value}',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        }

    },],
    tooltip: {
        shared: true
    },
    legend: {
        layout: 'vertical',
        align: 'left',
        x: 80,
        verticalAlign: 'top',
        y: 55,
        floating: true,
        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
    },
    series: [{
        name: 'Likes a la fecha',
        type: 'column',
        yAxis: 1,
        color:'#0045A4',
        data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
        tooltip: {
            valueSuffix: ''
        }

    },  {
        name: 'Pérdidas de Likes',
        type: 'spline',
        color:'#CA0D0D',
        data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
        tooltip: {
            valueSuffix: ''
        }
    }]
});

function GenerarGraficos(){
    //alert("generar grafica");
   
    var fecha= $("daterange-btn").value;
   

    var params ={

            "ACT": '1'             
        };

        $.ajax({
            data:   params,  
            url:    'datos.php', 
            type:   'post',
            beforeSend: function () { //before make the ajax call
                var chart = $('#container').highcharts();
                chart.showLoading();
            },
            error: function(response){ //if an error happens it will be processed here
                var chart = $('#container').highcharts();
                chart.hideLoading();
                alert("error: Chart error"); 
                popup('popUpDiv');
            },
            success:    function (response) { // the result of the call will be processed here
                var result = eval(response);
                //alert(response);
                alert(result);
                var chart = $('#container').highcharts();
                //var chart3 = $('#container3').highcharts();
                chart.xAxis[0].setCategories(result[0]);
                chart.series[0].setData(result[1]); //ingresos
                //chart.series[1].setData(result[2]); //egresos

            }
        });

}


</script>
    
</body>
</html>