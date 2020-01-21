<?php
include('../auth.php');
                                    
		$valor = $_POST['valor'];
	
            # code...
        
        $sql = "SELECT DISTINCT Criteria FROM reporte_keywords_google where CampaignName='$valor' and Cost>'0'";
        
        $query = mysql_query($sql);

		
         while ($row = mysql_fetch_row($query)) { 
            $a++;
         echo   '<option value="'.$row[0].'">'.$a.' - '.$row[0].'</option>'. "/n";
         } 
?>
