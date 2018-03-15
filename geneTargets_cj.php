

	<?
	$page_title="SNP in UTR";
	   include "head.php";
	   include "pages.php";
	?>

<div id="content">
	<h2 class="quicksearch"> Targets gain/loss by SNPs in genes' 3'UTR</h2>

<? $gene=$_GET["gene"];
   $mirna=$_GET["mirna"];
   $snp=$_GET["snp"];
   $gainorlost=$_GET["gainorlost"];
   if($gainorlost=="loss") $gainorlost="lost";
?>


	<div class="panel panel-info">
		<div class="panel-heading">
			<h4 class="panel-title">Browse From Here</h4>
		</div>
		<div class="panel-body">
			<form class="form-horizontal" role="form" method="get" action="geneTargets.php">
                <input type="hidden" name="token" value="<?php echo $token; ?>" />
				<div class="form-group">
					<label class="col-sm-3 control-label">Browse by gene:</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="gene"  value="<? if($gene!=""||$mirna!=""||$snp!="") echo $gene; ?>">
					</div>
					<span class="help-block">(e.g. AGTR1)</span>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Browse by miRNA:</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="mirna" value="<? if($gene!=""||$mirna!=""||$snp!="") echo $mirna;?>">
					</div>
					<span class="help-block">(e.g. hsa-miR-155-5p)</span>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Browse by SNP:</label>
					<div class="col-sm-3">
						<input type="text" class="form-control " name="snp" value="<? if($gene!=""||$mirna!=""||$snp!="") echo $snp;?>">
					</div>
					<span class="help-block">(e.g. rs5186)</span>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-6">
						<button class="btn btn-primary" type="submit" name="gainorlost" value="loss">Loss</button>
						<button class="btn btn-danger" type="submit" name="gainorlost" value="gain">Gain</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<?if($mirna==""&&$snp==""&&$gene=="") {}
	else {?>
 <div >
  <table class="table table-hover table-bordered">
   <tr class="info">
		<th>SNP in <br/>gene 3'UTR</th>
		<th>miRNA</th>
		<th >SNP location</th>
		<th align="center">Energy change<br/>(kcal/mol)</th>
		<th align="center" >miRNA/SNP-target duplexes</th>
		<th >Effect by SNP<br/> on 3'UTR</th>
   </tr>

   <? include "connectinclude.php";
   	$sqlcontrol= "select * from gene_target_" . $gainorlost. " where ";
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
	  //echo $sqlcontrol;
	  $result = mysql_query($sqlcontrol);
	  $total=mysql_num_rows($result);
          pages($total,10);
          $sqlcontrol .= " limit $firstcount,$displaypg";
	  if($total!=0){
          $result = mysql_query($sqlcontrol);
          echo $pagenav;
          }
	  $p=1;
	  while($row = mysql_fetch_array($result))
	  {$sqlcontrol1="select * from snp_allele_in_utr where id='".$row["SNP_id"]."'";
	   $result1=mysql_query($sqlcontrol1);
	   $row1=mysql_fetch_array($result1);
	   if($p==1) $p=0; else $p=1;?>
		  <tr>
		    <td >
				<? echo $row["gene_id"].'('.$row["NM_id"].')' ?>;<br/>
				<div >
					<a href="http://www.ncbi.nlm.nih.gov/projects/SNP/snp_ref.cgi?rs=<? echo $row["SNP_id"] ?>" target="_blank">
						<? echo $row["SNP_id"]; ?><br/>
					</a><? echo '('.$row1["original_allele"].'/'.$row1["snp_allele"].')' ?>
				</div>
			</td>
			<td>
				<a href="http://www.mirbase.org/cgi-bin/query.pl?terms=<? echo $row["miRNA_id"] ?>" target="_blank"> <? echo $row["miRNA_id"] ?></a>
			</td>
			<td align="center"><? echo $row["snp_loc"]; ?> </td>
			<td  style="text-align:center"><? echo "Wild Type: ".$row["wild_energy"].'<br>'."SNP Type: ".$row["snp_energy"]?> </td>
			<td style="text-align:center"><?
			$str=$row["base_pair"];
			$enter=0;
			$space=0;
			$space2=0;
			$flag=0;
			$length=0;
			$line4=0;
			$start=$row["M_start"]-1;
			$loc=0;
			$energy=0;
			$countstart=0;
			$point=1;?>
				<table border="0" cellpadding="0" style="font-family:Arial, Helvetica, sans-serif; font-size:13px"><tr><?
			for($i=0;$i<strlen($str);$i++)
			 {if($str[$i]=="\n")
			    {$enter++;
				}

			  if($enter>=3)

				{		if($str[$i]=="\n")
				  {?></tr><tr> <?

				  }
				else
				  {

					  ?><td><?  if($str[$i]=='X'){
						  ?> <div style="color:#FF0000"><?
							 echo '<b>'.'X'.'</b></div>';
	 							 }
								elseif($str[$i]=='Y'){
									?><div style="color:#F0F"><?
									 echo '<b>'.'|'.'<b></div>';
	 							}
								elseif($str[$i]=='S'){
								?><div style="color:#F0F;font-weight:bold;">
					<a title="<? echo $row1['original_allele'].'--->'.$row1['snp_allele']; ?>"
				 href="http://www.ncbi.nlm.nih.gov/projects/SNP/snp_ref.cgi?rs=<? echo $row["SNP_id"] ?> target='_blank'"
					style="cursor:pointer"  target="_blank">
								<?
									   echo $row1['snp_allele'];
					                  ?></a> </div> <?

									}
								 else
								{
								  echo $str[$i];
								}



					?></td><?

				  }
			  }
             }
			 ?></tr></table>
				<div style="color:#F0F;margin-bottom:6px;"><?
 echo          $row["SNP_id"].": "   ;
echo $row1['original_allele'].' --> '.$row1['snp_allele'];

echo "<br></div>" ;
echo $energyprint;
			    $str=str_replace(' ',',', $str);
                $str=str_replace("\n",'$',$str);
               ?>
			</td>
			  <td style="text-align:center">
				  <? if($gainorlost=="lost") echo "loss"; else echo "gain" ?>
			  </td>
		  </tr>
		 <?}?>
  </table>

 <? echo $pagenav; ?>
 </div>

 <? }?>
</div>
<?
include "footerinclude.php";

?>
