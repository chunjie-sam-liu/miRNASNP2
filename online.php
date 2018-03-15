
<?
$page_title="miRNASNP online tools";
include "head.php";
?>

<script>
$(document).ready(function() {
	$('button.submit-check').on('click', function(e) {
		var re_sequence = new RegExp("^[ATGCUatgcu]*$");
		var form = $(this).parents('form');
		var textarea1 = form.find('textarea[name=wild]').val();
		var textarea2 = form.find('textarea[name=snp]').val();
		var value = $.grep(form.find('textarea[data-required=true]'), function(n, i){x=$(n); return x.val() == "";})
		if (!re_sequence.test(textarea1) || !re_sequence.test(textarea2) || textarea1 == "" || value.length > 0) {
			$('<div id="message" class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>	<strong>Error!</strong> Please enter valid sequence!</div>').insertBefore(form);
			e.preventDefault();
		}
	});
});
</script>


<div class="content">
<h2 class="quicksearch">miRNASNP online tools</h2><br/>
 <!--[if IE 6]>  <![endif]-->
	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<!--SNP in gene impact on miRNA:miRNA interaction-->
<div class="panel panel-info" id="gene">
	<div class="panel-heading" role="tab" id="headingOne">
		<h4 class="panel-title">
			<strong>
				(1) SNP in gene impact on miRNA:mRNA interaction
			</strong>
		</h4>
	</div>

	<div class="panel-body">
		<p style="font-size:16px;text-align: justify">
			&nbsp;&nbsp;&nbsp;&nbsp;This is a web server to predict the loss and gain of miRNA:mRNA binding sites disturbed by a SNP in the mRNA 3'UTR sequence. If only one sequence is provided, it will predict miRNAs which target this sequence. While if wild sequence and SNP sequence are provided, it will predict the wild sequence related miRNAs, SNP sequence related miRNAs, the lost miRNAs of the wild sequence and the gained miRNAs of the SNP sequence by comparing the results of the wild and SNP sequences. Only one base difference is allowed between the wild sequence and SNP sequence.
		</p>

		<form name="online" action="onlineResult.php" method="GET">

			<input type="hidden" name="token" value="<?php echo $token; ?>" />
			<div class="form-group has-error">
				<label class="control-label" style="font-size:18px; color:#BD4700;margin:15px 0;">Please input your wild gene sequence(Required):</label>
				<textarea id='textarea-1' rows="3"  class="form-control" name="wild" data-required='true'>GGACAGAGGTCAGCGTGATCCCCTGCCTCAACAGGCCACCGTGAGGGAGG</textarea>
			</div>
			<div class="form-group has-error">
				<label class="control-label" style="font-size: 18px;color:#BD4700;margin:15px 0;">Please input your SNP gene sequence (Optional):</label>
				<textarea id='textarea-2' rows="3" class="form-control" name="snp">GGACAGAGGTCAGCGTGATCCCCTACCTCAACAGGCCACCGTGAGGGAGG</textarea>
			</div>
			<div style="text-align: right">
				<input type="hidden" name="hash" value=<?php echo $_COOKIE['cookie']?>></input>
				<button type="submit" value="Submit" name="submit" class="btn btn-danger submit-check">Submit</button>
			&nbsp;&nbsp;&nbsp;&nbsp;
				<button type="reset"  value="Example" name="reset" class="btn btn-primary">Example</button>
			</div>
		</form>
	</div>

</div>


 <!--[if IE 6]> 3td <![endif]-->

