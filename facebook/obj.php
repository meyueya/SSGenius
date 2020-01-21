<?php
include('../auth.php');

										$valor = $_POST['valor'];


                                        $sql = "SELECT * FROM `campana` WHERE a='$valor'";
                                        
                                        $query = mysql_query($sql);
                              
										
                                         while ($row = mysql_fetch_row($query)) { 
                                            $a++;
                                         echo   '<option value="'.$row[3].'">'.$a.' - '.$row[1].'</option>'. "/n";
                                         } 
                                  
										 
										
									



?>
