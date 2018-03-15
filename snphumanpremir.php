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

// # Check URL
if ($_SERVER["SCRIPT_NAME"] != $_SERVER["PHP_SELF"]) {
    echo '<script>
        alert("Input is illegal, you are return back ^.^!");
        // window.history.back();
        document.location.href="/miRNASNP2";
    </script>';
    exit;
}
//
// # Exclude illegal query
if (preg_match("/[\'\(\);\"<>]/", urldecode($_SERVER["QUERY_STRING"]))) {
    echo '<script>
        alert("Input is illegal, you are return back ^.^!");
        // window.history.back();
        document.location.href="/miRNASNP2";
    </script>';
    exit;
}
//

?>
<?
$page_title="miRNASNP:the list of SNP-miRNA";
	    include "head.php";
	    include "connectinclude.php";
		include("pages.php");
	?>

<div id="content" >
<h2 class="quicksearch">SNPs in human pre-miRNA regions</h2>
<p style='text-align: justify'>There are 2257 SNPs in human pre-miRNA regions.The SNP data are based on  <a href='http://www.ncbi.nlm.nih.gov/projects/SNP/' target="_blank"/>dbSNP version: 137 </a>.The human genome assembly is NCBI GRCh37. You can click on your interesting  miRNA in the following table to see details, including miRNA information and SNP information. Energy change represents the minimum free energy(MFE) of SNP-miRNA minus MFE of wild-miRNA. Predicted product represents the effect of SNP on the maturation of miRNA. Up means the SNP may up-regulate the product of miRNA, while down means the SNP may down-regulate the miRNA product and mild means the SNP slightly or do not change the product of miRNA.</p>
<br>

<?php
	// var_dump($_SERVER);
	// var_dump(urldecode($_SERVER["QUERY_STRING"]));
?>
<!--	filter from here-->
	<form class="form-horizontal" role="form" method="get" action="snphumanpremir.php">
		<input type="hidden" name="token" value="<?php echo $token; ?>" />
		<div class="form-group has-error">
			<label class="control-label col-sm-2">Position:</label>
			<div class="col-sm-3">
			<input type="text" class="form-control" name="position" value="<?echo $_GET[position];?>" placeholder="chr1:1102563-201688733" pattern="chr.*:\d+-\d+">
			</div>
			<span class="help-block">input a user-defined region such as "chr1:1102563-201688733" or "chr1"</span>
		</div>
		<div class="form-group has-error">
			<label class="control-label  col-sm-2">SNP GMAF:</label>
			<div class="col-sm-3">
				<select class="form-control " name="gmaf">
					<option value="0">ALL</option>
					<option value="0.01">&lt;0.01</option>
					<option value="0.05">&lt;0.05</option>
					<option value="0.1">&gt;0.01</option>
					<option value="0.5">&gt;0.05</option>
				</select>
			</div>
		</div>
		<div class="form-group has-error">
			<label class="control-label  col-sm-2">Energy Change:</label>
			<div class="col-sm-3">
				<select class="form-control" name="engergyChange">
					<option value="0">ALL</option>
					<option value="2">&gt;2</option>
					<option value="-2">&lt;-2</option>
				</select>
			</div>
			<div class="has-error ">
				<div class="checkbox col-sm-offset-5">
					<label>
						<input type="checkbox" name="gwas" value="1"><strong>in GWAS LD Region</strong>
					</label>
				</div>
			</div>
		</div>
		<div class="form-group has-error">
			<div class="col-sm-offset-5 col-sm-2">
				<input type="hidden" name="hash" value=<?php echo $_COOKIE['cookie']?>></input>
				<button type="submit" class="btn btn-danger">
					Search
				</button>
				<button type="reset" class="btn btn-primary">
					Reset
				</button>
			</div>
		</div>
	</form>

<?

	$position = $_GET['position'];
	$gmaf = $_GET['gmaf'];
	$energyChange = $_GET['engergyChange'];
	$gwas = $_GET['gwas'];

	$sql = "select * from snphumanpremir";

//filteration
			if($gwas == 1){
				if(preg_match("/where/", $sql)) $sql = $sql." and ld_num > 0 ";
				else $sql = $sql." where ld_num > 0";
			}
			if($gmaf == 0.01){
				if(preg_match("/where/", $sql)) {$sql = $sql." and alt_freq <0.01 "; }
				else $sql = $sql." where alt_freq <0.01";
			}
			if($gmaf == 0.05){
				if(preg_match("/where/", $sql)) $sql = $sql." and  alt_freq <0.05 ";
				else $sql = $sql." where  alt_freq < 0.05";
			}
			if($gmaf == 0.1){
				if(preg_match("/where/", $sql)) $sql = $sql." and  alt_freq >0.01 ";
				else $sql = $sql." where  alt_freq > 0.01";
			}
			if($gmaf == 0.5){
				if(preg_match("/where/", $sql)) $sql = $sql." and  alt_freq >0.05 ";
				else $sql = $sql." where  alt_freq > 0.05";
			}
			if($energyChange == 2){
				if(preg_match("/where/", $sql)) $sql = $sql." and  changed_energy > 2";
				else $sql = $sql." where  changed_energy > 2";
			}
			if($energyChange == -2){
				if(preg_match("/where/", $sql)) $sql = $sql." and changed_energy <-2";
				else $sql = $sql." where  changed_energy <-2";
			}
			if(!empty($position)){
				if(preg_match("/-/",$position)){
					$array = explode(":", $position);
					$span = explode("-", $array[1]);
					if(preg_match("/where/", $sql)) $sql = $sql." and chr = '".$array[0]."' and position between $span[0] and $span[1]";
					else $sql = $sql." where  chr = '".$array[0]."' and  position between $span[0] and $span[1]";
				}
				else{
					if(preg_match("/where/", $sql)) $sql = $sql." and chr = '".$position ."'";
					else $sql = $sql." where  chr = '".$position ."'";
				}
			}

