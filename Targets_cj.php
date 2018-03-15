
<?
	$page_title="Targets";
	include "head.php";
	include "pages.php";
include "connectinclude.php";
?>


<div id="content" >
<h2 class="quicksearch"> Targets gain/loss by SNPs in miRNA seed regions</h2>


 <? $gene=$_GET["gene"];?>

<div class="panel panel-info">
	<div class="panel-heading">
		<h4 class="panel-title">Browse From Here</h4>
	</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" name="mirnaSearch2" method="get" action="Targets.php">
			<input type="hidden" name="token" value="<?php echo $token; ?>" />
			<div class="form-group">
				<label class="col-sm-3 control-label">Browse by gene:</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" name="gene">
				</div>
				<span class="help-block">(e.g. ICMT)</span>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Browse by miRNA:</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" name="mirna">
				</div>
				<span class="help-block">(e.g. hsa-miR-33a-3p)</span>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Browse by SNP:</label>
				<div class="col-sm-3">
					<input type="text" class="form-control " name="snp">
				</div>
				<span class="help-block">(e.g. rs77809319)</span>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-6">
					<button class="btn btn-danger" type="submit" name="gainorlost" value="gain">Gain</button>
					<button class="btn btn-primary" type="submit" name="gainorlost" value="loss">Loss</button>
				</div>
			</div>
		</form>
	</div>
</div>


