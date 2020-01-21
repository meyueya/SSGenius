<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require_once("Database.php");
class ReporteConsulta{
//1tabla
    function getInformesFB($id_page){
        $dbh = Database::getInstance();
        if($_SERVER['REQUEST_METHOD']=='POST'){
        $desde = date("Y-m-d", strtotime($_POST['date1']));
        $hasta = date("Y-m-d", strtotime($_POST['date2']));
        $statement01 = $dbh->prepare("SELECT created_time_fecha as fecha, COUNT(*) as 'total_inbox' 
            FROM `ssg_conversations_messages_facebook` 
            WHERE page_id ='".$id_page."' AND created_time_fecha BETWEEN '".$desde."' and '".$hasta."'  
            group BY day(created_time_fecha), month(created_time_fecha),year(created_time_fecha) 
            
  ");
        $statement01->execute();
        $registros = $statement01->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
}}}
//desglozar
 class ReporteConsultaimp{
    function getInformesimp($id_page){
       $dbhi = Database::getInstance();
       if($_SERVER['REQUEST_METHOD']=='POST'){
        $desde = date("Y-m-d", strtotime($_POST['date1']));
        $hasta = date("Y-m-d", strtotime($_POST['date2']));
        $statement02 = $dbhi->prepare("SELECT created_time_fecha,conversation_id, from_name, from_id, to_name, to_id, message 
            FROM `ssg_conversations_messages_facebook`
            WHERE page_id ='".$id_page."' AND created_time_fecha BETWEEN '".$desde."' and '".$hasta."'   


              ");
        $statement02->execute();
        $registros02 = $statement02->fetchAll(PDO::FETCH_ASSOC);
        return $registros02;
   
}}
 }

//2da tabla
 class ReporteConsult{
    function getInformes($id_page){
       $dbhb = Database::getInstance();
       if($_SERVER['REQUEST_METHOD']=='POST'){
        $desde = date("Y-m-d", strtotime($_POST['date1']));
        $hasta = date("Y-m-d", strtotime($_POST['date2']));
        $statement1 = $dbhb->prepare("SELECT created_time_fecha as fecha, COUNT(*) as 'total_mesajes'
            FROM `ssg_conversations_messages_facebook` 
           WHERE from_id!='".$id_page."' AND  page_id ='".$id_page."' AND created_time_fecha BETWEEN '".$desde."' and '".$hasta."'  
               group BY day(created_time_fecha), month(created_time_fecha),year(created_time_fecha)
               ");
        $statement1->execute();
        $registro = $statement1->fetchAll(PDO::FETCH_ASSOC);
        return $registro;
   
}}
 }// TABLA 2 DESGLOZAR
 class ReporteConsultarea{
    function getInformesrea($id_page){
       $dbhrea = Database::getInstance();
       if($_SERVER['REQUEST_METHOD']=='POST'){
        $desde = date("Y-m-d", strtotime($_POST['date1']));
        $hasta = date("Y-m-d", strtotime($_POST['date2']));
        $statementrea = $dbhrea->prepare("SELECT  created_time_fecha, conversation_id,to_id,from_id, from_name, to_id, to_name, message
                FROM `ssg_conversations_messages_facebook` 
                where  from_id!='".$id_page."' AND page_id ='".$id_page."' AND created_time_fecha BETWEEN '".$desde."' and '".$hasta."' group by message ");
        $statementrea->execute();
        $registrorea = $statementrea->fetchAll(PDO::FETCH_ASSOC);
        return $registrorea;
   
}}
 } //tabla 3
  class ReporteConsultuser{
    function getInformesuser($id_page){
       $dbhuser = Database::getInstance();
       if($_SERVER['REQUEST_METHOD']=='POST'){
        $desde = date("Y-m-d", strtotime($_POST['date1']));
        $hasta = date("Y-m-d", strtotime($_POST['date2']));
        $statementuser = $dbhuser->prepare("SELECT from_name, to_name, from_id, to_id, DATE_FORMAT(created_time, '%Y-%m-%d') FechaStr , created_time_fecha AS fecha,COUNT(DISTINCT to_id) AS 'Total_respondido' 
            FROM ssg_conversations_messages_facebook WHERE page_id ='".$id_page."' and from_id='".$id_page."' AND created_time_fecha BETWEEN '".$desde."' and '".$hasta."' group by fechastr ");
        $statementuser->execute();
        $registrouser = $statementuser->fetchAll(PDO::FETCH_ASSOC);
        return $registrouser;
   
}}
 }// desglozar
 class ReporteConsultvid{
    function getInformesvid($id_page){
       $dbhvid = Database::getInstance();
       if($_SERVER['REQUEST_METHOD']=='POST'){
        $desde = date("Y-m-d", strtotime($_POST['date1']));
        $hasta = date("Y-m-d", strtotime($_POST['date2']));
        $statementvid = $dbhvid->prepare("SELECT * FROM `ssg_conversations_messages_facebook`  
            where page_id='".$id_page."' and from_id='".$id_page."' and created_time_fecha BETWEEN '".$desde."' and '".$hasta."' group by conversation_id");
        $statementvid->execute();
        $registrovid = $statementvid->fetchAll(PDO::FETCH_ASSOC);
        return $registrovid;
   
}}
 } //tabla 4
 class ReporteConsultview{
    function getInformesview($id_page){
       $dbhview = Database::getInstance();
       if($_SERVER['REQUEST_METHOD']=='POST'){
        $desde = date("Y-m-d", strtotime($_POST['date1']));
        $hasta = date("Y-m-d", strtotime($_POST['date2']));
        $statementview = $dbhview->prepare("SELECT  a.created_time_fecha AS created_time_fecha ,b.from_name as Nombre_usuario,b.from_id as id_usuario,b.to_name as Nombre_Pagina, b.created_time as fecha, b.message as M_usuario,
            a.from_name as fmovil, a.to_name as tmovil, a.to_id as iduser, a.created_time as fmovil, a.message as mmovil, avg(TIMEDIFF(a.created_time,b.created_time)) as 'minutos' 
            FROM ssg_conversations_messages_facebook as a
            inner join ssg_conversations_messages_facebook as b
            where b.from_id=a.to_id and a.page_id='".$id_page."' and a.created_time_fecha 
            BETWEEN '".$desde."' and '".$hasta."'  and a.from_id=a.page_id and
            b.page_id='".$id_page."' and b.created_time_fecha BETWEEN '".$desde."' and '".$hasta."'  and b.from_id!=b.page_id
            group by a.created_time_fecha");
        $statementview->execute();
        $registroview = $statementview->fetchAll(PDO::FETCH_ASSOC);
        return $registroview;
   
}}
 }//desglose
  class ReporteConsultcta{
    function getInformescta($id_page){
       $dbhcta = Database::getInstance();
       if($_SERVER['REQUEST_METHOD']=='POST'){
        $desde = date("Y-m-d", strtotime($_POST['date1']));
        $hasta = date("Y-m-d", strtotime($_POST['date2']));
        $statementcta = $dbhcta->prepare("SELECT a.created_time_fecha AS created_time_fecha, b.from_name as Nombre_usuario,b.from_id as id_usuario,b.to_name as Nombre_Pagina, b.created_time as Fecha, b.message as M_usuario,a.from_name as fmovil, a.to_name as tmovil, a.to_id as iduser, a.created_time as fmovil, a.message as mmovil, TIMEDIFF(a.created_time,b.created_time) as ' minutos', 
IFNULL((CASE a.created_time WHEN '0000-00-00' THEN COUNT(a.created_time) END), 0) AS total_no_respondido,
 (CASE WHEN a.created_time  >'0000-00-00 00:00:00' THEN COUNT(a.created_time) END) AS total_respondido,
 IFNULL( (CASE WHEN  TIMEDIFF(a.created_time,b.created_time)  >'47:59:59' THEN COUNT( TIMEDIFF(a.created_time,b.created_time)) END), 0) AS 'Respodido_despues_de_48_horas'
FROM ssg_conversations_messages_facebook as a
inner join ssg_conversations_messages_facebook as b
 where b.from_id=a.to_id and a.page_id='".$id_page."' and a.created_time_fecha 
            BETWEEN '".$desde."' and '".$hasta."'  and a.from_id=a.page_id and
            b.page_id='".$id_page."' and b.created_time_fecha BETWEEN '".$desde."' and '".$hasta."' and b.from_id!=b.page_id

group by a.message ");
        $statementcta->execute();
        $registrocta = $statementcta->fetchAll(PDO::FETCH_ASSOC);
        return $registrocta;
   
}}
  }//tabla 5
  class ReporteConsultalc{
    function getInformesalc($id_page){
       $dbhalc = Database::getInstance();
       if($_SERVER['REQUEST_METHOD']=='POST'){
        $desde = date("Y-m-d", strtotime($_POST['date1']));
        $hasta = date("Y-m-d", strtotime($_POST['date2']));
        $statementalc = $dbhalc->prepare("SELECT created_time_fecha as fecha, count(DISTINCT from_name) as personas FROM `ssg_conversations_messages_facebook` 
                WHERE  from_id!='".$id_page."'  and page_id ='".$id_page."' AND created_time_fecha BETWEEN '".$desde."' and '".$hasta."'  group by to_name, created_time_fecha");
        $statementalc->execute();
        $registroalc = $statementalc->fetchAll(PDO::FETCH_ASSOC);
        return $registroalc;
   
}}
  }// desglose
  class Reportetabla{
    function getInformestabla($id_page){
       $dbhtabla = Database::getInstance();
       if($_SERVER['REQUEST_METHOD']=='POST'){
        $desde = date("Y-m-d", strtotime($_POST['date1']));
        $hasta = date("Y-m-d", strtotime($_POST['date2']));
        $statementtabla = $dbhtabla->prepare("SELECT created_time_fecha ,conversation_id,from_name,from_id, to_name, message  FROM ssg_conversations_messages_facebook 
        WHERE from_id!='".$id_page."'  and  page_id ='".$id_page."' AND created_time_fecha BETWEEN '".$desde."' and '".$hasta."' group by created_time_fecha, from_name");
        $statementtabla->execute();
        $registrotabla = $statementtabla->fetchAll(PDO::FETCH_ASSOC);
        return $registrotabla;
   
}}
  }
       
        

 
 
        