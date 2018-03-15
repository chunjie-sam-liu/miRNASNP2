<?  header("Content-type:image/jpeg"); 

    $id=$_GET["id"];
	
	
    $ip="********"
    $user="********"
    $password="********"
    $db="********"
    $conn=mysql_connect($ip,$user,$password) or die("Cannot connect to server!".mysql_error());
    mysql_select_db($db,$conn) or die("Cannot select database!".mysql_error()); 
    $sqlcontrolcountup="select count(miRNAid) from table8_flank_down "."where miRNAid='".$id."' and loc='up'";
    $result = mysql_query($sqlcontrolcountup);
	$rowcountup = mysql_fetch_array($result);
    $countup=$rowcountup["count(miRNAid)"];
	$sqlcontrol="select count(miRNAid) from table8_flank_down "."where miRNAid='".$id."' and loc='down'";
    $result = mysql_query($sqlcontrol);
	$row = mysql_fetch_array($result);
    $countdown=$row["count(miRNAid)"];
	$sqlcontrol="select count(premir) from table4_miRNA_SNP "."where premir='".$id."'";
	$result = mysql_query($sqlcontrol);
	$row = mysql_fetch_array($result);
    $countmir=$row["count(premir)"];
	$sqlcontrol1="select * from table1_pre_miRNA where id='".$id."'";
	$result1 = mysql_query($sqlcontrol1);
	$row1 = mysql_fetch_array($result1);
    $seq=$row1["seq"];
	$mirlength=strlen($seq);
	$sqlcontrol4="select * from table4_miRNA_SNP "."where premir='".$id."'";
	$result4=mysql_query($sqlcontrol4);
	$on_premir=array();
	$snp_onpre=array();
	for($i=1;$i<=$countmir;$i++)
	  {$row4=mysql_fetch_array($result4);
	   $snp_onpre[$i]=$row4["snp_id"];
	   $on_premir[$i]=$row4["on_premir"];
	  }
	$sqlcontrolup="select * from table8_flank_down where miRNAid='".$id."' and loc='up'";
	$resultup=mysql_query($sqlcontrolup);
	$on_up=array();
	$snp_onup=array();
	for($i=1;$i<=$countup;$i++)
	  {$rowup=mysql_fetch_array($resultup);
	   $snp_onup[$i]=$rowup["snp_id"];
	   $on_up[$i]=$rowup["distance"];
	  }
	$sqlcontroldown="select * from table8_flank_down where miRNAid='".$id."' and loc='down'";
	$resultdown=mysql_query($sqlcontroldown);
	$on_down=array();
	$snp_ondown=array();
	for($i=1;$i<=$countdown;$i++)
	 {$rowdown=mysql_fetch_array($resultdown);
	  $snp_ondown[$i]=$rowdown["snp_id"];
	  $on_down[$i]=$rowdown["distance"];
	 }
	    
	$totallength=400+$mirlength+400;
	$im=imagecreate(1000,450);
    $white=imagecolorallocate($im,255,255,255); //the bgcolor of the image
    $black=imagecolorallocate($im,0,0,0);
	$red=imagecolorallocate($im,255,0,0);
	$blue=imagecolorallocate($im,0,0,255);
    imageline($im,20,140,20+$totallength,140,$black);
	imageline($im,420,140,420+$mirlength,140,$red);
	imageline($im,20,130,20,140,$black);
	imageline($im,420,130,420,140,$red);
	imageline($im,420+$mirlength,130,420+$mirlength,140,$red);
	imageline($im,20+$totallength,130,20+$totallength,140,$black);
	imagestring($im,15,20,150,"-1000",1);
	imagestring($im,15,420,150,"0",1);
	imagestring($im,15,420,110,"0",$red);
	imagestring($im,15,420+$mirlength,110,$mirlength,$red);
	imagestring($im,15,420+$mirlength,150,"0",1);
	imagestring($im,15,10+$totallength,150,"1000",1);
	
	
	
	$p30=0;
	$p50=0;
	$p70=0;
	$p90=0;
	$p230=0;
	$p250=0;
	$p270=0;
	$p210=0;
	$p10=0;
	$p290=0;
	$p291=0;
	$p310=0;
	$p170=0;
	$p330=0;
	$p350=0;
	$p370=0;
	$p390=0;
	$p410=0;
	$p430=0;
	$heigh=array();
	$heigh[1]=30;
	$heigh[2]=50;
	$heigh[3]=70;
	$heigh[4]=90;
	$heigh[5]=230;
	$heigh[6]=210;
	$heigh[7]=190;
	$heigh[8]=250;
	$heigh[9]=10;
	$heigh[10]=270;
    $heigh[11]=291;
	$heigh[12]=310;
	$heigh[13]=170;
	$heigh[14]=330;
	$heigh[15]=350;
	$heigh[16]=370;
	$heigh[17]=390;
	$heigh[18]=410;
	$heigh[19]=430;
	$p=2;
	$suffix=0;
	$max=0;
	for($i=1;$i<=$countup;$i++)
	{
	 if((1000+$on_up[$i])/5*2+20<=$p50)
	  {$p=3;
	   if((1000+$on_up[$i])/5*2+20<=$p70)
	    {$p=4;
		 if((1000+$on_up[$i])/5*2+20<=$p90)
		  {$p=1;
		   if((1000+$on_up[$i])/5*2+20<=$p30)
		    {$p=5;
			 if((1000+$on_up[$i])/5*2+20<=$p230)
			  {$p=6;
			   if((1000+$on_up[$i])/5*2+20<=$p250)
			    {$p=7;
				 if((1000+$on_up[$i])/5*2+20<=$p270)
				  {$p=8;
				   if((1000+$on_up[$i])/5*2+20<=$p210)
				    {$p=9;
					 if((1000+$on_up[$i])/5*2+20<=$p10)
					  {$p=10;
					   if((1000+$on_up[$i])/5*2+20<=$p290)
					   {$p=11;
					    if((1000+$on_up[$i])/5*2+20<=$p291)
						 {$p=12;
					      if((1000+$on_up[$i])/5*2+20<=$p310)
						   {$p=13;
						      if((1000+$on_up[$i])/5*2+20<=$p170)
						        { $p=14;
								   if((1000+$on_up[$i])/5*2+20<=$p330)
						             { $p=15;
									   if((1000+$on_up[$i])/5*2+20<=$p350)
									    {$p=16;
										 if((1000+$on_up[$i])/5*2+20<=$p370)
										  {$p=17;
									        if((1000+$on_up[$i])/5*2+20<=$p390)	  
									         {$p=18;
											  if((1000+$on_up[$i])/5*2+20<=$p410)
									            $p=19;
											 }
										  }
										}
								     }		  	 	
							    
								}
						   }				 
						 }     
					   }
					  } 	 
					}  
				  }
				}
		      }
			}
		  }	 		  
				
		}
	  }	 
	  imageline($im,(1000+$on_up[$i])/5*2+20,$heigh[$p],(1000+$on_up[$i])/5*2+20,140,$black); 
	 imagestring($im,2,(1000+$on_up[$i])/5*2+22,$heigh[$p],$snp_onup[$i],$black);
	 if($suffix<(1000+$on_up[$i])/5*2+20)
	  imagestring($im,1,(1000+$on_up[$i])/5*2+20,142,$on_up[$i],$black);
	 else
	  imagestring($im,1,(1000+$on_up[$i])/5*2+20,130,$on_up[$i],$black);
	 $suffix=(1000+$on_up[$i])/5*2+20+10;
	 if($p==1) $p30=(1000+$on_up[$i])/5*2+70;
	 if($p==2) $p50=(1000+$on_up[$i])/5*2+70;
	 if($p==3) $p70=(1000+$on_up[$i])/5*2+70;
	 if($p==4) $p90=(1000+$on_up[$i])/5*2+70;
	 if($p==5) $p230=(1000+$on_up[$i])/5*2+70;
	 if($p==6) $p250=(1000+$on_up[$i])/5*2+70;
	 if($p==7) $p270=(1000+$on_up[$i])/5*2+70;
	 if($p==8) $p210=(1000+$on_up[$i])/5*2+70;
	 if($p==9) $p10=(1000+$on_up[$i])/5*2+70;
	 if($p==10) $p290=(1000+$on_up[$i])/5*2+70;
	 if($p==11) $p291=(1000+$on_up[$i])/5*2+70;
	 if($p==12) $p310=(1000+$on_up[$i])/5*2+70;
	 if($p==13) $p170=(1000+$on_up[$i])/5*2+70;
	 if($p==14) $p330=(1000+$on_up[$i])/5*2+70;
	 if($p==15) $p350=(1000+$on_up[$i])/5*2+70;
	 if($p==16) $p370=(1000+$on_up[$i])/5*2+70;
	 if($p==17) $p390=(1000+$on_up[$i])/5*2+70;
	 if($p==18) $p410=(1000+$on_up[$i])/5*2+70;
	 if($p==19) $p430=(1000+$on_up[$i])/5*2+70;
	 if($max<=$p) $max=$p;
	 $p=2;
	}
	for($i=1;$i<=$countmir;$i++)
	{
	 if($on_premir[$i]+420<=$p50)
	  { $p=3;
	   if($on_premir[$i]+420<=$p70)
	    {$p=4;
		 if($on_premir[$i]+420<=$p90)
		  {$p=1;
		   if($on_premir[$i]+420<=$p30)
		    {$p=5;
			 if($on_premir[$i]+420<=$p230)
			  {$p=6;
			   if($on_premir[$i]+420<=$p250)
			    {$p=7;
				 if($on_premir[$i]+420<=$p270)
				  {$p=8;
				   if($on_premir[$i]+420<$p210)
				    {$p=9;
					 if($on_premir[$i]+420<$p10)
					  {$p=10;
					   if($on_premir[$i]+420<=$p290)
					    {$p=11;
					     if($on_premir[$i]+420<=$p291)
					      {	 $p=12;
					        if($on_premir[$i]+420<=$p310)
							 {$p=13;
						      if($on_premir[$i]+420<=$p170)
						        { $p=14;
								   if($on_premir[$i]+420<=$p330)
						             { $p=15;
									   if($on_premir[$i]+420<=$p350)
									    {$p=16;
										 if($on_premir[$i]+420<=$p370)
										  {$p=17;
									        if($on_premir[$i]+420<=$p390)	  
									         {$p=18;
											  if($on_premir[$i]+420<=$p410)
									            $p=19;
											 }
										  }
										}
									 }
							    }
						     }
						   			
						  }	  
						}
					  }
					}  
				  }
				}
		      }
			}
		  } 		  
				
		}
	  }	 
	  imageline($im,$on_premir[$i]+420,$heigh[$p],$on_premir[$i]+420,140,$red); 
	 imagestring($im,2,$on_premir[$i]+422,$heigh[$p],$snp_onpre[$i],$red);
	 if($suffix<$on_premir[$i]+420)
	  imagestring($im,1,$on_premir[$i]+420,142,$on_premir[$i],$red);
	 else
	  imagestring($im,1,$on_premir[$i]+420,130,$on_premir[$i],$red);
	 $suffix= $on_premir[$i]+420+10;
	 if($p==1) $p30=$on_premir[$i]+420+70;
	 if($p==2) $p50=$on_premir[$i]+420+70;
	 if($p==3) $p70=$on_premir[$i]+420+70;
	 if($p==4) $p90=$on_premir[$i]+420+70;
	 if($p==5) $p230=$on_premir[$i]+420+70;
	 if($p==6) $p250=$on_premir[$i]+420+70;
	 if($p==7) $p270=$on_premir[$i]+420+70;
	 if($p==8) $p210=$on_premir[$i]+420+70;
	 if($p==9) $p10=$on_premir[$i]+420+70;
	 if($p==10) $p290=$on_premir[$i]+420+70;
	 if($p==11) $p291=$on_premir[$i]+420+70;
	 if($p==12) $p310=$on_premir[$i]+420+70;
	 if($p==13) $p170=$on_premir[$i]+420+70;
	 if($p==14) $p330=$on_premir[$i]+420+70;
	 if($p==15) $p350=$on_premir[$i]+420+70;
	 if($p==16) $p370=$on_down[$i]/5*2+420+$mirlength+70;
	 if($p==17) $p390=$on_down[$i]/5*2+420+$mirlength+70;
	 if($p==18) $p410=$on_down[$i]/5*2+420+$mirlength+70;
	 if($p==19) $p430=$on_down[$i]/5*2+420+$mirlength+70;
	 if($max<=$p) $max=$p;
	 $p=2;
	}
	for($i=1;$i<=$countdown;$i++)
	{
	 if($on_down[$i]/5*2+420+$mirlength<=$p50)
	  {$p=3;
	   if($on_down[$i]/5*2+420+$mirlength<=$p70)
	    {$p=4;
		 if($on_down[$i]/5*2+420+$mirlength<=$p90)
		  {$p=1;
		   if($on_down[$i]/5*2+420+$mirlength<=$p30)
		    {$p=5;
			 if($on_down[$i]/5*2+420+$mirlength<=$p230)
			  {$p=6;
			   if($on_down[$i]/5*2+420+$mirlength<=$p250)
			    {$p=7;
				 if($on_down[$i]/5*2+420+$mirlength<=$p270)
				  {$p=8;
				   if($on_down[$i]/5*2+420+$mirlength<$p210)
				    {$p=9;
					 if($on_down[$i]/5*2+420+$mirlength<$p10)
					  {$p=10;
					   if($on_down[$i]/5*2+420+$mirlength<=$p290)
					    {$p=11;
					     if($on_down[$i]/5*2+420+$mirlength<=$p291)
					      {	 $p=12;
					        if($on_down[$i]/5*2+420+$mirlength<=$p310)
							 {$p=13;
						      if($on_down[$i]/5*2+420+$mirlength<=$p170)
						        { $p=14;
								   if($on_down[$i]/5*2+420+$mirlength<=$p330)
						             { $p=15;
									   if($on_down[$i]/5*2+420+$mirlength<=$p350)
									    {$p=16;
										 if($on_down[$i]/5*2+420+$mirlength<=$p370)
										  {$p=17;
									        if($on_down[$i]/5*2+420+$mirlength<=$p390)	  
									         {$p=18;
											  if($on_down[$i]/5*2+420+$mirlength<=$p410)
									            $p=19;
											 }
										  }
										}
									 }
							    }
						     }
						  }	   
						}
					  }
					}  
				  }
				}
		      }
			}
		  } 		  
				
		}
	  }	 
	  imageline($im,$on_down[$i]/5*2+420+$mirlength,$heigh[$p],$on_down[$i]/5*2+420+$mirlength,140,$black); 
	  imagestring($im,2,$on_down[$i]/5*2+422+$mirlength,$heigh[$p],$snp_ondown[$i],$black);
	 if($suffix<$on_down[$i]/5*2+420+$mirlength)
	  imagestring($im,1,$on_down[$i]/5*2+420+$mirlength,142,$on_down[$i],$black);
	 else
	  imagestring($im,1,$on_down[$i]/5*2+420+$mirlength,130,$on_down[$i],$black);
	 $suffix= $on_down[$i]/5*2+420+$mirlength+10;
	 if($p==1) $p30=$on_down[$i]/5*2+420+$mirlength+70;
	 if($p==2) $p50=$on_down[$i]/5*2+420+$mirlength+70;
	 if($p==3) $p70=$on_down[$i]/5*2+420+$mirlength+70;
	 if($p==4) $p90=$on_down[$i]/5*2+420+$mirlength+70;
	 if($p==5) $p230=$on_down[$i]/5*2+420+$mirlength+70;
	 if($p==6) $p250=$on_down[$i]/5*2+420+$mirlength+70;
	 if($p==7) $p270=$on_down[$i]/5*2+420+$mirlength+70;
	 if($p==8) $p210=$on_down[$i]/5*2+420+$mirlength+70;
	 if($p==9) $p10=$on_down[$i]/5*2+420+$mirlength+70;
	 if($p==10) $p290=$on_down[$i]/5*2+420+$mirlength+70;
	 if($p==11) $p291=$on_down[$i]/5*2+420+$mirlength+70;
	 if($p==12) $p310=$on_down[$i]/5*2+420+$mirlength+70;
	 if($p==13) $p170=$on_down[$i]/5*2+420+$mirlength+70;
	 if($p==14) $p330=$on_down[$i]/5*2+420+$mirlength+70;
	 if($p==15) $p350=$on_down[$i]/5*2+420+$mirlength+70;
	 if($p==16) $p370=$on_down[$i]/5*2+420+$mirlength+70;
	 if($p==17) $p390=$on_down[$i]/5*2+420+$mirlength+70;
	 if($p==18) $p410=$on_down[$i]/5*2+420+$mirlength+70;
	 if($p==19) $p430=$on_down[$i]/5*2+420+$mirlength+70;
	 if($max<=$p) $max=$p;
	 $p=2;
	}
	if($max==9) $max=8;
	if($max==7||$max==6) $max=5;
	if($max==13) $max=12;
	if($max<5) $max=13;
	$imnew=imagecreate(1000,$heigh[$max]+20);
	imagecopyresized($imnew,$im,0,0,0,0,1000,$heigh[$max]+20,1000,$heigh[$max]+20);
	//imagejpeg($im);
	imagedestroy($im);
	imagejpeg($imnew);
    imagedestroy($imnew);   
   
?>
