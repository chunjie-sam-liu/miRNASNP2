	<?
	   include "head.php";
	?>


<div id="content" style="font-family:Arial, Helvetica, sans-serif; font-size:16px">

  
  <p>
    <? 
   $species=array("chicken","chimp","cow","dog","horse","mouse","rattus","zebrafish","human");
   $count=array();
   $count[1]="chicken";
   $count[2]="chimp";
   $count[3]="cow";
   $count[4]="dog";
   $count[5]="horse";
   $count[6]="mouse";
   $count[7]="rattus";
   $count[8]="zebrafish";
   $count[9]="human";
   $url= $_SERVER["REQUEST_URI"];
   for($i=0;$i<=9;$i++)
      $url[$i]="";
	  
    $url=ltrim($url);
   $terms1=$_GET["terms1"];
   $terms=$_GET["terms"];
   $species[$_GET["species"]]++;
   $chr=$_GET["chr"];
   $miRNA=$_GET["miRNA"];
   $SNP=$_GET["SNP"];
   $strand=$_GET["strand"];
   $seed=$_GET["seed"];
   $order=$_GET["order"];
   $requir=$_GET["requir"];

include "connectinclude.php"; 
 
 

  if($terms!="")
   {    $terms=trim($terms);
        
        $sqlcontrol1="select * from chicken_info where snp_id like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["acc"]!="")
		  {
		   $species["chicken"]++;
		   $SNP=$terms;
		  } 
		$sqlcontrol1="select * from chimp_info where snp_id like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["acc"]!="")
		  {
		   $species["chimp"]++;
		   $SNP=$terms;
		  } 
		$sqlcontrol1="select * from cow_info where snp_id like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["acc"]!="")
		 { 
		   $species["cow"]++;
		   $SNP=$terms;
		  }
		$sqlcontrol1="select * from dog_info where snp_id like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["acc"]!="")
		  {$species["dog"]++;
		   $SNP=$terms;
		  } 
		$sqlcontrol1="select * from horse_info where snp_id like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["acc"]!="")
		  {$species["horse"]++;
		     $SNP=$terms;
		  }	 
		$sqlcontrol1="select * from mouse_info where snp_id like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["acc"]!="")
		  {$species["mouse"]++;
		   $SNP=$terms;
		  } 
		$sqlcontrol1="select * from rattus_info where snp_id like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["acc"]!="")
		  {$species["rattus"]++;
		     $SNP=$terms;
		  }	 
		$sqlcontrol1="select * from zebrafish_info where snp_id like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["acc"]!="")
		  {$species["zebrafish"]++;
		    $SNP=$terms;
	      } 
		$sqlcontrol1="select * from table4_miRNA_SNP  where snp_id like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		  {$species["human"]++;
		    $SNP=$terms;
		  }	
		$sqlcontrol1="select * from table8_flank_down where snp_id like '%".$terms."%'";
		$result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["snp_id"]!="")
		  {$species["human"]++;
		    $SNP=$terms;
		  }
		  
	    $sqlcontrol1="select * from chicken_info where acc like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		  {$species["chicken"]++;
		   $acc=$terms;
		  } 
		$sqlcontrol1="select * from chimp_info where acc like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		  {$species["chimp"]++;
		    $acc=$terms;
		  } 
		$sqlcontrol1="select * from cow_info where acc like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		 { $species["cow"]++;
		  $acc=$terms;
		  } 
		$sqlcontrol1="select * from dog_info where acc like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		  {$species["dog"]++;
		   $acc=$terms;
		  } 
		$sqlcontrol1="select * from horse_info where acc like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		 { $species["horse"]++;
		  $acc=$terms;
		  } 
		$sqlcontrol1="select * from mouse_info where acc like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		 { $species["mouse"]++;
		  $acc=$terms;
		  } 
		$sqlcontrol1="select * from rattus_info where acc like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		  {$species["rattus"]++;
		   $acc=$terms;
		  } 
		$sqlcontrol1="select * from zebrafish_info where acc like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		 { $species["zebrafish"]++;
		  $acc=$terms;
		  } 
		$sqlcontrol1="select * from table1_pre_miRNA  where acc like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["id"]!="")
		  {$species["human"]++;
		   $acc=$terms;
		  } 
		$sqlcontrol1="select * from table8_flank_down where acc like '%".$terms."%'";
		$result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["acc"]!="")
		  {$species["human"]++;
		    $acc=$terms;
		  }  
		  
	   $sqlcontrol1="select * from chicken_info where pre_miRNA like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		  {$species["chicken"]++;
		   $miRNA=$terms;
		  } 
		$sqlcontrol1="select * from chimp_info where pre_miRNA like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		  {$species["chimp"]++;
		    $miRNA=$terms;
		  } 
		$sqlcontrol1="select * from cow_info where pre_miRNA like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		 { $species["cow"]++;
		  $miRNA=$terms;
		  } 
		$sqlcontrol1="select * from dog_info where pre_miRNA like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		  {$species["dog"]++;
   		   $miRNA=$terms;
		  } 
	  	$sqlcontrol1="select * from horse_info where pre_miRNA like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		 { $species["horse"]++;
		  $miRNA=$terms;
		  } 
		$sqlcontrol1="select * from mouse_info where pre_miRNA like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		 { $species["mouse"]++;
		  $miRNA=$terms;
		  } 
		$sqlcontrol1="select * from rattus_info where pre_miRNA like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		  {$species["rattus"]++;
		   $miRNA=$terms;
		  } 
		$sqlcontrol1="select * from zebrafish_info where pre_miRNA like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		 { $species["zebrafish"]++;
		  $miRNA=$terms;
		  } 
		$sqlcontrol1="select * from table4_miRNA_SNP where premir like '%".$terms."%'";
		$result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		  {$species["human"]++;
		   $miRNA=$terms;
		  } 
		
		$sqlcontrol1="select * from table8_flank_down where miRNAid like '%".$terms."%'";
		
		$result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["miRNAid"]!="")
		  {$species["human"]++;
		    $miRNA=$terms;
		  }    
	    
	    
		$sqlcontrol1="select * from gene_target_gain where gene_id='".$terms."'";
        
		$result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["miRNA_id"]!="")
		  {$gene=$terms;
		   $extra="gene";
		   $gene_target_gain="gain";
		  }
		
		$sqlcontrol1="select * from gene_target_lost where gene_id='".$terms."'";
        $result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["miRNA_id"]!="")
		  {$gene=$terms;
		   $extra="gene";
		   $gene_target_loss="loss";
		  }  
		  
		$sqlcontrol1="select * from seed_target_gain where gene_id='".$terms."'";
        $result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["miRNA_id"]!="")
		  {$gene=$terms;
		   $extra="gene";
		   $seed_target_gain="gain";
		  }  
		 
		$sqlcontrol1="select * from seed_target_loss where gene_id='".$terms."'";
        $result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["miRNA_id"]!="")
		  {$gene=$terms;
		   $extra="gene";
		   $seed_target_loss="loss";
		  }  
		  
		
		$sqlcontrol1="select * from gene_target_gain where SNP_id='".$terms."'";
        
		$result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["miRNA_id"]!="")
		  {$extra="snp";
		   $gene_target_gain="gain";
		  }
		
		$sqlcontrol1="select * from gene_target_lost where SNP_id='".$terms."'";
		
        $result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["miRNA_id"]!="")
		  {$extra="snp";
		   $gene_target_loss="loss";
		  }  
		  
		$sqlcontrol1="select * from seed_target_gain where SNP_id='".$terms."'";
        $result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["miRNA_id"]!="")
		  {$extra="snp";
		   $seed_target_gain="gain";
		  }  
		 
		$sqlcontrol1="select * from seed_target_loss where SNP_id='".$terms."'";
        $result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["miRNA_id"]!="")
		  {$extra="snp";
		   $seed_target_loss="loss";
		  }  
		  
		$sqlcontrol1="select * from gene_target_gain where miRNA_id='".$terms."'";
        
		$result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["miRNA_id"]!="")
		  {$extra="mirna";
		   $gene_target_gain="gain";
		  }
		
		$sqlcontrol1="select * from gene_target_lost where miRNA_id='".$terms."'";
        $result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["miRNA_id"]!="")
		  {$extra="mirna";
		   $gene_target_loss="loss";
		  }  
		  
		$sqlcontrol1="select * from seed_target_gain where miRNA_id='".$terms."'";
        $result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["miRNA_id"]!="")
		  {$extra="mirna";
		   $seed_target_gain="gain";
		  }  
		 
		$sqlcontrol1="select * from seed_target_loss where miRNA_id='".$terms."'";
        $result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["miRNA_id"]!="")
		  {$extra="mirna";
		   $seed_target_loss="loss";
		  }    
		
		
  
  }	 
  
  if($terms1=='flanking')
  { $species["human"]++;
    for($pp=1;$pp<=8;$pp++)
	  $species[$count[$pp]]=0;
  }	  
