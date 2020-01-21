$(function () {
    var des=moment().startOf('year'); 
    var has=moment().endOf('month');   
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Mes Actual'  : [moment().startOf('month'), moment().endOf('month')],
          'Mes Pasado'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
          'Últimos 2 Meses': [moment().subtract(2, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
          'Últimos 3 Meses': [moment().subtract(3, 'month').startOf('month'), moment().subtract(0, 'month').endOf('month')],
          'Últimos 6 Meses': [moment().subtract(6,'month').startOf('month'), moment().subtract(0, 'month').endOf('month')],
          'Año Actual'  : [moment().startOf('year'), moment().endOf('month')],
          'Año pasado'  : [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
          'Último año'  : [moment().subtract(12, 'month').startOf('month'), moment().subtract(0, 'month').endOf('month')],
          'Últimos 2 años'  : [moment().subtract(24, 'month').startOf('month'), moment().subtract(0, 'month').endOf('month')]
        },
        startDate: des,
        endDate  : has,
        "autoApply": true,
        locale : {
        "format": 'YYYY/MM/DD',
        "separator": " - ",
        "applyLabel": "Aplicar",
        "cancelLabel": "Cancelar",
        "fromLabel": "Desde",
        "toLabel": "Hasta",
        "customRangeLabel": "Rango",
              
        "daysOfWeek": [
            "DOM",
            "LUN",
            "MAR",
            "MIR",
            "JUE",
            "VIR",
            "SAB"
        ],
        "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ]
        
    }
      },
      function (des, has, label) {
        $('#daterange-btn span').html(des.format('YYYY/MM/DD') + ' | ' + has.format('YYYY/MM/DD'));      
      }
    );

  });

  function getInfoPage(){
    $.preloader.start({
      src : 'https://ssgenius.com/wp-content/uploads/sprites1.png'
  });
    $("#contenedor_info").hide();
    infoForm = getFormData($('#form_parametros'));
    //infoForm.cantidad_escogida = cant_dias_semanas_meses_entre_fechas_escogidas(infoForm.daterange_fecha,infoForm.agrupar_por);
    //console.log(infoForm);return;
    $.post('controller/paidMediaController.php',{'infoForm':infoForm})
    .done(function(dataInfo){
      var dataInfo = JSON.parse(dataInfo);
      console.log(dataInfo);
       var detallesCampaniaFace = dataInfo.detallesCampaniaFace;
       var detallesProductos = dataInfo.detallesProductos;
       var detallesFormatos = dataInfo.detallesFormatos;
       var infoConsumo = dataInfo.detallesGraficos.consumo;
       $.preloader.stop();
       $("#contenedor_info").show();
       generarGraficoConsumo(infoConsumo);
       generarGraficoFormatoSpend(detallesFormatos);
       generarGraficoProductosCTR(detallesProductos);
       generarGraficoProductosCilcs(detallesProductos);
        $.post('views/paid-media-list-format.php',{'detallesFormatos':detallesFormatos})
          .done(function(data){
            $('#list_info_format').empty().append(data);
            incluir_DataTable('list_info_format_table');
          });
        $.post('views/paid-media-list-product.php',{'detallesProductos':detallesProductos})
          .done(function(data){
            $('#list_info_product').empty().append(data);
            incluir_DataTable('list_info_product_table');
          });
        $.post('views/paid-media-list.php',{'detallesCampaniaFace':detallesCampaniaFace})
          .done(function(data){
            $('#list_info').empty().append(data);
            incluir_DataTable('list_info_table');
          });

      });
  }

  function obtener_nombres_productos(arreglo) {
    var arregloCompleto = [];
    $.each(arreglo, function(index,value){
      arregloCompleto.push(value.nombre_producto);
    });
    return arregloCompleto;
  }

  function obtener_nombres_formatos(arreglo) {
    var arregloCompleto = [];
    $.each(arreglo, function(nombre,value){
      arregloCompleto.push(nombre);
    });
    return arregloCompleto;
  }

  function obtener_ctr_productos(arreglo) {
    var arregloCompleto = [];
    $.each(arreglo, function(index,value){
      arregloCompleto.push(value.totales.ctr);
    });
    return arregloCompleto;
  }

  function obtener_clics_productos(arreglo) {
    var arregloCompleto = [];
    $.each(arreglo, function(index,value){
      arregloCompleto.push(value.totales.link_clicks);
    });
    return arregloCompleto;
  }

  function obtener_inversion_formatos(arreglo) {
    var arregloCompleto = [];
    $.each(arreglo, function(index,value){
      arregloCompleto.push(value.totales.spend);
    });
    return arregloCompleto;
  }

  function generarGraficoConsumo(arreglo) {
    var avancePorcentaje = (parseFloat(arreglo.avance)/parseFloat(arreglo.meta))*100;
    if (arreglo.meta) {
      $('#consumo').highcharts({
        chart: {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false,
          type: 'pie'
        },
        title: {
          text: '%Consumo'
        },
        legend: {
          align: 'center',
        // x: 30,
          verticalAlign: 'bottom',
        // y: +55,
          floating: true,
          backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
          borderColor: '#CCC',
          borderWidth: 1,
          shadow: true
        },
        tooltip: {
          pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        exporting: {
          enabled: false 
          },
        plotOptions: {
          pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            //colors: pieColors,
            dataLabels: {
              enabled: true,
              format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
              distance: -50,
              filter: {
                property: 'percentage',
                operator: '>',
                value: 4
              }
            }
          }
        },
        series: [{
          name: 'Consumo',
          data: [
            { name: 'Avance',
            color: '#ff9933',
              y: avancePorcentaje
              },
            { name: 'Meta',
            color: '#d9d9d9',
            y: 100-avancePorcentaje
              },
          ]
        }]
      });
    } else {
      $('#consumo').html('debes agregar parametros de inversion mensuales para ver este grafico');
    }
  }

  function generarGraficoFormatoSpend(arreglo) {
    $('#inversion_formatos').highcharts({
      chart: {
        type: 'column'
      },
      title: {
        text: 'Inversión por Formatos'
      },
      xAxis: {
        categories: obtener_nombres_formatos(arreglo)
      },        
      yAxis: [
        {
        min: 0,
        title: {
          text: 'spend'
        },
        stackLabels: {
          enabled: false,
          style: {
            fontWeight: 'bold',
            color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
          }
        }
      },
        { // Primary yAxis
        labels: {
            format: '{value}',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        },
        title: {
            text: 'pauta',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        },
        opposite: true
    },],
      /* legend: {
        align: 'center',
        //x: 30,
        verticalAlign: 'bottom',
        //y: +55,
        floating: true,
        backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
        borderColor: '#CCC',
        borderWidth: 1,
        shadow: true
      }, 
      tooltip: {
         headerFormat: '<b>{point.x}</b><br/>',
         pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}',
          backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
       },*/
      exporting: {
        enabled: false
      },
      plotOptions: {
        column: {
          stacking: 'normal',
          dataLabels: {
            enabled: true,
            color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
          }
        }
      },
      series: [
      {
        //name: 'Pauta PAGE_LIKES',
        yAxis: 1,
        data: obtener_inversion_formatos(arreglo),
        color: '#ff9933'
      }]
    });
  }

  function generarGraficoProductosCTR(arreglo) {
    $('#ctr_productos').highcharts({
      chart: {
        type: 'column'
      },
      title: {
        text: 'CTR por Productos'
      },
      xAxis: {
        categories: obtener_nombres_productos(arreglo)
      },        
      yAxis: [
        {
        min: 0,
        title: {
          text: 'CTR'
        },
        stackLabels: {
          enabled: false,
          style: {
            fontWeight: 'bold',
            color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
          }
        }
      },
        { // Primary yAxis
        labels: {
            format: '{value}',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        },
        title: {
            text: 'pauta',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        },
        opposite: true
    },],
      /* legend: {
        align: 'center',
        //x: 30,
        verticalAlign: 'bottom',
        //y: +55,
        floating: true,
        backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
        borderColor: '#CCC',
        borderWidth: 1,
        shadow: true
      }, 
      tooltip: {
         headerFormat: '<b>{point.x}</b><br/>',
         pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}',
          backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
       },*/
      exporting: {
        enabled: false
      },
      plotOptions: {
        column: {
          stacking: 'normal',
          dataLabels: {
            enabled: true,
            color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
          }
        }
      },
      series: [
      {
        //name: 'Pauta PAGE_LIKES',
        yAxis: 1,
        data: obtener_ctr_productos(arreglo),
        color: '#ff9933'
      }]
    });
  }

  function generarGraficoProductosCilcs(arreglo) {
    $('#cpc_productos').highcharts({
      chart: {
        type: 'column'
      },
      title: {
        text: 'Clics por Productos'
      },
      xAxis: {
        categories: obtener_nombres_productos(arreglo)
      },        
      yAxis: [
        {
        min: 0,
        title: {
          text: 'Clics'
        },
        stackLabels: {
          enabled: false,
          style: {
            fontWeight: 'bold',
            color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
          }
        }
      },
        { // Primary yAxis
        labels: {
            format: '{value}',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        },
        title: {
            text: 'pauta',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        },
        opposite: true
    },],
      /* legend: {
        align: 'center',
        //x: 30,
        verticalAlign: 'bottom',
        //y: +55,
        floating: true,
        backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
        borderColor: '#CCC',
        borderWidth: 1,
        shadow: true
      }, 
      tooltip: {
         headerFormat: '<b>{point.x}</b><br/>',
         pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}',
          backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
       },*/
      exporting: {
        enabled: false
      },
      plotOptions: {
        column: {
          stacking: 'normal',
          dataLabels: {
            enabled: true,
            color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
          }
        }
      },
      series: [
      {
        //name: 'Pauta PAGE_LIKES',
        yAxis: 1,
        data: obtener_clics_productos(arreglo),
        color: '#ff9933'
      }]
    });
  }