<?
   $mirna=$_GET["mirna"];
   $snp=$_GET["snp"];
   $gainorlost=$_GET["gainorlost"];
	$url=$_SERVER["REQUEST_URI"];
	$parse_url=parse_url($url);
	$url_query=$parse_url["query"];
	if($url_query){
		if(preg_match("/page=/",$url_query)) {
			$url = preg_replace('/&page=\d*/', '', $url);
		}
		$url=$url.'&page';
	}else {
		$url.="?page";
}
?>
<?
   if($mirna==""&&$snp==""&&$gainorlost==""){
		$sqlcontrolTargetComnined = "select * from table9_mir_tarrget_num_info order by miRNA";
		$resultTargetComnined = mysql_query($sqlcontrolTargetComnined);
		$total=mysql_num_rows($resultTargetComnined);
		pages($total,50);
		$sqlcontrolTargetComnined .= " limit $firstcount,$displaypg";
		#	echo $sqlcontrolTargetComnined;
		$resultTargetComnined = mysql_query($sqlcontrolTargetComnined);
		echo "<div style='margin-left:10px'>";
		echo $pagenav;
		echo "</div>";


  ?>
<!--	   table-->
		<div >
			<table class="table table-hover table-bordered">
				<tr class="info">
					<th >miRNA</th>
					<th>Chromosome</th>
					<th>Start</th>
					<th>End</th>
					<th style="text-align:center">SNP in seed</th>
					<th >Numbers of <br>gain target genes</th>
					<th >Numbers of <br>lost target gene</th>
				</tr>
			<?
		$p=1;
		while($thisline=mysql_fetch_array($resultTargetComnined)){
			if($p==1) $p=0; else $p=1;?>
				<tr>
	     			<td><a href="http://www.mirbase.org/cgi-bin/query.pl?terms=<? echo $thisline["miRNA"] ?>" target="_blank"><? echo $thisline["miRNA"]; ?> </a>
					</td>
 					<td style="text-align:center"><? echo $thisline["chr"]; ?></td>
 					<td> <?echo $thisline["miR_start"];?> </td>
 					<td> <?echo $thisline["miR_end"];?> </td>
					<td>
						<a href="http://www.ncbi.nlm.nih.gov/projects/SNP/snp_ref.cgi?rs=<? echo $thisline["SNP_id"] ?>" target="_blank"> <? echo $thisline["SNP_id"] ?> </a>
					</td>
					<td>
                    	<div style="float:left;align:center"><? echo $thisline["gain_num"]; ?></div>
							<form name="mirnaSearch2" METHOD="GET" ACTION="Targets.php" style="float:right">
							<input type="hidden" name="token" value="<?php echo $token; ?>" />
							<input type="hidden" name="mirna" value="<? echo $thisline["miRNA"]?>" />
							<input type="hidden" name="snp" value="<? echo $thisline["SNP_id"]?>" />
							<input type="hidden" name="gainorlost" value="gain" />
								<button type="submit" class="btn btn-danger">Details</button>
							</form>
 					 </td>
					<td>
                     	<div style="float:left"> <? echo $thisline["lost_num"]; ?></div>
						<form name="mirnaSearch2" METHOD="GET" ACTION="Targets.php" style="float:right">
							<input type="hidden" name="token" value="<?php echo $token; ?>" />
						<input type="hidden" name="mirna" value="<? echo $thisline["miRNA"]?>" />
						<input type="hidden" name="snp" value="<? echo $thisline["SNP_id"]?>" />
						<input type="hidden" name="gainorlost" value="loss" />
							<button type="submit" class="btn btn-info">Details</button>
  						</form>
					 </td>
      			</tr>

		<?}?>
			</table>
		</div>

<?		echo "<div>";
		echo $pagenav;
		echo "</div>";
	 }
	else{
		include("pages.php");?>
		<div >
  			<table class="table table-hover table-bordered">
   			<tr class="info">
    			<th>miRNA</th>
    			<th>Target site on <br>gene 3'UTR</th>
				<th>Energy change<br>(kcal/mol) </th>
				<th style="text-align: center">SNP-miRNA/target duplexes </th>
				<th style="text-align: center">Effect by SNP-miRNA</th>
   			</tr>
  			<?	include "connectinclude.php";

	   $sqlcontrol="select * from seed_target_" . $gainorlost . "_with_base where ";
	   $condition = array();
	   if($gene!=""){
		   $tmp = "gene_id='" . $gene . "'" ;
		   array_push($condition,$tmp);
	   }
	   if($mirna!= ""){
		   $tmp = "miRNA_id='" . $mirna . "'" ;
		   array_push($condition,$tmp);
	   }
	   if($snp!= ""){
		   $tmp = "SNP_id='" . $snp . "'" ;
		   array_push($condition,$tmp);
	   }
	   $conditions = join(" AND ", $condition);
	  $sqlcontrol .= $conditions;
	 			$result = mysql_query($sqlcontrol);
				if($result){
				$total=mysql_num_rows($result);
				pages($total,50);
				$sqlcontrol .= "limit $firstcount,$displaypg";
				$result = mysql_query($sqlcontrol);
				$p=1;
				if($result){
				echo $pagenav;
				while($row = mysql_fetch_array($result)){
					$sqlcontrol3="select * from table4_miRNA_SNP where snp_id='".$row["SNP_id"]."'";
					$result3=mysql_query($sqlcontrol3);
					$row3=mysql_fetch_array($result3);
					$snp_allele=substr($row3['ref_allele'],-1);
					$mirlength=$strpos2-$strpos1-1;
					if($p==1) $p=0; else $p=1;?>
					<tr>
						<td>
							<a href="http://www.mirbase.org/cgi-bin/query.pl?terms=<? echo $row["miRNA_id"] ?>" target="_blank"><? echo $row["miRNA_id"]; ?></a><br/>
							<a href="http://www.ncbi.nlm.nih.gov/projects/SNP/snp_ref.cgi?rs=<? echo $row["SNP_id"] ?>" target="_blank"> <? echo $row["SNP_id"]; ?> </a>
						</td>
						<td >
							<? echo $row["gene_id"] ?>
							(<a href = "http://www.ncbi.nlm.nih.gov/nuccore/<? echo $row["NM_id"]?>" target = _blank><? echo $row["NM_id"]."</a>)" ?><br>
								<? echo $row["M_start"]."-".$row["M_end"];?>
						</td>
						<td><? echo "Wild Type: ". $row["wild_energy"]."<br>"."SNP Type: ".$row["snp_energy"];?></td>
						<td	 style="font-size:13px;"><?
							$str=$row["base_pair"];
							echo $str."<br>";
							$enter=0;?>
							<table border="0" cellpadding="0" ><tr><?
								for($i=0;$i<strlen($str);$i++){
									if($str[$i]=="\n") {$enter++;}
									if($enter>=2){
										if($str[$i]=="\n"){?>
								</tr>
								<tr>
									<?}else{?>
										<td><?if($str[$i]=='X'){?>
											<div style="color:#FF0000"><?
												if ($gainorlost=="gain"){
													echo '<b>'.'|'.'<b>';
												}
												else{
												echo '<b>'.X.'<b>';
												}
                                                echo '</div>';
										}elseif($str[$i]=='S'){?>
											<div style="color:#F0F;font-weight:bold;">
												<a title="<? echo $row1['original_allele'].'--->'.$row1['snp_allele']; ?>" href="http://www.ncbi.nlm.nih.gov/projects/SNP/snp_ref.cgi?rs=<? echo $row["SNP_id"] ?>" style="cursor:pointer"  target="_blank"><?echo $snp_allele;?></a>
											</div><?}
										else{
											echo $str[$i];
										}
										?>
										</td>
									<?}
									}
									}?>
								</tr>
							</table>
            			</td>
							<td style="text-align:center"><? echo $gainorlost ?> </td>
						</tr>
 <?}}}?>
			</table>
			<? echo $pagenav;?>
		</div>

 <div style="float:right"><a href="Targets.php">Back to the list of MiRNA</a></div>
 <? }?>

</div>



<?
include "footerinclude.php";

?>