$pp=9;

if($miRNA==""&&$acc==""&&$SNP==""&&$chr==""&&$_GET["species"]==""&&$gene==""&&$gene_target_loss==""&&$gene_target_gain==""&&$seed_target_gain==""&&$seed_target_loss=="")
{echo "<br><p>No items found, please check your search term and try again.</p>";
}


if($species[$count[$pp]]>=1&&($miRNA!=""||$acc!=""||$SNP!=""||$chr!=""||$_GET["species"]=="human"))
{

if($terms1=="")
  {$sqlcontrol1="select * from table4_miRNA_SNP";
   $sqlcontrol2="select * from table8_flank_down";
  }
 else
  {$sqlcontrol1="select * from table8_flank_down";
  }
 $p=0;
 if($miRNA!="")
 {  if($terms1=="")
     {$sqlcontrol1=$sqlcontrol1." where premir like '%".$miRNA."%'";
      $sqlcontrol2=$sqlcontrol2." where miRNAid like '%".$miRNA."%'";
  
	 }
	 else
	 {$sqlcontrol1=$sqlcontrol1." where miRNAid like '%".$miRNA."%'";
	 }
	$p=1;
 }
 if($SNP!="")
 {if($p==0)
   {$sqlcontrol1=$sqlcontrol1." where";
    $sqlcontrol2=$sqlcontrol2." where";
	} 
  else
  {if($terms!="")
    {$sqlcontrol1=$sqlcontrol1." or";$sqlcontrol2=$sqlcontrol2." or";}
   else
     {$sqlcontrol1=$sqlcontrol1." and";$sqlcontrol2=$sqlcontrol2." and";}
  }
  $sqlcontrol1=$sqlcontrol1." snp_id like '%".$SNP."%'";
  $sqlcontrol2=$sqlcontrol2." snp_id like '%".$SNP."%'";
  $p=1;
 }
 if($acc!="")
 { if($p==0)
    {$sqlcontrol1=$sqlcontrol1." where";
	 $sqlcontrol2=$sqlcontrol2." where";
	 }
  else
   {if($terms!="")
      {$sqlcontrol1=$sqlcontrol1." or";$sqlcontrol2=$sqlcontrol2." or";}
   else
      {$sqlcontrol1=$sqlcontrol1." and";$sqlcontrol2=$sqlcontrol2." and";}
	}
  $sqlcontrol1=$sqlcontrol1." acc like '%".$acc."%'";
  $sqlcontrol2=$sqlcontrol2." acc like '%".$acc."%'";
  $p=1;
 }     
 if($chr!="")
 {if($p==0)
   {$sqlcontrol1=$sqlcontrol1." where";
    $sqlcontrol2=$sqlcontrol2." where";
   }
  else
   {$sqlcontrol1=$sqlcontrol1." and";$sqlcontrol2=$sqlcontrol2." and";}
   
  $sqlcontrol1=$sqlcontrol1." chr='".$chr."'";
  $sqlcontrol2=$sqlcontrol2." chr='".$chr."'";
  
 } 

 $result2=mysql_query(str_replace("*","count(*)",$sqlcontrol1));       
 $row2=mysql_fetch_array($result2);
 
 
 if($requir=="chr")
 {$result3=mysql_query(str_replace("*","count(miRNAid)",$sqlcontrol1." group by miRNAid"));       
 $num=mysql_num_rows($result3);
 $row3=mysql_fetch_array($result3);
 }
 
 if($row2["count(*)"]!=0)
 {if($order!="")
  {$sqlcontrol1=$sqlcontrol1." order by ".$order.",premir,snp_pos,chr";
  }
  else
  {if($terms1=="")
    $sqlcontrol1=$sqlcontrol1." order by premir";
   else
    $sqlcontrol1=$sqlcontrol1." order by miRNAid";
  }
 } 
 
 $sqlcontrol2=$sqlcontrol2." order by miRNAid";

 
 
 $result = mysql_query($sqlcontrol1);
 $result2=mysql_query($sqlcontrol2);
 
 $resultcount1=mysql_query(str_replace("*","count(*)",$sqlcontrol1));       
 $rowcount1=mysql_fetch_array($resultcount1);
 
 
 if($terms1=="")
 {$resultcount2=mysql_query(str_replace("*","count(*)",$sqlcontrol2));       
  $rowcount2=mysql_fetch_array($resultcount2);
 }
 
 if($terms1=="")
   {if($rowcount1["count(*)"]!=0)
    {echo "<br/><div class=\"quicksearch\">SNPs in human pre-miRNA regions</div>";
    } 
	if($requir=="pre")
	 echo "<br/><font size='+0'>There are ".$row2["count(*)"]." SNPs in human pre-miRNA regions.The SNP data are based on  <a href='http://www.ncbi.nlm.nih.gov/projects/SNP/'/>dbSNP version: 132 </a>.The human genome assembly is NCBI GRCh37.<br/></font>";
   
   }
  else 
   {
    echo "<br/><div class=\"quicksearch\">miRNAs with SNPs in pre-miRNA flanking regions (-1kb, +1kb)</div>";
    if($requir=="chr")
	 echo "<font size='+0'><br/>There are ".$num." pre-miRNAs on of human Chromosome ".$chr.".The miRNA data are based on <a href='http://www.mirbase.org/'>miRBase release 16</a>.The human genome assembly is NCBI GRCh37.</font>";


   }
 ?> 
    <?
 if($terms1=="")
 {if($rowcount1["count(*)"]!=0)
  {
 ?>
<br/>  
  <table border="1" style="font-size:14px">
    <tr class="ttt2"> 
   <td width="120"> <a href="<? echo $url."&order=premir" ?>">  Pre-miRNA  </a>  
   </td>
   <td width="100"> <a href="<? echo $url."&order=snp_id" ?>">  SNP ID  </a> 
   </td>
   <td width="100"> <a href="<? echo $url."&order=chr" ?>">  Chromosome   </a>
   </td>
   <td width="100">SNP Positon
   </td>
   
   <td  style="text-align:center" width="100">Allele
   </td>
   <td width="120" style="text-align:center">Location
   </td>
   </tr>
  <?
   }
  }
  else
  {?>
  <br/>
  <br/>
  <table border="1" style="font-size:14px">
     <tr class="ttt2">
	 <td width="120">miRNA
	 </td>
	 <td width="100">ACC
	 </td>
	 <td width="100">Chromosome
	 </td>
	 <td width="100">Start
	 </td>
	 <td width="100">End
	 </td>
	 <td width="80">miRNA strand
	 </td>
	 <td width="120">Numbers of SNPs  up/down
	 </td>
	 </tr>
	<? 
  }
  if($terms1=="")
  {	
   if($rowcount1["count(*)"]!=0)
   {
  $l=0;
  
    while($row = mysql_fetch_array($result))
    {?><tr class="<? if($l==0){echo "ttt1";$l=1;}else{echo "ttt2";$l=0;} ?>">
        
           <td>
		  
				     <a href="miRNA_details.php?id=<? echo $row["premir"] ?>">
		             <font color='blue'><b><? echo $row["premir"];?></b></font>
               
		   </a>	
		   </td>	
	      
	  <td width="91"><? echo $row["snp_id"];
	       ?>
      </td>	
	  <td width="70"><? echo $row["chr"];
	       ?>
      </td>	
	  <td><? echo $row["snp_pos"];
	      ?>
	  </td>
	  
	  <td style="text-align:center"><? echo $row["ref_allele"];
	      ?>
	  </td>
      <td style="text-align:center">
        <? if($row["seed"]=="in_m")
		        echo "in_mature";
			else
			  if($row["seed"]=="in_seed")
			     echo "in_seed";
			  else 
			     echo "pre-miRNA";
		 ?>
         		 
      </td>
      
	  
	</tr>
	 <?
    }
  ?></table><?
  }
  if($terms!="")
	  {if($rowcount2["count(*)"]!=0)
	   {
	   ?>
	     <br/>
         <div class="quicksearch">SNPs in the pre-miRNA flanking regions (-1kb ~ +1kb)</div>
         <br/>
	     <table border="1" style="font-size:14px">
	     <tr class="ttt2">
	     <td width="120">miRNA
	     </td>
	     <td width="120">ACC
	     </td>
	      <td width="100">Chromosome
	      </td>
	      <td width="120">Start
	       </td>
	      <td width="120">End
	      </td>
	      <td width="100">miRNA strand
	      </td>
	       <td width="140" style="text-align:center">Numbers of SNPs <br/> up/down
	      </td>
	      </tr>
	 
	     <? 
	       $l=0;
           $pll="";
           while($row = mysql_fetch_array($result2))
            {  if($pll!=$row["miRNAid"])
	            { $pll=$row["miRNAid"];  
                  $sqlcontrolup="select count(miRNAid) from table8_flank_down "."where miRNAid='".$pll."' and loc='up'";
		          $resultup = mysql_query($sqlcontrolup);
		          $rowup=mysql_fetch_array($resultup);
                  $sqlcontroldown="select count(miRNAid) from table8_flank_down "."where miRNAid='".$pll."' and loc='down'";
		          $resultdown = mysql_query($sqlcontroldown);
		          $rowdown=mysql_fetch_array($resultdown);
   ?>
     <tr class="<? if($l==0){echo "ttt1";$l=1;}else{echo "ttt2";$l=0;} ?>">
        
           <td>
		    
		         <a href="snpinflanking.php?id=<? echo $row["miRNAid"] ?>">
		          <font color='blue'><b><? echo $row["miRNAid"];?></b></font>
                 </a>	
		  
		   </td>	
	      
	  <td width="91"><? echo $row["acc"];
	       ?>
      </td>	
	  <td width="70"><? echo $row["chr"];
	       ?>
      </td>	
	  <td><? echo $row["start"];
	      ?>
	  </td>
	  <td><? echo $row["end"];
	      ?>
	  </td>
	  <td style="text-align:center"><? echo $row["strand"];
	      ?>
	  </td>
	  <td style="text-align:center"><? echo $rowup["count(miRNAid)"]."/".$rowdown["count(miRNAid)"]; ?>
	  </td>
	   
	  
	</tr>
	
	  <?
	           }
	       }
	  
	    ?></table><?
	  }
    }
  }
  else
  {	 
  $l=0;
  $pll="";
  while($row = mysql_fetch_array($result))
  {  if($pll!=$row["miRNAid"])
	  { $pll=$row["miRNAid"];  
        $sqlcontrolup="select count(miRNAid) from table8_flank_down "."where miRNAid='".$pll."' and loc='up'";
		$resultup = mysql_query($sqlcontrolup);
		$rowup=mysql_fetch_array($resultup);
        $sqlcontroldown="select count(miRNAid) from table8_flank_down "."where miRNAid='".$pll."' and loc='down'";
		$resultdown = mysql_query($sqlcontroldown);
		$rowdown=mysql_fetch_array($resultdown);
   ?>
     <tr class="<? if($l==0){echo "ttt1";$l=1;}else{echo "ttt2";$l=0;} ?>">
        
           <td>
		    
		         <a href="snpinflanking.php?id=<? echo $row["miRNAid"] ?>">
		          <font color='blue'><b><? echo $row["miRNAid"];?></b></font>
                 </a>	
		  
		   </td>	
	      
	  <td width="91"><? echo $row["acc"];
	       ?>
      </td>	
	  <td width="70"><? echo $row["chr"];
	       ?>
      </td>	
	  <td><? echo $row["start"];
	      ?>
	  </td>
	  <td><? echo $row["end"];
	      ?>
	  </td>
	  <td style="text-align:center"><? echo $row["strand"];
	      ?>
	  </td>
	  <td style="text-align:center"><? echo $rowup["count(miRNAid)"]."/".$rowdown["count(miRNAid)"]; ?>
	  </td>
	   
	  
	</tr>
	 <?
	  }
	 }
    ?> </table>
  <?
  }	 
 
  }



