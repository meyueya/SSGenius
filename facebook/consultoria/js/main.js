/*   $(function () {
    var d = "<?php echo $d;?>";
    if(d!==''){ var des='moment("<?php echo $d;?>")'; var has='moment("<?php echo $h;?>")'; }
    else if(d === ''){ var des=moment().startOf('year'); var has=moment().endOf('month');  }
 
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          
          'Mes Actual'  : [moment().startOf('month'), moment().endOf('month')],
          'Mes Pasado'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
          'Hace 2 Meses': [moment().subtract(2, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
          'Hace 3 Meses': [moment().subtract(3, 'month').startOf('month'), moment().subtract(0, 'month').endOf('month')],
          'Hace 6 Meses': [moment().subtract(6,'month').startOf('month'), moment().subtract(0, 'month').endOf('month')],
          'Año Actual'  : [moment().startOf('year'), moment().endOf('month')],
          'Año pasado'  : [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
          'Hace 1 año'  : [moment().subtract(12, 'month').startOf('month'), moment().subtract(0, 'month').endOf('month')],
          'Hace 2 año'  : [moment().subtract(24, 'month').startOf('month'), moment().subtract(0, 'month').endOf('month')]
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
      function (start, end, label) {
      
        $('#daterange-btn span').html(start.format('dd/mm/yyyy') + ' - ' + end.format('dd/mm/yyyy'))
      }
    )

   
  }) */
  
 



 $('#camp').change(function()
  {
    var valor = $(this).val();
    
    // Lista de modelos
    $.post( 'keywords.php', { valor: valor} ).done( function( respuesta )
    {
      $( '#key' ).html( respuesta );
    });
  });






