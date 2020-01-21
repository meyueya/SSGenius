<?php
require_once("Database.php");
class SentimentDictionaryModel{ 
        
  public function getInfoSentimentDictionary()
  {
      $dbh = Database::getInstance();
      $statement=$dbh->prepare("SELECT * FROM `ssg_sentiment_dictionary`");
      $statement->execute();
      $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
      return $arreglo;
  }
               
  public function setFraseSentimentDictionary($array)
  {
      $dbh = Database::getInstance();
      $statement= $dbh->prepare("INSERT INTO `ssg_sentiment_dictionary`(`frase`, `valor`) VALUES (:frase,:valor)");
      $statement->bindParam(':frase', $array['frase']);
      $statement->bindParam(':valor', $array['valor']);
      $statement->execute();
  }

  public function updateFraseSentimentDictionary($array)
  {
      $dbh = Database::getInstance();
      $sth = $dbh->prepare("UPDATE `ssg_sentiment_dictionary` SET `frase`=:frase, `valor`=:valor WHERE id=:id");
      $sth->bindParam(':id', $array['id']);
      $sth->bindParam(':frase', $array['frase']);
      $sth->bindParam(':valor', $array['valor']);
      $sth->execute();
  }
  
  public function deleteFraseSentimentDictionary($id)
  {
      $dbh = Database::getInstance();
      $statement= $dbh->prepare("DELETE FROM `ssg_sentiment_dictionary` WHERE `id` =:id");
      $statement->bindParam(':id', $id);
      $statement->execute();
  }

}