for($pp=1;$pp<=8;$pp++)
{
if($species[$count[$pp]]>=1&&($miRNA!=""&&$SNP!=""&&$acc!=""||$_GET["species"]!=""))
{
 $sqlcontrol1="select * from ".$count[$pp]."_info";
 $p=0;
 
 if($miRNA!="")
 {  $sqlcontrol1=$sqlcontrol1." where pre_miRNA like '%".$miRNA."%'";
    $p=1;
 }
 if($SNP!="")
 {if($p==0)
   $sqlcontrol1=$sqlcontrol1." where";
  else
   {if(terms!="")
    $sqlcontrol1=$sqlcontrol1." or";
   else
    $sqlcontrol1=$sqlcontrol1." and";
	}
  $sqlcontrol1=$sqlcontrol1." snp_id like '%".$SNP."%'";
  $p=1;
 }
 if($acc!="")
 { if($p==0)
   $sqlcontrol1=$sqlcontrol1." where";
  else
   {if(terms!="")
    $sqlcontrol1=$sqlcontrol1." or";
   else
    $sqlcontrol1=$sqlcontrol1." and";
	}
  $sqlcontrol1=$sqlcontrol1." acc like '%".$acc."%'";
  $p=1;
 }
 if($strand!="")
 {  if($p==0)
   $sqlcontrol1=$sqlcontrol1." where";
  else
   $sqlcontrol1=$sqlcontrol1." and";
   
  $sqlcontrol1=$sqlcontrol1." strand='".$strand."'";
  $p=1;
 }
 if($seed!="")
 {  if($p==0)
   $sqlcontrol1=$sqlcontrol1." where";
  else
   $sqlcontrol1=$sqlcontrol1." and";
  $sqlcontrol1=$sqlcontrol1." seed='".$seed."'";
  $p=1;
 }

 $result2=mysql_query(str_replace("*","count(*)",$sqlcontrol1));       
 $row2=mysql_fetch_array($result2);
 
 if($row2!=0)
 {if($order!="")
  {$sqlcontrol1=$sqlcontrol1." order by ".$order;
  }
  else
  {$sqlcontrol1=$sqlcontrol1." order by "."pre_miRNA";
  }
  $result = mysql_query($sqlcontrol1);
  echo "<br/><font size='+2'><b>SNPs in miRNAs of ".$count[$pp]."</b></font><br>";

$spacies_genome["chimp"]="PanTro2.1";
$spacies_genome["chicken"]="WASHUC2";
   $spacies_genome["cow"]="Btau_4.0";
   $spacies_genome["dog"]="Dog2.0";
   $spacies_genome["horse"]="EquCab2";
   $spacies_genome["mouse"]="NCBIM37";
   $spacies_genome["rattus"]="RGSC3.4";
   $spacies_genome["zebrafish"]="Zv7";
    

  if($requir=="species")

   echo "<br/><font size='-1'>There are ".$row2["count(*)"]." SNPs in ".$count[$pp]." pre-miRNAs.The SNP data are based on  <a href='http://www.ncbi.nlm.nih.gov/projects/SNP/'/>dbSNP version: 132 </a>.The ".$count[$pp]." genome assembly is ".$spacies_genome[$count[$pp]]." .</font>";
  ?>
  
  <table border="1">
  <tr class="ttt2">
  <td width="100"> <a href="<? echo $url."&order=snp_id" ?>">  SNP ID   </a>  
  </td>
  <td> <a href="<? echo $url."&order=chr" ?>">    Chr   </a>   
  </td>
  <td> SNP Pos
  </td>
  <td>  <a href="<? echo $url."&order=pre_miRNA" ?>"> Pre-miRNA </a>
  </td>
 
  <td> Strand
  </td>
  <td> Start
  </td>
  <td> End
  </td>
  <td ><div title="SNP loc relative to pre-miRNA" style="cursor:pointer"> On pre</div>
  </td>
  <td > mature miRNA
  </td>
	  <td ><div title="SNP loc relative to mature miRNA" style="cursor:pointer"> On mat</div>
  </td>
  <td> Mature
  </td>
  </tr>
  <? 
   

 
  while($row = mysql_fetch_array($result))
  {?><tr class="<? if($l==0){echo "ttt1";$l=1;}else{echo "ttt2";$l=0;} ?>">
     <td><a href="http://www.ncbi.nlm.nih.gov/projects/SNP/snp_ref.cgi?rs=<? echo $row["snp_id"]?>" target="_blank">
    <? echo $row["snp_id"];
    ?>
    </a>
	</td>
    <td>
   <? echo $row["chr"];
    ?>
    </td>
    <td>
   <? echo $row["snp_pos"];
    ?>
    </td>
    <td>
	<a href="http://www.mirbase.org/cgi-bin/mirna_entry.pl?acc=<? echo $row["acc"]?>" target="_blank">
   <? echo $row["pre_miRNA"];
    ?>
	</a>
    </td>
  
    <td style="text-align:center">
   <? echo $row["strand"];
    ?>
    </td>
    <td>
   <? echo $row["start"];
    ?>
    </td>
    <td>
   <? echo $row["end"];
    ?>
    </td>
    <td>
   <? echo $row["on_premiR"];
    ?>
    </td>
    <td>
   <? echo $row["miRNA"];
    ?>
    </td>
    <td style="text-align:center">
   <? echo $row["on_miRNA"];
    ?>
    </td>
    <td style="text-align:center">
   <? echo $row["seed"];
    ?>
    </td>
    </tr>
    
    <?
   }
  ?> </table>
  <?
 }
}

}


