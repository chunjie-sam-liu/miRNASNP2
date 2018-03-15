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
if (preg_match("/[\'\(\):;\"<>]/", urldecode($_SERVER["QUERY_STRING"]))) {
    echo '<script>
        alert("Input is illegal, you are return back ^.^!");
        // window.history.back();
        document.location.href="/miRNASNP2";
    </script>';
    exit;
}


?>
<?php

$page_title="Targets";
include "head.php";
require_once "connectinclude.php";

?>
<script>
$(document).ready(function() {
    $('input[type=checkbox].disable-gain').on('click', function(e){
        if ($(this).is(':checked')) {
	        $('button#submit-gain').addClass('disabled');
        };
        if ($('input[type=checkbox].disable-gain:checked').length == 0) {
            $('button#submit-gain').removeClass('disabled');
        }
    });
});
</script>
<?php
    // var_dump($_SERVER);
    // var_dump(urldecode($_SERVER["QUERY_STRING"]));
?>
<?

//for search
// var_dump($_GET);
$_GET = array_map('mysql_real_escape_string', $_GET);
// var_dump($_GET);
// var_dump($_SERVER);
// var_dump(urldecode($_SERVER["QUERY_STRING"]));


$gene = $_GET["gene"];
$mirna=$_GET["mirna"];
$snp=$_GET["snp"];
$mirna_expression = $_GET["mirna_expression"];
$gene_expression = $_GET["gene_expression"];

// check box
$validate = $_GET["validate"];
$negative = $_GET["negative"];
$ld = $_GET["ld"];

//submit gain or loss
$gainorlost=$_GET["gainorlost"];

//pangination
$page = $_GET["page"];
$pages = 0;
?>

	<!--	//pagination-->
<?function paginate($count, &$sql, &$page,&$pages){
	$pagesize = 30;
	$pages = ceil($count/$pagesize);
	if(isset($_GET["page"])){
		$page = intval($_GET['page']);
	}
	else $page = 1;

	$offset = $pagesize*($page - 1);
	$sql = $sql."  limit $offset, $pagesize";
}?>

	<!--page navigation function-->
<?function pageButton($count,$page,$pages, $sql){
	$url=$_SERVER["REQUEST_URI"];
	$parse_url=parse_url($url);
	$url_query=$parse_url["query"];

	if($url_query){
		if(preg_match('/page=/',$url_query)){
			$url = preg_replace('/page=\d*/', '', $url);
			$url = $url.'page';
		}
		else $url=$url.'&page';
	}
	else {
		$url.="?page";
	}
	?>
	<div style="magin:10px;">
		<ul class="pager" style="list-style-type: none">

			<li style="float:left;"><a style="width:180px">Total:<? echo $count?></a></li>

			<li><a style="width: 100px;" href="<?echo $url?>=1">First</a></li>

			<li <?if($page==1) echo "class='disabled'"?>><a style="width: 100px;" href="<?if($page==1)echo $url."=1#"; else echo $url.'='.($page-1);?>">Previous</a></li>

			<li <?if($page==$pages) echo "class='disabled'"?>><a style="width: 100px;" href="<?if($page==$pages)echo $url.'='.$pages; else echo $url.'='.($page+1);?>">Next</a></li>


			<li ><a style="width: 100px; "href="<?echo $url.'='.$pages?>">Last</a></li>

			<li>
				<select name="page" style="width: 100px;color:rgb(66,139,202);border:1px solid #ccc;border-radius: 15px;box-shadow:inset 0 1px 1px #ccc;padding: 5px 12px;" onchange="window.location='<?echo $url."="?>'+this.value">
					<? for($i=1; $i<=$pages;$i++){?>
						<option value="<?echo $i?>"><?echo $i?></option>
					<?}?>
				</select>
			</li>
			<!-- <li style="float: right;"><a href="downloading.php?sql=<?echo base64_encode($sql)?>">Download</a></li> -->
			<li style="float: right;"><a style="width: 100px;">Page: <?echo $page;?></a></li>
		</ul>
	</div>
<?}?>

	<!--	//the search show function;-->
	<!--	//to get all records in seed regions-->
