<?php
require_once("Database.php");
date_default_timezone_set('America/Lima');
class ConsultoriaModel{
    
    //consultoria ssg

    public function traerConsultorias($page_id){
        $connection = Database::getInstance();
        $statement = $connection->prepare("SELECT id_consultoria, COUNT(DISTINCT(id_analisis)) as analisis, kpi_principal, fecha, titulo, titulo_consultoria, page_id FROM ssg_consultoria as a WHERE `page_id`=$page_id GROUP BY id_consultoria");
        $statement->execute();
        $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }
    
    public function traerConsultoria($id , $page_id){
        $connection = Database::getInstance();
        $statement = $connection->prepare("SELECT * FROM `ssg_consultoria` WHERE `id_consultoria`= $id AND `page_id`=$page_id");
        $statement->execute();
        $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }

    public function getMaxIDConsultoria($page_id){
        $dbh = Database::getInstance();
        $statement=$dbh->prepare("SELECT max(`id_consultoria`) as max FROM `ssg_consultoria` WHERE `page_id`=$page_id");
        $statement->execute();
        $maximo=$statement->fetch();	
        return $maximo;
    }
            
    public function setConsultoria($array){
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("INSERT INTO `ssg_consultoria` (`id_consultoria`, `id_analisis`, `tipo`, `objetivo`, `titulo`, `kpi`, `kpi_principal`, `fecha`, `titulo_consultoria`, `page_id`) VALUES (:id_consultoria, :id_analisis, :tipo, :obj, :titulo, :kpi, :principal, :fecha, :titulo_consultoria, :page_id)");
        $statement->bindParam(':id_consultoria', $array['id_consultoria'], PDO::PARAM_STR);
        $statement->bindParam(':id_analisis', $array['id_analisis'], PDO::PARAM_STR);
        $statement->bindParam(':tipo', $array['tipo'], PDO::PARAM_STR);
        $statement->bindParam(':obj', $array['obj'], PDO::PARAM_STR);
        $statement->bindParam(':titulo', $array['titulo'], PDO::PARAM_STR);
        $statement->bindParam(':kpi', $array['kpi'], PDO::PARAM_STR);
        $statement->bindParam(':principal', $array['principal'], PDO::PARAM_STR);
        $statement->bindParam(':fecha', $array['fecha'], PDO::PARAM_STR);
        $statement->bindParam(':titulo_consultoria', $array['titulo_consultoria'], PDO::PARAM_STR);
        $statement->bindParam(':page_id', $array['page_id'], PDO::PARAM_STR);
        $result = $statement->execute(); 
    }
    public function deleteConsultoria($id_consultoria,$page_id){
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("DELETE FROM `ssg_consultoria` WHERE `id_consultoria`=:id_consultoria AND `page_id` =:page_id");
        $statement->bindParam(':id_consultoria', $id_consultoria);
        $statement->bindParam(':page_id', $page_id);
        $statement->execute();
    }

    // analisis consultoria ssg 

    public function setAnalisisConsultoria($array){
        $dbh = Database::getInstance();
        $statement = $dbh->prepare("INSERT INTO `ssg_analisis_consultoria`(`id_consultoria`, `page_id`, `nanalisis`, `tipo_analisis`, `titulo`, `hipotesis`, `observaciones`) VALUES (:id_consultoria, :page_id, :nanalisis, :tipoa, :titulo, :hip, :obs)");
        $statement->bindParam(':id_consultoria', $array['id_consultoria'], PDO::PARAM_STR);
        $statement->bindParam(':titulo', $array['titulo'], PDO::PARAM_STR);
        $statement->bindParam(':obs', $array['obs'], PDO::PARAM_STR);
        $statement->bindParam(':hip', $array['hip'], PDO::PARAM_STR);
        $statement->bindParam(':tipoa', $array['tipoa'], PDO::PARAM_STR);
        $statement->bindParam(':nanalisis', $array['nanalisis'], PDO::PARAM_STR);
        $statement->bindParam(':page_id', $array['page_id'], PDO::PARAM_STR);
        $result = $statement->execute();
    }