//pagination
			$url=$_SERVER["REQUEST_URI"];

			$parse_url=parse_url($url);

			$url_query=$parse_url["query"];

			if($url_query){
				if(preg_match('/page=/',$url_query)) {
					$url = preg_replace('/page=\d*/', '', $url);
					$url=$url.'page';
				}
				else $url=$url.'&page';
			}else {
				$url.="?page";
			}

			$count = mysql_fetch_row(mysql_query( str_replace("*", "count(*)",$sql )))[0];

			$pagesize = 30;
			$pages = ceil($count/$pagesize);

			if(isset($_GET["page"])){
				$page = intval($_GET['page']);
			}
			else $page = 1;

			$offset = $pagesize*($page - 1);
			$sql = $sql." order by id limit $offset, $pagesize";


			$result = mysql_query($sql);

?>
<!--pagination-->
	<div style="magin:10px;">
		<ul class="pager" style="list-style-type: none">

			<li style="float:left;"><a style="width:180px">Total records:<? echo $count?></a></li>

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

<table  id="snphuman" class="table tablesorter table-hover table-bordered ">
	<thead>
	<tr class="info">
		<th data-sort="string" >
			Pre-miRNA
		</th>
		<th>
			SNP ID
		</th>
		<th>
			Chr
		</th>
		<th data-sort="int">Position</th>
		<th style="text-align:center;">Allele</th>
		<th style="text-align: center">GMAF<br>(%)</th>
		<th style="text-align:center">
			Location
			<a data-toggle="popover"  data-container="body" data-content="Here, pre-miRNA means SNP in pre-miRNA but not in mature region; in mature means SNP in mature region but not in seed region." data-trigger="hover" data-placement="bottom">
			<span class="glyphicon glyphicon-question-sign red"  ></span></a>
		</th>
		<th style="text-align: center"> Energy change<br>(kcal/mol)</th>
		<th style="text-align:center">
			Predict<span class="glyphicon glyphicon-question-sign red" data-container="body" data-toggle="popover" data-content="up:expression increases; mild:expression changes mildly; down:expression decreases." data-trigger="hover" data-placement="bottom"></span>
		</th>
		<th style="text-align: center">LD SNP</th>
	</tr>
	</thead>
	<tbody>
	<?while($row = mysql_fetch_array($result)){?>
		<tr>
			<td>
				<a href="miRNA_details.php?id=<? echo $row["premir"] ?>">
					<span style="color:red;font-weight: bold"><? echo $row["premir"];?></span>
				</a>
			</td>
			<td>
				<a href="http://www.ncbi.nlm.nih.gov/projects/SNP/snp_ref.cgi?rs=<? echo $row["snp_id"] ?>" target="_blank">
					<? echo $row["snp_id"];?>
			</td>
			<td style="text-align: center;">
				<? echo $row["chr"]?>
			</td>
			<td style="text-align: center">
				<?echo $row['position'];?>
			</td>
			<td style="text-align: center;">
				<?echo $row["ref_allele"]?>
			</td>
			<td style="text-align: center;">
				<?if(is_numeric($row["ref_freq"])) echo $row["ref_freq"]."/".$row["alt_freq"];else echo "-";?>
			</td>
			<td style="text-align: center">
				<?
				if($row["seed"]=="in_m") {echo "in mature";}
				else if($row["seed"]=="in_seed") echo "in seed";
				else echo "pre-miRNA";
				?>
			</td>
			<td style="text-align: center">
				<?
				echo $row["changed_energy"];
				?>
			</td>
			<td style="text-align: center">
				<?
				if($row["changed_energy"]>=2) echo "down";
				elseif($row["changed_energy"]<=-2)
					echo "up";
				else echo "mild";
				?>
			</td>
			<td style="text-align: center">
				<?
				if($row["ld_num"] > 0) echo '<span class="glyphicon glyphicon-ok green" value="0"></span>';
				else echo '<span class="glyphicon glyphicon-remove red" value="0"></span>'
				?>
			</td>
		</tr>
	<?}?>
	</tbody>
</table>

<div style="magin:10px;">
	<ul class="pager" style="list-style-type: none">

		<li style="float:left;"><a style="width:180px">Total records:<? echo $count?></a></li>

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
  </div>

  <?include "footerinclude.php";?>