function getFormData($form){
  var unindexed_array = $form.serializeArray();
  var indexed_array = {};
  $.map(unindexed_array, function(n, i){
    if (n['name'].indexOf('[]') !=-1) {
      var propiedad = n['name'].substr(0, n['name'].length-2);
      if (!indexed_array.hasOwnProperty(propiedad)) {
        indexed_array[propiedad]=[];
      }
      indexed_array[propiedad].push(n['value']);
    }else{
      indexed_array[n['name']] = n['value'];
    }
  });
  return indexed_array;
}

function GenerarGrafico(arreglo,infoPauta,infoKpiPagado,infoKpiorganico,indicador,nombreKpi,separador){
  $('#container').highcharts({
    chart: {
      type: 'column'
    },
    title: {
      text: nombreKpi
    },
    xAxis: {
      categories: get_values_categories_highcharts(arreglo,separador)
    },        
    yAxis: [
      {
      min: 0,
      title: {
        text: nombreKpi
      },
      stackLabels: {
        enabled: false,
        style: {
          fontWeight: 'bold',
          color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
        }
      }
    },
      { // Primary yAxis
      labels: {
          format: '{value}',
          style: {
              color: Highcharts.getOptions().colors[1]
          }
      },
      title: {
          text: 'pauta',
          style: {
              color: Highcharts.getOptions().colors[1]
          }
      },
      opposite: true
  }, /* { // Secondary yAxis
      title: {
          text: 'Reacciones',
          style: {
              color: Highcharts.getOptions().colors[0]
          }
      },
      labels: {
          format: 'P{value} ',
          style: {
              color: Highcharts.getOptions().colors[0]
          }
      },
      opposite: true
  }, { // third yAxis
      title: {
          text: 'Inversión',
          style: {
              color: Highcharts.getOptions().colors[0]
          }
      },
      labels: {
          format: 'P{value} ',
          style: {
              color: Highcharts.getOptions().colors[0]
          }
      },
      opposite: true
  } */],
    /* yAxis: {
      min: 0,
      title: {
        text: nombreKpi
      },
      stackLabels: {
        enabled: false,
        style: {
          fontWeight: 'bold',
          color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
        }
      }
    }, */
    legend: {
      align: 'center',
      x: 30,
      verticalAlign: 'bottom',
      y: +55,
      floating: true,
      backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
      borderColor: '#CCC',
      borderWidth: 1,
      shadow: true
    },
    tooltip: {
       headerFormat: '<b>{point.x}</b><br/>',
       pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}',
        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
     },
    exporting: {
      enabled: false
    },
    plotOptions: {
      column: {
        stacking: 'normal',
        dataLabels: {
          enabled: true,
          color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
        }
      }
    },
    series: [
    {
      name: 'Pauta PAGE_LIKES',
      yAxis: 1,
      data: get_valores_pauta_indicador(infoPauta,'PAGE_LIKES'),
      color: '#CA1A15'
    },
    {
      name: 'Pauta POST_ENGAGEMENT',
      yAxis: 1,
      data: get_valores_pauta_indicador(infoPauta,'POST_ENGAGEMENT'),
      color: '#004F82'
    },
    {
      name: 'Pauta LINK_CLICKS',
      yAxis: 1,
      data: get_valores_pauta_indicador(infoPauta,'LINK_CLICKS'),
      color: '#554F82'
    },
    {
      name: 'Pauta REACH',
      yAxis: 1,
      data: get_valores_pauta_indicador(infoPauta,'REACH'),
      color: '#334F82'
    },
    {
      name: 'Pauta LEAD_GENERATION',
      yAxis: 1,
      data: get_valores_pauta_indicador(infoPauta,'LEAD_GENERATION'),
      color: '#816F82'
    },
    {
      name: 'Pauta CONVERSIONS',
      yAxis: 1,
      data: get_valores_pauta_indicador(infoPauta,'CONVERSIONS'),
      color: '#914F82'
    },
    {
      name: 'Pauta VIDEO_VIEWS',
      yAxis: 1,
      data: get_valores_pauta_indicador(infoPauta,'VIDEO_VIEWS'),
      color: '#742F82'
    },
    {
      name: 'Pauta EVENT_RESPONSES',
      yAxis: 1,
      data: get_valores_pauta_indicador(infoPauta,'EVENT_RESPONSES'),
      color: '#965F82'
    },
    {
      name: nombreKpi,
      type: 'spline',
      color:'#F15C80',
      max: 1,
      data: get_valores_post_indicador(arreglo,indicador),
      tooltip: {
      valueSuffix: '  '
      }
    },
    {
      name: nombreKpi+" Pagado",
      type: 'spline',
      color:'#F89C66',
      max: 1,
      data: get_valores_post_indicador(infoKpiPagado,indicador),
      tooltip: {
      valueSuffix: '  '
      }
    },
    {
      name: nombreKpi+" Organico",
      type: 'spline',
      color:'#F12C01',
      max: 1,
      data: get_valores_post_indicador(infoKpiorganico,indicador),
      tooltip: {
      valueSuffix: '  '
      }
    }]
  });
}

