<?php
require_once("Database.php");
  class SistemaSentimentValoradorModel{

    public function getCommentsNoSentimentByCommentID($comment_id=null){
        $dbh = Database::getInstance();
        $sql = "SELECT 
                *
                FROM `ssg_faceboook_comments` comments
                WHERE comments.id NOT IN (SELECT comment_id FROM `ssg_comment_rating`)
                AND comments.id=:comment_id 
                GROUP BY comments.id
                ";
        $statement = $dbh->prepare($sql);
        $statement->bindParam(':comment_id',$comment_id);
        $statement->execute();
        $comment = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $comment[0];
    }

    public function getCommentsNoSentimentFromPost($post_id){
        $dbh = Database::getInstance();
        $sql = "SELECT 
                *
                FROM `ssg_facebook_comments` comments
                WHERE comments.id NOT IN (SELECT comment_id FROM `ssg_comment_rating`)
                AND comments.post_id=:post_id 
                GROUP BY comments.id
                ";
        $statement = $dbh->prepare($sql);
        $statement->bindParam(':post_id',$post_id);
        $statement->execute();
        $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $comments;
    }

    public function getCommentsNoSentimentByDate($arreglo){
        $dbh = Database::getInstance();
        $sql = "SELECT 
                *
                FROM `ssg_facebook_comments` comments
                WHERE comments.page_id=:page_id
                AND comments.id NOT IN (SELECT comment_id FROM `ssg_comment_rating`)
                AND comments.created_time BETWEEN :desde AND :hasta
                GROUP BY comments.id
                ";
        $statement = $dbh->prepare($sql);
        $statement->bindParam(':page_id',$arreglo['page_id']);
        $statement->bindParam(':desde',$arreglo['desde']);
        $statement->bindParam(':hasta',$arreglo['hasta']);
        $statement->execute();
        $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $comments;
    }

    public function getCommentsSentiment($arreglo){
        $dbh = Database::getInstance();

        $sql = "SELECT 
                comments.id,comments.message,rating.valor,rating.coincidencias
                FROM `ssg_facebook_comments` comments
                INNER JOIN `ssg_comment_rating` rating
                ON comments.id=rating.comment_id
                WHERE comments.page_id=:page_id
                GROUP BY comments.id
                ";
        $statement = $dbh->prepare($sql);
        $statement->bindParam(':page_id',$arreglo['page_id']);
        $statement->execute();
        $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $comments;
    }

    public function getInfoSentimentDictionary(){
        $dbh = Database::getInstance();
        $sql = "SELECT
                *
                FROM `ssg_sentiment_dictionary`
                ORDER BY LENGTH(frase) DESC";
        //el orden descendiente de los tamaño es necesario para que funciones el sistema de catalogacion de comentarios
        $statement = $dbh->prepare($sql);
        $statement->execute();
        $infoFrases = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $infoFrases;
    }

    public function setCommentRating($arreglo){
        $dbh = Database::getInstance();
        $sql = "INSERT INTO `ssg_comment_rating`
        (`comment_id`, `valor`, `coincidencias`)
        VALUES (:comentario_id,:valorTotal,:coincidencias_id)";
        $statement = $dbh->prepare($sql);
        $statement->bindParam(':comentario_id',$arreglo['comentario_id']);
        $statement->bindParam(':valorTotal',$arreglo['valorTotal']);
        $statement->bindParam(':coincidencias_id',$arreglo['coincidencias_id']);
        $statement->execute();
    }

    public function UpdateCommentRating($arreglo){
        $dbh = Database::getInstance();
        $sql = "UPDATE `ssg_comment_rating` 
        SET `valor`=:valorTotal,`coincidencias`=:coincidencias_id 
        WHERE `comment_id`=:comentario_id";
        $statement = $dbh->prepare($sql);
        $statement->bindParam(':comentario_id',$arreglo['comentario_id']);
        $statement->bindParam(':valorTotal',$arreglo['valorTotal']);
        $statement->bindParam(':coincidencias_id',$arreglo['coincidencias_id']);
        $statement->execute();
    }


    /////////////////////////////sentiment page////////////////////////////////

    public function getPageWithSentiment() {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("SELECT 
        `page_id`
        FROM `ssg_facebook_comments` comments
        INNER JOIN `ssg_comment_rating` rating
        ON rating.`comment_id` = comments.`id`
        GROUP BY comments.`page_id`");
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }

    public function getInfoPage($page_id) {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("SELECT 
        pages.`id_facebook_page`, pages.`name`,
        MAX(comments.created_time) last_comment,MIN(comments.created_time) first_comment
        FROM `ssg_facebook_page` pages
        LEFT JOIN `ssg_facebook_comments` comments
        ON comments.page_id = pages.id_facebook_page
        WHERE pages.id_facebook_page=:page_id
        GROUP BY pages.id_facebook_page");
        $statement->bindParam(':page_id',$page_id);
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }

    public function getInfoCommentSentimentPage($page_id) {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("SELECT 
        MAX(comments.created_time) last_comment_with_sentiement,MIN(comments.created_time) first_comment_with_sentiement
        FROM `ssg_facebook_comments` comments
        INNER JOIN `ssg_comment_rating` rating
        ON comments.id = rating.comment_id
        WHERE comments.page_id=:page_id
        ");
        $statement->bindParam(':page_id',$page_id);
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }

    public function getInfoCommentSentimentPageByDate($arreglo) {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("SELECT 
        comments.message,comments.id,rating.valor, rating.coincidencias
        FROM `ssg_facebook_comments` comments
        LEFT JOIN `ssg_comment_rating` rating
        ON comments.id = rating.comment_id
        WHERE comments.page_id=:page_id
        AND comments.created_time BETWEEN :desde AND :hasta
        ");
        $statement->bindParam(':page_id',$arreglo['page_id']);
        $statement->bindParam(':desde',$arreglo['desde']);
        $statement->bindParam(':hasta',$arreglo['hasta']);
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }

    public function getCantAllCommentPageByDate($arreglo) {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("SELECT 
        COUNT(comments.id) cant_comment
        FROM `ssg_facebook_comments` comments
        WHERE comments.page_id=:page_id
        AND comments.created_time BETWEEN :desde AND :hasta
        ");
        $statement->bindParam(':page_id',$arreglo['page_id']);
        $statement->bindParam(':desde',$arreglo['desde']);
        $statement->bindParam(':hasta',$arreglo['hasta']);
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo[0]['cant_comment'];
    }

   public function getCantCommentSentimentPage($arreglo) {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("SELECT 
        COUNT(comments.id) cant_comment_sentiment
        FROM `ssg_facebook_comments` comments
        INNER JOIN `ssg_comment_rating` rating
        ON comments.id = rating.comment_id
        WHERE comments.page_id=:page_id
        AND comments.created_time BETWEEN :desde AND :hasta
        ");
        $statement->bindParam(':page_id',$arreglo['page_id']);
        $statement->bindParam(':desde',$arreglo['desde']);
        $statement->bindParam(':hasta',$arreglo['hasta']);
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo[0]['cant_comment_sentiment'];
    }

    public function getInfoCommentSentimentPageAverage($arreglo) {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("SELECT 
        rating.valor, rating.coincidencias
        FROM `ssg_facebook_comments` comments
        INNER JOIN `ssg_comment_rating` rating
        ON comments.id = rating.comment_id
        WHERE comments.page_id=:page_id
        AND comments.created_time BETWEEN :desde AND :hasta
        ");
        $statement->bindParam(':page_id',$arreglo['page_id']);
        $statement->bindParam(':desde',$arreglo['desde']);
        $statement->bindParam(':hasta',$arreglo['hasta']);
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }

    public function getCommentSentimentPositivePage($arreglo) {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("SELECT 
        rating.valor, rating.coincidencias
        FROM `ssg_facebook_comments` comments
        INNER JOIN `ssg_comment_rating` rating
        ON comments.id = rating.comment_id AND rating.valor>=0
        WHERE comments.page_id=:page_id 
        AND comments.created_time BETWEEN :desde AND :hasta
        ");
        $statement->bindParam(':page_id',$arreglo['page_id']);
        $statement->bindParam(':desde',$arreglo['desde']);
        $statement->bindParam(':hasta',$arreglo['hasta']);
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }

    public function getCommentSentimentNegativePage($arreglo) {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("SELECT 
        rating.valor, rating.coincidencias
        FROM `ssg_facebook_comments` comments
        INNER JOIN `ssg_comment_rating` rating
        ON comments.id = rating.comment_id AND rating.valor<0
        WHERE comments.page_id=:page_id 
        AND comments.created_time BETWEEN :desde AND :hasta
        ");
        $statement->bindParam(':page_id',$arreglo['page_id']);
        $statement->bindParam(':desde',$arreglo['desde']);
        $statement->bindParam(':hasta',$arreglo['hasta']);
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }

    /////////////////////////sentiment post//////////////////////

    public function getCantAllCommentPost($post_id) {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("SELECT 
        COUNT(comments.id) cant_comment
        FROM `ssg_facebook_comments` comments
        WHERE comments.post_id=:post_id
        ");
        $statement->bindParam(':post_id',$post_id);
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo[0]['cant_comment'];
    }

    public function getCantCommentSentimentPost($post_id) {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("SELECT 
        COUNT(comments.id) cant_comment_sentiment
        FROM `ssg_facebook_comments` comments
        INNER JOIN `ssg_comment_rating` rating
        ON comments.id = rating.comment_id
        WHERE comments.post_id=:post_id
        ");
        $statement->bindParam(':post_id',$post_id);
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo[0]['cant_comment_sentiment'];
    }

    public function getInfoCommentSentimentPost($post_id) {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("SELECT 
        comments.message,comments.id,rating.valor, rating.coincidencias
        FROM `ssg_facebook_comments` comments
        LEFT JOIN `ssg_comment_rating` rating
        ON comments.id = rating.comment_id
        WHERE comments.post_id=:post_id
        ");
        $statement->bindParam(':post_id',$post_id);
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }

    public function getInfoCommentSentimentPostAverage($post_id) {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("SELECT 
        rating.valor, rating.coincidencias
        FROM `ssg_facebook_comments` comments
        INNER JOIN `ssg_comment_rating` rating
        ON comments.id = rating.comment_id
        WHERE comments.post_id=:post_id
        ");
        $statement->bindParam(':post_id',$post_id);
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }

    public function getCantCommentSentimentPositivePost($post_id) {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("SELECT 
        rating.valor, rating.coincidencias
        FROM `ssg_facebook_comments` comments
        INNER JOIN `ssg_comment_rating` rating
        ON comments.id = rating.comment_id AND rating.valor>=0
        WHERE comments.post_id=:post_id 
        ");
        $statement->bindParam(':post_id',$post_id);
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }

    public function getCantCommentSentimentNegativePost($post_id) {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("SELECT 
        rating.valor, rating.coincidencias
        FROM `ssg_facebook_comments` comments
        INNER JOIN `ssg_comment_rating` rating
        ON comments.id = rating.comment_id AND rating.valor<0
        WHERE comments.post_id=:post_id 
        ");
        $statement->bindParam(':post_id',$post_id);
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }
  }