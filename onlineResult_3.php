<?
$page_title="miRNASNP:Results";
include "head.php";
?>

<?
$wild = $_GET['wild'];
$snp = $_GET['snp'];
$wild = trim($wild);
$snp = trim($snp);

if(isset($_REQUEST['hash'])){
	if ($_REQUEST['hash'] != $_COOKIE['cookie'])
	{
		// var_dump($_COOKIE['cookie']);
		echo '<script>alert("Please make sure the correct input.");history.back();</script>';
		exit;
	}
}

while(file_exists("online_result_3/processing.lock")){sleep(1);}

system("touch online_result_3/processing.lock");
$command = "perl online_set_3/online_analysis.pl $wild $snp";
system($command,$output);

system("rm online_result_3/processing.lock");

$file_wild = "online_set_3/seq1_RNAfold_re";
$fe_wild=file("$file_wild");
$file_snp = "online_set_3/seq2_RNAfold_re";
$fe_snp=file("$file_snp");

?>

<div class="content" >
<h2 class="quicksearch">  SNP impact on structure of pre-miRNA</h2>
 <!--[if IE 6]>  <![endif]-->
<div style="text-align:center;" >
<?if ($wild){
	echo "<h3>Structure of your wild miRNA</h3>";
}
else{
	echo "<h3>Structure of your SNP miRNA</h3>";
}
?>
<img src="online_set_3/SEQ1.png" /><br/>
<p size=1em style="font-family:sans-serif;font-size:1em;text-align: left">
<? printf('%02s',$fe_wild[1]);?><br/>
<? printf('%02s',$fe_wild[2]);?>
</p>
<? if ($snp != "") { ?>
<hr>
<? } ?>
<?
if (!$snp || !$wild){
echo " <!--[if IE 6]> \n";
}
?>
<h3>Structure of your SNP miRNA</h3>
<img src="online_set_3/SEQ2.png" />
<p style="font-family:sans-serif;font-size:1em;text-align:left">
<? printf('%02s',$fe_snp[1]);?><br/>
<? printf('%02s',$fe_snp[2]);?><br/>
</p>
<?
if(!$snp || !$wild){echo "<![endif]-->\n";}
?>

</div>
<hr>
</div>
 <?
  include "footerinclude.php";
  ?>
