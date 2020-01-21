
<?php

require './Classes/functions.php';



    require './config.php';
    mysql_set_charset('utf8');
    /* $sql = "SELECT DISTINCT `modelo` FROM `cliente` ORDER BY `modelo` ASC";
      $rs = mysql_query($sql); */
    ?>
     
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">        
           <link rel="stylesheet" href="../css/estilo.css"> 
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
           <link rel="stylesheet" href="../css/themes/blue/style.css" type="text/css" media="print, projection, screen" />
           <script type="text/javascript" src="js/jquery-latest.js"></script> 
           <!--<script type="text/javascript" src="js/jquery.tablesorter.js"></script>  -->
           <script src="../js/bootstrap.min.js"></script>
           <script type="text/javascript" language="javascript" src="../js/script.js"></script>


    <div class="container">
      
        <!--<div class="loading-div"><img src="images/cargando.gif"></div>-->

        <hr>

        <div class="row" id="result_semana" name="result_semana">

            <?php
            $sql_campana = "select * from pli4_message order by sent desc;";
            conect_bd_phplist2();
            $res_campana = mysql_query($sql_campana);
            disconect();
            $n_campana = mysql_num_rows($res_campana);

            $html = "";

            echo "<table class='table table-striped table-bordered'>";
            echo "<tr><th>Nombre</th><th>Envio</th><th>Fecha de Envio</th><th>Procesados</th><th>Visto</th>"
            . "<th>vistas unicas</th><th>Clics</th><th>Rebote</th><th>Registrados AIW</th></tr>";

            while ($row_campana = mysql_fetch_array($res_campana)) {
                $id_campana = $row_campana['id'];
                $nom_campana = $row_campana['subject'];
                $envio_mail = $row_campana['fromfield'];
                $fecha_envio = $row_campana['sent'];
                $procesados = $row_campana['processed'];
                $vistos = $row_campana['viewed']; // campo 1
                $rebote = $row_campana['pli4_message']; // campo 4
                $sql_vista_unica = "SELECT count(*) as visto FROM pli4_usermessage WHERE messageid = " . $id_campana . " and viewed != ''";
                conect_bd_phplist2();
                $res_vista_unica = mysql_query($sql_vista_unica);
                disconect();
                $row_vista_unica = mysql_fetch_array($res_vista_unica);
                $n_vista_unica = $row_vista_unica['visto']; // campo 2
                $sql_clics = "SELECT sum(`clicked`) as clic FROM `pli4_linktrack_ml` WHERE `messageid` = " . $id_campana . ";";
                conect_bd_phplist2();
                $res_clics = mysql_query($sql_clics);
                disconect();
                $row_clics = mysql_fetch_array($res_clics);
                $clics_campana = $row_clics['clic']; // campo 3
                //cruce con AIW, extrayendo usuarios que se registraron en AIW
                $n_form_aiw = 0;
                $sql_select_mail1 = "SELECT userid FROM `pli4_usermessage` where `messageid` = " . $id_campana . " and `viewed` != '' ";
                conect_bd_phplist2();
                $res_select_mail1 = mysql_query($sql_select_mail1);
                disconect();
                while ($row_select_mail1 = mysql_fetch_array($res_select_mail1)) {
                    $id_user = $row_select_mail1['userid'];
                    $sql_select_mail = "select email from pli4_user_user where id = " . $id_user . ";";
                    conect_bd_phplist2();
                    $res_select_mail = mysql_query($sql_select_mail);
                    disconect();
                    $row_select_mail = mysql_fetch_array($res_select_mail);
                    $email_user = $row_select_mail['email'];
                    //extraemos de AIW si existe el usuario
                    $sql_aiw_cliente = "select * from cliente where correo = '" . $email_user . "' and a = 12 and b = 1 ;";
                    //echo $sql_aiw_cliente."<br>";
                    conect_bd();
                    $res_aiw_cliente = mysql_query($sql_aiw_cliente);
                    disconect();
                    $n_res = mysql_num_rows($res_aiw_cliente);
                    if ($n_res > 0) {
                        $n_form_aiw++;
                    }
                }
                echo "<tr><td>" . $nom_campana . "</td><td>" . $envio_mail . "</td><td>" . $fecha_envio . "</td><td>" . $procesados . "</td><td>" . $vistos .
                "</td><td>" . $n_vista_unica . "</td><td>" . $clics_campana . "</td><td>" . $rebote . "</td><td>" . $n_form_aiw . "</td></tr>";
            }
            ?>
        </div>

        <div id="result_rep"></div>

    </div>


<!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->

<?php require '../footer/footer-2.php'; ?>