   <!-- Modal - Update post details -->
   <div class="modal fade" id="ver" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
        <!--<h5 class="modal-title">Modal title</h5>-->
        <h6>Detalles de la Publicación <span id="postTitleModal"></span></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <div class="modal-body ">
              <div class="box">
                  <div class="box-body row">
                      <div class="col-lg-7" style="padding:10px;">
                          <div class="card" style="padding-top: 20px;">
   <div class="card-heading image">
      <img src="https://graph.facebook.com/<?php echo $page->id_facebook_page; ?>/picture" alt=""/>
      <div class="card-heading-header">
         <h3><?php echo $page->name; ?></h3>
         <span id="fecha_post"></span>
      </div>
   </div>
   <div class="card-body">
      <p id="text-comunity">
      </p>
   </div>
   <div class="card-media">
      <a class="card-media-container" href="#">
         <img id="pic-post" src="" alt="media"/>
      </a>
   </div>
</div>
                    </div>
                    <div class="col-lg-5">
                        
                        <div class="row">
                            <div class="col-lg-7 modaldiv">
                          Fecha
                           </div> 
                          <div class="col-lg-5 modaldiv" id="fecha">
                           </div>   
                         <div class="col-lg-7 modaldiv">
                          Hora
                           </div> 
                          <div class="col-lg-5 modaldiv" id="hora">
                           </div>   
                         <div class="col-lg-7 modaldiv">
                          Día de la semana
                           </div> 
                          <div class="col-lg-5 modaldiv" id="dia_semana">
                           </div>   
                         <div class="col-lg-7 modaldiv">
                          Link
                           </div> 
                          <div class="col-lg-5 modaldiv" id="link">
                           </div>
                         <div class="col-lg-7 modaldiv">
                          Posts de esta fecha
                           </div> 
                          <div class="col-lg-5 modaldiv" id="postsDay">
                           </div>  
                        </div>
                        <br>
                        <?php if($arrayPost[1]['nombrekpi']!=''):?>
                        <h6>Indicadores de Filtro</h6>
                        <div class="row">    
                           <div class="col-lg-8 modaldiv nombre_kpi" id="nombre_kpi">
                           </div> 
                          <div class="col-lg-4 modaldiv" id="kpi_value">
                           </div> 
                          <div class="col-lg-8 modaldiv">
                            Índice <span class="nombre_kpi"></span>
                           </div> 
                          <div class="col-lg-4 modaldiv" id="indice_kpi">
                           </div>
                           <div class="col-lg-8 modaldiv">
                            Índice <span class="nombre_kpi"></span> alcance
                           </div> 
                          <div class="col-lg-4 modaldiv" id="indice_kpi_alcance">
                           </div>
                           <div class="col-lg-8 modaldiv">
                            Índice <span class="nombre_kpi"></span> inversión
                           </div> 
                          <div class="col-lg-4 modaldiv" id="indice_kpi_inversion">
                           </div>
                           <div class="col-lg-8 modaldiv">
                            Costo por <span class="nombre_kpi"></span>
                           </div> 
                          <div class="col-lg-4 modaldiv" id="costo_kpi">
                           </div>  
                        </div>
                        <?php endif?>
                        <br>
                        <h6>Indicadores</h6>
                        <div class="row">    
                           <div class="col-lg-8 modaldiv">
                               Fans a la fecha
                           </div> 
                          <div class="col-lg-4 modaldiv" id="fanpage">
                           </div> 
                          <div class="col-lg-8 modaldiv">
                              Alcance total
                           </div> 
                          <div class="col-lg-4 modaldiv" id="alcance">
                           </div>
                           <div class="col-lg-8 modaldiv">
                              Alcance pagado
                           </div> 
                          <div class="col-lg-4 modaldiv" id="alcance_pagado">
                           </div>
                           <div class="col-lg-8 modaldiv">
                              Alcance órganico
                           </div> 
                          <div class="col-lg-4 modaldiv" id="alcance_organico">
                           </div>
                           <div class="col-lg-8 modaldiv">
                              Comentarios
                           </div> 
                          <div class="col-lg-4 modaldiv" id="comentarios">
                           </div>  
                            <div class="col-lg-8 modaldiv">
                              Reacciones
                           </div> 
                          <div class="col-lg-4 modaldiv" id="reacciones">
                           </div>
                           <div class="col-lg-8 modaldiv">
                              Compartir
                           </div> 
                          <div class="col-lg-4 modaldiv" id="compartir">
                           </div>
                          <div class="col-lg-8 modaldiv">
                              Clic a link
                           </div> 
                          <div class="col-lg-4 modaldiv" id="link_clicks">
                           </div>
                           <div class="col-lg-8 modaldiv">
                              Vistas de video
                           </div> 
                          <div class="col-lg-4 modaldiv" id="post_video_views_unique">
                           </div>
                          <div class="col-lg-8 modaldiv">
                            Interaccion Total
                          </div> 
                        <div class="col-lg-4 modaldiv" id="interacciones_totales">
                         </div>
                         <div class="col-lg-8 modaldiv">
                             Inversión
                           </div> 
                          <div class="col-lg-4 modaldiv" id="inversion">
                           </div>
                        </div>
                        <br>
                        <h6>Índices</h6>
                        <div class="row">
                         <div class="col-lg-8 modaldiv">
                             Indice de interacción
                           </div> 
                          <div class="col-lg-4 modaldiv" id="indice_interaccion">
                           </div> 
                         <div class="col-lg-8 modaldiv">
                             Indice inter alcance
                           </div> 
                          <div class="col-lg-4 modaldiv" id="indice_inter_alcance">
                           </div>  
                          <div class="col-lg-8 modaldiv">
                             Indice interacción vs inversión
                           </div> 
                          <div class="col-lg-4 modaldiv" id="indice_interaccion_inversion">
                           </div>  
                        <div class="col-lg-8 modaldiv">
                             Indice Inter alcance vs inversión
                           </div> 
                          <div class="col-lg-4 modaldiv" id="indice_inter_alcance_inversion">
                           </div>
                           </div>
                        <br>
                        <h6>Catalogación</h6>
                        <div class="row">   
                        <div class="col-lg-3 modaldiv">
                             Tipo
                           </div> 
                          <div class="col-lg-9 modaldiv" id="tipo">
                           </div> 
                        <div class="col-lg-3 modaldiv">
                            Objetivo
                           </div> 
                          <div class="col-lg-9 modaldiv" id="objetivo">
                           </div>  
                         <div class="col-lg-9 modaldiv">
                          Nivel de libertad
                           </div> 
                          <div class="col-lg-3 modaldiv" id="nivelLibertad">
                           </div>
                        </div>
                      </div>
                      
                </div>
              </div>
              <div id='tbl' class="col-md-12"></div>
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->