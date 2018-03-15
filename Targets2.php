<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link href="main.css" rel="stylesheet" type="text/css" />
<style type="text/css">
a{TEXT-DECORATION:none;
         color:#0000FF;

 }
.top
{
float:left;
font-size:300%;
width:auto;
line-height:80%;
}
.ttt1{
	}
.ttt2{background-color:#FFE3D9;
	}
</style>

<title>Targets</title>
<script type="text/javascript">
 window.onload=window.onresize=function(){
	  if(document.getElementById("left").clientHeight<document.getElementById("content").clientHeight){
 document.getElementById("left").style.height=document.getElementById("content").offsetHeight+"px";fsetHeight+"px";
 }
 else{
 document.getElementById("content").style.height=document.getElementById("left").offsetHeight+"px";fsetHeight+"px";
 }
 }
</script>

</head>
<body>

<div id="container">
<div id='header'>
<img src="image/logo2.jpg" usemap="#chomap2" border="0"  />
  <map name="chomap2" id="chomap2">
  <area shape="rect" coords="22,0,305,130" href="index.php" alt="homepage" />
  </map>
</div>
<div id="left">


	<?
	   include "sidebarinclude.php";
	?>
</div>
<div id="content" style="font-family:Arial, Helvetica, sans-serif; font-size:16px">
<br>
<p class="quicksearch"> Targets gain/loss by SNPs in miRNA seed regions</p>
 <p style="font-family:Arial, Helvetica, sans-serif">

 <img src="image/logo_snp_in_seed.jpg" alt="snps in seed region" />
 <? $gene=$_GET["gene"];
 ?>
 <form name="mirnaSearch2" METHOD="GET" ACTION="Targets_cj.php" >
     <input type="hidden" name="token" value="<?php echo $token; ?>" />
                      Browse by gene (e.g. ERG) &nbsp;
                     <input type="text" name="gene" value="<? if($gene!="") echo $gene; else echo "ERG";?>" />
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 <input type="submit" name="gainorlost" value="gain" />
	 &nbsp;&nbsp;&nbsp;
	 <input type="submit" name="gainorlost" value="loss"  />
