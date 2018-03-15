

	<?
	$page_title="SNP in UTR";
	   include "head.php";
	?>

<div id="content" style="font-family:Arial, Helvetica, sans-serif; font-size:16px">
 <br>
<p class="quicksearch"> Targets gain/loss by SNPs in genes' 3'UTR</p>
 <img src="image/Logo_SNP_in_3UTR.jpg" alt="snps in UTRs" />
<? $gene=$_GET["gene"];
   $mirna=$_GET["mirna"];
   $snp=$_GET["snp"];
   $gainorlost=$_GET["gainorlost"];
   if($gainorlost=="loss") $gainorlost="lost";
   ?>
 <form name="mirnaSearch2" METHOD="GET" ACTION="geneTargets.php" style="margin-left:10px;margin-top:10px" >
<input type="hidden" name="token" value="<?php echo $token; ?>" />

                    Browse by gene (e.g. RBFOX1) &nbsp;
					 <input type="text" name="gene" value="<? if($gene!=""||$mirna!=""||$snp!="") echo $gene; else echo "RBFOX1" ;?>" />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 <input type="submit" name="gainorlost" value="loss" />
					 &nbsp;&nbsp;&nbsp;
					 <input type="submit" name="gainorlost" value="gain"  />
  </form>
  <form name="mirnaSearch2" METHOD="GET" ACTION="geneTargets.php" style="margin-left:10px;margin-top:10px" >
      <input type="hidden" name="token" value="<?php echo $token; ?>" />
                    Browse by miRNA (hsa-miR-200b-3p) &nbsp;
					 <input type="text" name="mirna" value="<? if($gene!=""||$mirna!=""||$snp!="") echo $mirna; else echo "hsa-miR-200b-3p";?>" />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 <input type="submit" name="gainorlost" value="loss" />
					 &nbsp;&nbsp;&nbsp;
					 <input type="submit" name="gainorlost" value="gain"  />
  </form>
  <form name="mirnaSearch2" METHOD="GET" ACTION="geneTargets.php" style="margin-left:10px;margin-top:10px" >
      <input type="hidden" name="token" value="<?php echo $token; ?>" />
                    Browse by SNP (rs41279484) &nbsp;
					 <input type="text" name="snp" value="<? if($gene!=""||$mirna!=""||$snp!="") echo $snp;else echo "rs41279484";?>" />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 <input type="submit" name="gainorlost" value="loss" />
					 &nbsp;&nbsp;&nbsp;
					 <input type="submit" name="gainorlost" value="gain" />
  </form>
<?
   if($mirna==""&&$snp==""&&$gene=="")
   {
    }
   else
	 {
 ?>
 <div id="table2" style="margin-left:10px;margin-top:10px">
  <table border="1">
   <tr class="ttt2">
    <td width="90">SNP in <br/>gene 3'UTR</td>
	<td width="120">miRNA</td>
	<td width="100" >SNP location and <br /> Target site on UTR</td>

	<td width="120" align="center">Energy change<br/>(kcal/mol)</td>
	<td align="center" width="320">miRNA/SNP-target duplexes</td>
	<td width="60">Effect by SNP on 3'UTR</td>
   </tr>
   <? include "connectinclude.php";
      if($gene!="")
       $sqlcontrol="select * from gene_target_".$gainorlost." where gene_id='".$gene."'";
      if($mirna!="")
	   $sqlcontrol="select * from gene_target_".$gainorlost." where miRNA_id='".$mirna."'";
	  if($snp!="")
	   $sqlcontrol="select * from gene_target_".$gainorlost." where SNP_id='".$snp."'";

	  $result = mysql_query($sqlcontrol);
	  $p=1;
	  while($row = mysql_fetch_array($result))
	  {$sqlcontrol1="select * from snp_allele_in_utr where id='".$row["SNP_id"]."'";
	   $result1=mysql_query($sqlcontrol1);
	   $row1=mysql_fetch_array($result1);
	   if($p==1) $p=0; else $p=1;
	    ?><tr class="<? if($p==0) echo "ttt1"; else echo "ttt2"; ?>">
		    <td width="90"><? echo $row["gene_id"] ?>;
<br/><div style="font-size:14px"><a href="http://www.ncbi.nlm.nih.gov/projects/SNP/snp_ref.cgi?rs=<? echo $row["SNP_id"] ?>" target="_blank"> <? echo $row["SNP_id"]; ?><br/> </a><? echo '('.$row1["original_allele"].'/'.$row1["snp_allele"].')' ?></div>  </td>
			<td width="120"><a href="http://www.mirbase.org/cgi-bin/query.pl?terms=<? echo $row["miRNA_id"] ?>" target="_blank"> <? echo $row["miRNA_id"] ?> </a></td>
			<td width="100" align="center"><? echo $row["snp_loc"]; ?> <br/><? echo $row["M_start"]."-".$row["M_end"] ?></td>

			<td width="120" style="text-align:center"><? echo "Wild: ".$row["wild_energy"].'<br>'."SNP: ".$row["snp_energy"] ?> </td>
			<td  width="320" style="text-align:center"><?


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
			$point=1;

			?><table border="0" cellpadding="0" style="font-family:Arial, Helvetica, sans-serif; font-size:13px"><tr><?
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
				 href="http://www.ncbi.nlm.nih.gov/projects/SNP/snp_ref.cgi?rs=<? echo $row["SNP_id"] ?>"
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
			<td width="30" style="text-align:center"><? if($gainorlost=="lost") echo "loss"; else echo "gain" ?> </td>
		   </tr>
		 <?
      }
   ?>
  </table>

 </div>

 <? }
 ?>
</div>
<?
include "footerinclude.php";

?>