    public function getMaxIDAnalisis($id_consultoria,$page_id){
        $dbh = Database::getInstance();
        $statement=$dbh->prepare("SELECT max(`nanalisis`) as max FROM `ssg_analisis_consultoria` WHERE `page_id`=$page_id AND `id_consultoria`=$id_consultoria");
        $statement->execute();
        $maximo=$statement->fetch();	
        return $maximo;
    }

    public function traerConsultoriaAnalisis($id,$page_id){
        $connection = Database::getInstance();
        $statement = $connection->prepare("SELECT * FROM `ssg_consultoria` WHERE `id_consultoria`=$id AND `page_id`=$page_id GROUP by `id_analisis`");
        $statement->execute();
        $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }

    public function traerAnalisisDeUnaConsultoria($id_analisis,$id,$page_id){
        $connection = Database::getInstance();
        $statement = $connection->prepare("SELECT * FROM `ssg_analisis_consultoria` WHERE `id_consultoria`=$id AND `page_id`=$page_id AND `nanalisis`=$id_analisis");
        $statement->execute();
        $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }


    public function traerConsultoriaTAnalisis($page_id){
        $connection = Database::getInstance();
        $statement = $connection->prepare("SELECT * FROM `ssg_tipos_analisis` WHERE `page_id`=$page_id AND `status`='active' ");
        $statement->execute();
        $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }


    public function traerCantAnalisis($id, $page_id){
        $connection = Database::getInstance();
        $statement = $connection->prepare("SELECT COUNT(*) analisis FROM `ssg_analisis_consultoria` WHERE `id_consultoria`= $id AND `page_id`=$page_id");
        $statement->execute();
        $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }

    public function traerInfoConsultoria($id, $page_id){
        // antes se llamaba traerAnalisis
        $connection = Database::getInstance();
        //$statement = $connection->prepare("SELECT * FROM `ssg_consultoria` WHERE `id_consultoria`= $id AND `page_id`=$page_id GROUP by `id_analisis`");
        $statement = $connection->prepare("SELECT ssg_consultoria.*, ssg_catalogacion.nombre as nombre_kpi_principal FROM `ssg_consultoria` INNER JOIN `ssg_catalogacion` ON ssg_consultoria.kpi_principal=ssg_catalogacion.id AND ssg_consultoria.page_id=$page_id AND ssg_consultoria.id_consultoria=$id GROUP by ssg_consultoria.id_analisis;");
        $statement->execute();
        $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }

   
    // Post consultoria ssg 
    
    public function setPostConsultoria($array){
        $dbh = Database::getInstance();
        $statement = $dbh->prepare("INSERT INTO `ssg_consultoria_generarpost`(`id_consultoria`, `page_id`, `post`, `id_analisis`, `fecha`, `post_id`) VALUES (:id_consultoria, :page_id, :post, :analisis, :fecha, :post_id)");
        $statement->bindParam(':id_consultoria', $array['id_consultoria'], PDO::PARAM_STR);
        $statement->bindParam(':post', $array['post'], PDO::PARAM_STR);
        $statement->bindParam(':analisis', $array['analisis'], PDO::PARAM_STR);
        $statement->bindParam(':fecha', $array['fecha'], PDO::PARAM_STR);
        $statement->bindParam(':page_id', $array['page_id'], PDO::PARAM_STR);
        $statement->bindParam(':post_id', $array['post_id'], PDO::PARAM_STR);
        $result = $statement->execute();
    }

    public function getMaxIDPostAnalisis($id_consultoria,$page_id){
        $dbh = Database::getInstance();
        $statement=$dbh->prepare("SELECT max(`post`) as max FROM `ssg_consultoria_generarpost` WHERE `page_id`=$page_id AND `id_consultoria`=$id_consultoria");
        $statement->execute();
        $maximo=$statement->fetch();	
        return $maximo;
    }

