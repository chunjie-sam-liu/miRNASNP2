<?

// $regex='/[#$%^&*()+=\[\]\';,.\/{}|":<>?~\\\\]/';
//
//         if (empty($terms) || preg_match($regex,$terms))
//         {
//                 echo '<script>alert("Please input correct ");history.back();</script>';
//                 exit;
//         }



        if(isset($_GET['hash'])){
            if ($_GET['hash'] != $_COOKIE['cookie'])
            {
                // var_dump($_COOKIE['cookie']);
                echo '<script>
                    alert("Input is illegal, you are return back ^.^!");
                    window.history.back();
                    // document.location.href="/miRNASNP2";
                </script>';
                exit;
            }
        }
        if ($_SERVER["SCRIPT_NAME"] != $_SERVER["PHP_SELF"]) {
            echo '<script>
                alert("Input is illegal, you are return back ^.^!");
                // window.history.back();
                document.location.href="/miRNASNP2";
            </script>';
            exit;
        }

        # Exclude illegal query
        if (preg_match("/[\'\(\):;\"<>]/", urldecode($_SERVER["QUERY_STRING"]))) {
            echo '<script>
                alert("Input is illegal, you are return back ^.^!");
                // window.history.back();
                document.location.href="/miRNASNP2";
            </script>';
            exit;
        }



	include "head.php";


	?>


