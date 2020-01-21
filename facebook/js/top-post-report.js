$(document).ready(function() {
  var claveskpis ={
    '39':'interactions',
    '40':'reactions',
    '41':'shares',
    '42':'comments',
    '43':'post_video_views_unique',
    '44':'link_clicks',
    '45':'reach',
    '46':'reach_paid',
    '47':'reach_organic',
    '48':'indice_interaccion',
    '49':'indice_interalcance',
    '50':'ad_spend',
    '52':'indice_interaccion_inversion',
    '53':'indice_interalcance_inversion',
  };
  $.get( "controller/topRostReportController.php", { 'psid': psid, 'operacion':'obtener_rangos_defecto' } )
  .done(function( data ) {
    data = JSON.parse(data)
    data = data.rangos_defecto;
    $('#daterange-btn').daterangepicker(
        {
          ranges   : {
            'Hoy'       : [moment(), moment()],
            'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Últimos 7 Días' : [moment().subtract(6, 'days'), moment()],
            'Últimos 30 Días': [moment().subtract(29, 'days'), moment()],
            'Mes Actual'  : [moment().startOf('month'), moment().endOf('month')],
            'Mes Pasado'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: data.dateMin,
          endDate  : data.dateMax,
          maxDate  : data.maxdatefull,
          minDate  : data.mindatefull,
          "autoApply": true,
          locale : {
          "format": 'YYYY-MM-DD',
          "separator": " | ",
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
        function (start, end, label) {
          $('#daterange-btn span').html(start.format('dd-mm-yyyy') + ' | ' + end.format('dd-mm-yyyy'))
        }
      );
  });
  $.get( "controller/topRostReportController.php", { 'psid': psid, 'operacion':'obtener_kpis' } )
  .done(function( data ) {
    data = JSON.parse(data)
    kpisFace = data.kpisFace;
    var excluirDeLista = ['45','46','47','48','49','50','52','53'];
    $("#orderby").append('<option value=fecha>Fecha</option>');
    $.each(kpisFace, function( index, value ) {
      if(jQuery.inArray(value.id, excluirDeLista) == -1){
        $("#getPostByKpi").append('<option value='+value.id+'>'+value.nombre+'</option>');
      }
      $("#orderby").append('<option value='+value.id+'>'+value.nombre+'</option>');
    });
    $('#getPostByKpi').selectpicker('refresh');
    $('#orderby').selectpicker('refresh');
  });
  $.get( "controller/topRostReportController.php", { 'psid': psid, 'operacion':'obtener_tipos' } )
  .done(function( data ) {
    data = JSON.parse(data)
    tipos = data.tipos;
    $.each(tipos, function( index, value ) {
      $("#tiposSelect").append('<option value='+value.id+'>'+value.nombre+'</option>');
    });
    $('#tiposSelect').selectpicker('refresh');
    $('#tiposSelect').selectpicker('render');
  });
  $.get( "controller/topRostReportController.php", { 'psid': psid, 'operacion':'obtener_objetivos' } )
  .done(function( data ) {
    data = JSON.parse(data)
    objetivos = data.objetivos;
    $.each(objetivos, function( index, value ) {
      $("#objetivosSelect").append('<option value='+value.id+'>'+value.nombre+'</option>');
    });
    $('#objetivosSelect').selectpicker('refresh');
    $('#objetivosSelect').selectpicker('render');
  });

  $('#greport').click(function(event){
    event.preventDefault();
    infoForm = getFormData($('#form_filtros'));
    $.post('controller/topRostReportController.php',{'infoForm':infoForm,'operacion':'traer_post'})
    .done(function (data){
      //console.log(data);return;
      data = JSON.parse(data);
      console.log(data);
      All_post=data.postsUnidosOrdenados;
      //All_post=data.postsAllParameters.concat(data.postsByKpiCatalogacion.concat(data.postsRelleno));
      var claveKpi = claveskpis[infoForm.getPostByKpi];
      var nombrekpi = ($("#getPostByKpi :selected").text() != 'Todos')?$("#getPostByKpi :selected").text():'Interacciones';
      agregarGraficaConKpi(nombrekpi,claveKpi,All_post);
      $.post('./views/topPostlist.php',{'infoposts':data.postsAllParameters,'allinfo':data.postsUnidosOrdenados})
      .done(function(listPostsAllParameters){
        $("#postsAllParameters").empty();
        $("#postsAllParameters").append(listPostsAllParameters);
      });
      $.post('./views/topPostlist.php',{'infoposts':data.postsByKpiCatalogacion,'allinfo':data.postsUnidosOrdenados})
      .done(function(listPostsByKpiCatalogacion){
        $("#postsByKpiCatalogacion").empty();
        $("#postsByKpiCatalogacion").append(listPostsByKpiCatalogacion);
      });
      if (data.postsRelleno.length > 0) {
        $.post('./views/topPostlist.php',{'infoposts':data.postsRelleno,'allinfo':data.postsUnidosOrdenados})
        .done(function(listPostsRelleno){
          $("#postsByKpiCatalogacion").append(listPostsRelleno);
        });
      }
    });
    
  });
});

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


function agregarGraficaBasica(info_post) {
  Highcharts.chart('grafica_info_posts', {
      chart: {
          zoomType: 'xy'
      },
              showInLegend: true,
      title: {
          text: 'Evolutivo del Post'
      },
      subtitle: {
          text: ''
      },
      credits: {
           enabled: false
       },
      xAxis: {
            labels: {
              format: '{value}',
              rotation: -45,
              style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif',
                color: '#00AD82'
              }
            }
          },
      yAxis: [{ // Primary yAxis
          labels: {
              format: '{value}',
              style: {
                  color: Highcharts.getOptions().colors[1]
              }
          },
          title: {
              text: 'Indice de Interacción',
              style: {
                  color: Highcharts.getOptions().colors[1]
              }
          }
      }, { // Secondary yAxis
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
      }],
      tooltip: {
          format: 'P{value}',
          borderColor: '#FFF',
          useHTML: true,
          shared: true,
          shadow:false,
      },
      legend: {
          layout: 'vertical',
          align: 'left',
          x: 60,
          verticalAlign: 'top',
          y: 0,
          floating: true,
          backgroundColor: 'rgba(255, 255, 255, 0.4)'
      },
      series: [{
          name: 'Reacciones',
          type: 'column',
          yAxis: 1,
          data: get_valores_post_indicador(info_post,'reactions'),
          tooltip: {
              valueSuffix: ' '
          }
      },{
          name: 'Compartir',
          type: 'column',
          yAxis: 1,
          data: get_valores_post_indicador(info_post,'shares'),
          tooltip: {
              valueSuffix: ' '
          }
      },{
          name: 'Comentario',
          type: 'column',
          yAxis: 1,
          data: get_valores_post_indicador(info_post,'comments'),
          tooltip: {
              valueSuffix: ' '
          }
      },{
          name: 'Vistas de video',
          type: 'column',
          yAxis: 1,
          data: get_valores_post_indicador(info_post,'post_video_views_unique'),
          tooltip: {
              valueSuffix: ' '
          }
      },{
          name: 'Clics a links',
          type: 'column',
          yAxis: 1,
          data: get_valores_post_indicador(info_post,'link_clicks'),
          tooltip: {
              valueSuffix: ' '
          }
      },{
          name: 'Inversión',
          color:'#2856FF',
          type: 'spline',
          yAxis: 2,
          data: get_valores_post_indicador(info_post,'ad_spend'),
          tooltip: {
              valueSuffix: ' '
          }
      },{
          name: 'Indice de Interacción',
          type: 'spline',
          data: get_valores_post_indicador(info_post,'indice_interaccion'),
          tooltip: {
              valueSuffix: ''
          },
          color: '#EB7CB4'
      }]
  });
}

function agregarGraficaConKpi(nombrekpi,claveKpi,arreglo) {
  Highcharts.chart('grafica_info_posts', {
      chart: {
        zoomType: 'xy'
      },

       plotOptions: {
    series: {
        cursor: 'pointer',
        point: {
           /*  events: {
                click: function (e) {
                    llenar_ssgmodal(this.category,array_code[this.category]);
                    return false;
                }
            } */
        }
    }
},
 showInLegend: true,
      title: {
        text: nombrekpi+' por Publicación'
      },
      subtitle: {
        text: 'Ssgenius.com'
      },
      xAxis: 
      {
          labels: {
            format: '{value}',
            rotation: -45,
            style: {
              fontSize: '13px',
              fontFamily: 'Verdana, sans-serif',
              color: '#00AD82'
            }
          }
        },/* [{
        categories: [<?php echo rtrim($count,','); ?>],
        crosshair: true
      }], */
      yAxis: [{ // Primary yAxis
        labels: {
          format: '{value}',
          style: {
            color: Highcharts.getOptions().colors[1]
          }
        },
        title: {
          text: 'Inversión',
          style: {
            color: Highcharts.getOptions().colors[1]
          }
        },
        opposite: true

      }, { // Secondary yAxis
        gridLineWidth: 0,
        title: {
          text: nombrekpi,
          style: {
            color: Highcharts.getOptions().colors[1]
          }
        },
        labels: {
          format: '{value}',
          style: {
            color: Highcharts.getOptions().colors[1]
          }
        }

      }, { // Tertiary yAxis
        gridLineWidth: 0,
        title: {
          text: 'Costo por '+nombrekpi,
          style: {
            color: Highcharts.getOptions().colors[1]
          }
        },
        labels: {
          format: '{value}',
          style: {
            color: Highcharts.getOptions().colors[1]
          }
        },
        opposite: true
      }],
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
        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || 'rgba(255,255,255,0.25)'
      },
      series: [{
        name: nombrekpi,
        color:'#00CA79',
        type: 'column',
        yAxis: 1,
        data: get_valores_post_indicador(arreglo,claveKpi),
       

      },{
        name: 'Inversión',
        color:'#2856FF',
        type: 'spline',
        yAxis: 0,
        data: get_valores_post_indicador(arreglo,'ad_spend'),
        tooltip: {
            valueSuffix: ' '
        }
      }, {
        name: 'Índice '+nombrekpi,
        color:'#EB7CB4',
        type: 'spline',
        yAxis: 2,
        data: get_valores_indice_kpi(arreglo,claveKpi),
        marker: {
          enabled: false
        }

      }, {
        name: 'Índice inter Alcance',
        color:'#9ACA61',
        type: 'spline',
        data: get_valores_post_indicador(arreglo,'indice_interalcance'),
        marker: {
          enabled: false
        }

      }, {
        name: 'Índice de '+nombrekpi+' vs Inversión',
        color:'#9966FF',
        type: 'spline',
        data: get_valores_indice_kpi_inversion(arreglo,claveKpi),
        marker: {
          enabled: false
        }

      }, {
        name: 'Índice Alcance vs Inversión',
        color:'#7CB5EC',
        type: 'spline',
        data: get_valores_indice_alcance_inversion(arreglo),
        marker: {
          enabled: false
        }
      }, {
        name: 'Costo por Acción',
        color:'#7CB5EC',
        type: 'spline',
        yAxis: 2,
        data: get_valores_costo_por_accion_kpi_principal(arreglo,claveKpi),
        marker: {
          enabled: false
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
      if(indicador == 'ad_spend' && index!=0){
          if (value['page_id']=="192597304105183") {
              var valorAmostrar = parseFloat(valorAmostrar/0.55)
          }
      }
      arrayValores.push(valorAmostrar);
  });
  return arrayValores;
}

function get_valores_accion_kpi_principal_diario(arreglo,indicador) {
  var arrayValores=[];
  $.each(arreglo, function( index, value ) {
      var totalAccionHastaLaActualidad = (value[indicador])?parseFloat(value[indicador]):parseFloat(0);
      var totalAccionHastaAyer = (index==0)?parseFloat(0):(arreglo[index-1][indicador])?parseFloat(arreglo[index-1][indicador]):parseFloat(0);
      if (indicador == 'interacciones') {
        var totalAccionHastaLaActualidad = get_valores_interacciones(value);
        var totalAccionHastaAyer = (index!=0)?get_valores_interacciones(arreglo[index-1]):parseFloat(0);
      }
      var accionesHoy = (totalAccionHastaLaActualidad>totalAccionHastaAyer)?totalAccionHastaLaActualidad-totalAccionHastaAyer:parseFloat(0);
      arrayValores.push(accionesHoy);
  });
  return arrayValores;
}

function get_valores_costo_por_accion_kpi_principal(arreglo,indicador) {
  var arrayValores=[];
  var inversionDiaria = get_valores_post_indicador(arreglo,'ad_spend');
  var acciones = get_valores_post_indicador(arreglo,indicador)
  $.each(arreglo, function( index, value ) {
    var accion = acciones[index];
    var ad_spend = inversionDiaria[index];
    var valorAmostrar = (accion>0)?parseFloat(ad_spend/accion):parseFloat(0);
      arrayValores.push(valorAmostrar);
  });
  return arrayValores;
}

function get_valores_interacciones(arreglo) {
var reacciones = parseFloat(parseFloat(arreglo['post_video_views_unique'])+parseFloat(arreglo['link_clicks'])+parseFloat(arreglo['shares'])+parseFloat(arreglo['reactions'])+parseFloat(arreglo['comments']));
return reacciones
}

function get_valores_indice_kpi(arreglo,indicador) {
  var valoresAmostrar = [];
  $.each(arreglo,function(index,value) {
      var kpi = value[indicador]?parseFloat(value[indicador]):parseFloat(0);
      var indiceKpi = parseFloat(value['page_fans'])>0.00?parseFloat(kpi/value['page_fans']):parseFloat(0);
      var indiceKpi = parseFloat(indiceKpi*1000);
      valoresAmostrar.push(indiceKpi);
  });
  return valoresAmostrar;
}

function get_valores_indice_kpi_inversion(arreglo,indicador) {
  var indiceKpi = get_valores_indice_kpi(arreglo,indicador);
  var valoresAmostrar = [];
  $.each(arreglo,function(index,value) {
      var ad_spend = value['ad_spend']?parseFloat(value['ad_spend']):parseFloat(0);
      var indiceKpiInversion = ad_spend>0?parseFloat(indiceKpi[index]/ad_spend):parseFloat(0);
      var indiceKpiInversion = parseFloat(indiceKpiInversion*100);
      valoresAmostrar.push(indiceKpiInversion);
  });
  return valoresAmostrar;
}

function get_valores_indice_alcance_inversion(arreglo) {
  var indiceInteralcance = get_valores_post_indicador(arreglo,'indice_interalcance');
  var valoresAmostrar = [];
  $.each(arreglo,function(index,value) {
      var ad_spend = value['ad_spend']?parseFloat(value['ad_spend']):parseFloat(0);
      var indiceAlcanceInversion = ad_spend>0?parseFloat(indiceInteralcance[index]/ad_spend):parseFloat(0);
      var indiceAlcanceInversion = parseFloat(indiceAlcanceInversion*100);
      valoresAmostrar.push(indiceAlcanceInversion);
  });
  return valoresAmostrar;
} 