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
    infoForm = getFormData($('#form_parametros'));
    infoForm.cantidad_escogida = cant_dias_semanas_meses_entre_fechas_escogidas(infoForm.daterange_fecha,infoForm.agrupar_por);
    console.log(infoForm);
    $.post('controller/reportImpactInvestmentPageController.php',{'infoForm':infoForm})
      .done(function(dataInfo){
       // console.log(dataInfo);
        var dataInfo = JSON.parse(dataInfo);
        var infoPage = dataInfo.infoPage;
        var infoPautaPage = dataInfo.infoPautaPage;
        var kpiPagado = dataInfo.kpiPagado;
        var kpiorganico = dataInfo.kpiorganico;
        var nombrekpi = ($("#indicador :selected").text() != 'Seleccione')?$("#indicador :selected").text():'Interacciones';
        GenerarGrafico(infoPage,infoPautaPage,kpiPagado,kpiorganico,infoForm.indicador,nombrekpi,infoForm.agrupar_por);
        $.post('views/report-Impact-investment-page-list.php',{'infoPage':infoPage,'indicador':infoForm.indicador,'nombre_kpi':nombrekpi})
          .done(function(data){
            $('#list_info').empty().append(data);
            incluir_DataTable();
          });
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

function incluir_DataTable() {
  $('#list_info_table').DataTable({
    dom: 'Bfrtip',
    processing: true,
    pageLength: 10,
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

$('#my_reports').addClass("active");
$('#my_reports_examples').addClass("show");
$('#impact_ads_page').addClass("active");                         