if($extra!="")
{
?>

<br/>
         <div class="quicksearch">Targets gain/loss search of <? echo $terms ?></div>
<br/>
 
       <table border="1" width="800px"><tr class="ttt2" width="800px"><th> Targets gain/loss by SNP in miRNA seed </th> </tr>
       <? 
	       $sqlcontrol="select count(*) from seed_target_gain_with_base where ".$extra."_id='".$terms."'";
		    $result = mysql_query($sqlcontrol);
		    $row = mysql_fetch_array($result);
		     
		    ?>
			<tr class="ttt1"><td>	&nbsp;&nbsp;&nbsp; <? echo $row["count(*)"] ?> records of <? echo $terms ?>  in target gain dataset. 

			
			<? if($row["count(*)"]>0)
			  {
			   ?>
			   <a href="Targets_cj.php?<? echo $extra ?>=<? echo $terms ?>&gainorlost=gain"> Click for detail </a>.
			   <?
			  }
			?>
			</td></tr>
		  
       <? 
	       $sqlcontrol="select count(*) from seed_target_loss_with_base where ".$extra."_id='".$terms."'";
		    $result = mysql_query($sqlcontrol);
		    $row = mysql_fetch_array($result);
		    ?>
			<tr><td>	&nbsp;&nbsp;&nbsp; <? echo $row["count(*)"] ?> records of <? echo $terms ?> in target loss dataset. 
			
			<? if($row["count(*)"]>0)
			  {
			   ?>
			   <a href="Targets_cj.php?<? echo $extra ?>=<? echo $terms ?>&gainorlost=loss"> Click for detail </a>.
			   <?
			  }
			
		?>  
			</td></tr>
		 
	   <tr class=ttt2 ><th> Targets gain/loss by SNP in gene 3'UTR</th> </tr>
     
       <? 
	       $sqlcontrol="select count(*) from gene_target_gain where ".$extra."_id='".$terms."'";
		    $result = mysql_query($sqlcontrol);
		    $row = mysql_fetch_array($result);
		   ?>
			 <tr><td> &nbsp;&nbsp;&nbsp; <? echo $row["count(*)"] ?> records of  <? echo $terms ?> in target gain dataset. 
			
			<? if($row["count(*)"]>0)
			  {
			   ?>
			   <a href="geneTargets.php?<? echo $extra ?>=<? echo $terms ?>&gainorlost=gain"> Click for detail </a>.
			   <?
			  }
		?>   
       </td></tr><tr><td>
  
       <? 
	        $sqlcontrol="select count(*) from gene_target_lost where ".$extra."_id='".$terms."'";
		    $result = mysql_query($sqlcontrol);
		    $row = mysql_fetch_array($result);
		   ?>
			 &nbsp;&nbsp;&nbsp; <? echo $row["count(*)"] ?> records of <? echo $terms ?> in target loss dataset.
			
			<? if($row["count(*)"]>0)
			  {
			   ?>
			   <a href="geneTargets.php?<? echo $extra?>=<? echo $terms ?>&gainorlost=loss"> Click for detail. </a>.
			</td></tr></table><br>
			<?
			  }
		?>   
     
<?
}
   
?>

</div>
<?
include "footerinclude.php";

?>
