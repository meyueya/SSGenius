<?php
require_once("Database.php");
class InversioncuentamesesModel{ 

  public function getInfoInversionMesesCuenta($arreglo)
  {
      $dbh = Database::getInstance();
      $statement=$dbh->prepare("SELECT * FROM `ssg_inversion_cuenta_mes` WHERE `id_page` =:id_page AND  `id_adaccount` =:id_adaccount ");
      $statement->bindParam(':id_page', $arreglo['id_page']);
      $statement->bindParam(':id_adaccount',  $arreglo['id_adaccount']);
      $statement->execute();
      $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
      return $arreglo;
  }
               
  public function setValoresInversion($array)
  {
      $dbh = Database::getInstance();
      $statement= $dbh->prepare("INSERT INTO `ssg_inversion_cuenta_mes`(`id_adaccount`, `id_page`, `fecha`, `cantidad`) VALUES (:id_adaccount,:id_page,:fecha,:cantidad)");
      $statement->bindParam(':id_adaccount', $array['id_adaccount']);
      $statement->bindParam(':id_page', $array['id_page']);
      $statement->bindParam(':fecha', $array['fecha']);
      $statement->bindParam(':cantidad', $array['cantidad']);
      $statement->execute();
  }
  
  public function updateValoresInversion($array)
  {
      $dbh = Database::getInstance();
      $sth = $dbh->prepare("UPDATE `ssg_inversion_cuenta_mes` SET `fecha`=:fecha, `cantidad`=:cantidad WHERE id=:id");
      $sth->bindParam(':id', $array['id']);
      $sth->bindParam(':fecha', $array['fecha']);
      $sth->bindParam(':cantidad', $array['cantidad']);
      $sth->execute();
  }

  public function deleteValorInversion($id)
  {
      $dbh = Database::getInstance();
      $statement= $dbh->prepare("DELETE FROM `ssg_inversion_cuenta_mes` WHERE `id` =:id");
      $statement->bindParam(':id', $id);
      $statement->execute();
  }
  /*                            <li id="inversioncuentameses">
                            <a href="./inversioncuentameses.php">
                                <span class="sidebar-mini-icon">AI</span>
                                <span class="sidebar-normal"> Administrar Inversiones </span>
                            </a>
                          </li> */
}