<!--SNP in miRNA seed impact on miRNA:miRNA interaction-->
<div class="panel panel-info" id="seed">
	<div class="panel-heading">
		<h4 class="panel-title"><strong>(2) SNP in miRNA seed impact on miRNA:mRNA interaction</strong></h4>
	</div>
	<div class="panel-body">
		<p style="font-size:16px;text-align: justify">
			&nbsp;&nbsp;&nbsp;&nbsp;This tool is to predict the loss and gain of miRNA:mRNA binding sites disturbed by a SNP in the miRNA seed region. If only one sequence is provided, it will predict target genes of this miRNA. While if wild miRNA and SNP miRNA are provided, it will predict target genes of the wild miRNAs, target genes of the SNP miRNA, lost genes of the wild miRNA and gained genes of the SNP miRNA by comparing the results of the wild and SNP miRNA. Only one base difference is allowed between the wild miRNA and SNP miRNA.
		</p>
		<form name="online" action="onlineResult_2.php" method="GET">
			<input type="hidden" name="token" value="<?php echo $token; ?>" />
			<div class="form-group has-error">
				<label class="control-label" style="font-size:18px; color:#BD4700;margin:15px 0;">Please input your wild miRNA sequence (Required):</label>
				<textarea rows="3"  class="form-control" name="wild" data-required='true'>GCGACCCACUCUUGGUUUCCA</textarea>
			</div>
			<div class="form-group has-error">
				<label class="control-label" style="font-size: 18px;color:#BD4700;margin:15px 0;">Please input your SNP miRNA sequence (Required):</label>
				<textarea rows="3" class="form-control" name="snp" data-required='true'>GCAACCCACUCUUGGUUUCCA</textarea>
			</div>
			<div style="text-align: right">
				<input type="hidden" name="hash" value=<?php echo $_COOKIE['cookie']?>></input>
				<button type="submit" value="Submit" name="submit" class="btn btn-danger submit-check">Submit</button>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<button type="reset"  value="Example" name="reset" class="btn btn-primary">Example</button>
			</div>
		</form>
		<p style="text-align: center;font-size:16px">Note: It takes 1~2 minutes before the result comes out! <span style="color:blue;">Do not close the window!</span></p>
	</div>
</div>


 <!--[if IE 6]> 3td <![endif]-->

<!--SNP impact on the structure of the pre-miRNA-->
<div class="panel panel-info" id="structure">
	<div class="panel-heading">
		<h4 class="panel-title"><strong>(3) SNP impact on the structure of the pre-miRNA</strong></h4>
	</div>
	<div class="panel-body">
		<p style="font-size:16px;text-align: justify">
			&nbsp;&nbsp;&nbsp;&nbsp;This tool is to predict the impact of SNP on the structure of pre-miRNA. When wild pre-miRNA and/or SNP pre-miRNA are provided, it will predict the minimum free energy of the pre-miRNA and automatically draw the secondary structure of pre-miRNA.
		</p>
		<form name="online" action="onlineResult_3.php" method="GET">
			<input type="hidden" name="token" value="<?php echo $token; ?>" />
			<div class="form-group has-error">
				<label class="control-label" style="font-size:18px; color:#BD4700;margin:15px 0;">Please input your wild pre-miRNA sequence (Required):</label>
				<textarea rows="3"  class="form-control" name="wild" data-required='true'>CAGCUCGGGCAGCCGUGGCCAUCUUACUGGGCAGCAUUGGAUGGAGUCAGGUCUCUAAUACUGCCUGGUAAUGAUGACGGCGGAGCCCUGCACG</textarea>
			</div>
			<div class="form-group has-error">
				<label class="control-label" style="font-size: 18px;color:#BD4700;margin:15px 0;">Please input your SNP pre-miRNA sequence (Optional):</label>
				<textarea rows="3" class="form-control" name="snp">CAGCUCGGGCAGCCGUGGCCAUCUUACUGCGCAGCAUUGGAUGGAGUCAGGUCUCUAAUACUGCCUGGUAAUGAUGACGGCGGAGCCCUGCACG</textarea>
			</div>
			<div style="text-align: right">
				<input type="hidden" name="hash" value=<?php echo $_COOKIE['cookie']?>></input>
				<button type="submit" value="Submit" name="submit" class="btn btn-danger submit-check">Submit</button>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<button type="reset"  value="Example" name="reset" class="btn btn-primary">Example</button>
			</div>
		</form>
	</div>
</div>
</div>

</div>

<?
include "footerinclude.php";
?>