<div id="content" style="font-family:Arial, Helvetica, sans-serif; font-size:16px">



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
   $terms=strtolower(trim($_REQUEST['terms']));
	//加入preg_match_all,进行正则过滤，防止sql注入

	if(isset($_GET['hash'])){
	if ($_GET['hash'] != $_COOKIE['cookie'])
	{
		echo '<script>alert("Please make sure the correct input.");history.back();</script>';
		exit;
	}
}
	// $regex = "/\/|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\=|\\\|\|/";
	// $regex="/^[a-zA-Z0-9_\-\.]+$/";
	$regex='/[#$%^&*()+=\[\]\';,.\/{}|":<>?~\\\\]/';

	if (empty($terms) || preg_match_all($regex,$terms))
	{
		echo '<script>alert("Please input correct ");
        document.location.href="/miRNASNP2";</script>';
		exit;
	}
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

		$sqlcontrol1="select * from seed_target_gain_with_base where gene_id='".$terms."'";
        $result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["miRNA_id"]!="")
		  {$gene=$terms;
		   $extra="gene";
		   $seed_target_gain="gain";
		  }

		$sqlcontrol1="select * from seed_target_loss_with_base where gene_id='".$terms."'";
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

		$sqlcontrol1="select * from seed_target_gain_with_base where SNP_id='".$terms."'";
        $result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["miRNA_id"]!="")
		  {$extra="snp";
		   $seed_target_gain="gain";
		  }

		$sqlcontrol1="select * from seed_target_loss_with_base where SNP_id='".$terms."'";
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

		$sqlcontrol1="select * from seed_target_gain_with_base where miRNA_id='".$terms."'";
        $result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["miRNA_id"]!="")
		  {$extra="mirna";
		   $seed_target_gain="gain";
		  }

		$sqlcontrol1="select * from seed_target_loss_with_base where miRNA_id='".$terms."'";
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
    {echo "<div class=\"quicksearch\">SNPs in human pre-miRNA regions</div>";
    }
	if($requir=="pre")
	 echo "<font size='+0'>There are ".$row2["count(*)"]." SNPs in human pre-miRNA regions.The SNP data are based on  <a href='http://www.ncbi.nlm.nih.gov/projects/SNP/'/>dbSNP version: 132 </a>.The human genome assembly is NCBI GRCh37.<br/></font>";

   }
  else
   {
    echo "<div class=\"quicksearch\">miRNAs with SNPs in pre-miRNA flanking regions (-1kb, +1kb)</div>";
    if($requir=="chr")
	 echo "<font size='+0'>There are ".$num." pre-miRNAs on of human Chromosome ".$chr.".The miRNA data are based on <a href='http://www.mirbase.org/'>miRBase release 16</a>.The human genome assembly is NCBI GRCh37.</font>";


   }
 ?>
    <?
 if($terms1=="")
 {if($rowcount1["count(*)"]!=0)
  {
 ?>

  <table class="table table-hover table-bordered">
    <tr class="info">
   <th > <a href="<? echo $url."&order=premir" ?>">  Pre-miRNA  </a>
   </th>
   <th> <a href="<? echo $url."&order=snp_id" ?>">  SNP ID  </a>
   </th>
   <th> <a href="<? echo $url."&order=chr" ?>">  Chromosome   </a>
   </th>
   <th>SNP Positon
   </th>

   <th style="text-align:center" >Allele
   </th>
   <th style="text-align:center">Location
   </th>
   </tr>
  <?
   }
  }
  else
  {?>
  <br/>
  <br/>
  <table class="table table-hover table-bordered ">
     <tr class="info">
	 <th >miRNA
	 </th>
	 <th>ACC
	 </th>
	 <th>Chromosome
	 </th>
	 <th>Start
	 </th>
	 <th>End
	 </th>
	 <th>miRNA strand
	 </th>
	 <th>Numbers of SNPs  up/down
	 </th>
	 </tr>
	<?
  }
  if($terms1=="")
  {
   if($rowcount1["count(*)"]!=0)
   {
  $l=0;

    while($row = mysql_fetch_array($result))
    {?><tr>

           <td>

				     <a href="miRNA_details.php?id=<? echo $row["premir"] ?>">
		             <b style="color:red"><? echo $row["premir"];?></b>

		   </a>
		   </td>

	  <td><? echo $row["snp_id"];
	       ?>
      </td>
	  <td ><? echo $row["chr"];
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
         <div class="quicksearch">SNPs in the pre-miRNA flanking regions (-1kb ~ +1kb)</div>
         <br/>
	     <table class="table table-hover table-bordered nolinkcolor">
	     <tr class="info">
	     <th>miRNA
	     </th>
	     <th>ACC
	     </th>
	      <th>Chromosome
	      </th>
	      <th>Start
	       </th>
	      <th>End
	      </th>
	      <th>miRNA strand
	      </th>
	       <th style="text-align:center">Numbers of SNPs <br/> up/down
	      </th>
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
     <tr >

           <td>

		         <a href="snpinflanking.php?id=<? echo $row["miRNAid"] ?>">
		          <b style="color:red"><? echo $row["miRNAid"];?></b>
                 </a>

		   </td>

	  <td ><? echo $row["acc"];
	       ?>
      </td>
	  <td ><? echo $row["chr"];
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
     <tr >

           <td>

		         <a href="snpinflanking.php?id=<? echo $row["miRNAid"] ?>">
		          <b style="color:red"><? echo $row["miRNAid"];?></b>
                 </a>

		   </td>

	  <td ><? echo $row["acc"];
	       ?>
      </td>
	  <td ><? echo $row["chr"];
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

  <table class="table table-hover table-bordered nolinkcolor">
  <tr class="info">
  <th > <a href="<? echo $url."&order=snp_id" ?>">  SNP ID   </a>
  </th>
  <th> <a href="<? echo $url."&order=chr" ?>">    Chr   </a>
  </th>
  <th> SNP Pos
  </th>
  <th>  <a href="<? echo $url."&order=pre_miRNA" ?>"> Pre-miRNA </a>
  </th>

  <th> Strand
  </th>
  <th> Start
  </th>
  <th> End
  </th>
  <th><div title="SNP loc relative to pre-miRNA" style="cursor:pointer"> On pre</div>
  </th>
  <th > mature miRNA
  </th>
	  <th ><div title="SNP loc relative to mature miRNA" style="cursor:pointer"> On mat</div>
  </th>
  <td> Mature
  </td>
  </tr>
  <?



  while($row = mysql_fetch_array($result))
  {?><tr >
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


if($extra!="") {?>
	<div class="quicksearch">Targets gain/loss search of <? echo $terms ?></div><br/>
	<table class="table table-hover table-bordered nolinkcolor">
	<tr class="info">
		<th> Targets gain/loss by SNP in miRNA seed </th>
	</tr>
	<?
	$sqlcontrol="select count(*) from seed_target_gain_with_base where ".$extra."_id='".$terms."'";
	$result = mysql_query($sqlcontrol);
	$row = mysql_fetch_array($result);
	?>

	<tr >
		<td style="font-size: 18px;vertical-align: baseline"><? echo $row["count(*)"] ?> records of <? echo $terms ?>  in target gain dataset.
	<? if($row["count(*)"]>0) {?>
		<a href="Targets.php?<? echo $extra ?>=<? echo $terms ?>&gainorlost=gain"><button class="btn btn-danger btn-sm">Click for Details</button></a>
	<?}?>
		</td>
	</tr>

	<?
	$sqlcontrol="select count(*) from seed_target_loss_with_base where ".$extra."_id='".$terms."'";
	$result = mysql_query($sqlcontrol);
	$row = mysql_fetch_array($result);
	?>
	<tr>
		<td style="font-size: 18px;vertical-align: baseline"><? echo $row["count(*)"] ?> records of <? echo $terms ?> in target loss dataset.
			<? if($row["count(*)"]>0) {?>
				<a href="Targets.php?<? echo $extra ?>=<? echo $terms ?>&gainorlost=loss"><button class="btn  btn-primary btn-sm">Click for Details</button></a>
			<?}?>
			</td>
	</tr>

	<tr class="info"><th> Targets gain/loss by SNP in gene 3'UTR</th> </tr>

	<?
	$sqlcontrol="select count(*) from gene_target_gain where ".$extra."_id='".$terms."'";
	$result = mysql_query($sqlcontrol);
	$row = mysql_fetch_array($result);
	?>

	<tr>
		<td style="font-size: 18px;vertical-align: baseline"><? echo $row["count(*)"] ?> records of  <? echo $terms ?> in target gain dataset.
			<? if($row["count(*)"]>0) {?>
				<a href="geneTargets.php?<? echo $extra ?>=<? echo $terms ?>&gainorlost=gain">
					<button class="btn btn-danger btn-sm">Click for Details</button>
				</a>
			<?}?>
		</td>
	</tr>
		<?
		$sqlcontrol="select count(*) from gene_target_lost where ".$extra."_id='".$terms."'";
		$result = mysql_query($sqlcontrol);
		$row = mysql_fetch_array($result);
		?>

	<tr>
		<td style="font-size: 18px;vertical-align: baseline"><? echo $row["count(*)"] ?> records of <? echo $terms ?> in target loss dataset.
			<? if($row["count(*)"]>0){?>
			<a href="geneTargets.php?<? echo $extra?>=<? echo $terms ?>&gainorlost=loss">
			<button class="btn btn-primary btn-sm">Click for Details</button>
			</a>
			<?}?>
		</td>
	</tr>

	</table>
<?}?>
</div>

<?
include "footerinclude.php";

?>
