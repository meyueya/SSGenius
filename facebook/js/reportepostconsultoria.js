$(function(){
    console.log(info_post);
    Highcharts.chart('grafica_info_post', {
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
                format: 'dia{value}',
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
            name: 'Indice de Interacción',
            type: 'spline',
            data: get_valores_post_indicador(info_post,'indice_interaccion'),
            tooltip: {
                valueSuffix: ''
            },
            color: '#EB7CB4'
        }]
    });
/* 
    if(ordenby==50){

        //esta es la graf para kpi inversion 
        Highcharts.chart('grafica_info_post', {
          chart: {
              zoomType: 'xy'
          },
          
                  showInLegend: true,
          title: {
              text: nombre+' por Publicación'
          },
          subtitle: {
              text: ''
          },
          credits: {
               enabled: false
           },
          xAxis:  {
                labels: {
                  format: 'P{value}',
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
                  text: 'Indice de Interacción Inversión',
                  style: {
                      color: Highcharts.getOptions().colors[1]
                  }
              }
          }, { // Secondary yAxis
              title: {
                  text: 'Inversión',
                  style: {
                      color:  '#FF9965'
                  }
              },
              labels: {
                  format: '{value} ',
                  style: {
                      color: Highcharts.getOptions().colors[0]
                  }
              },
              opposite: true
          }],
         tooltip: {
                formatter: function () {
                     var s = [];
         
              s.push('<b>' +this.x + '</b>');
              this.points.forEach(function(point) {
                  if (point.series.name == "Inversión"){
                    s.push('<span style="color:'+point.series.color+'">' + point.series.name + ':</span><b>  ' + point.y + ' $</b>');
                  } else {
                      s.push('<span style="color:'+point.series.color+'">' + point.series.name + ':</span><b> ' + point.y + '</b>'); 
                  }
              });
                    return s;
                },
                    split: true
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                x: 60,
                verticalAlign: 'top',
                y: 0,
                floating: true,
                backgroundColor:  'rgba(255, 255, 255, 0.4)'
            },
            series: [{
                name: 'Inversión',
                type: 'column',
                yAxis: 1,
                data: inv,
                tooltip: {
                    valueSuffix: ' '
                },
                color: '#FF9965'

            },{
                name: 'Indice de Interacción Inversión',
                type: 'spline',
                data: indice_interaccion_inversion,
                tooltip: {
                    valueSuffix: ' '
                },
                color: '#9966FF'

            }]
            });

      }

      else if(ordenby==48 || ordenby==49 || ordenby==52 || ordenby==53){
        //graficas de indices
       Highcharts.chart('grafica_info_post', {
          chart: {
              zoomType: 'xy'
          },
          
                  showInLegend: true,
         title: {
              text: nombre+' de Publicación'
          },
          subtitle: {
              text: ''
          },
          credits: {
               enabled: false
           },
          xAxis: {
                labels: {
                  format: 'P{value}',
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
                  text: 'Indice de Interacción Inversión',
                  style: {
                      color: Highcharts.getOptions().colors[1]
                  }
              },
              showFirstLabel: false
          }, { // Secondary yAxis
              title: {
                  text: 'Indice Inter Alcance',
                  style: {
                      color: Highcharts.getOptions().colors[0]
                  }
              },
              labels: {
                  format: '{value} ',
                  style: {
                      color: Highcharts.getOptions().colors[0]
                  }
              },
              showFirstLabel: false,
              opposite: true
          }],
          tooltip: {
                   shared: true,
                  crosshairs: true,
          },
          legend: {
              layout: 'vertical',
              align: 'left',
              x: 60,
              verticalAlign: 'top',
              y: 0,
              floating: true,
              backgroundColor:  'rgba(255, 255, 255, 0.4)'
          },
          series: [{
              name: 'Índice de Interacción',
              type: 'spline',
              yAxis: 1,
              data: indicei,
              tooltip: {
                  valueSuffix: ' '
              },
              color: '#EB7CB4'

          },{
              name: 'Índice de Inter Alcance',
              type: 'spline',
              data: indiceia,
              tooltip: {
                  valueSuffix: ' '
              },
              color: '#9ACA61'

          },{
              name: 'Índice de Interacción vs Inversión',
              type: 'spline',
              data: indice_interaccion_inversion,
              tooltip: {
                  valueSuffix: ' '
              },
              color: '#9966FF'

          },{
              name: 'Indice de Inter Alcance vs Inversión',
              type: 'spline',
              data: indice_interalcance_inversion,
              tooltip: {
                  valueSuffix: ' '
              },
              color: '#7CB5EC'

          }]
    });

        }
      else{
        //esta es la graf kpis no indices
        Highcharts.chart('grafica_info_post', {
            chart: {
                zoomType: 'xy'
            },
                  showInLegend: true,
              title: {
                  text: nombre+' por Publicación'
              },
              subtitle: {
                  text: ''
              },
              xAxis: [{
                categories: d,
                crosshair: true
              }],
              yAxis: [{ // Primary yAxis
                labels: {
                  format: '{value}',
                  style: {
                    color: Highcharts.getOptions().colors[1]
                  }
                },
                title: {
                  text: 'Índice inter Alcance',
                  style: {
                    color: Highcharts.getOptions().colors[1]
                  }
                },
                opposite: true
              }, { // Secondary yAxis
                gridLineWidth: 0,
                title: {
                  text: nombre,
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
                  text: 'Índice '+nombre,
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
                name: nombre,
                color:'#00CA79',
                type: 'column',
                yAxis: 1,
                data: kpi_actual
              }, {
                name: 'Índice '+nombre,
                color:'#EB7CB4',
                type: 'spline',
                yAxis: 2,
                data: indice_kpi,
                marker: {
                  enabled: false
                }
              }, {
                name: 'Índice inter Alcance',
                color:'#9ACA61',
                type: 'spline',
                data:  indiceInteralcance,
                marker: {
                  enabled: false
                }
              }, {
                name: 'Índice de '+nombre+' vs Inversión',
                color:'#9966FF',
                type: 'spline',
                data: indice_kpi_inversion,
                marker: {
                  enabled: false
                }
              }, {
                name: 'Índice Alcance vs Inversión',
                color:'#7CB5EC',
                type: 'spline',
                data: indice_alcance_inversion,
                marker: {
                  enabled: false
                }
              }, {
                name: 'Costo por Acción',
                color:'#7CB5EC',
                type: 'spline',
                data: costo_kpi,
                marker: {
                  enabled: false
                }
              }]
        }); 
  } */
});
function get_valores_post_indicador(arreglo,indicador) {
    var arrayValores=[];
    $.each(arreglo, function( index, value ) {
        arrayValores.push(parseFloat(value[indicador]));
    });
    return arrayValores;
}