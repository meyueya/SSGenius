<?php
/*este es el menu del lado izquierdo de la pagina*/
  require_once('controller/UserPermits.php');
  $id_user=$_SESSION['id_user'];
  $userpermits= new UserPermits;
  $nivel_permiso= $userpermits->getNivelPermiso($id_user);
?>
<div class="sidebar" data-color="white" data-active-color="danger">
  <div class="logo">
    <div id="logogrande">
      <div class="logo-image-big">
        <img src="https://ssgenius.com/wp-content/uploads/2018/10/cropped-logo-1.png" style="padding-left: 15px; width: 160px!important;display: block;margin: auto;">
      </div>       
    </div>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li id="my_pages">
        <a data-toggle="collapse" href="#my_pages_examples">
          <i class="nc-icon nc-book-bookmark"></i>
          <p>
            Mis Páginas
            <b class="caret caret2"></b>
          </p>
        </a>
        <div class="collapse " id="my_pages_examples">
          <ul class="nav">
            <?php $isFirst = true;$cantidad_mostrar=6;?>
            <?php if(isset($pages)):?>
              <?php $contador=1; foreach($pages as $page):?>
                <?php if($contador<=$cantidad_mostrar):?>
                  <li id="my_page_<?= $page['id_facebook_page']; ?>">
                    <a data-src="<?php echo $page['id_facebook_page']; ?>" href="index.php?psid=<?= $page['id_facebook_page']; ?>">
                      <span class="sidebar-mini-icon"><img src="https://graph.facebook.com/<?php echo $page['id_facebook_page']; ?>/picture"></span>
                      <span class="sidebar-normal"> <div style="top: 23px;left: -20px;" _ngcontent-c44="" class="ap-social-icon facebook"></div> <?php echo $page['name']; ?></span>
                    </a>
                  </li>
                  <?php $contador++; $isFirst = false;?>
                <?php endif?>
              <?php endforeach?>
              <?php if(count($pages)>$cantidad_mostrar):?>
                <li id="all_pages">
                  <a href="allpages.php?act=list" class="slide-item active">
                    <span class="sidebar-mini-icon"><i class="nc-icon nc-bullet-list-67"></i></span>
                    <span class="sidebar-normal"> Ver Todas</span>
                  </a>
                </li>
              <?php endif?>
            <?php endif?>
            <li id="admid_my_pages">
              <a href="page.php?act=list">
                <span class="sidebar-mini-icon"><i class="nc-icon nc-settings"></i></span>
                <span class="sidebar-normal"> Administrar Páginas</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li>
        <a href="cuenta-de-anuncios.php">
          <i class="nc-icon nc-box"></i>
          <p>Cuenta Publicitaría</p>
        </a>
      </li>
      <li id="cuentas_por_pag">
        <a href="cuentas-por-pagina.php">
          <i class="nc-icon nc-lock-circle-open"></i>
          <p>Aprobar Cuentas</p>
        </a>
      </li>
      <hr>
      <?php if(isset($_GET['psid'])):?>
        <?php foreach($pages as $page_actual):?>
          <?php if($_GET['psid']==$page_actual['id_facebook_page']):?>
            <li id="pagina_actual">
              <a id="active" style="opacity: 1; color: #000000;" data-toggle="collapse" href="#pagina_actual_examples">
                <i><span class="sidebar-mini-icon"><img src="https://graph.facebook.com/<?= $page_actual['id_facebook_page']; ?>/picture"></span></i>
                <p>
                  <?= $page_actual['name']; ?>
                  <b class="caret caret2"></b>
                </p>
              </a>
              <div class="collapse " id="pagina_actual_examples">
                <ul class="nav">
                  <?php if($nivel_permiso>1):?>
                    <li id="cataloging">
                      <a data-toggle="collapse" href="#cataloging_examples">
                        <i class="nc-icon nc-ruler-pencil"></i>
                        <p>
                          Catalogación
                          <b class="caret caret2"></b>
                        </p>
                      </a>
                      <div class="collapse " id="cataloging_examples">
                        <ul class="nav">
                          <?php if($nivel_permiso>1):?>
                            <li id="catalogar">
                              <a href="./catalogar.php?psid=<?= $_SESSION['psid']?>">
                                <span class="sidebar-mini-icon">C</span>
                                <span class="sidebar-normal"> Catalogar </span>
                              </a>
                            </li>
                          <?php endif?>
                          <?php if($nivel_permiso>1):?>
                            <li id="admin_catalogados">
                              <a href="./admincatalogados.php?psid=<?= $_SESSION['psid']?>">
                                <span class="sidebar-mini-icon">PC</span>
                                <span class="sidebar-normal"> Administrar Post Catalogados </span>
                              </a>
                            </li>
                            <li id="repo_catalogados">
                              <a href="./reportcatalogados.php?psid=<?= $_SESSION['psid']?>">
                                <span class="sidebar-mini-icon">RC</span>
                                <span class="sidebar-normal"> Reporte Post Catalogados </span>
                              </a>
                            </li>
                          <?php endif?>
                          <?php if($nivel_permiso>2):?>
                            <li id="admin_cataloging">
                              <a href="./tipos-objetivos.php?psid=<?= $_SESSION['psid']?>">
                                <span class="sidebar-mini-icon">CF</span>
                                <span class="sidebar-normal">Configurar Catalogación </span>
                              </a>
                            </li>
                          <?php endif?>
                        </ul>
                      </div>
                    </li>
                  <?php endif?>  
                  <?php if($nivel_permiso>1):?>
                    <li id="consultancy">
                      <a data-toggle="collapse" href="#consultancy_examples">
                        <i class="nc-icon nc-single-copy-04"></i>
                        <p>
                          Consultoría
                          <b class="caret caret2"></b>
                        </p>
                      </a>
                      <div class="collapse " id="consultancy_examples">
                        <ul class="nav">
                          <li id="new_consulting">
                            <a href="./definirconsultoria.php?psid=<?= $_SESSION['psid']?>">
                              <span class="sidebar-mini-icon">DC</span>
                              <span class="sidebar-normal"> Definir Consultoria </span>
                            </a>
                          </li>
                          <li id="admin_consulting">
                            <a href="./reporteconsultoria.php?psid=<?= $_SESSION['psid']?>">
                              <span class="sidebar-mini-icon">IC</span>
                              <span class="sidebar-normal"> Informes Consultoria </span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </li>
                  <?php endif?>
                  <li id="my_reports">
                    <a data-toggle="collapse" href="#my_reports_examples">
                      <i class="nc-icon nc-chart-bar-32"></i>
                      <p>
                        Reportes
                        <b class="caret caret2"></b>
                      </p>
                    </a>
                    <div class="collapse " id="my_reports_examples">
                      <ul class="nav">
                        <li id="graphics_fb">
                          <a href="./graficosfacebook.php?psid=<?= $_SESSION['psid']?>">
                            <span class="sidebar-mini-icon">GF</span>
                            <span class="sidebar-normal"> Facebook Page General </span>
                          </a>
                        </li>
                        <li id="reports_fb">
                          <a href="./reporteinformes.php?psid=<?= $_SESSION['psid']?>">
                            <span class="sidebar-mini-icon">*</span>
                            <span class="sidebar-normal"> Informes FB </span>
                          </a>
                        </li>
                        <li id="reports_fb">
                          <a href="./consultareporte.php?psid=<?= $_SESSION['psid']?>">
                            <span class="sidebar-mini-icon">◉</span>
                            <span class="sidebar-normal"> Reporte Verificacion </span>
                          </a>
                        </li>
                        <li id="reports_fb">
                          <a href="./consultainbox.php?psid=<?= $_SESSION['psid']?>">
                            <span class="sidebar-mini-icon">◉</span>
                            <span class="sidebar-normal"> Reporte Inbox </span>
                          </a>
                        </li>
                         <li id="reports_fb">
                          <a href="./reporteleads.php?psid=<?= $_SESSION['psid']?>">
                            <span class="sidebar-mini-icon">◉</span>
                            <span class="sidebar-normal"> Reporte Leads </span>
                          </a>
                        </li>
                        <li id="reports_ssg_post_fb">
                          <a href="./reportessgpostfb.php?psid=<?= $_SESSION['psid']?>">
                            <span class="sidebar-mini-icon">P FB</span>
                            <span class="sidebar-normal"> Informes Post FB</span>
                          </a>
                        </li>
                        <li id="top_post_report">
                          <a href="./top-post-report.php?psid=<?= $_SESSION['psid']?>">
                            <span class="sidebar-mini-icon">I  & H</span>
                            <span class="sidebar-normal"> Indicadores Vs Históricos</span>
                          </a>
                        </li>
                        <li id="impact_ads_page">
                          <a href="./report-Impact-investment-page.php?psid=<?= $_SESSION['psid']?>">
                            <span class="sidebar-mini-icon">ADS</span>
                            <span class="sidebar-normal"> Impacto ADS en Page</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li id="sentiment">
                    <a data-toggle="collapse" href="#sentiment_examples">
                      <i class="nc-icon nc-chart-bar-32"></i>
                      <p>
                        Sentiment
                        <b class="caret caret2"></b>
                      </p>
                    </a>
                    <div class="collapse " id="sentiment_examples"> 
                      <ul class="nav">
                        <li id="sentiment_procesar_fecha">
                          <a href="./sistema-sentiment-valorador.php?psid=<?= $_SESSION['psid']?>">
                            <span class="sidebar-mini-icon">PF</span>
                            <span class="sidebar-normal"> Procesar Fecha </span>
                          </a>
                        </li>
                        <li id="sentiment_reporte_general">
                          <a href="#">
                            <span class="sidebar-mini-icon">RG</span>
                            <span class="sidebar-normal"> Reporte General </span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </li> 
                   <?php if($nivel_permiso<1):?>
                  <li id="aiw">
                    <a data-toggle="collapse" href="#aiw_reporte_general">
                        <i class="nc-icon nc-chart-bar-32"></i>
                      <p>
                          AIW
                          <b class="caret caret2"></b>
                      </p>
                    </a>
                    <div class="collapse " id="aiw_reporte_general"> 
                      <ul class="nav">
                        <li id="dashboard_paid_media">
                          <a href="./paidmedia.php?psid=<?= $_SESSION['psid']?>">
                            <span class="sidebar-mini-icon">D</span>
                            <span class="sidebar-normal"> Dashboard</span>
                          </a>
                        </li>
                        <!-- <li id="aiw_reporte">
                          <a href="./reportefacebookform1.php?psid=<?= $_SESSION['psid']?>">
                              <span class="sidebar-mini-icon">AIW</span>
                              <span class="sidebar-normal"> Reporte General </span>
                          </a>
                        </li> -->
                        <li id="all_ads_ssg">
                            <a href="./reportegoogle.php">
                                <span class="sidebar-mini-icon">GE</span>
                                <span class="sidebar-normal"> Reporte Google </span>
                            </a>
                          </li>
                      </ul>
                    </div>
                  </li> 
                  <?php endif?>
                  <li id="config_page_facebook">
                    <a href="./configuracion_page_facebook_ssg_all_rol.php?psid=<?= $_GET['psid']?>">
                      <span class="sidebar-mini-icon">CP</span>
                      <span class="sidebar-normal"> Configurar Página </span>
                    </a>
                  </li>
                  <li id="producto_cuenta">
                    <a href="./producto-cuenta.php?psid=<?= $_GET['psid']?>">
                      <span class="sidebar-mini-icon">P</span>
                      <span class="sidebar-normal"> Productos </span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
          <?php endif?>
        <?php endforeach?>
      <?php endif?>
      <?php if($nivel_permiso>3):?>
                    <li id="config_page">
                      <a data-toggle="collapse" href="#config_page_examples">
                        <i class="nc-icon nc-key-25"></i>
                        <p>
                            Configurar Páginas
                            <b class="caret caret2"></b>
                        </p>
                      </a>
                      <div class="collapse " id="config_page_examples">
                        <ul class="nav">
                          <li id="config_page_facebook">
                            <a href="./configuracion_page_facebook_ssg.php">
                                <span class="sidebar-mini-icon">CP</span>
                                <span class="sidebar-normal"> Configurar Página </span>
                            </a>
                          </li>
                          <li id="all_config_page">
                            <a href="./allConfigPageFacebook.php">
                                <span class="sidebar-mini-icon">IF</span>
                                <span class="sidebar-normal"> Páginas Configuradas </span>
                            </a>
                          </li>
                          <li id="all_page_ssg">
                            <a href="./allPageSSG.php">
                                <span class="sidebar-mini-icon">All</span>
                                <span class="sidebar-normal"> Páginas SSG </span>
                            </a>
                          </li>
                          <li id="all_ads_ssg">
                            <a href="./configFacebookAcounts.php">
                                <span class="sidebar-mini-icon">FB</span>
                                <span class="sidebar-normal"> Cuentas Publicitarias </span>
                            </a>
                          </li>
                           <li id="inversioncuentameses">
                            <a href="./inversioncuentameses.php">
                                <span class="sidebar-mini-icon">AI</span>
                                <span class="sidebar-normal"> Administrar Inversiones </span>
                            </a>
                          </li>
                          <li id="cuentas_por_pag_superadmin">
                            <a href="cuentas-por-pagina-superadmin.php">
                                <i class="nc-icon nc-lock-circle-open"></i>
                                <p>Aprobar Cuentas</p>
                            </a>
                           </li>
                           <li id="valores_globales">
                                <a href="./valoresglobales.php">
                                    <span class="sidebar-mini-icon">DV</span>
                                    <span class="sidebar-normal"> Definir Valores </span>
                                </a>
                            </li>
                           <li id="ssg_productos">
                                <a href="./productos.php">
                                    <span class="sidebar-mini-icon">P</span>
                                    <span class="sidebar-normal"> Productos </span>
                                </a>
                            </li>
                        </ul>
                      </div>
                    </li>

                  <?php endif?> 
    </ul>
  </div>
</div>
    