<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("Database.php");
class UserModel{
     public function __construct(){}
    //guardar usuario
	public function saveFacebookUser($id_user, $id_facebook, $short_name, $name, $email_facebook, $picture, $facebook_access_token, $created_time, $latest_visit)
		{
			try{
			$dbh = Database::getInstance();
			$sql = "INSERT INTO ssg_user (id_user, id_facebook, short_name, name, email_facebook, picture, facebook_access_token, created_time, latest_visit) VALUES (:id_user, :id_facebook, :short_name, :name, :email_facebook, :picture, :facebook_access_token, :created_time, :latest_visit)";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_user', $id_user, PDO::PARAM_STR);
			$sth->bindParam(':id_facebook', $id_facebook, PDO::PARAM_STR);
			$sth->bindParam(':short_name', $short_name, PDO::PARAM_STR);
			$sth->bindParam(':name', $name, PDO::PARAM_STR);
			$sth->bindParam(':email_facebook', $email_facebook, PDO::PARAM_STR);			
			$sth->bindParam(':picture', $picture, PDO::PARAM_STR);
			$sth->bindParam(':facebook_access_token', $facebook_access_token, PDO::PARAM_STR);
			$sth->bindParam(':created_time', $created_time, PDO::PARAM_STR);
			$sth->bindParam(':latest_visit', $latest_visit, PDO::PARAM_STR);
			$sth->execute();
            $count = $sth->rowCount();
            $this->setRolUser($id_user);
			return $count;						
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
    }
    
	private function setRolUser($id_user)
	{
			try{
			$dbh = Database::getInstance();
			$sql = "INSERT INTO ssg_rol_user (id_user) VALUES (:id_user)";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_user', $id_user, PDO::PARAM_STR);
			$sth->execute();
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
	}
	
	 public function UpdateFacebookUser($id_facebook, $short_name, $name, $email_facebook, $picture, $facebook_access_token, $latest_visit){
            try{
                 $dbh = Database::getInstance();
                 $sql = "UPDATE ssg_user SET short_name = :short_name, name = :name, email_facebook = :email_facebook, picture = :picture, facebook_access_token = :facebook_access_token, latest_visit = :latest_visit WHERE id_facebook = :id_facebook";
                 $sth = $dbh->prepare($sql);
                 $sth->bindParam(':short_name', $short_name, PDO::PARAM_STR);
                 $sth->bindParam(':name', $name, PDO::PARAM_STR);
                 $sth->bindParam(':email_facebook', $email_facebook, PDO::PARAM_STR);
                 $sth->bindParam(':picture', $picture, PDO::PARAM_STR);
                 $sth->bindParam(':facebook_access_token', $facebook_access_token, PDO::PARAM_STR);
                 $sth->bindParam(':latest_visit', $latest_visit, PDO::PARAM_STR);
                 $sth->bindParam(':id_facebook', $id_facebook, PDO::PARAM_STR);
                 $campos = $sth->execute();
	                return $campos; 
            }  catch (PDOException $e){ die('Fail query'); }
        }
	
		public function saveRelationUserPageFacebook($id_user, $id_facebook_page, $page_token, $state, $created_time)
		{
			try{
			$dbh = Database::getInstance();
			$sql = "INSERT INTO ssg_facebook_user_page (id_user, id_facebook_page, page_token, state, created_time) VALUES (:id_user, :id_facebook_page, :page_token, :state, :created_time)";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_user', $id_user, PDO::PARAM_STR);
			$sth->bindParam(':id_facebook_page', $id_facebook_page, PDO::PARAM_STR);
			$sth->bindParam(':page_token', $page_token, PDO::PARAM_STR);
			$sth->bindParam(':state', $state, PDO::PARAM_STR);
			$sth->bindParam(':created_time', $created_time, PDO::PARAM_STR);
			$sth->execute();
			$count = $sth->rowCount();
			return $count;						
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
	}
	
	
	// metodo para eliminar una relacion
	    public function deleteRelationUserPageFacebook($id_user)
			{
			try {
				// eliminamos los productos relacionados
			$dbh = Database::getInstance();
			$sql = "DELETE FROM ssg_facebook_user_page WHERE id_user = ?";
			$sth = $dbh->prepare($sql);
			$sth->execute(array($id_user));
			$deleteNoveltys = $sth->rowCount();
			return $deleteNoveltys;
			}catch (PDOException $e) {
			  die( 'Fallo en query: ' . $e->getMessage() );}
			}
		
		 public function checkRelationPages($id_facebook_page,$id_user) {
            $con = Database::getInstance();
            $stmt = $con->prepare("SELECT id_facebook_page FROM ssg_facebook_user_page WHERE id_facebook_page = :id_facebook_page AND id_user = :id_user");
            $stmt->bindParam(':id_facebook_page', $id_facebook_page);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->execute();
                if($stmt->rowCount() > 0){
                    return true;
                } else {
                    return false;
                }
            }
            
	     public function getAccesTokenForUser($id_user)
        {
         	 try {
			 $dbh = Database::getInstance();
			 $sql = "SELECT facebook_access_token FROM ssg_user";
			 $sth = $dbh->prepare($sql);
			 $sth->execute();
			 $object = $sth->fetchObject();
			 return $object->facebook_access_token;
			 //return $sql;
			 }catch (PDOException $e) {
			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() ); }   
        }
  
          public function getIdUser($id_facebook) {
               try {
                 $con = Database::getInstance();
                 $stmt = $con->prepare("SELECT id_user FROM ssg_user WHERE id_facebook = :id_facebook");
                 $stmt->bindParam(':id_facebook', $id_facebook);
                 $stmt->execute();
                 $object = $stmt->fetchObject();
                 if ($object){
                 return $object->id_user;
                 } else { return false;}
               }catch (PDOException $e) {
			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() ); } 
            }
            
             public function getUser($id_user) {
               try {
                 $con = Database::getInstance();
                 $stmt = $con->prepare("SELECT * FROM ssg_user WHERE id_user = :id_user");
                 $stmt->bindParam(':id_user', $id_user);
                 $stmt->execute();
                 $object = $stmt->fetchObject();
                 return $object;
               }catch (PDOException $e) {
			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() ); } 
            }
            
           public function getfacebook_access_tokenUser($id_user) {
               try {
                 $con = Database::getInstance();
                 $stmt = $con->prepare("SELECT facebook_access_token FROM ssg_user WHERE id_user = :id_user");
                 $stmt->bindParam(':id_user', $id_user);
                 $stmt->execute();
                 $object = $stmt->fetchObject();
                 return $object->facebook_access_token;
               }catch (PDOException $e) {
			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() ); } 
            }
            
           public function checkUser($id_user) {
            $con = Database::getInstance();
            $stmt = $con->prepare("SELECT id_user FROM ssg_user WHERE id_user = :id_user");
            $stmt->bindParam(':id_user', $id_user);
            $stmt->execute();
                if($stmt->rowCount() > 0){
                    return true;
                } else {
                    return false;
                }
            }
            
            
        public function usernameCheck($id_facebook) {
            $con = Database::getInstance();
            $stmt = $con->prepare("SELECT id_facebook FROM ssg_user WHERE id_facebook = :id_facebook");
            $stmt->bindParam(':id_facebook', $id_facebook);
            $stmt->execute();
                if($stmt->rowCount() > 0){
                    return true;
                } else {
                    return false;
                }
            }
            
       
}