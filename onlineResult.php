<?
$page_title="miRNASNP:Result";
include "head.php";
?>
<?php

if(isset($_REQUEST['hash'])){
	if ($_REQUEST['hash'] != $_COOKIE['cookie'])
	{
		// var_dump($_COOKIE['cookie']);
		echo '<script>alert("Please make sure the correct input.");history.back();</script>';
		exit;
	}
}
?>
<?
$regex='/[#$%^&*()+=\[\]\';,.\/{}|":<>?~\\\\]/';

$wild = $_GET['wild'];
if (empty($wild) || preg_match_all($regex,$wild))
{
	echo '<script>alert("Please input correct ");
	document.location.href="/miRNASNP2";</script>';
	exit;
}
$snp = $_GET['snp'];
if (empty($snp) || preg_match_all($regex,snp))
{
	echo '<script>alert("Please input correct ");
	document.location.href="/miRNASNP2";</script>';
	exit;
}
$wild = trim($wild);
$snp = trim($snp);
$uniq_code=uniqid();


while(file_exists("online_result/processing.lock")) {sleep(1);}

system("rm -fr online_result/*",$output);

system("touch online_result/processing.lock");

$command = "perl online_set/online_analysis.pl $wild $snp $uniq_code";

system($command,$output);

system("rm online_result/processing.lock");

//miranda path
$file_wild = "online_result/seq1_target.$uniq_code";
$fe_wild=file("$file_wild");
for($i=0;$i<count($fe_wild);$i++)
{
        list($mir_wild[$i],$start_ts_wild[$i],$end_ts_wild[$i],$start_da_wild[$i],$end_da_wild[$i],$da_sc_wild[$i],$da_en_wild[$i])=split("\t",$fe_wild[$i]);
}
$file_snp = "online_result/seq2_target.$uniq_code";
$fe_snp=file("$file_snp");
for($i=0;$i<count($fe_snp);$i++)
{
        list($mir_snp[$i],$start_ts_snp[$i],$end_ts_snp[$i],$start_da_snp[$i],$end_da_snp[$i],$da_sc_snp[$i],$da_en_snp[$i])=split("\t",$fe_snp[$i]);
}

$file_loss = "online_result/seq_target_loss.$uniq_code";
$fe_loss=file("$file_loss");
for($i=0;$i<count($fe_loss);$i++)
{
        list($mir_loss[$i],$start_ts_loss[$i],$end_ts_loss[$i],$start_da_loss[$i],$end_da_loss[$i],$da_sc_loss[$i],$da_en_loss[$i])=split("\t",$fe_loss[$i]);
}
$file_gain = "online_result/seq_target_gain.$uniq_code";
$fe_gain=file("$file_gain");
for($i=0;$i<count($fe_gain);$i++)
{
        list($mir_gain[$i],$start_ts_gain[$i],$end_ts_gain[$i],$start_da_gain[$i],$end_da_gain[$i],$da_sc_gain[$i],$da_en_gain[$i])=split("\t",$fe_gain[$i]);
}
?>


<div class="content">