    public function traerpost($id){ 
        $connection = Database::getInstance();
        $statement = $connection->prepare("SELECT * FROM `ssg_consultoria_generarpost` WHERE `id_consultoria`=$id");
        $statement->execute();
        $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }

    
    public function getPostRecientes($page_id){ 
        $desde=date('Y-m-d', strtotime('-7 day'));
        $connection = Database::getInstance();
        $statement = $connection->prepare("SELECT id,created_time,picture FROM `ssg_post_page_facebook` WHERE `created_time`>=:created_time AND `page_id`=:page_id");
        $statement->bindParam(':page_id', $page_id, PDO::PARAM_STR);
        $statement->bindParam(':created_time', $desde, PDO::PARAM_STR);        
        $statement->execute();
        $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }

    public function getInfoPost($id_post){
        $con = Database::getInstance();
		$sql = "SELECT *
        FROM ssg_post_page_facebook 
        WHERE id=:id_post";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_post', $id_post, PDO::PARAM_STR);        
        $stmt->execute();
        $arreglo = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }

    public function traerConsultoriasPost($whereSQL=1){
        $connection = Database::getInstance();
        $statement = $connection->prepare("SELECT id_consultoria, COUNT(DISTINCT(post)) as analisis, fecha FROM ssg_consultoria_generarpost WHERE $whereSQL GROUP BY id_consultoria");
        $statement->execute();
        $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $registros; 
    }

    public function traerConsultoriasPosts($whereSQL=1, $group=''){
        $connection = Database::getInstance();
        $statement = $connection->prepare("SELECT 
        a.id_consultoria, a.id_analisis, a.fecha, a.post, a.analisis_padre, a.post_id, 
        b.nombre, 
        c.titulo, c.hipotesis, c.observaciones 
        FROM ssg_consultoria_generarpost as a, 
        ssg_tipos_analisis as b, 
        ssg_analisis_consultoria as c 
        WHERE  a.id_analisis=c.id $whereSQL ".$group);
        $statement->execute();
        $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }


    //reportekpis consultoria

    public function getValoresrepotekpis($id, $page_id){
        $dbh = Database::getInstance();                                            
        $statement=$dbh->prepare("SELECT 
        ssg_consultoria.* ,
        ssg_catalogacion.nombre AS nombre, 
        ssg_tipo.nombre AS tipo,
        ssg_objetivo.nombre AS objetivo
        FROM `ssg_consultoria` 
        INNER JOIN ssg_catalogacion
        ON ssg_consultoria.kpi_principal=ssg_catalogacion.id
        INNER JOIN ssg_catalogacion ssg_tipo
        ON ssg_consultoria.tipo=ssg_tipo.id
        INNER JOIN ssg_catalogacion ssg_objetivo
        ON ssg_consultoria.objetivo=ssg_objetivo.id
        WHERE ssg_consultoria.id_consultoria=:id 
        AND ssg_consultoria.page_id=:page_id GROUP BY ssg_consultoria.id_analisis");
        /* $statement=$dbh->prepare("SELECT * 
        FROM ssg_consultoria as a, ssg_catalogacion as b 
        WHERE a.kpi_principal=b.id AND a.id_consultoria=:id 
        AND a.page_id=:page_id GROUP BY id_analisis"); */
        $statement->bindParam(':id', $id);
        $statement->bindParam(':page_id', $page_id);
        $statement->execute();
        $registros=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }

    public function getKpisAnalisisConsultoria($id_analisis,$id_consultoria,$page_id){
        $dbh = Database::getInstance();                                            
        $statement=$dbh->prepare("SELECT a.kpi,b.nombre 
        FROM ssg_consultoria as a, ssg_catalogacion as b 
        WHERE a.kpi=b.id AND a.id_analisis=:id_analisis AND a.id_consultoria=:id_consultoria AND a.page_id=:page_id AND a.kpi!=a.kpi_principal");
        $statement->bindParam(':id_analisis', $id_analisis);
        $statement->bindParam(':id_consultoria', $id_consultoria);
        $statement->bindParam(':page_id', $page_id);
        $statement->execute();
        $registros=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }
    
}