function get_valores_post_indicador(arreglo,indicador) {
  var arrayValores=[];
  $.each(arreglo, function( index, value ) {
      if (value[indicador]) {
          var valorAmostrar = parseFloat(value[indicador]);
      }else{
          var valorAmostrar = parseFloat(0);
      }
      arrayValores.push(valorAmostrar);
  });
  return arrayValores;
}

function get_valores_pauta_indicador(arregloPauta,indicador) {
  var arrayInfoPauta =arregloPauta[indicador]
  var arrayValores=[];
  $.each(arrayInfoPauta, function( index, value ) {
    if (value["spend"]) {
      var spend = parseFloat(value["spend"]);
    }else{
      var spend = parseFloat(0);
    }
    var valorAmostrar = parseFloat(spend);
    arrayValores.push(valorAmostrar);
  });
  return arrayValores;
}

function get_values_categories_highcharts(arreglo,separador) {
  var arrayValores=[];
  $.each(arreglo, function( index, value ) {
      if(separador =='meses'){
        var valorAmostrar = get_names_months(value['mes']);
      }
      if(separador =='semanas'){
        var valorAmostrar = value['semana'];
      }
      if(separador =='dias'){
        var valorAmostrar =value['dia'];
      }
      arrayValores.push(valorAmostrar);
  });
  return arrayValores;
}