$('#facebook').addClass("show");
$('#f').addClass("active");
$('#grf').addClass("active");



    
   




  $.each( [ 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22 ], function( i, l ){
 
    //la variable fecha y periodo estan definidas en el dumento externo a este: informefb
    var id = l;
    var x = new Array();
    var y = new Array();
    var z = new Array()
    var w = new Array();
    var d = new Array();
    var ef = new Array();
    var em = new Array();
    var eu = new Array();
    var ed = new Array();
    var ds = new Array();
    var f;
    var m;
    var u;  
    var titulo;
    var titulo2;

    var params ={

            "ACT": id,
            "fecha": fecha,
            "fecha_comparacion": fecha_comparacion,
            "periodo": periodo             
        };

 $.ajax({
            data:   params,  
            url:    'datos.php', 
            type:   'post',
            beforeSend: function () { //before make the ajax call
                var chart = $('#container').highcharts();
                //chart.showLoading();
            },
            error: function(response){ //if an error happens it will be processed here
                var chart = $('#container').highcharts();
                chart.hideLoading();
                alert("error: Chart error"); 
                popup('popUpDiv');
            },
            success: function(DatosRecuperados) {
              //datos comparacion
              $.ajax({
                  data:   {
                    "ACT": id,
                    "fecha": fecha_comparacion,
                    "periodo": periodo             
                  },  
                  url:    'datos.php', 
                  type:   'post',
                  beforeSend: function () { //before make the ajax call
                      var chart = $('#container').highcharts();
                      //chart.showLoading();
                  },
                  error: function(responserror){ //if an error happens it will be processed here
                    alert('error');  

                  },
                  success: function(DatosComparacion) {
                $.each(DatosRecuperados, function(i,o){

                    if (o.x!=null) {x[i] = parseInt(o.x);} else{x[i]=0; }
                    if (o.y) {y[i] = parseInt(o.y);} else{y[i]=0; }
                    if (o.w) {w[i] = parseFloat(o.w);}
                    if (o.z) {z[i] = parseFloat(o.z);}
                    if (o.ds) {ds[i] = parseFloat(o.ds);}
                    if (o.f) {f = parseFloat(o.f);}
                    if (o.m) {m = parseFloat(o.m);}
                    if (o.u) {u = parseFloat(o.u);}
                    
                    
                    if(id==7){
                      var  edad = (o.s).split('.');
    
                      if(edad[1]=='13-17'){if(edad[0]=='F'){ef[0] = parseInt(o.b);}if(edad[0]=='M'){em[0] = parseInt(o.b);}if(edad[0]=='U'){eu[0] = parseInt(o.b);}}
                      if(edad[1]=='18-24'){if(edad[0]=='F'){ef[1] = parseInt(o.b);}if(edad[0]=='M'){em[1] = parseInt(o.b);}if(edad[0]=='U'){eu[1] = parseInt(o.b);}}
                      if(edad[1]=='25-34'){if(edad[0]=='F'){ef[2] = parseInt(o.b);}if(edad[0]=='M'){em[2] = parseInt(o.b);}if(edad[0]=='U'){eu[2] = parseInt(o.b);}}
                      if(edad[1]=='35-44'){if(edad[0]=='F'){ef[3] = parseInt(o.b);}if(edad[0]=='M'){em[3] = parseInt(o.b);}if(edad[0]=='U'){eu[3] = parseInt(o.b);}}
                      if(edad[1]=='45-54'){if(edad[0]=='F'){ef[4] = parseInt(o.b);}if(edad[0]=='M'){em[4] = parseInt(o.b);}if(edad[0]=='U'){eu[4] = parseInt(o.b);}}
                      if(edad[1]=='55-64'){if(edad[0]=='F'){ef[5] = parseInt(o.b);}if(edad[0]=='M'){em[5] = parseInt(o.b);}if(edad[0]=='U'){eu[5] = parseInt(o.b);}}
                      if(edad[1]=='65+')  {if(edad[0]=='F'){ef[6] = parseInt(o.b);}if(edad[0]=='M'){em[6] = parseInt(o.b);}if(edad[0]=='U'){eu[6] = parseInt(o.b);}}
                      ed=['13-17','18-24','25-34','35-44','45-54','55-64','65+'];
                    }


                     if(periodo=='a'){
                      titulo = 'Mes'; 
                      titulo2 = 'Dia'; 
                      d[i] ='Dia '+parseInt(o.d);
                   
                    }

                    if(periodo=='b'){
                      titulo = 'Año'; 
                      titulo2 = 'Semana'; 
                      d[i] ='Semana '+parseInt(o.d);
                   
                    }

                    if(periodo=='c'){
                     
                    if (o.d==1) {d[i] = 'Ene';}
                    if (o.d==2) {d[i] = 'Feb';}
                    if (o.d==3) {d[i] = 'Mar';}
                    if (o.d==4) {d[i] = 'Abr';}
                    if (o.d==5) {d[i] = 'May';}
                    if (o.d==6) {d[i] = 'Jun';}
                    if (o.d==7) {d[i] = 'Jul';}
                    if (o.d==8) {d[i] = 'Ago';}
                    if (o.d==9) {d[i] = 'Sep';}
                    if (o.d==10) {d[i] = 'Oct';}
                    if (o.d==11) {d[i] = 'Nov';}
                    if (o.d==12) {d[i] = 'Dic';}
                    titulo = 'Año'; 
                    titulo2 = 'Mes'; 

                    }
                    

                    


               });
              
              
                  

             if(id==0){
              var balance_comparacion=0;
              var contador=0;
                  $('#link0').html('<table id="example0" class="display compact"><thead style="text-align: center;  font-size: 10px;"><tr><th> '+titulo+' </th><th> '+titulo2+' </th><th>Nuevos Likes</th><th>Dislikes</th><th>Balance</th><th>Comparación</th></tr></thead><tbody id="example0"></tbody></table>');
                  $.each(DatosRecuperados, function(i, d) {
                  
                  $('#example0').append('<tr><td>'+d.z+'</td><td>'+d.d+'</td><td>'+d.x+'</td><td>'+d.y+'</td><td>'+(d.x-d.y)+'</td><td id="examples0'+contador+'"></td></tr>');
                  $('#examples0'+contador).html(porcentaje_comparacion(balance_comparacion, (d.x-d.y), '#examples0'+contador));
                  balance_comparacion=d.x-d.y;
                  contador++;
                  });

                  $('#container'+id).highcharts({
                    chart: {
                      type: 'column'
                    },
                    title: {
                      text: 'Nuevos likes vs Dislikes'
                    },
                    xAxis: {
                      categories: d
                    },
                    yAxis: {
                      min: 0,
                      title: {
                        text: 'Likes a la fecha'
                      },
                      stackLabels: {
                        enabled: false,
                        style: {
                          fontWeight: 'bold',
                          color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                        }
                      }
                    },
                    legend: {
                      align: 'right',
                      x: -30,
                      verticalAlign: 'top',
                      y: 25,
                      floating: true,
                      backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                      borderColor: '#CCC',
                      borderWidth: 1,
                      shadow: true
                    },
                   /* tooltip: {
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
                    series: [{
                      name: 'Dislikes',
                      data: y,
                      color: '#CA1A15'
                    },
                    {
                      name: 'Nuevos Likes',
                      data: x,
                      color: '#004F82'
                    }]
                  });

             }


             if(id=='1'){
                 
                  
                    $('#link1').html('<table id="example1" class="display compact"><thead style="text-align: center; font-size: 10px;"><tr><th> '+titulo+' </th><th> '+titulo2+' </th><th>Likes a la fecha</th><th>Dislikes</th></tr></thead><tbody id="example1"></tbody></table>');
                  $.each(DatosRecuperados, function(i, d) {
                  
                  $('#example1').append('<tr><td>'+d.z+'</td><td>'+d.d+'</td><td>'+d.x+'</td><td>'+d.y+'</td></tr>');
                  });

                           $('#container'+id).highcharts({
                                 chart: {
                    zoomType: 'xy'
                },
                title: {
                    text: 'Histórico de Likes vs Dislikes'
                },
               /* subtitle: {
                    text: 'Source: WorldClimate.com'
                },*/
                xAxis: [{
                    categories: d,
                    crosshair: true
                }],
                yAxis: [{ // Primary yAxis
                  
                    labels: {

                        format: '{value}',
                        style: {
                            color: '#F15C80'
                        }
                    },
                    title: {
                        text: 'Dislikes',
                        style: {
                            color: '#F15C80'
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

                                exporting: {
                                    enabled: false
                                },
                              series: [{
                                name: 'Likes a la fecha',
                                type: 'column',
                                yAxis: 1,
                                color:'#004F82',
                                data: x,
                                tooltip: {
                                valueSuffix: ''
                                }
                                
                                },  {
                                name: 'Dislikes',
                                type: 'spline',
                                color:'#F15C80',
                                max: 1,
                                data: y,
                                tooltip: {
                                valueSuffix: ''
                                }
                                }]
                            });
             }



             if(id==2){



                    $('#link2').html('<table id="example2" class="display compact"><thead style="text-align: center; font-size: 10px;"><tr><th> '+titulo+' </th><th> '+titulo2+' </th><th>Likes a la fecha</th><th>Nuevos Likes</th><th>% Crecimiento de Likes</th></tr></thead><tbody id="example2"></tbody></table>');
                  $.each(DatosRecuperados, function(i, d) {
                  
                  $('#example2').append('<tr><td>'+d.z+'</td><td>'+d.d+'</td><td>'+d.x+'</td><td>'+d.y+'</td><td>'+Math.round(d.w*1000)/1000+' %</td></tr>');
                  });
                  
                 // concole.log(d);



                                $('#container'+id).highcharts({
                                       chart: {
                          zoomType: 'xy'
                      },
                      title: {
                          text: 'Crecimiento de Likes'
                      },
                     /* subtitle: {
                          text: 'Source: WorldClimate.com'
                      },*/
                      xAxis: [{
                          categories: d,
                          crosshair: true
                      }],
                      yAxis: [{ // Primary yAxis
                          labels: {
                              format: '{value}%',
                              style: {
                                  color: '#00AD82'
                              }
                          },
                          title: {
                              text: 'Likes Ganados',
                              style: {
                                  color: '#00AD82'
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

                      },
                      { // Tertiary yAxis
                      gridLineWidth: 0,
                      title: {
                        text: 'Nuevos Likes',
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
                                      backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
                                      },

                                      exporting: {
                                          enabled: false
                                      },
                                    series: [{
                                      name: 'Likes a la fecha',
                                      type: 'column',
                                      yAxis: 1,
                                      color:'#004F82',
                                      data: x,
                                      tooltip: {
                                      valueSuffix: ''
                                      }
                                      
                                      }, 
                                      {
                                    name: 'Nuevos Likes',
                                    type: 'spline',
                                    yAxis: 2,
                                    color:'#00CA79',
                                    data: y,
                                    marker: {
                                      enabled: false
                                    },
                                    dashStyle: 'shortdot',
                                    tooltip: {
                                      valueSuffix: ''
                                    }

                                     },
                                      {
                                      name: 'Crecimiento de Likes',
                                      type: 'spline',
                                      color:'#00AD82',
                                      data: w,
                                      tooltip: {
                                      valueSuffix: ''
                                      }
                                      }]
                                  });

             }





              if(id==3){


                  var likesorg=0;
                  var likespag=0;
                  var comp_likesorg=0;
                  var comp_likespag=0;
                  var balance_comparacion=0;
                  var contador=0;
                  $('#link3').html('<table id="example3" class="display compact"><thead style="text-align: center; font-size: 10px;"><tr><th> '+titulo+' </th><th> '+titulo2+' </th><th>Pagados</th><th>Organicos</th><th>Balance</th><th>Comparación</th></tr></thead><tbody id="example3"></tbody></table>');
                  $.each(DatosRecuperados, function(i, d) {
                   likesorg+=parseInt(d.y);
                   likespag+=parseInt(d.x);
                  $('#example3').append('<tr><td>'+d.z+'</td><td>'+d.d+'</td><td>'+d.x+'</td><td>'+d.y+'</td><td>'+d.w+'</td><td id="examples3'+contador+'"></td></tr>');
                  $('#examples3'+contador).html(porcentaje_comparacion(balance_comparacion, d.w, '#examples3'+contador));
                  balance_comparacion=d.w;
                  contador++;
                  });
                  $.each(DatosComparacion, function(i, d) {
                   comp_likesorg+=parseInt(d.y);
                   comp_likespag+=parseInt(d.x);
                  });

                               var tests = [
                              { num: likesorg, digits: 1 }
                             
                              ];
                               var tests1 = [
                              { num: likespag, digits: 1 }
                             
                              ];

                          

                              
                      
                              $('#likesorg').html(nFormatter(tests[0].num, tests[0].digits));
                              $('#likesorg_comp').html(porcentaje_comparacion(comp_likesorg,likesorg,'#likesorg_comp'));
                              $('#likespag').html(nFormatter(tests1[0].num, tests[0].digits));
                              $('#likespag_comp').html(porcentaje_comparacion(comp_likespag,likespag,'#likespag_comp'));
                              



                                 $('#container'+id).highcharts({
                                chart: {
                                  type: 'bar'
                                },
                                title: {
                                  text: 'Como se consiguieron los Likes (Total)'
                                },
                                xAxis: {
                                  categories: d
                                },
                                yAxis: {
                                  //min: 0,
                                  title: {
                                    text: 'Porcentaje'
                                  }
                                },
                                legend: {
                                  reversed: true
                                },
                                tooltip: {
                                pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
                                shared: true
                                },
                                exporting: {
                                          enabled: false
                                },
                                plotOptions: {
                                  series: {
                                    stacking: 'normal'
                                  }
                                },
                                series: [{
                                  name: 'Pagados',
                                  color:'#004F82',
                                  data: x
                                },{
                                  name: 'Organicos',
                                  color:'#00CA79',
                                  data: y
                                }]
                              });
              }



               if(id==4){


                    
                  $('#link4').html('<table id="example4" class="display compact"><thead style="text-align: center; font-size: 10px;"><tr><th> '+titulo+' </th><th> '+titulo2+' </th><th>Pagados (%)</th><th>Organicos (%)</th></tr></thead><tbody id="example4"></tbody></table>');
                  $.each(DatosRecuperados, function(i, d) {
                   if (d.x!=null) {x[i] = parseFloat(d.x);} else{x[i]=0; }
                    if (d.y) {y[i] = parseFloat(d.y);} else{y[i]=0; }
                  $('#example4').append('<tr><td>'+d.z+'</td><td>'+d.d+'</td><td>'+d.x+' %</td><td>'+d.y+' %</td></tr>');
                  // $('#example4').append('<tr><td>'+d.z+'</td><td>'+d.d+'</td><td>'+Math.round(d.x*1000)/1000+' %</td><td>'+Math.round(d.y*1000)/1000+' %</td></tr>');
                  });

                                 $('#container'+id).highcharts({
                                chart: {
                                  type: 'bar'
                                },
                                title: {
                                  text: 'Como se consiguieron los Likes (Total)'
                                },
                                xAxis: {
                                  categories: d
                                },
                                yAxis: {
                                  min: 0,
                                  max: 100,
                                  labels: {
                                  format: '{value}%',
                                  style: {
                                      color: '#00AD82'
                                  }
                                  },
                                  title: {
                                    text: 'Porcentaje (%)'
                                  }
                                },
                                legend: {
                                  reversed: true
                                },
                                tooltip: {
                                pointFormat: '<span style="color:{series.color}">{series.name}</span>: ({point.percentage:.1f}%)<br/>',
                                shared: true
                                },
                                exporting: {
                                          enabled: false
                                },
                                plotOptions: {
                                  series: {
                                    stacking: 'normal'
                                  }
                                },

                                series: [{
                                  name: 'Pagados',
                                  color:'#004F82',
                                  data: x
                                },{
                                  name: 'Organicos',
                                  color:'#00CA79',
                                  data: y
                                }]
                              });
              }


              if(id==5){
                var nfansn=0;
                var comp_nfansn=0;

                $('#link5').html('<table id="example5" class="display compact"><thead style="text-align: center; font-size: 10px;"><tr><th> '+titulo+' </th><th> '+titulo2+' </th><th>Nuevos Likes</th></tr></thead><tbody id="example5"></tbody></table>');
                  $.each(DatosRecuperados, function(i, d) {
                  
                  $('#example5').append('<tr><td>'+d.z+'</td><td>'+d.d+'</td><td>'+d.x+'</td></tr>');
                  nfansn+=parseInt(d.x);
                  });
                  $.each(DatosComparacion, function(i, d) {
                  comp_nfansn+=parseInt(d.x);
                  });

                              var tests = [
                              { num: nfansn, digits: 1 }
                             
                              ];
                              var i;
                              for (i = 0; i < tests.length; i++) {
                              $('#nfansn').html(nFormatter(tests[i].num, tests[i].digits));
                            }
                            $('#nfansn_comp').html(porcentaje_comparacion(comp_nfansn,nfansn,'#nfansn_comp'));



                            $('#container'+id).highcharts({
                                        chart: {
                                          type: 'column'
                                        },
                                        title: {
                                          text: 'Nuevos fans netos'
                                        },
                                        xAxis: {
                                          categories: d,
                                          labels: {
                                            rotation: -45,
                                            style: {
                                              fontSize: '13px',
                                              fontFamily: 'Verdana, sans-serif'
                                            }
                                          }
                                        },
                                        yAxis: {
                                          min: 0,
                                          title: {
                                            text: 'Cantidad de Fans'
                                          }
                                        },
                                        legend: {
                                          enabled: false
                                        },
                                        tooltip: {
                                          pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b>',
                                          shared: true
                                          },
                                         exporting: {
                                         enabled: false
                                         },
                                        series: [{
                                          name: 'Fans Netos',
                                          data: x,
                                          color: '#004F82',
                                          dataLabels: {
                                            enabled: true,
                                            rotation: -90,
                                            color: '#FFFFFF',
                                            align: 'right',
                                            //format: '{point.y:.1f}', // one decimal
                                            y: 10, // 10 pixels down from the top
                                            style: {
                                              fontSize: '13px',
                                              fontFamily: 'Verdana, sans-serif'
                                            }
                                          }
                                        }]
                                      });
              }


              if(id==6){

                $('#link6').html('<table id="example6" class="display compact"><thead style="text-align: center; font-size: 10px;"><tr><th> Rango de Fecha </th><th> Hombre (%)</th><th> Mujer (%)</th><th> Otros (%)</th></tr></thead><tbody id="example6"></tbody></table>');
                  $.each(DatosRecuperados, function(i, d) {
                  
                  $('#example6').append('<tr><td>'+fecha+'</td><td>'+d.m+' %</td><td>'+d.f+' %</td><td>'+d.u+' %</td></tr>');
                  });
                  
                  


                           $('#container'+id).highcharts({
                            chart: {
                              plotBackgroundColor: null,
                              plotBorderWidth: null,
                              plotShadow: false,
                              type: 'pie'
                            },
                            title: {
                              text: 'Perfil de likes Demográfico'
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
                              name: 'Fans',
                              data: [
                                 { name: 'Mujer',
                                 color: '#F15C80 ',
                                  y: f
                                   },
                                { name: 'Hombre',
                                color: '#004F82 ',
                                 y: m
                                  },
                               
                                { name: 'Otros',
                                 color: '#434348 ',
                                  y: u 
                                },
                               
                              ]
                            }]
                          });
                     }  

                     if(id==7){


                       $('#link7').html('<table id="example7" class="display compact"><thead style="text-align: center; font-size: 10px;"><tr><th>Rango de Edad</th><th>Hombre</th><th>Mujer</th><th>Otros</th></tr></thead><tbody id="example7"></tbody></table>');
                       $.each(ed, function(i) {
                       
                       $('#example7').append('<tr><td>'+ed[i]+'</td><td>'+em[i]+'</td><td>'+ef[i]+'</td><td>'+eu[i]+'</td></tr>');
                       });
                  
                 

                                $('#container'+id).highcharts({
                                  chart: {
                                    type: 'column'
                                  },
                                  title: {
                                    text: 'Perfil Fans Edades'
                                  },
                                 
                                  xAxis: {
                                    categories: ed,
                                    crosshair: true
                                  },
                                  yAxis: {
                                    min: 0,
                                    title: {
                                      text: 'Fans'
                                    }
                                  },
                                  tooltip: {
                                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                      '<td style="padding:0"><b>{point.y}</b></td></tr>',
                                    footerFormat: '</table>',
                                    shared: true,
                                    useHTML: true
                                  },
                                  exporting: {
                                   enabled: false
                                  },
                                  plotOptions: {
                                    column: {
                                      pointPadding: 0.2,
                                      borderWidth: 0
                                    }
                                  },
                                  series: [{
                                    name: 'Hombre',
                                    color: '#004F82 ',
                                    data: em

                                  }, {
                                    name: 'Mujer',
                                    color: '#F15C80 ',
                                    data: ef

                                  }, {
                                    name: 'Otros',
                                    color: '#434348 ',
                                    data: eu

                                  }]
                                });

                     }




                  if(id==8){
                  var alcance=0;
                  var comp_alcance=0;
                $('#link8').html('<table id="example8" class="display compact"><thead style="text-align: center; font-size: 10px;"><tr><th> '+titulo+' </th><th> '+titulo2+' </th><th>Alcance</th></tr></thead><tbody id="example8"></tbody></table>');
                  $.each(DatosRecuperados, function(i, d) {
                  $('#example8').append('<tr><td>'+d.z+'</td><td>'+d.d+'</td><td>'+d.x+'</td></tr>');
                    alcance+=parseInt(d.x);
                  });
                  $.each(DatosComparacion, function(i, d) {
                    comp_alcance+=parseInt(d.x);
                  });

                              var tests = [
                              { num: alcance, digits: 1 }
                             
                              ];
                              var i;
                              for (i = 0; i < tests.length; i++) {
                              $('#alcance').html(nFormatter(tests[i].num, tests[i].digits));
                            }
                            $('#alcance_comp').html(porcentaje_comparacion(comp_alcance,alcance,'#alcance_comp'));
                              





                  
            


                            $('#container'+id).highcharts({
                                        chart: {
                                          type: 'column'
                                        },
                                        title: {
                                          text: 'Alcance'
                                        },
                                        xAxis: {
                                          categories: d,
                                          labels: {
                                            rotation: -45,
                                            style: {
                                              fontSize: '13px',
                                              fontFamily: 'Verdana, sans-serif'
                                            }
                                          }
                                        },
                                        yAxis: {
                                          min: 0,
                                          title: {
                                            text: 'Cantidad de Alcance'
                                          }
                                        },
                                        legend: {
                                          enabled: false
                                        },
                                        tooltip: {
                                          pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b>',
                                          shared: true
                                          },
                                         exporting: {
                                         enabled: false
                                         },
                                        series: [{
                                          name: 'Alcance',
                                          data: x,
                                          color: '#00CA79',
                                          dataLabels: {
                                            enabled: true,
                                            rotation: -90,
                                            color: '#FFFFFF',
                                            align: 'right',
                                            //format: '{point.y:.1f}', // one decimal
                                            y: 10, // 10 pixels down from the top
                                            style: {
                                              fontSize: '13px',
                                              fontFamily: 'Verdana, sans-serif'
                                            }
                                          }
                                        }]
                                      });
              }






                      if(id==9){

                $('#link9').html('<table id="example9" class="display compact"><thead style="text-align: center; font-size: 10px;"><tr><th> '+titulo+' </th><th> '+titulo2+' </th><th>Alcance</th></tr></thead><tbody id="example9"></tbody></table>');
                  $.each(DatosRecuperados, function(i, d) {

                  $('#example9').append('<tr><td>'+d.z+'</td><td>'+d.d+'</td><td>'+d.x+'</td></tr>');
                  });
                  
              



                            $('#container'+id).highcharts({
                                        chart: {
                                          type: 'column'
                                        },
                                        title: {
                                          text: 'Interacciones'
                                        },
                                        xAxis: {
                                          categories: d,
                                          labels: {
                                            rotation: -45,
                                            style: {
                                              fontSize: '13px',
                                              fontFamily: 'Verdana, sans-serif'
                                            }
                                          }
                                        },
                                        yAxis: {
                                          min: 0,
                                          title: {
                                            text: 'Cantidad de Interacciones'
                                          }
                                        },
                                        legend: {
                                          enabled: false
                                        },
                                        tooltip: {
                                          pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b>',
                                          shared: true
                                          },
                                         exporting: {
                                         enabled: false
                                         },
                                        series: [{
                                          name: 'Interacciones',
                                          data: x,
                                          color: '#ED7D31',
                                          dataLabels: {
                                            enabled: true,
                                            rotation: -90,
                                            color: '#FFFFFF',
                                            align: 'right',
                                            //format: '{point.y:.1f}', // one decimal
                                            y: 10, // 10 pixels down from the top
                                            style: {
                                              fontSize: '13px',
                                              fontFamily: 'Verdana, sans-serif'
                                            }
                                          }
                                        }]
                                      });
              }



             if(id==10){



                    
                  $('#link10').html('<table id="example10" class="display compact"><thead style="text-align: center; font-size: 10px;"><tr><th> '+titulo+' </th><th> '+titulo2+' </th><th>Hombre</th><th>Mujer</th><th>Otros</th></tr></thead><tbody id="example10"></tbody></table>');
                      $.each(DatosRecuperados, function(i, d) {
                    if (d.f) {ef[i] = parseFloat(d.f);}
                    if (d.m) {em[i] = parseFloat(d.m);}
                    if (d.u) {eu[i] = parseFloat(d.u);}
                    if (d.ds) {ds[i] = d.ds;}
                       
                       $('#example10').append('<tr><td>'+d.z+'</td><td>'+d.d+'</td><td>'+d.m+'</td><td>'+d.f+'</td><td>'+d.u+'</td></tr>');
                       });

                   
                                 $('#container'+id).highcharts({
                                chart: {
                                  type: 'bar'
                                },
                                title: {
                                  text: 'Como se consiguieron los Likes (Total)'
                                },
                                xAxis: {

                                  categories: d
                                },
                                yAxis: {
                                  min: 0,
                                  max: 100,
                                  labels: {
                              format: '{value}%',
                              style: {
                                  color: '#00AD82'
                              }
                          },
                                  title: {
                                    text: 'Porcentaje (%)'
                                  }
                                },
                                legend: {
                                  reversed: true
                                },
                                tooltip: {
                                pointFormat: '<span style="color:{series.color}">{series.name}</span>:  ({point.percentage:.1f}%)<br/>',
                                shared: true
                                },
                                exporting: {
                                          enabled: false
                                },
                                plotOptions: {
                                  series: {
                                    stacking: 'normal'
                                  }
                                },
                                series: [{
                                  name: 'Otros',
                                  color:'#434348',
                                  data: eu
                                },
                                {
                                  name: 'Mujer',
                                  color:'#F15C80',      
                                  data: ef
                                },
                                {
                                  name: 'Hombre',
                                  color:'#004F82',
                                  data: em
                                }
                                ]
                              });
              } 



               if(id==11){

                $('#link11').html('<table id="example11" class="display compact"><thead style="text-align: center; font-size: 10px;"><tr><th> Hora </th><th>Max Fans</th></tr></thead><tbody id="example11"></tbody></table>');
                  $.each(DatosRecuperados, function(i, d) {

                    if (d.h) {ds[i] = parseInt(d.h);}
                    if (d.f) {x[i] = parseInt(d.f);}
                   
                  
                  $('#example11').append('<tr><td>'+d.h+'</td><td>'+d.f+'</td></tr>');
                  });
                  
                 // concole.log(d);



                            $('#container'+id).highcharts({
                                        chart: {
                                          type: 'column'
                                        },
                                        title: {
                                          text: 'Fans Online'
                                        },
                                        xAxis: {
                                          categories: ds,
                                       
                                          labels: {
                                            format: '{value}:00',
                                            rotation: -45,
                                            style: {
                                              fontSize: '13px',
                                              fontFamily: 'Verdana, sans-serif',
                                              color: '#00AD82'
                                            }
                                          }
                                        },
                                        yAxis: {
                                          min: 0,
                                          
                                          title: {
                                            text: 'Cantidad de Fans Online'
                                          }
                                        },
                                        legend: {
                                          enabled: false
                                        },
                                        tooltip: {
                                          pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b>',
                                          shared: true
                                          },
                                         exporting: {
                                         enabled: false
                                         },
                                        series: [{
                                          name: 'Alcance',
                                          data: x,
                                          color: '#004F82',
                                          dataLabels: {
                                            enabled: true,
                                            rotation: -90,
                                            color: '#FFFFFF',
                                            align: 'right',
                                            //format: '{point.y:.1f}', // one decimal
                                            y: 10, // 10 pixels down from the top
                                            style: {
                                              fontSize: '13px',
                                              fontFamily: 'Verdana, sans-serif'
                                            }
                                          }
                                        }]
                                      });
              }

               if(id=='12'){
                  var alcance=0;
                  var clics=0;
                  var impresions=0;
                  var engagements=0;
                  var engagements_users=0;
                  /* inicio variable compracion */
                  var comp_alcance=0;
                  var comp_clics=0;
                  var comp_impresions=0;
                  var comp_engagements=0;
                  var comp_engagements_users=0;
                  /* fin variable compracion */
                  console.log(DatosRecuperados);
                  console.log(DatosComparacion);
                  
                    $('#link12').html('<table id="example12" class="display compact"><thead style="text-align: center; font-size: 10px;"><tr><th> '+titulo+' </th><th> '+titulo2+' </th><th>Engaged users</th><th>Comparación</th><th>Engagement rate</th><th>Comparación</th></tr></thead><tbody id="example12"></tbody></table>');
                  $.each(DatosRecuperados, function(i, d) {
                  console.log(DatosComparacion[i])
                  $('#example12').append('<tr><td>'+d.z+'</td><td>'+d.d+'</td><td>'+d.x+'</td><td>'+d.x+'</td><td>'+d.w+'</td><td>'+d.w+'</td></tr>');
                   clics+=parseInt(d.clics);
                   impresions+=parseInt(d.page_impressions);
                   engagements+=parseInt(d.page_post_engagements);
                   engagements_users+=parseInt(d.x);
                  });
                  /* inicion preceso variable datos compracion */
                  $.each(DatosComparacion, function(i, d) {
                   comp_clics+=parseInt(d.clics);
                   comp_impresions+=parseInt(d.page_impressions);
                   comp_engagements+=parseInt(d.page_post_engagements);
                   comp_engagements_users+=parseInt(d.x);
                  });
                  /* fin preceso variable datos compracion */

                              var tests = [
                              { num: impresions, digits: 3 }
                             
                              ];

                               var tests2 = [
                              { num: engagements, digits: 1 }
                             
                              ];
                              var tests3 = [
                              { num: engagements_users, digits: 1 }
                             
                              ];

                              var tests4 = [
                              { num: clics, digits: 1 }
                             
                              ];
                              var i;
                              for (i = 0; i < tests.length; i++) {
                            
                              }

                              $('#impresions').html(nFormatter(tests[0].num, tests[0].digits));
                              $('#impresions_comp').html(porcentaje_comparacion(comp_impresions, impresions,'#impresions_comp'));
                              $('#engagements').html(nFormatter(tests2[0].num, tests2[0].digits));
                              $('#engagements_comp').html(porcentaje_comparacion(comp_engagements, engagements,'#engagements_comp'));
                              $('#engagements_users').html(nFormatter(tests3[0].num, tests3[0].digits));
                              $('#engagements_users_comp').html(porcentaje_comparacion(comp_engagements_users, engagements_users,'#engagements_users_comp'));
                              $('#clics').html(nFormatter(tests4[0].num, tests4[0].digits));
                              $('#clics_comp').html(porcentaje_comparacion(comp_clics, clics,'#clics_comp'));


               




                  $('#container'+id).highcharts({
                                 chart: {
                    zoomType: 'xy'
                },
                title: {
                    text: 'Engaged users vs engagement rate'
                },
               /* subtitle: {
                    text: 'Source: WorldClimate.com'
                },*/
                xAxis: [{
                    categories: d,
                    crosshair: true
                }],
                yAxis: [{ // Primary yAxis
                  
                    labels: {

                        format: '{value}',
                        style: {
                            color: '#F15C80'
                        }
                    },
                    title: {
                        text: 'Engagement rate',
                        style: {
                            color: '#ED7D31'
                        }
                    },
                    opposite: true

                }, { // Secondary yAxis
                    gridLineWidth: 0,
                    title: {
                        text: 'Engaged users',
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
                                valueDecimals: 2,
                              legend: {
                                layout: 'vertical',
                                align: 'left',
                                x: 80,
                                verticalAlign: 'top',
                                y: 55,
                                floating: true,
                                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
                                },

                                exporting: {
                                    enabled: false
                                },
                              series: [{
                                name: 'Engaged users',
                                type: 'column',
                                yAxis: 1,
                                color:'#004F82',
                                data: x,
                                tooltip: {
                                valueSuffix: ''
                                }
                                
                                },  {
                                name: 'Engagement rate',
                                type: 'spline',
                                color:'#ED7D31',
                                max: 1,
                                data: w,
                                tooltip: {
                                valueSuffix: ''
                                }
                                }]
                            });
             }

                if(id=='13'){
                 
                  
                    $('#link13').html('<table id="example13" class="display compact"><thead style="text-align: center; font-size: 10px;"><tr><th> '+titulo+' </th><th> '+titulo2+' </th><th>Alcance promedio</th><th>Engagement rate</th></tr></thead><tbody id="example13"></tbody></table>');
                  $.each(DatosRecuperados, function(i, d) {
                  
                  $('#example13').append('<tr><td>'+d.z+'</td><td>'+d.d+'</td><td>'+d.x+'</td><td>'+d.w+'</td></tr>');
                  });

                           $('#container'+id).highcharts({
                                 chart: {
                    zoomType: 'xy'
                },
                title: {
                    text: 'Alcance promedio de post vs Engagement Rate'
                },
               /* subtitle: {
                    text: 'Source: WorldClimate.com'
                },*/
                xAxis: [{
                    categories: d,
                    crosshair: true
                }],
                yAxis: [{ // Primary yAxis
                  
                    labels: {

                        format: '{value}',
                        style: {
                            color: '#F15C80'
                        }
                    },
                    title: {
                        text: 'Engagement rate',
                        style: {
                            color: '#ED7D31'
                        }
                    },
                    opposite: true

                }, { // Secondary yAxis
                    gridLineWidth: 0,
                    title: {
                        text: 'Alcance promedio',
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
                                valueDecimals: 2,
                              legend: {
                                layout: 'vertical',
                                align: 'left',
                                x: 80,
                                verticalAlign: 'top',
                                y: 55,
                                floating: true,
                                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
                                },

                                exporting: {
                                    enabled: false
                                },
                              series: [{
                                name: 'Alcance promedio',
                                type: 'column',
                                yAxis: 1,
                                color:'#00CA79',
                                data: x,
                                tooltip: {
                                valueSuffix: ''
                                }
                                
                                },  {
                                name: 'Engagement rate',
                                type: 'spline',
                                color:'#ED7D31',
                                max: 1,
                                data: w,
                                tooltip: {
                                valueSuffix: ''
                                }
                                }]
                            });
             }

                    if(id==14){



                    
                  $('#link14').html('<table id="example14" class="display compact"><thead style="text-align: center; font-size: 10px;"><tr><th> '+titulo+' </th><th> '+titulo2+' </th><th>Hombre</th><th>Mujer</th><th>Otros</th></tr></thead><tbody id="example14"></tbody></table>');
                      $.each(DatosRecuperados, function(i, d) {
                    if (d.f) {ef[i] = parseFloat(d.f);}
                    if (d.m) {em[i] = parseFloat(d.m);}
                    if (d.u) {eu[i] = parseFloat(d.u);}
                    if (d.ds) {ds[i] = d.ds;}
                       
                       $('#example14').append('<tr><td>'+d.z+'</td><td>'+d.d+'</td><td>'+d.m+'</td><td>'+d.f+'</td><td>'+d.u+'</td></tr>');
                       });

                   
                                 $('#container'+id).highcharts({
                                chart: {
                                  type: 'bar'
                                },
                                title: {
                                  text: 'Nuevos Likes Demográfico'
                                },
                                xAxis: {

                                  categories: d
                                },
                                yAxis: {
                                  min: 0,
                                 // max: 100,
                                  labels: {
                              format: '{value}',
                              style: {
                                  color: '#00AD82'
                              }
                          },
                                  title: {
                                    text: 'Cantidad de Likes'
                                  }
                                },
                                legend: {
                                  reversed: true
                                },
                                tooltip: {
                                pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
                                shared: true
                                },
                                exporting: {
                                          enabled: false
                                },
                                plotOptions: {
                                  series: {
                                    stacking: 'normal'
                                  }
                                },
                                series: [{
                                  name: 'Otros',
                                  color:'#434348',
                                  data: eu
                                },
                                {
                                  name: 'Mujer',
                                  color:'#F15C80',      
                                  data: ef
                                },
                                {
                                  name: 'Hombre',
                                  color:'#004F82',
                                  data: em
                                }
                                ]
                              });
              } 
                                  if(id==15){

                                var reactions = new Array();
                                var shares = new Array();
                                var comments = new Array();
                                var video = new Array();
                                var clink = new Array();
                                var indicei = new Array();
                                var count = 0;
                                var int;
                                var intp=0;
                                //var fecha; 
                                
                                var last = Object.keys(DatosRecuperados['uno']).length;
                                last = parseInt(last)-1;
                                

                      $.each(DatosRecuperados['uno'], function(i, d) {
                      
                      if (d.reactions) {reactions[i] = parseInt(d.reactions);}
                      if (d.shares) {shares[i] = parseInt(d.shares);}
                      if (d.comments) {comments[i] = parseInt(d.comments);}
                      if (d.post_video_views_unique) {video[i] = parseInt(d.post_video_views_unique);}
                      if (d.link_clicks) {clink[i] = parseInt(d.link_clicks);}
                      if (d.indice_interaccion) {indicei[i] = parseFloat(d.indice_interaccion);}
                      
                      if(i<last){
                      intp += parseInt(d.reactions)+parseInt(d.shares)+parseInt(d.comments)+parseInt(d.post_video_views_unique)+parseInt(d.link_clicks);
                      
                      }
                      
                      });
                      
                        $.each(DatosRecuperados['uno'], function(i, d) {
                     
                      if (d.reactions) {reactions[i] = parseInt(d.reactions);}
                      if (d.shares) {shares[i] = parseInt(d.shares);}
                      if (d.comments) {comments[i] = parseInt(d.comments);}
                      if (d.post_video_views_unique) {video[i] = parseInt(d.post_video_views_unique);}
                      if (d.link_clicks) {clink[i] = parseInt(d.link_clicks);}
                      if (d.indice_interaccion) {indicei[i] = parseFloat(d.indice_interaccion);}
                     

                    //Hacemos una función para hacer las operaciones
                    function textoFecha(fecha){
                    var numDiaSem = fecha.getDay(); //getDay() devuelve el dia de la semana.(0-6).
                    //Creamos un Array para los nombres de los días    
                    var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
                    var diaLetras = diasSemana[fecha.getDay()];   //El día de la semana en letras. getDay() devuelve el dia de la semana.(0-6).
                    //Otro Array para los nombres de los meses    
                    var meses = new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                    var mesLetras = meses[fecha.getMonth()];  //El mes en letras
                    var diaMes = (fecha.getDate());   //getDate() devuelve el dia(1-31).
                    var anho = fecha.getFullYear();  //getFullYear() devuelve el año(4 dígitos).
                    var hora = fecha.getHours();    //getHours() devuelve la hora(0-23).
                    var min = fecha.getMinutes();   //getMinutes() devuelve los minutos(0-59).
                    if ((min >= 0) && (min < 10)) {    //Algoritmo para añadir un cero cuando el min tiene 1 cifra.
                    min = "0" + min;
                    }
                    var devolver =  diaLetras+ ", " + diaMes + " de " + mesLetras + " de " + anho + " a las " + hora + ":" + min + " horas.";
                    return devolver;
                    }
                     var fecha = new Date(d.created_time); //Declaramos el objeto fecha actual//Declaramos el objeto fecha actual
                    fecha = textoFecha(fecha);

                    


                  
                      
                      if(i<4)
                      {
                        int = parseInt(d.reactions)+parseInt(d.shares)+parseInt(d.comments)+parseInt(d.post_video_views_unique)+parseInt(d.link_clicks);

                           $('#pi'+i).html('<table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" class="tabla" style="border-collapse:collapse;border-color:#ddd; font-size: 10px;"><thead><tr><th colspan="2"><a  href="'+d.permalink_url+'"" target="_blank"><div style="height: 250px; width: 100%; background-size:cover;background-repeat: no-repeat; background-image:url('+d.picture+'); background-position: center;" alt=""></div></a></th></tr></thead><tbody style="text-align: left;"><tr><td colspan="2"><a  href="'+d.permalink_url+'"" target="_blank">'+d.message+'</a></td></tr><tr><th width="55%"> Fecha:</th><td> '+fecha+'</td> </tr><tr><th width="55%"> Fans a la fecha:</th><td>'+d.page_fans+'</td></tr><tr><th width="55%"> Nuevos Me gusta a la Pagína:</th><td>'+DatosRecuperados['dos'][0]['fans']+'</td></tr><tr><th> Total de interacción en la pagína: </th> <td>'+intp+'</td></tr><tr><th> Total interacción en el post: </th> <td>'+int+'</td> </tr><tr><th> Alcance:</th><td>'+d.reach+'</td></tr><tr><th> Alcance organico: </th><td>'+d.reach_organic+'</td></tr><tr><th>Alcance pagdo:</th><td>'+d.reach_paid+'</td></tr><tr><th>Inversión (S/):</th><td>S/.'+d.inversion+'</td></tr><tr><th> Veces compartido:</th> <td>'+d.shares+'</td></tr><tr><th> Comentarios:</th><td>'+d.comments+'</td></tr><tr><th> Reacciones:</th><td>'+d.reactions+'</td></tr><tr><th> Clic unicos a link:</th><td>'+d.link_clicks+'</td></tr><tr><th> Vistas unicas a video:</th><td>'+d.post_video_views_unique+'</td></tr><tr><th> Indice de interacción:</th><td>'+d.indice_interaccion+'</td></tr><tr><th> Indice inter alcance:</th><td>'+d.indice_interalcance+'</td></tr><tr><th> Indice interacción vs inversión:</th><td>'+d.indice_interaccion_inversion+'</td></tr><tr><th> Indice Inter alcance vs inversión:</th><td>'+d.indice_interalcance_inversion+'</td></tr></tbody></table>'); 
                         

                      }





                       
                       });



                      
                                  Highcharts.chart('grafica1', {
                                    chart: {
                                        zoomType: 'xy'
                                    },
                                    
                                            showInLegend: true,
                                    title: {
                                        text: 'Interacción por Publicación'
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
                                        data: reactions,
                                        tooltip: {
                                            valueSuffix: ' '
                                        }

                                    },{
                                        name: 'Compartir',
                                        type: 'column',
                                        yAxis: 1,
                                        data: shares,
                                        tooltip: {
                                            valueSuffix: ' '
                                        }

                                    },{
                                        name: 'Comentario',
                                        type: 'column',
                                        yAxis: 1,
                                        data: comments,
                                        tooltip: {
                                            valueSuffix: ' '
                                        }

                                    },{
                                        name: 'Vistas de video',
                                        type: 'column',
                                        yAxis: 1,
                                        data: video,
                                        tooltip: {
                                            valueSuffix: ' '
                                        }

                                    },{
                                        name: 'Clics a links',
                                        type: 'column',
                                        yAxis: 1,
                                        data: clink,
                                        tooltip: {
                                            valueSuffix: ' '
                                        }

                                    },{
                                        name: 'Indice de Interacción',
                                        type: 'spline',
                                        data: indicei,
                                        tooltip: {
                                            valueSuffix: ''
                                        },
                                        color: '#EB7CB4'
                                    }]
                                });

                                              }


                                 if(id=='16'){
                 
                              var nropost=0;
                              var comp_nropost=0;
                              $.each(DatosRecuperados, function(i, d) {
                               nropost+=parseInt(d.nropost);
                               });
                              $.each(DatosComparacion, function(i, d) {
                               comp_nropost+=parseInt(d.nropost);
                               });

                              var tests = [
                              { num: nropost, digits: 1 }
                             
                              ];

                              $('#nropost').html(nFormatter(tests[0].num, tests[0].digits));
                              $('#nropost_comp').html(porcentaje_comparacion(comp_nropost,nropost,'#nropost_comp'));
                            }



                            if(id==17){

                                var reactions = new Array();
                                var shares = new Array();
                                var comments = new Array();
                                var video = new Array();
                                var clink = new Array();
                                var indicei = new Array();
                                var alcance = new Array();
                                var indiceia = new Array();
                                var count = 0;
                                var int;
                                var intp=0;
                                //var fecha; 
                                
                                var last = Object.keys(DatosRecuperados['uno']).length;
                                last = parseInt(last)-1;
                                

                      $.each(DatosRecuperados['uno'], function(i, d) {
                      
                      if (d.reactions) {reactions[i] = parseInt(d.reactions);}
                      if (d.shares) {shares[i] = parseInt(d.shares);}
                      if (d.comments) {comments[i] = parseInt(d.comments);}
                      if (d.post_video_views_unique) {video[i] = parseInt(d.post_video_views_unique);}
                      if (d.link_clicks) {clink[i] = parseInt(d.link_clicks);}
                      if (d.indice_interaccion) {indicei[i] = parseInt(d.indice_interaccion);}
                      
                      if(i<last){
                      intp += parseInt(d.reactions)+parseInt(d.shares)+parseInt(d.comments)+parseInt(d.post_video_views_unique)+parseInt(d.link_clicks);
                      
                      }
                      
                      });
                      
                        $.each(DatosRecuperados['uno'], function(i, d) {
                     
                      if (d.reactions) {reactions[i] = parseInt(d.reactions);}
                      if (d.shares) {shares[i] = parseInt(d.shares);}
                      if (d.comments) {comments[i] = parseInt(d.comments);}
                      if (d.post_video_views_unique) {video[i] = parseInt(d.post_video_views_unique);}
                      if (d.link_clicks) {clink[i] = parseInt(d.link_clicks);}
                      if (d.indice_interaccion) {indicei[i] = parseInt(d.indice_interaccion);}
                      if (d.reach) {alcance[i] = parseInt(d.reach);}
                      if (d.indice_interalcance) {indiceia[i] = parseInt(d.indice_interalcance);}
                     

                    //Hacemos una función para hacer las operaciones
                    function textoFecha(fecha){
                    var numDiaSem = fecha.getDay(); //getDay() devuelve el dia de la semana.(0-6).
                    //Creamos un Array para los nombres de los días    
                    var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
                    var diaLetras = diasSemana[fecha.getDay()];   //El día de la semana en letras. getDay() devuelve el dia de la semana.(0-6).
                    //Otro Array para los nombres de los meses    
                    var meses = new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                    var mesLetras = meses[fecha.getMonth()];  //El mes en letras
                    var diaMes = (fecha.getDate());   //getDate() devuelve el dia(1-31).
                    var anho = fecha.getFullYear();  //getFullYear() devuelve el año(4 dígitos).
                    var hora = fecha.getHours();    //getHours() devuelve la hora(0-23).
                    var min = fecha.getMinutes();   //getMinutes() devuelve los minutos(0-59).
                    if ((min >= 0) && (min < 10)) {    //Algoritmo para añadir un cero cuando el min tiene 1 cifra.
                    min = "0" + min;
                    }
                    var devolver =  diaLetras+ ", " + diaMes + " de " + mesLetras + " de " + anho + " a las " + hora + ":" + min + " horas.";
                    return devolver;
                    }
                     var fecha = new Date(d.created_time); //Declaramos el objeto fecha actual//Declaramos el objeto fecha actual
                    fecha = textoFecha(fecha);

                    


                  
                      
                      if(i<4)
                      {
                        int = parseInt(d.reactions)+parseInt(d.shares)+parseInt(d.comments)+parseInt(d.post_video_views_unique)+parseInt(d.link_clicks);

                           $('#pa'+i).html('<table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" class="tabla" style="border-collapse:collapse;border-color:#ddd; font-size: 10px;"><thead><tr><th colspan="2"><a  href="'+d.permalink_url+'"" target="_blank"><div style="height: 250px; width: 100%; background-size:cover;background-repeat: no-repeat; background-image:url('+d.picture+'); background-position: center;" alt=""></div></a></th></tr></thead><tbody style="text-align: left;"><tr><td colspan="2"><a  href="'+d.permalink_url+'"" target="_blank">'+d.message+'</a></td></tr><tr><th width="55%"> Fecha:</th><td> '+fecha+'</td> </tr><tr><th width="55%"> Fans a la fecha:</th><td>'+d.page_fans+'</td></tr><tr><th width="55%"> Nuevos Me gusta a la Pagína:</th><td>'+DatosRecuperados['dos'][0]['fans']+'</td></tr><tr><th> Total de interacción en la pagína: </th> <td>'+intp+'</td></tr><tr><th> Total interacción en el post: </th> <td>'+int+'</td> </tr><tr><th> Alcance:</th><td>'+d.reach+'</td></tr><tr><th> Alcance organico: </th><td>'+d.reach_organic+'</td></tr><tr><th>Alcance pagdo:</th><td>'+d.reach_paid+'</td></tr><tr><th>Inversión (S/):</th><td>S/.'+d.inversion+'</td></tr><tr><th> Veces compartido:</th> <td>'+d.shares+'</td></tr><tr><th> Comentarios:</th><td>'+d.comments+'</td></tr><tr><th> Reacciones:</th><td>'+d.reactions+'</td></tr><tr><th> Clic unicos a link:</th><td>'+d.link_clicks+'</td></tr><tr><th> Vistas unicas a video:</th><td>'+d.post_video_views_unique+'</td></tr><tr><th> Indice de interacción:</th><td>'+d.indice_interaccion+'</td></tr><tr><th> Indice inter alcance:</th><td>'+d.indice_interalcance+'</td></tr><tr><th> Indice interacción vs inversión:</th><td>'+d.indice_interaccion_inversion+'</td></tr><tr><th> Indice Inter alcance vs inversión:</th><td>'+d.indice_interalcance_inversion+'</td></tr></tbody></table>'); 
                         

                      }





                       
                       });



                 
                                  Highcharts.chart('grafica2', {
                                    chart: {
                                        zoomType: 'xy'
                                    },
                                    
                                            showInLegend: true,
                                    title: {
                                        text: 'Alcance por Publicación'
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
                                          text: 'Indice de Interacción Alcance',
                                          style: {
                                              color: Highcharts.getOptions().colors[1]
                                          }
                                      }
                                    }, { // Secondary yAxis
                                        title: {
                                        text: 'Alcance',
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
                                            pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b> {point.y}</b><br/>',
                                            shared: true,
                                            crosshairs: true,
                                            animation: true,
                                            outside: true,
                                            split: true,
                                            followPointer: true
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
                                            name: 'Alcance',
                                            type: 'column',
                                            yAxis: 1,
                                            data: alcance,
                                            tooltip: {
                                                valueSuffix: ' '
                                            },
                                            color: '#609ACA'

                                        },{
                                            name: 'Indice de Inter Alcance',
                                            type: 'spline',
                                            data: indiceia,
                                            tooltip: {
                                                valueSuffix: ' '
                                            },
                                            color: '#9ACA61'

                                        }]
                                });

                                              }



                    

                        if(id==18){

                                var reactions = new Array();
                                var shares = new Array();
                                var comments = new Array();
                                var video = new Array();
                                var clink = new Array();
                                var indicei = new Array();
                                var alcance = new Array();
                                var indiceia = new Array();
                                var count = 0;
                                var int;
                                var intp=0;
                                //var fecha; 
                                var inv = new Array();
                                var indiceii = new Array();
                                
                                var last = Object.keys(DatosRecuperados['uno']).length;
                                last = parseInt(last)-1;
                                

                      $.each(DatosRecuperados['uno'], function(i, d) {
                      
                      if (d.reactions) {reactions[i] = parseInt(d.reactions);}
                      if (d.shares) {shares[i] = parseInt(d.shares);}
                      if (d.comments) {comments[i] = parseInt(d.comments);}
                      if (d.post_video_views_unique) {video[i] = parseInt(d.post_video_views_unique);}
                      if (d.link_clicks) {clink[i] = parseInt(d.link_clicks);}
                      if (d.indice_interaccion) {indicei[i] = parseInt(d.indice_interaccion);}
                      
                      if(i<last){
                      intp += parseInt(d.reactions)+parseInt(d.shares)+parseInt(d.comments)+parseInt(d.post_video_views_unique)+parseInt(d.link_clicks);
                      
                      }
                      
                      });
                      
                        $.each(DatosRecuperados['uno'], function(i, d) {
                     
                      if (d.reactions) {reactions[i] = parseInt(d.reactions);}
                      if (d.shares) {shares[i] = parseInt(d.shares);}
                      if (d.comments) {comments[i] = parseInt(d.comments);}
                      if (d.post_video_views_unique) {video[i] = parseInt(d.post_video_views_unique);}
                      if (d.link_clicks) {clink[i] = parseInt(d.link_clicks);}
                      if (d.indice_interaccion) {indicei[i] = parseInt(d.indice_interaccion);}
                      if (d.reach) {alcance[i] = parseInt(d.reach);}
                      if (d.indice_interalcance) {indiceia[i] = parseInt(d.indice_interalcance);}
                      if (d.inversion) {inv[i] = parseInt(d.inversion);}
                      if (d.indice_interaccion_inversion) {indiceii[i] = parseInt(d.indice_interaccion_inversion);}

                    //Hacemos una función para hacer las operaciones
                    function textoFecha(fecha){
                    var numDiaSem = fecha.getDay(); //getDay() devuelve el dia de la semana.(0-6).
                    //Creamos un Array para los nombres de los días    
                    var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
                    var diaLetras = diasSemana[fecha.getDay()];   //El día de la semana en letras. getDay() devuelve el dia de la semana.(0-6).
                    //Otro Array para los nombres de los meses    
                    var meses = new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                    var mesLetras = meses[fecha.getMonth()];  //El mes en letras
                    var diaMes = (fecha.getDate());   //getDate() devuelve el dia(1-31).
                    var anho = fecha.getFullYear();  //getFullYear() devuelve el año(4 dígitos).
                    var hora = fecha.getHours();    //getHours() devuelve la hora(0-23).
                    var min = fecha.getMinutes();   //getMinutes() devuelve los minutos(0-59).
                    if ((min >= 0) && (min < 10)) {    //Algoritmo para añadir un cero cuando el min tiene 1 cifra.
                    min = "0" + min;
                    }
                    var devolver =  diaLetras+ ", " + diaMes + " de " + mesLetras + " de " + anho + " a las " + hora + ":" + min + " horas.";
                    return devolver;
                    }
                     var fecha = new Date(d.created_time); //Declaramos el objeto fecha actual//Declaramos el objeto fecha actual
                    fecha = textoFecha(fecha);

                    


                  
                      
                      if(i<4)
                      {
                        int = parseInt(d.reactions)+parseInt(d.shares)+parseInt(d.comments)+parseInt(d.post_video_views_unique)+parseInt(d.link_clicks);

                           $('#inv'+i).html('<table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" class="tabla" style="border-collapse:collapse;border-color:#ddd; font-size: 10px;"><thead><tr><th colspan="2"><a  href="'+d.permalink_url+'"" target="_blank"><div style="height: 250px; width: 100%; background-size:cover;background-repeat: no-repeat; background-image:url('+d.picture+'); background-position: center;" alt=""></div></a></th></tr></thead><tbody style="text-align: left;"><tr><td colspan="2"><a  href="'+d.permalink_url+'"" target="_blank">'+d.message+'</a></td></tr><tr><th width="55%"> Fecha:</th><td> '+fecha+'</td> </tr><tr><th width="55%"> Fans a la fecha:</th><td>'+d.page_fans+'</td></tr><tr><th width="55%"> Nuevos Me gusta a la Pagína:</th><td>'+DatosRecuperados['dos'][0]['fans']+'</td></tr><tr><th> Total de interacción en la pagína: </th> <td>'+intp+'</td></tr><tr><th> Total interacción en el post: </th> <td>'+int+'</td> </tr><tr><th> Alcance:</th><td>'+d.reach+'</td></tr><tr><th> Alcance organico: </th><td>'+d.reach_organic+'</td></tr><tr><th>Alcance pagdo:</th><td>'+d.reach_paid+'</td></tr><tr><th>Inversión (S/):</th><td>S/.'+d.inversion+'</td></tr><tr><th> Veces compartido:</th> <td>'+d.shares+'</td></tr><tr><th> Comentarios:</th><td>'+d.comments+'</td></tr><tr><th> Reacciones:</th><td>'+d.reactions+'</td></tr><tr><th> Clic unicos a link:</th><td>'+d.link_clicks+'</td></tr><tr><th> Vistas unicas a video:</th><td>'+d.post_video_views_unique+'</td></tr><tr><th> Indice de interacción:</th><td>'+d.indice_interaccion+'</td></tr><tr><th> Indice inter alcance:</th><td>'+d.indice_interalcance+'</td></tr><tr><th> Indice interacción vs inversión:</th><td>'+d.indice_interaccion_inversion+'</td></tr><tr><th> Indice Inter alcance vs inversión:</th><td>'+d.indice_interalcance_inversion+'</td></tr></tbody></table>'); 
                         

                      }





                       
                       });



                                  Highcharts.chart('grafica3', {
                                    chart: {
                                        zoomType: 'xy'
                                    },
                                    
                                            showInLegend: true,
                                    title: {
                                        text: 'Inversión por Publicación'
                                    },
                                    subtitle: {
                                        text: ''
                                    },
                                    credits: {
                                         enabled: false
                                     },
                                    xAxis: [{//categorias esta definido en el archivo que contiene a este
                                        categories: [categorias],
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
                                          data: indiceii,
                                          tooltip: {
                                              valueSuffix: ' '
                                          },
                                          color: '#9966FF'

                                      }]
                                      });

                                              }


                                if(id==19){

                                var reactions = new Array();
                                var shares = new Array();
                                var comments = new Array();
                                var video = new Array();
                                var clink = new Array();
                                var alcance = new Array();
                                var indicei = new Array();
                                var indiceia = new Array();
                                var indiceii = new Array();
                                var indiceiai = new Array();
                                var count = 0;
                                var int;
                                var intp=0;
                                //var fecha; 
                                var inv = new Array();
                                
                                
                                var last = Object.keys(DatosRecuperados['uno']).length;
                                last = parseInt(last)-1;
                                

                      $.each(DatosRecuperados['uno'], function(i, d) {
                      
                      if (d.reactions) {reactions[i] = parseInt(d.reactions);}
                      if (d.shares) {shares[i] = parseInt(d.shares);}
                      if (d.comments) {comments[i] = parseInt(d.comments);}
                      if (d.post_video_views_unique) {video[i] = parseInt(d.post_video_views_unique);}
                      if (d.link_clicks) {clink[i] = parseInt(d.link_clicks);}
                      if (d.indice_interaccion) {indicei[i] = parseInt(d.indice_interaccion);}
                      
                      if(i<last){
                      intp += parseInt(d.reactions)+parseInt(d.shares)+parseInt(d.comments)+parseInt(d.post_video_views_unique)+parseInt(d.link_clicks);
                      
                      }
                      
                      });
                      
                        $.each(DatosRecuperados['uno'], function(i, d) {
                     
                      if (d.reactions) {reactions[i] = parseInt(d.reactions);}
                      if (d.shares) {shares[i] = parseInt(d.shares);}
                      if (d.comments) {comments[i] = parseInt(d.comments);}
                      if (d.post_video_views_unique) {video[i] = parseInt(d.post_video_views_unique);}
                      if (d.link_clicks) {clink[i] = parseInt(d.link_clicks);}
                      if (d.indice_interaccion) {if(d.indice_interaccion>=100){ indicei[i] = parseInt(d.indice_interaccion)/100; } else if(d.indice_interaccion>=10){ indicei[i] = parseInt(d.indice_interaccion)/10; } else{ indicei[i] = parseInt(d.indice_interaccion); }}
                      if (d.indice_interalcance) {if(d.indice_interalcance>=100){ indiceia[i] = parseInt(d.indice_interalcance)/100; } else if(d.indice_interalcance>=10){ indiceia[i] = parseInt(d.indice_interalcance)/10; } else{ indiceia[i] = parseInt(d.indice_interalcance); }}
                      if (d.indice_interaccion_inversion) {if(d.indice_interaccion_inversion>=100){ indiceii[i] = parseInt(d.indice_interaccion_inversion)/100; } else if(d.indice_interaccion_inversion>=10){ indiceii[i] = parseInt(d.indice_interaccion_inversion)/10; } else{ indiceii[i] = parseInt(d.indice_interaccion_inversion); }}
                      if (d.indice_interalcance_inversion) {if(d.indice_interalcance_inversion>=100){ indiceiai[i] = parseInt(d.indice_interalcance_inversion)/100; } else if(d.indice_interalcance_inversion>=10){ indiceiai[i] = parseInt(d.indice_interalcance_inversion)/10; } else{ indiceiai[i] = parseInt(d.indice_interaccion_inversion); }}
                      if (d.reach) {alcance[i] = parseInt(d.reach);}
                      if (d.inversion) {inv[i] = parseInt(d.inversion);}
                      
                   


                    //Hacemos una función para hacer las operaciones
                    function textoFecha(fecha){
                    var numDiaSem = fecha.getDay(); //getDay() devuelve el dia de la semana.(0-6).
                    //Creamos un Array para los nombres de los días    
                    var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
                    var diaLetras = diasSemana[fecha.getDay()];   //El día de la semana en letras. getDay() devuelve el dia de la semana.(0-6).
                    //Otro Array para los nombres de los meses    
                    var meses = new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                    var mesLetras = meses[fecha.getMonth()];  //El mes en letras
                    var diaMes = (fecha.getDate());   //getDate() devuelve el dia(1-31).
                    var anho = fecha.getFullYear();  //getFullYear() devuelve el año(4 dígitos).
                    var hora = fecha.getHours();    //getHours() devuelve la hora(0-23).
                    var min = fecha.getMinutes();   //getMinutes() devuelve los minutos(0-59).
                    if ((min >= 0) && (min < 10)) {    //Algoritmo para añadir un cero cuando el min tiene 1 cifra.
                    min = "0" + min;
                    }
                    var devolver =  diaLetras+ ", " + diaMes + " de " + mesLetras + " de " + anho + " a las " + hora + ":" + min + " horas.";
                    return devolver;
                    }
                     var fecha = new Date(d.created_time); //Declaramos el objeto fecha actual//Declaramos el objeto fecha actual
                    fecha = textoFecha(fecha);

                    


                  
                      
                      if(i<4)
                      {
                        int = parseInt(d.reactions)+parseInt(d.shares)+parseInt(d.comments)+parseInt(d.post_video_views_unique)+parseInt(d.link_clicks);

                           $('#inii'+i).html('<table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" class="tabla" style="border-collapse:collapse;border-color:#ddd; font-size: 10px;"><thead><tr><th colspan="2"><a  href="'+d.permalink_url+'"" target="_blank"><div style="height: 250px; width: 100%; background-size:cover;background-repeat: no-repeat; background-image:url('+d.picture+'); background-position: center;" alt=""></div></a></th></tr></thead><tbody style="text-align: left;"><tr><td colspan="2"><a  href="'+d.permalink_url+'"" target="_blank">'+d.message+'</a></td></tr><tr><th width="55%"> Fecha:</th><td> '+fecha+'</td> </tr><tr><th width="55%"> Fans a la fecha:</th><td>'+d.page_fans+'</td></tr><tr><th width="55%"> Nuevos Me gusta a la Pagína:</th><td>'+DatosRecuperados['dos'][0]['fans']+'</td></tr><tr><th> Total de interacción en la pagína: </th> <td>'+intp+'</td></tr><tr><th> Total interacción en el post: </th> <td>'+int+'</td> </tr><tr><th> Alcance:</th><td>'+d.reach+'</td></tr><tr><th> Alcance organico: </th><td>'+d.reach_organic+'</td></tr><tr><th>Alcance pagdo:</th><td>'+d.reach_paid+'</td></tr><tr><th>Inversión (S/):</th><td>S/.'+d.inversion+'</td></tr><tr><th> Veces compartido:</th> <td>'+d.shares+'</td></tr><tr><th> Comentarios:</th><td>'+d.comments+'</td></tr><tr><th> Reacciones:</th><td>'+d.reactions+'</td></tr><tr><th> Clic unicos a link:</th><td>'+d.link_clicks+'</td></tr><tr><th> Vistas unicas a video:</th><td>'+d.post_video_views_unique+'</td></tr><tr><th> Indice de interacción:</th><td>'+d.indice_interaccion+'</td></tr><tr><th> Indice inter alcance:</th><td>'+d.indice_interalcance+'</td></tr><tr><th> Indice interacción vs inversión:</th><td>'+d.indice_interaccion_inversion+'</td></tr><tr><th> Indice Inter alcance vs inversión:</th><td>'+d.indice_interalcance_inversion+'</td></tr></tbody></table>'); 
                        


                      }





                       
                       });



                                  Highcharts.chart('grafica4', {
                                    chart: {
                                        zoomType: 'xy'
                                    },
                                    
                                            showInLegend: true,
                                   title: {
                                        text: 'Índices de Publicación'
                                    },
                                    subtitle: {
                                        text: ''
                                    },
                                    credits: {
                                         enabled: false
                                     },
                                    xAxis: [{//categorias esta definido en el archivo que contiene a este
                                        categories: [categorias],
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
                                       /* formatter: function () {
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
                                            split: true,*/
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
                                        data: indiceii,
                                        tooltip: {
                                            valueSuffix: ' '
                                        },
                                        color: '#9966FF'

                                    },{
                                        name: 'Indice de Inter Alcance vs Inversión',
                                        type: 'spline',
                                        data: indiceiai,
                                        tooltip: {
                                            valueSuffix: ' '
                                        },
                                        color: '#7CB5EC'

                                    }]
                                      });

                                              }




                     if(id==20){
               imp = new Array();
                $('#link20').html('<table id="example20" class="display compact"><thead style="text-align: center; font-size: 10px;"><tr><th> '+titulo+' </th><th> '+titulo2+' </th><th>Impresiones</th></tr></thead><tbody id="example20"></tbody></table>');
                  $.each(DatosRecuperados, function(i, d) {
                  
                  $('#example20').append('<tr><td>'+d.z+'</td><td>'+d.d+'</td><td>'+d.page_impressions+'</td></tr>');
                   if (d.page_impressions) {imp[i] = parseInt(d.page_impressions);}

                  });

                 

                            





                  
            


                            $('#container'+id).highcharts({
                                        chart: {
                                          type: 'column'
                                        },
                                        title: {
                                          text: 'Impresiones'
                                        },
                                        xAxis: {
                                          categories: d,
                                          labels: {
                                            rotation: -45,
                                            style: {
                                              fontSize: '13px',
                                              fontFamily: 'Verdana, sans-serif'
                                            }
                                          }
                                        },
                                        yAxis: {
                                          min: 0,
                                          title: {
                                            text: 'Cantidad de Impresiones'
                                          }
                                        },
                                        legend: {
                                          enabled: false
                                        },
                                        tooltip: {
                                          pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b>',
                                          shared: true
                                          },
                                         exporting: {
                                         enabled: false
                                         },
                                        series: [{
                                          name: 'Impresiones',
                                          data: imp,
                                          color: '#02C4BE',
                                          dataLabels: {
                                            enabled: true,
                                            rotation: -90,
                                            color: '#FFFFFF',
                                            align: 'right',
                                            //format: '{point.y:.1f}', // one decimal
                                            y: 10, // 10 pixels down from the top
                                            style: {
                                              fontSize: '13px',
                                              fontFamily: 'Verdana, sans-serif'
                                            }
                                          }
                                        }]
                                      });
              }



                     if(id==21){
               clic = new Array();
                $('#link21').html('<table id="example21" class="display compact"><thead style="text-align: center; font-size: 10px;"><tr><th> '+titulo+' </th><th> '+titulo2+' </th><th>Clics</th></tr></thead><tbody id="example21"></tbody></table>');
                  $.each(DatosRecuperados, function(i, d) {
                  
                  $('#example21').append('<tr><td>'+d.z+'</td><td>'+d.d+'</td><td>'+d.clics+'</td></tr>');
                    if (d.clics) {clic[i] = parseInt(d.clics);}

                  });

          

                            





                  
            


                            $('#container'+id).highcharts({
                                        chart: {
                                          type: 'column'
                                        },
                                        title: {
                                          text: 'Clics'
                                        },
                                        xAxis: {
                                          categories: d,
                                          labels: {
                                            rotation: -45,
                                            style: {
                                              fontSize: '13px',
                                              fontFamily: 'Verdana, sans-serif'
                                            }
                                          }
                                        },
                                        yAxis: {
                                          min: 0,
                                          title: {
                                            text: 'Cantidad de Clics'
                                          }
                                        },
                                        legend: {
                                          enabled: false
                                        },
                                        tooltip: {
                                          pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b>',
                                          shared: true
                                          },
                                         exporting: {
                                         enabled: false
                                         },
                                        series: [{
                                          name: 'Clics',
                                          data: clic,
                                          color: '#E1E100',
                                          dataLabels: {
                                            enabled: true,
                                            rotation: -90,
                                            color: '#FFFFFF',
                                            align: 'right',
                                            //format: '{point.y:.1f}', // one decimal
                                            y: 10, // 10 pixels down from the top
                                            style: {
                                              fontSize: '13px',
                                              fontFamily: 'Verdana, sans-serif'
                                            }
                                          }
                                        }]
                                      });
              }


                 if(id==22){

                  var alcancep=0;
                  var impresionsp=0;
                  var clicsp=0;
                  var tcomen=0;
                  var tcomenr=0;
                  var tinbox=0;
                  var tinboxr=0;
                  var tcominbox=0;
                  var tcominboxr=0;
                  var talcance=0;
                  var timp=0;
                  var tclics=0;
                  var alcance=0;
                  var clics=0;
                  var impresions=0;
                  var tcomu=0;
                  var tinboxu=0;
                  var tcominboxu=0;
                  /* inicio variables comparacion */
                  var comp_alcancep=0;
                  var comp_impresionsp=0;
                  var comp_clicsp=0;
                  var comp_tcomen=0;
                  var comp_tcomenr=0;
                  var comp_tinbox=0;
                  var comp_tinboxr=0;
                  var comp_tcominbox=0;
                  var comp_tcominboxr=0;
                  var comp_talcance=0;
                  var comp_timp=0;
                  var comp_tclics=0;
                  var comp_alcance=0;
                  var comp_clics=0;
                  var comp_impresions=0;
                  /* fin variables comparacion */
            
                  $.each(DatosRecuperados['uno'], function(i, d) {
                  
                
                    impresionsp = d.imp;
                    clicsp = d.clics;
                    alcancep = d.alcance;

                  });
               
                  $.each(DatosRecuperados['dos'], function(i, d) {
                  
             
                    tcomen = d.comentarios;
                    tcomenr = d.respuestas;
                    tcomu = d.unicos;
                   

                  });

                  $.each(DatosRecuperados['tres'], function(i, d) {
                  
                 
                    tinbox = d.comentarios;
                    tinboxr = d.respuestas;
                    tinboxu = d.unicos;
                  
                
                  });
                  $.each(DatosRecuperados['cuatro'], function(i, d) {
                  
                 
                     alcance = d.alcance;
                     impresions= d.page_impressions;
                     clics = d.clics;
                
                  });
                   tcominboxu += parseInt(tcomu)+parseInt(tinboxu);
                   tcominbox += parseInt(tcomen)+parseInt(tinbox);
                   tcominboxr += parseInt(tcomenr)+parseInt(tinboxr);
                   talcance += parseInt(alcancep)+parseInt(alcance);
                   timp += parseInt(impresionsp)+parseInt(impresions);
                   tclics += parseInt(clicsp)+parseInt(clics);


                  /* inicio proceso datos de comparacion */
                                    
                  $.each(DatosComparacion['uno'], function(i, d) {
                                    
                                  
                    comp_impresionsp = d.imp;
                    comp_clicsp = d.clics;
                    comp_alcancep = d.alcance;

                  });

                  $.each(DatosComparacion['dos'], function(i, d) {


                    comp_tcomen = d.comentarios;
                    comp_tcomenr = d.respuestas;
                  

                  });

                  $.each(DatosComparacion['tres'], function(i, d) {


                    comp_tinbox = d.comentarios;
                    comp_tinboxr = d.respuestas;


                  });
                  $.each(DatosComparacion['cuatro'], function(i, d) {


                    comp_alcance = d.alcance;
                    comp_impresions= d.page_impressions;
                    comp_clics = d.clics;

                  });

                  comp_tcominbox += parseInt(comp_tcomen)+parseInt(comp_tinbox);
                  comp_tcominboxr += parseInt(comp_tcomenr)+parseInt(comp_tinboxr);
                  comp_talcance += parseInt(comp_alcancep)+parseInt(comp_alcance);
                  comp_timp += parseInt(comp_impresionsp)+parseInt(comp_impresions);
                  comp_tclics += parseInt(comp_clicsp)+parseInt(comp_clics);
                  /* fin proceso datos de comparacion */

                             var tests = [
                              { num: alcancep, digits: 1 }
                             
                              ];
                               var testss = [
                              { num: alcanceep, digits: 1 }
                             
                              ];
                              var tests1 = [
                              { num: impresionsp, digits: 4 }
                             
                              ];
                              var tests2 = [
                              { num: clicsp, digits: 1 }
                             
                              ];

                              var tests3 = [
                              { num: tcomen, digits: 1 }
                             
                              ];

                              var tests4 = [
                              { num: tcomenr, digits: 1 }
                             
                              ];

                              var tests5 = [
                              { num: tinbox, digits: 1 }
                             
                              ];

                              var tests6 = [
                              { num: tinboxr, digits: 1 }
                             
                              ];

                              var tests7 = [
                              { num: tcominbox, digits: 1 }
                             
                              ];

                              var tests8 = [
                              { num: tcominboxr, digits: 1 }
                             
                              ];

                              var tests9 = [
                              { num: talcance, digits: 1 }
                             
                              ];

                              var tests10 = [
                              { num: timp, digits: 1 }
                             
                              ];

                              var tests11 = [
                              { num: tclics, digits: 1 }
                             
                              ];

                              var tests12 = [
                              { num: tcomu, digits: 1 }
                             
                              ];

                              var tests13 = [
                              { num: tinboxu, digits: 1 }
                             
                              ];

                             var tests14 = [
                              { num: tcominboxu, digits: 1 }
                             
                              ];

                          

                              
                      
                              $('#alcancep').html(nFormatter(tests[0].num, tests[0].digits));
                              $('#alcanceep').html(nFormatter(tests[0].num, tests[0].digits));
                              $('#alcancep_comp').html(porcentaje_comparacion(comp_alcancep, alcancep,'#alcancep_comp'));                                   
                              $('#impresionsp').html(nFormatter(tests1[0].num, tests[0].digits));
                              $('#impresionsp_comp').html(porcentaje_comparacion(comp_impresionsp, impresionsp,'#impresionsp_comp'));
                              $('#clicsp').html(nFormatter(tests2[0].num, tests[0].digits));
                              $('#clicsp_comp').html(porcentaje_comparacion(comp_clicsp, clicsp,'#clicsp_comp'));
                              $('#tcomen').html(nFormatter(tests3[0].num, tests[0].digits));
                              $('#tcomenr').html(nFormatter(tests4[0].num, tests[0].digits));
                              $('#tinbox').html(nFormatter(tests5[0].num, tests[0].digits));
                              $('#tinboxr').html(nFormatter(tests6[0].num, tests[0].digits));
                              $('#tcominbox').html(nFormatter(tests7[0].num, tests[0].digits));
                              $('#tcominboxr').html(nFormatter(tests8[0].num, tests[0].digits));
                              $('#talcance').html(nFormatter(tests9[0].num, tests[0].digits));
                              $('#talcance_comp').html(porcentaje_comparacion(comp_talcance, talcance,'#talcance_comp'));
                              $('#timp').html(nFormatter(tests10[0].num, tests[0].digits));
                              $('#timp_comp').html(porcentaje_comparacion(comp_timp, timp,'#timp_comp'));
                              $('#tclics').html(nFormatter(tests11[0].num, tests[0].digits));
                              $('#tclics_comp').html(porcentaje_comparacion(comp_tclics, tclics,'#tclics_comp'));
                              $('#tcomu').html(nFormatter(tests12[0].num, tests[0].digits));
                              $('#tinboxu').html(nFormatter(tests13[0].num, tests[0].digits));
                              $('#tcominboxu').html(nFormatter(tests14[0].num, tests[0].digits));


               }








                     $('#example'+id).DataTable({
                    "paging":   false,
                    "ordering": false,
                    "info":     false,
                    "searching": false
                    });


                   }
               });
               
             }
        });


});


 $(".textarea").change(function(){
      idcom=$(this).attr("id");
      com=$(this).val();
var params ={

    "idcom": idcom,
    "com": com,
    "id_inf": id_inf,
    "fecha": fecha,
    "fecha_comparacion": fecha_comparacion,
    "periodo": periodo              
        };

        $.ajax({
         url : "action.php",
         method:"POST", 
         data:   params,
         success:function(data){
           var obj = $.parseJSON(data);
          
           $.notify({
           title: '<strong> '+obj.ac+'!</strong>',
           message: 'Comentario Nro '+idcom+' registrado exitosaménte !!'
           },{
           type: obj.clase
           });
         }
        });

            
        });

    function nFormatter(num, digits) {
          var si = [
          { value: 1, symbol: "" },
          { value: 1E3, symbol: "k" },
          { value: 1E6, symbol: "M" },
          { value: 1E9, symbol: "G" },
          { value: 1E12, symbol: "T" },
          { value: 1E15, symbol: "P" },
          { value: 1E18, symbol: "E" }
          ];
          var rx = /\.0+$|(\.[0-9]*[1-9])0+$/;
          var i;
          for (i = si.length - 1; i > 0; i--) {
          if (num >= si[i].value) {
          break;
          }
          }
          return (num / si[i].value).toFixed(digits).replace(rx, "$1") + si[i].symbol;
    }

    function porcentaje_comparacion(valor_anterior, valor_actual, selector) {

      if (valor_anterior==0 || valor_anterior==null) {
        return '---'
      } else {        
        var porcentaje = (valor_actual/valor_anterior)*100
        if (porcentaje > 100) {
          $(selector).attr('style','color:#009900');
          var diferencia=porcentaje-100;
          var cadena ='% +'
        } else if(porcentaje < 100) {
          $(selector).attr('style','color:#FF0000');
          var diferencia=100-porcentaje;
          var cadena ='% -'
        }else{
          var diferencia=0;
          var cadena='';
        }
        var diferencia= Math.round(diferencia*100)/100;
        return diferencia+cadena;
      }
    }

function imprimir() {
if (window.print)
window.print()
else
alert("Para imprimir presione Crtl+P.");
}

$(document).ready(function(){
    //infoactual esta definida en el archivo que contiene a este
    var obj = jQuery.parseJSON( infoactual );
    if (obj != null) {
       

        $.each(obj,function(index,contenido){
            $("textarea").each(function(){
                if ($(this).attr('id') == contenido.id_com) {
                    $(this).text(contenido.comentario);
                }
            })
        });
    }
}); 


$(document).ready(function(){ 
    setInterval(function() {
      //window.print(); 
      //window.close();
    }, 1000); 
  }); 
  $(document).ready(function(){
    //infoactual esta definida en el archivo que contiene a este

      var obj = jQuery.parseJSON( infoactual );
      if (obj != null) {
       
  
          $.each(obj,function(index,contenido){
              $("div.comen2").each(function(){
                  if ($(this).attr('id') == contenido.id_com) {
                      $(this).text(contenido.comentario);
                  }
              })
          });
      }
  });