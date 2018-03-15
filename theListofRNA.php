<?php
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
# Check URL
if ($_SERVER["SCRIPT_NAME"] != $_SERVER["PHP_SELF"]) {
    echo '<script>
        alert("Input is illegal, you are return back ^.^!");
        // window.history.back();
        document.location.href="/miRNASNP2";
    </script>';
    exit;
}

# Exclude illegal query
if (preg_match("/[\'\(\):;=\"<>]/", urldecode($_SERVER["QUERY_STRING"]))) {
    echo '<script>
        alert("Input is illegal, you are return back ^.^!");
        // window.history.back();
        document.location.href="/miRNASNP2";
    </script>';
    exit;
}


?>
<?php
	$page_title="miRNASNP:the list of SNP-miRNA";
	include "head.php";
	?>

<script language="javascript">
        function showComment(layerName,action)  {
                if(action =="show"){
                        document.getElementById(layerName).style.visibility="visible";
                }
                else if(action=="hide"){
                        document.getElementById(layerName).style.visibility="hidden";
                }
        }
</script>


<div id="content" style="font-size:16px">

<?php
	//set species
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
if(isset($_GET['hash'])){
	if ($_GET['hash'] != $_COOKIE['cookie'])
	{
		// var_dump($_COOKIE['cookie']);
		echo '<script>alert("Please make sure the correct input.");history.back();</script>';
		exit;
	}
}

	//get input information,the url
   $url= $_SERVER["REQUEST_URI"];

	//SNPs in the flanking regions or
	//SNPs in the reed regions
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

	//connect to database
  include "connectinclude.php";

	// to define terms belong to which [snp miRNA acc gene]
	// it's cost too much resource to test terms because of searching all tables in database