function get_names_months(number) {

  switch(number){
    case '1':
      mes='Enero';
      break;
    case '2':
      mes='Febrero';
      break;
    case '3':
      mes='Marzo';
      break;
    case '4':
      mes='Abril';
      break;
    case '5':
      mes='Mayo';
      break;
    case '6':
      mes='Junio';
      break;
    case '7':
      mes='Julio';
      break;
    case '8':
      mes='Agosto';
      break;
    case '9':
      mes='Septiembre';
      break;
    case '10':
      mes='Octubre';
      break;
    case '11':
      mes='Noviembre';
      break;
    case '12':
      mes='Diciembre';
      break;
    default:
      mes='no definido';
  }
  return mes;
}

function incluir_DataTable(id) {
  $('#'+id).DataTable({
    paging: false,
    searching: false,
    dom: 'Bfrtip',
    processing: true,
    pageLength: 20,
    buttons: [{
      extend: 'excel',
      title: 'Reporte',
      filename: 'reporte'
    }],
    language: {
            search: "Buscar",
            emptyTable: "Sin Criterios para el Reporte!!",
            infoEmpty: "Mostrando 0 to 0 of 0 Entradas",
            lengthMenu: "Mostrar _MENU_ Entradas",
            loadingRecords: "Cargando...",
            processing: "Procesando...",
            infoFiltered: "(Filtrado de _MAX_ total entradas)",
            info: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            zeroRecords: "Sin resultados encontrados",
            paginate: {
                first:      "Inicio",
                previous:   "Anterior",
                next:       "Siguiente",
                last:       "Anterior"
            }
    }
  }); 
}

function cant_dias_semanas_meses_entre_fechas_escogidas(fechas,agrupar_por) {
  var fechas = infoForm.daterange_fecha.split(' - ');//inicio y fin 
  var fecha_inicio = fechas[0].replace("/", "-");
  var fecha_inicio = fecha_inicio.replace("/", "-");
  var fecha_fin = fechas[1].replace("/", "-");
  var fecha_fin = fecha_fin.replace("/", "-");//no reemplazaba todos los / por eso se repite la funcion replace esto se puede mejorar
  var fecha1 = moment(fecha_inicio);
  var fecha2 = moment(fecha_fin);
  switch (agrupar_por) {
    case 'dias':
      var cant = parseInt(fecha2.diff(fecha1, 'days')+1);
      break;
    case 'semanas':
      var cant = parseInt(fecha2.diff(fecha1, 'week')+1);
      break;
    case 'meses':
      var cant = parseInt(fecha2.diff(fecha1, 'month')+1);
      break;
    default:
      var cant = parseInt(fecha2.diff(fecha1, 'month')+1);
      break;
  }
  return cant;
}

$('#aiw').addClass("active");
$('#aiw_reporte_general').addClass("show");
$('#dashboard_paid_media').addClass("active");                         