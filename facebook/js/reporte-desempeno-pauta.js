$(function(){
    var info_post = AllInfo;
    $.each(info_post,function(index,valuesPost) {
      agregarGraficaBasica(index,valuesPost); 
    });
    //aniadirTabla(info_post);
    /* $('#rango').change(function(){
        var cantDias = $('#rango').val();
        info_post= reducirArray(AllInfo,cantDias);
        var idKpi = $('select[name="showgraphby"] option:selected').val();
        var nameKpi = $('select[name="showgraphby"] option:selected').text();
        aniadirGrafica(idKpi,nameKpi,info_post);
        //aniadirTabla(info_post); 
    }); */
    $('#showgraphby').change(function(){
        var idKpi = $('#showgraphby').val();
        var nameKpi = $('select[name="showgraphby"] option:selected').text();
        $.each(info_post,function(index,valuesPost) {
          aniadirGrafica(index,idKpi,nameKpi,valuesPost);
        });
    });
    
});

function agregarGraficaBasica(id_post,info_post) {
    Highcharts.chart('grafica_info_post_'+id_post, { 
        chart: {
            zoomType: 'xy',
            height: '200px'
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
          //categories: get_values_categories_highcharts(info_post),
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

function agregarGraficaConKpi(id_post,nombrekpi,claveKpi,arreglo) {
      //console.log(id_post,nombrekpi,claveKpi,arreglo);return;
    Highcharts.chart('grafica_info_post_'+id_post, {
        chart: {
          zoomType: 'xy',
          height: '200px'
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
          //categories: get_values_categories_highcharts(info_post),
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
          data: get_valores_accion_kpi_principal_diario(arreglo,claveKpi),
         

          },{
          name: 'Inversión',
          color:'#2856FF',
          type: 'spline',
          yAxis: 0,
          data: get_valores_post_indicador(arreglo,'ad_spend'),
          tooltip: {
              valueSuffix: ' '
          }
        },/*  {
          name: 'Índice '+nombrekpi,
          color:'#EB7CB4',
          type: 'spline',
          yAxis: 2,
          data: get_valores_indice_kpi(info_post,claveKpi),
          marker: {
            enabled: false
          }

        }, {
          name: 'Índice inter Alcance',
          color:'#9ACA61',
          type: 'spline',
          data: get_valores_post_indicador(info_post,'indice_interalcance'),
          marker: {
            enabled: false
          }

        }, {
          name: 'Índice de '+nombrekpi+' vs Inversión',
          color:'#9966FF',
          type: 'spline',
          data: get_valores_indice_kpi_inversion(info_post,claveKpi),
          marker: {
            enabled: false
          }

        }, {
          name: 'Índice Alcance vs Inversión',
          color:'#7CB5EC',
          type: 'spline',
          data: get_valores_indice_alcance_inversion(info_post),
          marker: {
            enabled: false
          }
        }, */ {
          name: 'Costo por Acción',
          color:'#7CB5EC',
          type: 'spline',
          yAxis: 2,
          data: get_valores_costo_por_accion_kpi_principal_diario(arreglo,claveKpi),
          marker: {
            enabled: false
          }

        }]
      });
}

/* function reducirArray(arreglo,cantidad){
    var infoAmostrar = [];
    $.each(arreglo,function(index,v){
        if (index<parseInt(cantidad)) {
            infoAmostrar.push(v);
        }
    });
    return infoAmostrar;
} */

function aniadirGrafica(id_post,idKpi,nameKpi,info_post){
    var claveskpis ={
        '39':'interacciones',
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
    if(!idKpi){
        agregarGraficaBasica(id_post,info_post);
    }else{
        agregarGraficaConKpi(id_post,nameKpi,claveskpis[idKpi],info_post);
    }
}

/* function aniadirTabla(info_post){
    $.post('views/post-dempeno-dia-table.php',{'infoHistPostConsultoria':info_post})
    .done(function(data){
        $('#desempenioTable').empty();
        $('#desempenioTable').append(data);
    });
} */

function get_valores_post_indicador(arreglo,indicador) {
    var arrayValores=[];
    $.each(arreglo, function( index, value ) {
        if (value[indicador]) {
            var valorAmostrar = parseFloat(value[indicador]);
        }else{
            var valorAmostrar = parseFloat(0);
        }
        if (indicador == 'interacciones') {
          var valorAmostrar = get_valores_interacciones(value);
        }
        if(indicador == 'ad_spend' && index!=0){
            var valorAmostrar = parseFloat(valorAmostrar-arreglo[index-1][indicador]);
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

function get_valores_costo_por_accion_kpi_principal_diario(arreglo,indicador) {
    var arrayValores=[];
    var inversionDiaria = get_valores_post_indicador(arreglo,'ad_spend');
    var accionesPorDias = get_valores_accion_kpi_principal_diario(arreglo,indicador)
    $.each(arreglo, function( index, value ) {
      var accionesUnDia = accionesPorDias[index];
      var ad_spend = inversionDiaria[index];
      var valorAmostrar = (accionesUnDia>0)?parseFloat(ad_spend/accionesUnDia):parseFloat(0);
        arrayValores.push(valorAmostrar);
    });
    return arrayValores;
}

function get_valores_interacciones(arreglo) {
  var reacciones = parseFloat(parseFloat(arreglo['post_video_views_unique'])+parseFloat(arreglo['link_clicks'])+parseFloat(arreglo['shares'])+parseFloat(arreglo['reactions'])+parseFloat(arreglo['comments']));
  return reacciones
}

function get_values_categories_highcharts(arreglo) {
 /*  var arrayValores=[];
  $.each(arreglo, function( index, value ) {
      var fecha = new Date(value.fecha_historico);
      fecha.setDate(fecha.getDate() - 1);
      console.log(fecha.getday())
      valorAmostrar=value.fecha_historico.substr(8,2);
      arrayValores.push(valorAmostrar);
  }); */
  return [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15];
}

/* 
  function get_valores_indice_kpi(arreglo,indicador) {
      var valoresAmostrar = [];
      $.each(arreglo,function(index,value) {
          var kpi = value[indicador]?parseFloat(value[indicador]):parseFloat(0);
          if (indicador == 'interacciones') {
            var kpi = get_valores_interacciones(value);
          }
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
*/