if($terms!=""){
	   $terms=trim($terms);
		// terms to SNP
	   //Chicken table
        $sqlcontrol1="select * from chicken_info where snp_id like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["acc"]!="")
		  {
		   $species["chicken"]++;
		   $SNP=$terms;
		  }

	   //Chimp table
		$sqlcontrol1="select * from chimp_info where snp_id like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["acc"]!="")
		  {
		   $species["chimp"]++;
		   $SNP=$terms;
		  }

	   //Cow table
		$sqlcontrol1="select * from cow_info where snp_id like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["acc"]!="")
		 {
		   $species["cow"]++;
		   $SNP=$terms;
		  }

	   //Dog table
		$sqlcontrol1="select * from dog_info where snp_id like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["acc"]!="")
		  {$species["dog"]++;
		   $SNP=$terms;
		  }

	   //Horse table
		$sqlcontrol1="select * from horse_info where snp_id like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["acc"]!="")
		  {$species["horse"]++;
		     $SNP=$terms;
		  }

	   //mouse table
		$sqlcontrol1="select * from mouse_info where snp_id like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["acc"]!="")
		  {$species["mouse"]++;
		   $SNP=$terms;
		  }

	   //rattus table
		$sqlcontrol1="select * from rattus_info where snp_id like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["acc"]!="")
		  {$species["rattus"]++;
		     $SNP=$terms;
		  }

	   //Zebrafish table
		$sqlcontrol1="select * from zebrafish_info where snp_id like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["acc"]!="")
		  {$species["zebrafish"]++;
		    $SNP=$terms;
	      }

	   //miRNA SNP table4 is human
		$sqlcontrol1="select * from table4_miRNA_SNP  where snp_id like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		  {$species["human"]++;
		    $SNP=$terms;
		  }

	   // flank table8 is human
		$sqlcontrol1="select * from table8_flank_down where snp_id like '%".$terms."%'";
		$result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["snp_id"]!="")
		  {$species["human"]++;
		    $SNP=$terms;
		  }

	   //terms to acc
	   //chiken acc
	    $sqlcontrol1="select * from chicken_info where acc like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		  {$species["chicken"]++;
		   $acc=$terms;
		  }

	   //chimp acc
		$sqlcontrol1="select * from chimp_info where acc like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		  {$species["chimp"]++;
		    $acc=$terms;
		  }

	   //cow acc
		$sqlcontrol1="select * from cow_info where acc like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		 { $species["cow"]++;
		  $acc=$terms;
		  }

	   //dog acc
		$sqlcontrol1="select * from dog_info where acc like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		  {$species["dog"]++;
		   $acc=$terms;
		  }

	   //horse acc
		$sqlcontrol1="select * from horse_info where acc like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		 { $species["horse"]++;
		  $acc=$terms;
		  }

	   //mouse acc
		$sqlcontrol1="select * from mouse_info where acc like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		 { $species["mouse"]++;
		  $acc=$terms;
		  }

	   //rattus acc
		$sqlcontrol1="select * from rattus_info where acc like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		  {$species["rattus"]++;
		   $acc=$terms;
		  }

	   //zebrafish acc
		$sqlcontrol1="select * from zebrafish_info where acc like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		 { $species["zebrafish"]++;
		  $acc=$terms;
		  }

	   //pre miRNA acc
		$sqlcontrol1="select * from table1_pre_miRNA  where acc like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["id"]!="")
		  {$species["human"]++;
		   $acc=$terms;
		  }

	   //flank acc
		$sqlcontrol1="select * from table8_flank_down where acc like '%".$terms."%'";
		$result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["acc"]!="")
		  {$species["human"]++;
		    $acc=$terms;
		  }

	   //chicken pre_miRNA
	   $sqlcontrol1="select * from chicken_info where pre_miRNA like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		  {$species["chicken"]++;
		   $miRNA=$terms;
		  }

	   //chimp pre_miRNA
		$sqlcontrol1="select * from chimp_info where pre_miRNA like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		  {$species["chimp"]++;
		    $miRNA=$terms;
		  }

	   //cow pre_miRNA
		$sqlcontrol1="select * from cow_info where pre_miRNA like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		 { $species["cow"]++;
		  $miRNA=$terms;
		  }

	   //dog pre_miRNA
		$sqlcontrol1="select * from dog_info where pre_miRNA like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		  {$species["dog"]++;
   		   $miRNA=$terms;
		  }

	   //horse pre_miRNA
	  	$sqlcontrol1="select * from horse_info where pre_miRNA like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		 { $species["horse"]++;
		  $miRNA=$terms;
		  }

	   //mouse pre_miRNA
		$sqlcontrol1="select * from mouse_info where pre_miRNA like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		 { $species["mouse"]++;
		  $miRNA=$terms;
		  }

	   //rattus pre_miRNA
		$sqlcontrol1="select * from rattus_info where pre_miRNA like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		  {$species["rattus"]++;
		   $miRNA=$terms;
		  }

	   //zebrafish pre_miRNA
		$sqlcontrol1="select * from zebrafish_info where pre_miRNA like '%".$terms."%'";
	    $result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		 { $species["zebrafish"]++;
		  $miRNA=$terms;
		  }

	   //human miRNA_SNP premir
		$sqlcontrol1="select * from table4_miRNA_SNP where premir like '%".$terms."%'";
		$result = mysql_query($sqlcontrol1);
		$row = mysql_fetch_array($result);
		if($row["snp_id"]!="")
		  {
			  $species["human"]++;
		   $miRNA=$terms;
		  }

	   // human flank miRNAid
		$sqlcontrol1="select * from table8_flank_down where miRNAid like '%".$terms."%'";
		$result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["miRNAid"]!="")
		  {$species["human"]++;
		    $miRNA=$terms;
		  }

	    // gene target gain  gene_id
		$sqlcontrol1="select * from gene_target_gain where gene_id='".$terms."'";
		$result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["miRNA_id"]!="")
		  {$gene=$terms;
		   $extra="gene";
		   $gene_target_gain="gain";
		  }

	   //gene target lost gene_id
		$sqlcontrol1="select * from gene_target_lost where gene_id='".$terms."'";
        $result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["miRNA_id"]!="")
		  {$gene=$terms;
		   $extra="gene";
		   $gene_target_loss="loss";
		  }

	   //seed target_gain with base gene_id
		$sqlcontrol1="select * from seed_target_gain_with_base where gene_id='".$terms."'";
        $result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["miRNA_id"]!="")
		  {$gene=$terms;
		   $extra="gene";
		   $seed_target_gain="gain";
		  }

	   //seed target loss with base gene id
		$sqlcontrol1="select * from seed_target_loss_with_base where gene_id='".$terms."'";
        $result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["miRNA_id"]!="")
		  {$gene=$terms;
		   $extra="gene";
		   $seed_target_loss="loss";
		  }

		//gene target gain snp id
		$sqlcontrol1="select * from gene_target_gain where SNP_id='".$terms."'";
		$result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["miRNA_id"]!="")
		  {
			  $extra="snp";
		   $gene_target_gain="gain";
		  }

	   //gene target loss snp id
		$sqlcontrol1="select * from gene_target_lost where SNP_id='".$terms."'";
        $result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["miRNA_id"]!="")
		  {$extra="snp";
		   $gene_target_loss="loss";
		  }

	   //seed target gain with base snp id
		$sqlcontrol1="select * from seed_target_gain_with_base where SNP_id='".$terms."'";
        $result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["miRNA_id"]!="")
		  {$extra="snp";
		   $seed_target_gain="gain";
		  }

	   // seed target loss with base snp id
		$sqlcontrol1="select * from seed_target_loss_with_base where SNP_id='".$terms."'";
        $result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["miRNA_id"]!="")
		  {$extra="snp";
		   $seed_target_loss="loss";
		  }

	   //gene target gain miRNA id
		$sqlcontrol1="select * from gene_target_gain where miRNA_id='".$terms."'";
		$result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["miRNA_id"]!="")
		  {$extra="mirna";
		   $gene_target_gain="gain";
		  }

	   //gene target lost miRNA id
		$sqlcontrol1="select * from gene_target_lost where miRNA_id='".$terms."'";
        $result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["miRNA_id"]!="")
		  {$extra="mirna";
		   $gene_target_loss="loss";
		  }

	   //seed target gain with base miRNA id
		$sqlcontrol1="select * from seed_target_gain_with_base where miRNA_id='".$terms."'";
        $result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["miRNA_id"]!="")
		  {$extra="mirna";
		   $seed_target_gain="gain";
		  }

	   //seed target loss with base miRNA id
		$sqlcontrol1="select * from seed_target_loss_with_base where miRNA_id='".$terms."'";
        $result=mysql_query($sqlcontrol1);
		$row=mysql_fetch_array($result);
		if($row["miRNA_id"]!="")
		  {$extra="mirna";
		   $seed_target_loss="loss";
		  }

  }

	//set $species['']=0 if terms1==flanking