<?function gain($gene,$mirna,$snp,$gene_expression,$mirna_expression,$ld){?>
	<?
	//condition
	$sql = "select * from gene_target_gain where ";

	$condition = array();

	if($mirna != ""){
		$tmp = "miRNA_id='" . $mirna . "'" ;
		array_push($condition,$tmp);
	}
	if($gene != ""){
		$tmp = "gene_id='" . $gene . "'" ;
		array_push($condition,$tmp);
	}
	if($snp != ""){
		$tmp = "SNP_id='" . $snp . "'" ;
		array_push($condition,$tmp);
	}

	if($gene_expression !="") {
		$tmp = "gene_ave > $gene_expression";
		array_push($condition, $tmp);
	}
	if($mirna_expression != "") {
		$tmp = "mirna_ave > $mirna_expression";
		array_push($condition, $tmp);
	}
	if($ld !=""){
		$tmp = 'ld_num = 1';
		array_push($condition, $tmp);
	}

	$condition = join(" AND ", $condition);

	$sql = $sql.$condition;

	$result = mysql_query($sql);
	$count = mysql_num_rows($result);

	paginate($count,$sql,$page,$pages);
	$result = mysql_query($sql);
	?>

	<?pageButton($count,$page,$pages, $sql);?>
	<table class="table table-hover table-bordered tablesorter" style="font-size: 14px;">
		<thead><tr class="info">
			<th>miRNA</th>
			<th>miRNA<br>exp.
				<span class="glyphicon glyphicon-question-sign red" data-toggle="popover" data-container="body" data-content="miRNA average expression! Click number to show details" data-trigger="hover" data-placement="bottom"></span>
				</th>
			<th>SNP in<br>gene 3'UTR</th>
			<th>Gene<br>exp.
				<span class="glyphicon glyphicon-question-sign red" data-toggle="popover" data-container="body" data-content="gene average expression!! Click number to show details" data-trigger="hover" data-placement="bottom"></span>
				</th>
			<th style="text-align: center">&Delta;&Delta;G&nbsp;<span class="glyphicon glyphicon-question-sign red" data-toggle="popover" data-container="body" data-content="Energy change (kcal/mol)" data-trigger="hover" data-placement="bottom"></span></th>
			<th style="text-align: center">miRNA/SNP-target duplexes </th>
			<th>LD SNP</th>
			<th style="text-align: center">Effect</th>
		</tr></thead>
		<tbody><?while($row = mysql_fetch_array($result)){?>
			<tr>
				<td style="text-align: center;vertical-align: middle">
					<a href="http://www.mirbase.org/cgi-bin/query.pl?terms=<? echo $row["miRNA_id"] ?>" target="_blank"><?echo $row['miRNA_id'];?></a>
				</td>
				<td style="text-align: center;vertical-align: middle">
					<?if($row['mirna_ave']!='NULL'){?>
					<a data-toggle="modal" href="#mymirna<?echo $row['id']?>">
						<strong style="color:red"><?echo $row['mirna_ave'];?></strong>
					</a>
					<?}
					else echo '-';
					?>
				</td>
				<div id="mymirna<?echo $row['id'] ?>" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
					<div class="modal-dialog" style="width:1000px;margin-top:7%;">
						<div class="modal-content" >
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title"><? echo $row['miRNA_id'] ?></h4>
							</div>
							<div class="modal-body"  >
								<img src="draw_expression.php?id=<? echo $row['mirnaID'];?>&flag=mirna">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				<td style="text-align: center;vertical-align: middle">
					<? echo $row['gene_id'] ?>
					<br>
					<a href = "http://www.ncbi.nlm.nih.gov/nuccore/<? echo $row["NM_id"]?>" target = _blank><?echo $row['NM_id'] ?></a>
					<br>
					<a href="http://www.ncbi.nlm.nih.gov/projects/SNP/snp_ref.cgi?rs=<? echo $row["SNP_id"] ?>" target="_blank"><?echo $row['SNP_id'] ?></a>
					<br>
					<?echo $row['snp_loc'] ?>
				</td>
				<td style="text-align: center;vertical-align: middle">
					<?if($row['gene_ave']!='NULL'){?>
					<a data-toggle="modal" href="#mygene<?echo $row['id']?>">
						<strong style="color:red;"><?echo $row['gene_ave'];?></strong>
					</a>
					<?}
					else echo '-';
					?>
				</td>
				<div id="mygene<?echo $row['id'] ?>" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
					<div class="modal-dialog" style="width:1000px;margin-top:7%;">
						<div class="modal-content" >
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title"><? echo $row['gene_id'] ?></h4>
							</div>
							<div class="modal-body"  >
								<img src="draw_expression.php?id=<? echo $row['geneID'];?>&flag=gene">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				<td style="text-align: center;vertical-align: middle">
					Wild: <? echo $row['wild_energy'] ?>
					<br>
					SNP: <? echo $row['snp_energy'] ?>
				</td>
				<td style="text-align: center;vertical-align: middle;">
					<!--					draw match by table-->
					<?
					$str=$row["base_pair"];
					$enter=0;
					?>
					<table style="margin:auto;" border="0" cellpadding="0" >
						<?
						$variable = " ";
						for($i=0;$i<strlen($str);$i++){
						if($str[$i]=="\n"){$enter++;}
						if($enter>=2){
						if($str[$i]=="\n"){?>
						<tr>
							<?}
							else{?>
								<td>
									<?
									if($str[$i]=='Y'){?>
										<div style="color:#FF0000">
											<?echo '<b>'.'|'.'<b>';?>
										</div>
									<?}
									elseif($str[$i]=='S'){?>
										<div style="color:#F0F;font-weight:bold;">
											<a href="http://www.ncbi.nlm.nih.gov/projects/SNP/snp_ref.cgi?rs=<? echo $row["SNP_id"] ?>" target="_blank">
												<? echo $variable;?>
											</a>
										</div>
									<?
									}
									else{
										if($str[$i-1] == " " && $str[$i+1]=="\n") $variable =$str[$i];
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
				<td style="text-align: center;vertical-align: middle">
					<?
					if($row["ld_num"] > 0) echo '<span class="glyphicon glyphicon-ok green" value="0"></span>';
					else echo '<span class="glyphicon glyphicon-remove red" value="0"></span>'
					?>
				</td>
				<td style="text-align: center;vertical-align: middle">gain</td>
			</tr>
		<?}?></tbody>
	</table>
	<?pageButton($count,$page,$pages,$sql);?>

<?}?>


<?function loss($gene,$mirna,$snp,$gene_expression,$mirna_expression, $validate, $ld, $negative){?>
	<?
	//condition
	$sql = "select * from gene_target_lost where ";

	$condition = array();
	if($mirna != ""){
		$tmp = "miRNA_id='" . $mirna . "'" ;
		array_push($condition,$tmp);
	}
	if($gene != ""){
		$tmp = "gene_id='" . $gene . "'" ;
		array_push($condition,$tmp);
	}
	if($snp != ""){
		$tmp = "SNP_id='" . $snp . "'" ;
		array_push($condition,$tmp);
	}

	if($gene_expression !="") {
		$tmp = "gene_ave > $gene_expression";
		array_push($condition, $tmp);
	}
	if($mirna_expression != "") {
		$tmp = "mirna_ave > $mirna_expression";
		array_push($condition, $tmp);
	}

	if($validate !=""){
		$tmp = 'validate = 1';
		array_push($condition, $tmp);
	}
	if($ld !=""){
		$tmp = 'ld_num = 1';
		array_push($condition, $tmp);
	}
	if($negative !=""){
		$tmp = 'dlbc < -0.2';
		array_push($condition, $tmp);
	}
	$condition = join(" AND ", $condition);

	$sql = $sql.$condition;

	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	paginate($count,$sql,$page,$pages);
	$result = mysql_query($sql);
	?>

	<?pageButton($count,$page,$pages, $sql);?>
	<table class="table table-hover table-bordered tablesorter" style="font-size: 14px;">
		<thead>
			<tr class="info">
			<th>miRNA</th>
			<th>miRNA <br>exp.<span class="glyphicon glyphicon-question-sign red" data-toggle="popover" data-container="body" data-content="miRNA average expression! Click number to show details" data-trigger="hover" data-placement="bottom"></span></th>
			<th>SNP in <br>gene 3'UTR</th>
			<th>Gene <br>exp.<span class="glyphicon glyphicon-question-sign red" data-toggle="popover" data-container="body" data-content="gene average expression!! Click number to show details" data-trigger="hover" data-placement="bottom"></span></th>
			<th><span class="glyphicon glyphicon-question-sign green" data-toggle="popover" data-container="body" data-content="miRNA-gene validated by experiment" data-trigger="hover" data-placement="bottom"></span></th>
			<th>Cor.&nbsp;<span class="glyphicon glyphicon-question-sign red" data-toggle="popover" data-container="body" data-content="The expression correlation value between miRNA and gene is calculated based on expression of pairwise samples of DLBC;click number to show details." data-trigger="hover" data-placement="bottom"></span></th>
			<th style="text-align: center">&Delta;&Delta;G&nbsp;<span class="glyphicon glyphicon-question-sign red" data-toggle="popover" data-container="body" data-content="Energy change (kcal/mol)" data-trigger="hover" data-placement="bottom"></th>
			<th style="text-align: center">SNP-miRNA/target duplexes </th>
			<th>LD SNP</th>
			<th style="text-align: center">Effect</th>
			</tr>
		</thead>
		<tbody>
		<?while($row = mysql_fetch_array($result)){?>
			<tr>
				<td style="text-align: center;vertical-align: middle">
					<a href="http://www.mirbase.org/cgi-bin/query.pl?terms=<? echo $row["miRNA_id"] ?>" target="_blank"><?echo $row['miRNA_id'];?></a>
				</td>
				<td style="text-align: center;vertical-align: middle">
					<?if($row['mirna_ave'] != 'NULL' ){?>
					<a data-toggle="modal" href="#mymirna<?echo $row['id']?>">
						<strong style="color:red"><?echo $row['mirna_ave'];?></strong>
					</a>
					<?}
					else echo '-';
					?>

				</td>
				<div id="mymirna<?echo $row['id'] ?>" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
					<div class="modal-dialog" style="width:1000px;margin-top:7%;">
						<div class="modal-content" >
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title"><? echo $row['miRNA_id'] ?></h4>
							</div>
							<div class="modal-body"  >
								<img src="draw_expression.php?id=<? echo $row['mirnaID'];?>&flag=mirna">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				<td style="text-align: center;vertical-align: middle">
					<? echo $row['gene_id'] ?>
					<br>
					<a href = "http://www.ncbi.nlm.nih.gov/nuccore/<? echo $row["NM_id"]?>" target = _blank><?echo $row['NM_id'] ?></a>
					<br>
					<a href="http://www.ncbi.nlm.nih.gov/projects/SNP/snp_ref.cgi?rs=<? echo $row["SNP_id"] ?>" target="_blank"><?echo $row['SNP_id'] ?></a>
					<br>
					<?echo $row['snp_loc'] ?>
				</td>
				<td style="text-align: center;vertical-align: middle">
					<?if($row['gene_ave'] != 'NULL'){?>
					<a data-toggle="modal" href="#mygene<?echo $row['id']?>">
						<strong style="color:red"><?echo $row['gene_ave'];?></strong>
					</a>
					<?}
					else echo '-';
					?>
				</td>
				<div id="mygene<?echo $row['id'] ?>" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
					<div class="modal-dialog" style="width:1000px;margin-top:7%;">
						<div class="modal-content" >
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title"><? echo $row['gene_id'] ?></h4>
							</div>
							<div class="modal-body"  >
								<img src="draw_expression.php?id=<? echo $row['geneID'];?>&flag=gene">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				<td style="text-align: center;vertical-align: middle">
					<?if($row['validate'] == 1){
						echo '<span class="glyphicon glyphicon-ok green" value="0"></span>';
					}
					else{
						echo '<span class="glyphicon glyphicon-remove red" value="0"></span>';
					}?>
				</td>
				<td style="text-align: center;vertical-align: middle">
					<?if(!($row['dlbc']=="NULL" || $row['dlbc'] == 'NA')){?>
						<a data-toggle="modal" href="#col<?echo $row['id']?>">
							<strong style="color:red"><?echo $row['dlbc'];?></strong>
						</a>
					<?}
					else echo '-';
					?>

				</td>
				<div id="col<?echo $row['id'] ?>" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
					<div class="modal-dialog" style="width:1000px;margin-top:7%;">
						<div class="modal-content" >
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title"><? echo $row['miRNA_id'].'&mdash;&mdash;&mdash;'.$row['gene_id'] ?></h4>
							</div>
							<div class="modal-body"  >
								<img src="drawcorrelation.php?id=<? echo $row['colID'];?>">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				<td style="text-align: center;vertical-align: middle">
					Wild: <? echo $row['wild_energy'] ?>
					<br>
					SNP: <? echo $row['snp_energy'] ?>
				</td>
				<td style="text-align: center;vertical-align: middle;">
					<!--					draw match by table-->
					<?
					$str=$row["base_pair"];
					$enter=0;
					?>
					<table style="margin:auto" border="0" cellpadding="0" >
						<?
						$variable = " ";
						for($i=0;$i<strlen($str);$i++){
						if($str[$i]=="\n"){$enter++;}
						if($enter>=2){
						if($str[$i]=="\n"){?>
						<tr>
							<?}
							else{?>
								<td>
									<?
									if($str[$i]=='X'){?>
										<div style="color:#FF0000">
											<?echo '<b>'.'X'.'<b>';?>
										</div>
									<?}
									elseif($str[$i]=='S'){?>
										<div style="color:#F0F;font-weight:bold;">
											<a href="http://www.ncbi.nlm.nih.gov/projects/SNP/snp_ref.cgi?rs=<? echo $row["SNP_id"] ?>" target="_blank">
												<? echo $variable;?>
											</a>
										</div>
									<?
									}
									else{
										if($str[$i-1] == " " && $str[$i+1]=="\n") $variable =$str[$i];
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
				<td style="text-align: center;vertical-align: middle">
					<?
					if($row["ld_num"] > 0) echo '<span class="glyphicon glyphicon-ok green" value="0"></span>';
					else echo '<span class="glyphicon glyphicon-remove red" value="0"></span>'
					?>
				</td>
				<td style="text-align: center;vertical-align: middle">loss</td>
			</tr>
		<?}?>
		</tbody>

	</table>

	<?pageButton($count,$page,$pages, $sql);?>

<?}?>


<div id="content">
	<h2 class="quicksearch"> Targets gain/loss by SNPs in gene 3'UTR</h2>

		<!--	form for search-->
		<div class="panel panel-info">
			<div class="panel-heading">
				<h4 class="panel-title">Browse From Here</h4>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" name="mirnaSearch2" method="get" action="geneTargets.php">
                    <input type="hidden" name="token" value="<?php echo $token; ?>" />
					<div class="form-group">
						<label class="col-sm-3 control-label">Browse by gene:</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="gene" pattern="[a-zA-Z0-9]*">
						</div>
						<span class="help-block">(e.g. AGTR1)</span>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Browse by miRNA:</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="mirna" pattern="[a-zA-Z0-9\-]+">
						</div>
						<span class="help-block">(e.g. hsa-miR-155-5p)</span>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Browse by SNP:</label>
						<div class="col-sm-3">
							<input type="text" class="form-control " name="snp" pattern="rs\d+">
						</div>
						<span class="help-block">(e.g. rs5186)</span>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">miRNA expression:</label>
						<div class="col-sm-3">
							<select class="form-control " name="mirna_expression">
								<option value="0">ALL</option>
								<option value="1">&gt;1</option>
								<option value="10">&gt;10</option>
								<option value="100">&gt;100</option>
								<option value="1000">&gt;1000</option>
							</select>
						</div>
						<span class="help-block" style="color:green">Filter by average expression (RPM) in different cancers in TCGA</span>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">gene expression:</label>
						<div class="col-sm-3">
							<select class="form-control " name="gene_expression">
								<option value="0">ALL</option>
								<option value="1">&gt;1</option>
								<option value="10">&gt;10</option>
								<option value="100">&gt;100</option>
								<option value="1000">&gt;1000</option>
							</select>
						</div>
						<span class="help-block" style="color:green" >Filter by average expression (RPKM) in different cancers in TCGA</span>
					</div>
					<div class="form-group has-error ">
						<div class="checkbox col-sm-offset-3 col-sm-4" data-triggle="hover" data-placement="right" data-original-title="only for loss">
							<label>
								<input  type="checkbox" name="ld" value="1"><strong>SNP in GWAS LD Region</strong>
							</label>
						</div>
					</div>
					<div class="form-group has-error ">
						<div class="checkbox col-sm-offset-3 col-sm-4" data-triggle="hover" data-placement="right" data-original-title="only for loss">
							<label>
								<input class='disable-gain' type="checkbox" name="validate" value="1"><strong>miRNA:target experimental validated</strong>
							</label>
							<span class="glyphicon glyphicon-question-sign" data-toggle="popover" data-container="body" data-content="Not available for Gain option, because there are no validated targets and expression correlation data for SNP type 3'UTR and miRNA " data-trigger="hover" data-placement="right"></span>
						</div>
					</div>
					<div class="form-group has-error ">
						<div class="checkbox col-sm-offset-3 col-sm-6" data-triggle="hover" data-placement="right" data-original-title="only for loss">
							<label>
								<input class='disable-gain' type="checkbox" name="negative" value="1"><strong>miRNA expression negatively correlate with gene expression</strong>
							</label>
							<span class="glyphicon glyphicon-question-sign" data-toggle="popover" data-container="body" data-content="Not available for Gain option, because there are no validated targets and expression correlation data for SNP type 3'UTR and miRNA " data-trigger="hover" data-placement="right"></span>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3">
							<input type="hidden" name="hash" value=<?php echo $_COOKIE['cookie']?>></input>
							<button class="btn btn-danger" type="submit" name="gainorlost" value="gain" id='submit-gain'>Gain</button>
							<button class="btn btn-primary" type="submit" name="gainorlost" value="loss">Loss</button>
						</div>
					</div>
				</form>
			</div>
		</div>

		<?
		if($gainorlost == "gain"){
			gain($gene,$mirna,$snp,$gene_expression,$mirna_expression,$ld);
		}
		elseif($gainorlost == "loss"){
			loss($gene,$mirna,$snp,$gene_expression,$mirna_expression, $validate, $ldi, $negative);
		}

		?>


</div>

<?
include "footerinclude.php";

?>