<?php
if ($snp != "") {
?>
<h2 class="quicksearch"> Results of Gene SNP impact on miRNA:mRNA interaction</h2>
 <!--[if IE 6]>  <![endif]-->
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	<!--Download Data-->
	<div class="panel panel-info">
		<div class="panel-heading" role="tab" id="headingZero">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseZero" aria-expanded="true" aria-labelledby="collapseZero">
					Download Data
				</a>
			</h4>
		</div>
		<div class="panel-collapse collapse in" id="collapseZero" role="tabpanel" aria-labelledby="headingZero">
		<div class="panel-body">
			<table class="table table-hover table-bordered">
				<tr >
					<th>Wild sequence related miRNAs</th>
					<td style="color:red" ><a href="online_result/seq1_target<? echo ".".$uniq_code?>"  target="_blank" ><strong style="color:red">download here</strong></a></td>
				</tr>
				<tr >
					<th>SNP sequence related miRNAs</th>
					<td><a href="online_result/seq2_target<? echo ".".$uniq_code?>" target="_blank"><strong style="color:red">download here</strong></a></td>
				</tr>
				<tr >
					<th>The lost miRNAs of wild sequence</th>
					<td><a href="online_result/seq_target_gain<? echo ".".$uniq_code?>" target="_blank"><strong style="color:red">download here</strong></a></td>
				</tr>
				<tr>
					<th>The obtained miRNAs of SNP sequence</th>
					<td><a href="online_result/seq_target_loss<? echo ".".$uniq_code?>" target="_blank"><strong style="color:red">download here</strong></a></td>
				</tr>
			</table>
		</div>
		</div>
	</div>
<!--Wild sequence related miRNAs-->
<div class="panel panel-info">
		<div class="panel-heading" role="tab" id="headingOne">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
					Wild sequence related miRNAs
				</a>
			</h4>
		</div>
		<div class="panel-collapse collapse"  id="collapseOne" role="tabpanel" aria-labelledby="headingOne">
			<div class="panel-body">
			<table class="table table-hover table-bordered" >
				<tr class="success">
					<th >miRNA</th>
					<th >UTR start by<br> Targetscan</th>
					<th >UTR end by<br> Targetscan</th>
					<th >UTR start by<br> miRanda</th>
					<th >UTR end by<br> miRanda</th>
					<th >miRanda score</th>
					<th >Energy by miRanda</th>
				</tr>
				<?for($j=0;$j<count($fe_wild);$j++){?>
					<tr style="text-align: center">
						<td><? echo $mir_wild[$j];?></td>
						<td><? echo $start_ts_wild[$j];?></td>
						<td><? echo $end_ts_wild[$j];?></td>
						<td><? echo $start_da_wild[$j];?></td>
						<td><? echo $end_da_wild[$j];?></td>
						<td><? echo $da_sc_wild[$j];?></td>
						<td><? echo $da_en_wild[$j];?></td>
					</tr>
				<?
				}
				?>
			</table>
			</div>
		</div>
</div>
<!--SNP sequence related miRNAs-->
<div class="panel panel-info">
	<div class="panel-heading" role="tab" id="headingTwo">
		<h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
			SNP sequence related miRNAs
			</a>
		</h4>
	</div>
	<div class="panel-collapse collapse"  id="collapseTwo" role="tabpanel" aria-labelledby="headingTwo">
	<div class="panel-body">
		<table class="table table-hover table-bordered">
			<tr class="success">
				<th >miRNA</th>
				<th >UTR start by<br> Targetscan</th>
				<th >UTR end by<br> Targetscan</th>
				<th >UTR start by<br> miRanda</th>
				<th >UTR end by<br> miRanda</th>
				<th >miRanda score</th>
				<th >Energy by miRanda</th>
			</tr>
			<?for($j=0;$j<count($fe_snp);$j++){?>
				<tr style="text-align:center;">
					<td><? echo $mir_snp[$j];?></td>
					<td><? echo $start_ts_snp[$j];?></td>
					<td><? echo $end_ts_snp[$j];?></td>
					<td><? echo $start_da_snp[$j];?></td>
					<td><? echo $end_da_snp[$j];?></td>
					<td><? echo $da_sc_snp[$j];?></td>
					<td><? echo $da_en_snp[$j];?></td>
				</tr>
			<?}?>
		</table>
	</div>
	</div>
</div>
<!--The gained miRNAs of SNP sequence-->
<div class="panel panel-info">
	<div class="panel-heading" role="tab" id="headingThree">
		<h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
				The gained miRNAs of SNP sequence
			</a>
		</h4>
	</div>
	<div class="panel-collapse collapse" id="collapseThree" role="tabpanel" aria-labelledby="headingThree">
	<div class="panel-body">
		<table class="table table-hover table-bordered">
			<tr class="success">
				<th >miRNA</th>
				<th >UTR start by<br> Targetscan</th>
				<th >UTR end by<br> Targetscan</th>
				<th >UTR start by<br> miRanda</th>
				<th >UTR end by<br> miRanda</th>
				<th >miRanda score</th>
				<th >Energy by<br> miRanda</th>
			</tr>
			<?for($j=0;$j<count($fe_gain);$j++){?>
				<tr style="text-align:center;">
					<td><? echo $mir_gain[$j];?></td>
					<td><? echo $start_ts_gain[$j];?></td>
					<td><? echo $end_ts_gain[$j];?></td>
					<td><? echo $start_da_gain[$j];?></td>
					<td><? echo $end_da_gain[$j];?></td>
					<td><? echo $da_sc_gain[$j];?></td>
					<td><? echo $da_en_gain[$j];?></td>
				</tr>
			<?}?>
		</table>
	</div>
	</div>
</div>
<!--The lost miRNAs of wild sequence-->
<div class="panel panel-info">
	<div class="panel-heading" role="tab" id="headingFour">
		<h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
				The lost miRNAs of wild sequence
			</a>
		</h4>
	</div>
	<div class="panel-collapse collapse" id="collapseFour" role="tabpanel" aria-labelledby="headingFour">
	<div class="panel-body">
		<table class="table table-hover table-bordered">
			<tr class="success">
				<th >miRNA</th>
				<th >UTR start by<br> Targetscan</th>
				<th >UTR end by<br> Targetscan</th>
				<th >UTR start by<br> miRanda</th>
				<th >UTR end by<br> miRanda</th>
				<th >miRanda score</th>
				<th >Energy by miRanda</th>
			</tr>
			<?for($j=0;$j<count($fe_loss);$j++){?>
				<tr style="text-align:center;">
					<td><? echo $mir_loss[$j];?></td>
					<td><? echo $start_ts_loss[$j];?></td>
					<td><? echo $end_ts_loss[$j];?></td>
					<td><? echo $start_da_loss[$j];?></td>
					<td><? echo $end_da_loss[$j];?></td>
					<td><? echo $da_sc_loss[$j];?></td>
					<td><? echo $da_en_loss[$j];?></td>
				</tr>
			<?}?>
		</table>
	</div>
	</div>
</div>

</div>
<?php
} else {
?>
                    <table class="table table-hover table-bordered" >
                                <tr class="success">
                                        <th >miRNA</th>
                                        <th >UTR start by<br> Targetscan</th>
                                        <th >UTR end by<br> Targetscan</th>
                                        <th >UTR start by<br> miRanda</th>
                                        <th >UTR end by<br> miRanda</th>
                                        <th >miRanda score</th>
                                        <th >Energy by miRanda</th>
                                </tr>
                                <?for($j=0;$j<count($fe_wild);$j++){?>
                                        <tr style="text-align: center">
                                                <td><? echo $mir_wild[$j];?></td>
                                                <td><? echo $start_ts_wild[$j];?></td>
                                                <td><? echo $end_ts_wild[$j];?></td>
                                                <td><? echo $start_da_wild[$j];?></td>
                                                <td><? echo $end_da_wild[$j];?></td>
                                                <td><? echo $da_sc_wild[$j];?></td>
                                                <td><? echo $da_en_wild[$j];?></td>
                                        </tr>
                                <?
                                }
                                ?>
                        </table>

<?
}
?>



</div>

<?
  include "footerinclude.php";
  ?>