if($terms1=='flanking'){
	  $species["human"]++;
	  for($pp=1;$pp<=8;$pp++)
	  $species[$count[$pp]]=0;
  }

$pp=9;

if($miRNA==""&&$acc==""&&$SNP==""&&$chr==""&&$_GET["species"]==""&&$gene==""&&$gene_target_loss==""&&$gene_target_gain==""&&$seed_target_gain==""&&$seed_target_loss=="")
{
	echo "<br>No items found, please check your search term and try again.";
}

if($species[$count[$pp]] >= 1 && ($miRNA!=""||$acc!=""||$SNP!=""||$chr!=""||$_GET["species"]=="human") ){
	if($terms1==""){
		$sqlcontrol1="select * from table4_miRNA_SNP";
		$sqlcontrol2="select * from table8_flank_down";
	}
	else{
		 $sqlcontrol1="select * from table8_flank_down";
	  }
 	$p=0;
	 if($miRNA!=""){
		 if($terms1==""){
			 $sqlcontrol1=$sqlcontrol1." where premir like '%".$miRNA."%'";
			 $sqlcontrol2=$sqlcontrol2." where miRNAid like '%".$miRNA."%'";
		 }
		 else{
			 $sqlcontrol1=$sqlcontrol1." where miRNAid like '%".$miRNA."%'";
		 }
		$p=1;
	 }
	 if($SNP!=""){
		 if($p==0){
			 $sqlcontrol1=$sqlcontrol1." where";
			 $sqlcontrol2=$sqlcontrol2." where";
		}
		  else{
			  if($terms!=""){
				  $sqlcontrol1=$sqlcontrol1." or";
				  $sqlcontrol2=$sqlcontrol2." or";
			  }
		   else{
			   $sqlcontrol1=$sqlcontrol1." and";
			   $sqlcontrol2=$sqlcontrol2." and";
		   }
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

	//add order
	 if($row2["count(*)"]!=0){
		 if($order!=""){
			 $sqlcontrol1=$sqlcontrol1." order by ".$order."";
	  	}
		 else{
			 if($terms1=="") $sqlcontrol1=$sqlcontrol1." order by premir";
			 else $sqlcontrol1=$sqlcontrol1." order by miRNAid";
		 }
	 }

	 $sqlcontrol2=$sqlcontrol2." order by miRNAid";

	 $result = mysql_query($sqlcontrol1);
	 $result2=mysql_query($sqlcontrol2);

	 $resultcount1=mysql_query(str_replace("*","count(*)",$sqlcontrol1));
	 $rowcount1=mysql_fetch_array($resultcount1);

	 if($terms1==""){
		 $resultcount2=mysql_query(str_replace("*","count(*)",$sqlcontrol2));
		 $rowcount2=mysql_fetch_array($resultcount2);
	 }

	 if($terms1==""){
		 if($rowcount1["count(*)"]!=0){
			 echo '<p class="quicksearch">SNPs in human pre-miRNA regions</p>';
		}
		 if($requir=="pre")echo "<p>There are 2257 SNPs in human pre-miRNA regions.The SNP data are based on  <a href='http://www.ncbi.nlm.nih.gov/projects/SNP/'/>dbSNP version: 137 </a>.The human genome assembly is NCBI GRCh37. You can click on your interesting  miRNA in the following table to see details, including miRNA information and SNP information. Energy change represents the minimum free energy(MFE) of SNP-miRNA minus MFE of wild-miRNA. Predicted product represents the effect of SNP on the maturation of miRNA. Up means the SNP may up-regulate the product of miRNA, while down means the SNP may down-regulate the miRNA product and mild means the SNP slightly or do not change the product of miRNA.   <br/></p>";
	   }
	 else{
		 echo '<p class="quicksearch">miRNAs with SNPs in pre-miRNA flanking regions (-1kb, +1kb)</p>';
		 if($requir=="chr")echo "<p>There are ".$num." pre-miRNAs on human Chromosome ".$chr.". The miRNA data are based on <a href='http://www.mirbase.org/'>miRBase release 19</a>. The human genome assembly is NCBI GRCh37.</p>";
	 }
	?>
<?
	 if($terms1==""){
		if($rowcount1["count(*)"]!=0){?>
			<table class="table table-hover table-bordered nolinkcolor">
				<tr class="info nolinkcolor">
					<th>
						<div style="float:left">Pre-miRNA&nbsp;</div>
						<div style="float:left">
							<a href="<? echo $url."&order=premir" ?>" title="order by snp">
								<img src="image/sort.png" width="15" height="15" />
							</a>
						</div>
					</th>
					<th>
						<div style="float:left">SNP ID&nbsp;</div>
						<div style="float:left">
							<a href="<? echo $url."&order=snp_id" ?>" title="order by snp">
								<img src="image/sort.png" width="15" height="15" />
							</a>
						</div>
					</th>
					<th>
						<div style="float:left">Chromosome</div>
						<div style="float:left">
							<a href="<? echo $url."&order=chr" ?>" title="order by chromosome">
								<img src="image/sort.png" width="15" height="15" />
							</a>
						</div>
					</th>
					<th>SNP Positon</th>
					<th style="text-align:center;word-break:break-all;">Allele</th>
					<th style="text-align:center">
						<div style="float:left">Location&nbsp;</div>
						<div style="float:left">
							<a href="<? echo $url."&order=seed" ?>" title="order by location">
								<img src="image/sort.png" width="15" height="15" />
							</a>
						</div>
					</th>
					<th>Energy change(kcal/mol)</th>
					<th>Predicted product</th>
				</tr>
		<?}
	 }
	 else{
		 ?>
  <br/>
	  <table class="table table-hover table-bordered">
		 <tr class="info">
			 <th >miRNA</th>
			 <th>ACC</th>
			 <th >Chromosome</th>
			 <th>Start</th>
			 <th>End</th>
			 <th>miRNA strand</th>
			 <th style="text-align: center">Numbers of SNPs <br/>up/down</th>
		 </tr>
	<?
  }
	if($terms1==""){
		if($rowcount1["count(*)"]!=0){
			$l=0;
			while($row = mysql_fetch_array($result)){?>
				<tr>
					<td>
						<a href="miRNA_details.php?id=<? echo $row["premir"] ?>">
							<b style="color:red"><? echo $row["premir"];?></b>
						</a>
					</td>
					<td><? echo $row["snp_id"];?></td>
					<td><? echo $row["chr"];?></td>
					<td><? echo $row["snp_pos"];?></td>
					<td>
						<div  style="text-align:center;word-break:break-all;overflow:auto;"><? echo $row["ref_allele"];?>
						</div>
					</td>
					<td style="text-align:center">
						<? if($row["seed"]=="in_m")
							echo "in_mature";
						else
							if($row["seed"]=="in_seed")
								echo "in_seed";
							else
								echo "pre-miRNA";?>
					</td>
					<?
					$mir_e=$row["premir"];
					$snp_e=$row["snp_id"];
					$sqlcontrol_e="select *  from table6_energy where premiRNA='$mir_e' and snp='$snp_e'";
					$result_e = mysql_query($sqlcontrol_e);
					$energy=mysql_fetch_array($result_e);
					?>
					<td style="text-align:center"><?echo $energy[4];?></td>
					<td style="text-align:center">
						<? if($energy[4]>=2)
							echo "down";
						elseif($energy[4]<=-2)
							echo "up";
						else
							echo "mild";
						?>
					</td>
		</tr>
		 <?}?>
		 </table>
		 <?
	  }
		if($terms!=""){
		  if($rowcount2["count(*)"]!=0){?>
			 <p class="quicksearch">SNPs in the pre-miRNA flanking regions (-1kb ~ +1kb)</p>
			  <table class="table table-hover table-bordered">
			  <tr class="info">
				  <th>miRNA</th>
				  <th>ACC</th>
				  <th>Chromosome</th>
				  <th>Start</th>
				  <th>End</th>
				  <th>miRNA strand</th>
				  <th style="text-align:center">Numbers of SNPs <br/> up/down</td>
			  </tr>
			  <?
			  $l=0;
			  $pll="";
			  while($row = mysql_fetch_array($result2)){
				  if($pll!=$row["miRNAid"]){
					  $pll=$row["miRNAid"];
					  $sqlcontrolup="select count(miRNAid) from table8_flank_down "."where miRNAid='".$pll."' and loc='up'";
					  $resultup = mysql_query($sqlcontrolup);
					  $rowup=mysql_fetch_array($resultup);
					  $sqlcontroldown="select count(miRNAid) from table8_flank_down "."where miRNAid='".$pll."' and loc='down'";
					  $resultdown = mysql_query($sqlcontroldown);
					  $rowdown=mysql_fetch_array($resultdown);
					  ?>
					  <tr>
						  <td>
							  <a href="snpinflanking.php?id=<? echo $row["miRNAid"] ?>">
								  <b style="color:red"><? echo $row["miRNAid"];?></b>
							  </a>
						  </td>
						  <td><? echo $row["acc"];?></td>
						  <td><? echo $row["chr"];?></td>
						  <td><? echo $row["start"];?></td>
						  <td><? echo $row["end"];?></td>
						  <td style="text-align:center"><? echo $row["strand"];?></td>
						  <td style="text-align:center">
							  <? echo $rowup["count(miRNAid)"]."/".$rowdown["count(miRNAid)"]; ?>
						  </td>
					  </tr>
				  <?
				  }
			  }
			  ?></table><?}
		}
	}
	else{
		  $l=0;
		  $pll="";
		  while($row = mysql_fetch_array($result)){
			  if($pll!=$row["miRNAid"]){
				  $pll=$row["miRNAid"];
				  $sqlcontrolup="select count(miRNAid) from table8_flank_down "."where miRNAid='".$pll."' and loc='up'";
				  $resultup = mysql_query($sqlcontrolup);
				  $rowup=mysql_fetch_array($resultup);
				  $sqlcontroldown="select count(miRNAid) from table8_flank_down "."where miRNAid='".$pll."' and loc='down'";
				  $resultdown = mysql_query($sqlcontroldown);
				  $rowdown=mysql_fetch_array($resultdown);
		   ?>
			 <tr>
				 <td>
					 <a href="snpinflanking.php?id=<? echo $row["miRNAid"] ?>">
						 <b style="color:red"><? echo $row["miRNAid"];?></b>
					 </a>
				 </td>
				 <td>
					 <? echo $row["acc"];?>
				 </td>
				 <td>
					 <? echo $row["chr"];?>
				 </td>
				 <td>
					 <? echo $row["start"];?>
				 </td>
				 <td>
					 <? echo $row["end"];?>
				 </td>
				 <td style="text-align:center">
					 <? echo $row["strand"];?>
				 </td>
				 <td style="text-align:center">
					 <? echo $rowup["count(miRNAid)"]."/".$rowdown["count(miRNAid)"];?>
				 </td>
			</tr>
			 <?}
		  }?>
		  </table>
	  <?}
}

for($pp=1;$pp<=8;$pp++) {
	if($species[$count[$pp]]>=1 && ($miRNA!="" && $SNP!="" && $acc!="" || $_GET["species"]!="")){
		 $sqlcontrol1="select * from ".$count[$pp]."_info";
		 $p=0;

		 if($miRNA!="")
		 {
			 $sqlcontrol1=$sqlcontrol1." where pre_miRNA like '%".$miRNA."%'";
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

		 if($row2!=0){
			 if($order!="")
		  {$sqlcontrol1=$sqlcontrol1." order by ".$order;
		  }
			 else{
			  $sqlcontrol1=$sqlcontrol1." order by "."pre_miRNA";
		  }
			 $result = mysql_query($sqlcontrol1);
			 $total =  mysql_query( str_replace('*','count(*)',$sqlcontrol1));
			 $total = mysql_fetch_array($total);
			 $total = $total['count(*)'];
			 echo "<p class='quicksearch'>SNPs in miRNAs of  $count[$pp] (total: $total)</p>";

			 $spacies_genome["chimp"]="PanTro2.1";
			 $spacies_genome["chicken"]="WASHUC2";
			 $spacies_genome["cow"]="Btau_4.0";
			 $spacies_genome["dog"]="Dog2.0";
			 $spacies_genome["horse"]="EquCab2";
			 $spacies_genome["mouse"]="NCBIM37";
			 $spacies_genome["rattus"]="RGSC3.4";
			 $spacies_genome["zebrafish"]="Zv7";

		  if($requir=="species")echo "<p>There are ".$row2["count(*)"]." SNPs in ".$count[$pp]." pre-miRNAs. The SNP data are based on  <a href='http://www.ncbi.nlm.nih.gov/projects/SNP/'/>dbSNP version: 137 </a>. The ".$count[$pp]." genome assembly is ".$spacies_genome[$count[$pp]]." .</p>";
		  ?>

		  <table class="table table-hover table-bordered">
		  <tr class="info">
			  <th >
				  SNP ID
				  <a href="<? echo $url . "&order=snp_id" ?>">
					  <img src="image/sort.png" width="15" height="15" />
				  </a>
			  </th>
			  <th>
				  Chr <a href="<? echo $url."&order=chr" ?>">
					  <img src="image/sort.png" width="15" height="15" />
				  </a>
			  </th>
			  <th>SNP Position</th>
			  <th>
				  Pre-miRNA
				  <a href="<? echo $url."&order=pre_miRNA" ?>">
					  <img src="image/sort.png" width="15" height="15" />
				  </a>
			  </th>
			  <th>Strand</th>
			  <th> Start</th>
			  <th> End</th>
			  <th>
				  <div title="SNP location relative to pre-miRNA" style="cursor:pointer">
					  On pre-miRNA
				  </div>
			  </th>
			  <th >
				  <div title="SNP location relative to mature miRNA" style="cursor:pointer"> On mature miRNA</div>
			  </th>
		  </tr>
		  <?
		  while($row = mysql_fetch_array($result)){?>
			  <tr>
				  <td>
					  <a href="http://www.ncbi.nlm.nih.gov/projects/SNP/snp_ref.cgi?rs=<? echo $row["snp_id"]?>"target="_blank" style="color:red">
						  <? echo $row["snp_id"];?>
					  </a>
				  </td>
				  <td>
					  <?echo $row["chr"];?>
				  </td>
				  <td><?echo $row["snp_pos"];?></td>
				  <td>
					  <a href="http://www.mirbase.org/cgi-bin/mirna_entry.pl?acc=<? echo $row["acc"]?>" target="_blank" style="color:red"><? echo $row["pre_miRNA"];?>
					  </a>
				  </td>
				  <td style="text-align:center">
					  <? echo $row["strand"];?>
				  </td>
				  <td>
					  <? echo $row["start"];?>
				  </td>
				  <td>
					  <? echo $row["end"];?>
				  </td>
				  <td style="text-align:center">
					  <? echo $row["on_premiR"];?>
				  </td>
				  <td style="text-align:center">
					  <? echo $row["on_miRNA"];?>
				  </td>
			  </tr>
			<?}?>
		  </table>
		 <?}
	}
}?>
</div>

<?
	include "footerinclude.php";
?>
