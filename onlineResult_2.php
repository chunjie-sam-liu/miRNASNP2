<?
$page_title="miRNASNP:Result";
include "head.php";
?>
<?
$wild = $_GET['wild'];
$snp = $_GET['snp'];
$wild = trim($wild);
$snp = trim($snp);
$uniq_code=uniqid();

if(isset($_REQUEST['hash'])){
	if ($_REQUEST['hash'] != $_COOKIE['cookie'])
	{
		// var_dump($_COOKIE['cookie']);
		echo '<script>alert("Please make sure the correct input.");history.back();</script>';
		exit;
	}
}

//echo "$uniq_code";
while(file_exists("online_result_2/processing.lock")) {sleep(1);}
system("rm -fr online_result_2/*",$output);
system("touch online_result_2/processing.lock");
$command = "perl online_set_2/online_analysis.pl $wild $snp $uniq_code";
system($command,$output);
system("rm online_result_2/processing.lock");

//miranda path
$file_loss = "online_result_2/seq_target_loss.$uniq_code";
$fe_loss=file("$file_loss");
for($i=0;$i<count($fe_loss);$i++)
{
        list($gene_loss[$i],$start_ts_loss[$i],$end_ts_loss[$i],$start_da_loss[$i],$end_da_loss[$i],$da_sc_loss[$i],$da_en_loss[$i])=split("\t",$fe_loss[$i]);
}
$file_gain = "online_result_2/seq_target_gain.$uniq_code";
$fe_gain=file("$file_gain");
for($i=0;$i<count($fe_gain);$i++)
{
        list($gene_gain[$i],$start_ts_gain[$i],$end_ts_gain[$i],$start_da_gain[$i],$end_da_gain[$i],$da_sc_gain[$i],$da_en_gain[$i])=split("\t",$fe_gain[$i]);
}
?>

<div class="content" style="border:#000000 solid 4">
	<h2 class="quicksearch"> Results of Seed SNP impact on miRNA:mRNA interaction </h2>

	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<!--download data-->
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
				<th>The lost Targets of wild sequence</th>
				<td><a href="online_result_2/seq_target_gain<? echo ".".$uniq_code?>" target="_blank"><strong style="color:red">download here</strong></a></td>
			</tr>
			<tr>
				<th>The obtained Targets of SNP sequence</th>
				<td><a href="online_result_2/seq_target_loss<? echo ".".$uniq_code?>" target="_blank"><strong style="color:red">download here</strong></a></td>
			</tr>
		</table>
	</div>
	</div>
</div>

	<!--	The obtained Targets of SNP sequence-->
<div class="panel panel-info">
	<div class="panel-heading" role="tab" id="headingOne">
		<h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
			The obtained Targets of SNP sequence
			</a>
		</h4>
	</div>
	<div class="panel-collapse collapse"  id="collapseOne" role="tabpanel" aria-labelledby="headingOne">
	<div class="panel-body">
		<table class="table table-hover table-bordered">
			<tr class="success">
				<th >Gene</th>
				<th >Gene start by<br> Targetscan</th>
				<th >Gene end by<br> Targetscan</th>
				<th >Gene start by<br> miRanda</th>
				<th >Gene end by<br> miRanda</th>
				<th >miRanda score</th>
				<th >Energy by miRanda</th>
			</tr>
			<?for($j=0;$j<count($fe_gain);$j++){?>
				<tr style="text-align:center;">
					<td><? echo $gene_gain[$j];?></td>
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

<!--The lost Targets of wild sequence-->
<div class="panel panel-info">
	<div class="panel-heading" role="tab" id="headingTwo">
		<h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
			The lost Targets of wild sequence
			</a>
		</h4>
	</div>
	<div class="panel-collapse collapse"  id="collapseTwo" role="tabpanel" aria-labelledby="headingTwo">
	<div class="panel-body">
		<table class="table table-hover table-bordered">
			<tr class="success">
				<th >Gene</th>
				<th >Gene start by Targetscan</th>
				<th >Gene end by Targetscan</th>
				<th >Gene start by miRanda</th>
				<th >Gene end by miRanda</th>
				<th >miRanda score</th>
				<th >Energy by miRanda</th>
			</tr>
			<?for($j=0;$j<count($fe_loss);$j++){?>
				<tr style="text-align:center;">
					<td><? echo $gene_loss[$j];?></td>
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

</div>

 <?
  include "footerinclude.php";
  ?>
