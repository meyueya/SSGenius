<?php
include_once 'conec.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
       
    </head>
    <body>
        
        <?php
$id_page=256278787729451;
$desde=20190701;
$hasta=20190730;

                      
              $sql="SELECT id_adaccount FROM ssg_cuenta_por_pagina WHERE page_id='256278787729451' GROUP BY id_adaccount ";
			$resultt= mysqli_query($conn, $sql);                  
			$datas = array();
                       
                        if (mysqli_num_rows($resultt) > 0){
                            while ($row=mysqli_fetch_assoc($resultt)){
                                
                                $datas[]=$row;
                            }
                        }
                        $totalloop = sizeof ($datas); 
                            //echo $totalloop;
                            
                          $totalalcance='0';
                  for ($x = 0; $x <=$totalloop-1; $x++) {
                     // print_r($datas[$x]) ;
              $id_cuenta=$datas[$x]['id_adaccount'];
              echo "<br>";
            echo "ID de cuenta : ".$id_cuenta;
            echo "<br>";
            echo "<br>"; 
       
          $sqlAL="select SUM(if(objective='POST_ENGAGEMENT' or objective='POST_ENGAGEMENT' or objective='VIDEO_VIEWS', reach,0)) AS alcance FROM aiw_facebook_data_ads WHERE account_id='".$id_cuenta."' and `date_start` BETWEEN '".$desde."' and '".$hasta."'";
          
           while($row=mysqli_fetch_array($resultAL)){
               
                   //echo "Alcance:  ".$row[0] . "<br />";
                   
                   $totalalcance=$row[0]+$totalalcance;
                  print_r($resultAL);
                  //echo "<br>".$totalalcance;
                   
           }/*
          $sqlIM="SELECT SUM(impressions) as imp  FROM aiw_facebook_data_ads WHERE account_id='".$id_cuenta."'";
          $resultIM= mysqli_query($conn,$sqlIM);
          
           while($row=mysqli_fetch_array($resultIM)){
               
                   echo "Impresiones:  ".$row[0] . "<br />";
                   
                   $totalimp=$row[0]+$totalimp;
                  
                  //echo "<br>".$totalimp;
                   
           }
          $sqlCL="SELECT SUM(clicks) as clics  FROM aiw_facebook_data_ads WHERE account_id='".$id_cuenta."'";
          $resultCL= mysqli_query($conn,$sqlCL);
          
           while($row=mysqli_fetch_array($resultCL)){
               
                   echo "Clicks:  ".$row[0] . "<br />";
                   
                   $totalc=$row[0]+$totalc;
                  //echo "<br>".$totalalc;
                   
           }
                
            */
         
                  }
                      echo "<br>Total ALCANCE:  ".$totalalcance; 
                     /* echo "<br><br>Total IMPRESIONES:  ".$imp=$totalimp;
                      echo "<br><br>Total CLICS:  ". $clics=$totalc;  */
                      
                       $alcance=$totalalcance;
                       $imp=$totalimp;
                       $clics=$totalc;  
                        $results=array 
                                (array("alcance"=>$alcance,"imp"=>$imp,"clics"=>$clics));
                          // print_r($results);
			
                     
         
?>
                        
    </body>
</html>
 