</form>
<?
   $mirna=$_GET["mirna"];
   $snp=$_GET["snp"];
   $gainorlost=$_GET["gainorlost"];
   if($mirna==""&&$snp==""&&$gainorlost=="")
   {
   include "connectinclude.php";


  ?>

 <div id="table1"  style="margin-top:10px;margin-left:10px;">
  <table border="1">
   <tr class="ttt2">
    <td width="120">
	  miRNA
	</td>
	<td width="50">
	  Chromosome
	</td>
	<td width="100">
	 Start
	</td>
	<td width="100">
	 End
	</td>
	<td width="100" style="text-align:center">
	 SNP in seed
	</td>
	<td width="140">
	 Numbers of <br/>
	 gain target genes
	</td>
	<td width="140">
	 Numbers of <br/>
	 lost target gene
	</td>
   </tr>
  <?  $sqlcontrol="select miRNA_id from seed_target_gain_with_base group by miRNA_id";
      $result = mysql_query($sqlcontrol);
	  $p=1;
	  while($row = mysql_fetch_array($result))
	  {if($p==1) $p=0; else $p=1;
	   $sqlcontrolmrna="select * from table2_mature_miRNA where mature_miRNA_id='".$row["miRNA_id"]."'";
	   $sqlcontrolsnp="select SNP_id from seed_target_gain_with_base where miRNA_id='".$row["miRNA_id"]."' group by SNP_id";
	   $resultsnp=mysql_query($sqlcontrolsnp);
	   $resultmrna=mysql_query($sqlcontrolmrna);
	   $rowmrna=mysql_fetch_array($resultmrna);
	   while($rowsnp=mysql_fetch_array($resultsnp))
	   {$sqlcontrolpre="select premir from table4_miRNA_SNP where snp_id='".$rowsnp["SNP_id"]."' and miRNA='".$row["miRNA_id"]."'";
	    $resultpre=mysql_query($sqlcontrolpre);
$rowpre=mysql_fetch_array($resultpre);
$sqlcontrolstarttoend="select * from table2_mature_miRNA where premiRNA_id='".$rowpre["premir"]."'";
$resultstarttoend=mysql_query($sqlcontrolstarttoend);
$rowstarttoend=mysql_fetch_array($resultstarttoend);
$sqlcontrolchr="select chr from table1_pre_miRNA where id='".$rowpre["premir"]."'";
	    $resultchr=mysql_query($sqlcontrolchr);
	    $rowchr=mysql_fetch_array($resultchr);
	    $sqlcontrolgain="select count(miRNA_id) from seed_target_gain_with_base where miRNA_id='".$row["miRNA_id"]."' and SNP_id='".$rowsnp["SNP_id"]."'";
	    $sqlcontrollost="select count(miRNA_id) from seed_target_loss_with_base where miRNA_id='".$row["miRNA_id"]."' and SNP_id='".$rowsnp["SNP_id"]."'";
$resultgain=mysql_query($sqlcontrolgain);
	    $resultlost=mysql_query($sqlcontrollost);
$rowgain=mysql_fetch_array($resultgain);
	    $rowlost=mysql_fetch_array($resultlost);
	   ?>
	   <tr class="<? if($p==0) echo "ttt1"; else echo "ttt2"; ?>">
	     <td width="130"><a href="http://www.mirbase.org/cgi-bin/query.pl?terms=<? echo $row["miRNA_id"] ?>" target="_blank"> <? echo $row["miRNA_id"]; ?> </a></td>
 <td style="text-align:center"> <? echo $rowchr["chr"]; ?></td>
 <td> <? echo $rowstarttoend["start_on_chr"]; ?> </td>
 <td> <? echo $rowstarttoend["end_on_chr"]; ?> </td>
 <td><a href="http://www.ncbi.nlm.nih.gov/projects/SNP/snp_ref.cgi?rs=<? echo $rowsnp["SNP_id"] ?>" target="_blank"> <? echo $rowsnp["SNP_id"] ?> </a></td>
 <td> <div style="float:left;align:center"><? echo $rowgain["count(miRNA_id)"]; ?></div>
  <form name="mirnaSearch2" METHOD="GET" ACTION="Targets_cj.php" style="float:right">
      <input type="hidden" name="token" value="<?php echo $token; ?>" />
  <input type="hidden" name="mirna" value="<? echo $row["miRNA_id"]?>" />
  <input type="hidden" name="snp" value="<? echo $rowsnp["SNP_id"]?>" />
  <input type="hidden" name="gainorlost" value="gain" />
<input type="image"   onClick="mirnaSearch2.submit()" Src="image/detail_submit2.png" width="90" height="45" alt="target" />

</form>
  </td>
 <td><div style="float:left"> <? echo $rowlost["count(miRNA_id)"]; ?></div>
   <form name="mirnaSearch2" METHOD="GET" ACTION="Targets_cj.php" style="float:right">
       <input type="hidden" name="token" value="<?php echo $token; ?>" />
  <input type="hidden" name="mirna" value="<? echo $row["miRNA_id"]?>" />
  <input type="hidden" name="snp" value="<? echo $rowsnp["SNP_id"]?>" />
  <input type="hidden" name="gainorlost" value="loss" />
          <input type="image"   onClick="mirnaSearch2.submit()" Src="image/detail_submit2.png" width="90" height="45" alt="target" />

  </form>
 </td>
       </tr>
	   <? }} ?>
  </table>
 </div>
 <? }
     else
	 {
 ?>
 <div id="table2" style="font-family:Arial, Helvetica, sans-serif;margin-top:10px;margin-left:10px;">
  <table border="1">
   <tr class="ttt2">

    <td width="180" >miRNA</td>

    <td width="120" >Target&nbsp;site on <br>gene 3'UTR</td>
	<td width="150" >Energy change<br>(kcal/mol) </td>
	<td  width="300" align="center" >SNP-miRNA/target duplexes </td>
	<td >&nbsp;&nbsp;Effect by SNP-miRNA</td>

   </tr>
   <? include "connectinclude.php";
      if($gene!="")
       $sqlcontrol="select * from seed_target_".$gainorlost."_with_base  where gene_id='".$gene."'";
      else
	   if($snp!=""&&$mirna!="")
	    $sqlcontrol="select * from seed_target_".$gainorlost."_with_base  where miRNA_id='".$mirna."' and SNP_id='".$snp."'";
	   else
	    $sqlcontrol="select * from seed_target_".$gainorlost."_with_base  where miRNA_id='".$mirna."' or SNP_id='".$snp."'";
	  $sqlcontrol1=$sqlcontrol." and conserved_in_species!='NULL'";


	  $result = mysql_query($sqlcontrol);
	  $result1 = mysql_query($sqlcontrol1);
	  $p=1;
	  while($row = mysql_fetch_array($result))
	  {
$sqlcontrol3="select * from table4_miRNA_SNP where snp_id='".$row["SNP_id"]."'";
           $result3=mysql_query($sqlcontrol3);
           $row3=mysql_fetch_array($result3);
	$snp_allele=substr($row3['ref_allele'],-1);


$mirlength=$strpos2-$strpos1-1;
if($p==1) $p=0; else $p=1;
	    ?><tr class="<? if($p==0) echo "ttt1"; else echo "ttt2"; ?>">
	<td  width="180" ><a href="http://www.mirbase.org/cgi-bin/query.pl?terms=<? echo $row["miRNA_id"] ?>" target="_blank"> <? echo $row["miRNA_id"]; ?> </a><br/><a href="http://www.ncbi.nlm.nih.gov/projects/SNP/snp_ref.cgi?rs=<? echo $row["SNP_id"] ?>" target="_blank"> <? echo $row["SNP_id"]; ?> </a></td>
	<td  width="120" ><? echo $row["gene_id"]."(".$row["NM_id"].")" ?><br><? echo $row["M_start"]."-".$row["M_end"];?></td>
	<td  width="150"><? echo "Wild: ". $row["wild_energy"]."<br>"."SNP: ".$row["snp_energy"];?></td>
	<td	 width="300" style="font-size:13px;"><?
                        $str=$row["base_pair"];
                        $enter=0;
                        ?><table border="0" cellpadding="0" ><tr><?



		 for($i=0;$i<strlen($str);$i++)
			{
				if($str[$i]=="\n")
                       {$enter++;
                                }

				if($enter>=2)

                 {               if($str[$i]=="\n")
							{
							?></tr><tr> <?

                                  }
                                else
                                  {

									  ?><td><?  if($str[$i]=='X'){

										  ?> <div style="color:#FF0000"><?
										 if ($gainorlost=="gain"){echo '<b>'.'|'.'<b>';}else{ echo '<b>'.X.'<b>';}
                                                         echo '</div>';

                                                                }
                                                                elseif($str[$i]=='S'){
                                                                ?><div style="color:#F0F;font-weight:bold;">
                                        <a title="<? echo $row1['original_allele'].'--->'.$row1['snp_allele']; ?>"
                                 href="http://www.ncbi.nlm.nih.gov/projects/SNP/snp_ref.cgi?rs=<? echo $row["SNP_id"] ?>"
                                        style="cursor:pointer"  target="_blank">
                                                                <?
                                                                           echo $snp_allele;
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




             </td>


	<td style="text-align:center"><? echo $gainorlost ?> </td>

   </tr>
 <?
      }
   ?></table>

 </div>

 <div style="float:right"><a href="Targets_cj.php">Back to the list of MiRNA</a></div>
 <? }
 ?>

</div>
<?
include "footerinclude.php";

?>
