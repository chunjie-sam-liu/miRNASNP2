	<?
	$page_title="miRNASNP:search";
	   include "head.php";
	?>

<div id="content">
	<h2 class="quicksearch"> miRNASNP</h2>

	<div class="panel panel-info" name="Search by snp type">
		<div class="panel-heading">
			<h3 class="panel-title">
				Search by SNP type
			</h3>
		</div>
		<div class="panel-body headedBox">
			<form class="form-horizontal" role="form" action="theListofRNA.php" method="get">
				<input type="hidden" name="token" value="<?php echo $token; ?>" />
				<input type="hidden" name="token" value="<?php echo $token; ?>" />
				<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align: right">SNPs in the flanking regions:</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" placeholder="hsa-mir-449b" name="terms" value="hsa-mir-449b"/>
						<input type="hidden" name="terms1" value="flanking" />
					</div>
					<div class="col-sm-2">
					<input type="hidden" name="hash" value=<?php echo $_COOKIE['cookie']?>></input>
						<button class="btn btn-primary" type="submit">Search</button>
					</div>
				</div>
			</form>
			<form class="form-horizontal" role="form" action="theListofRNA.php" method="get">
				<input type="hidden" name="token" value="<?php echo $token; ?>" />
				<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align: right">SNPs in the reed regions:</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" placeholder="hsa-mir-33a" name="terms" value="hsa-mir-33a"/>
						<input type="hidden" name="species" value="human" />
					</div>
					<div class="col-sm-2">
						<input type="hidden" name="hash" value=<?php echo $_COOKIE['cookie']?>></input>
						<button class="btn btn-primary" type="submit">Search</button>
					</div>
				</div>
			</form>
			<form class="form-horizontal" role="form" action="theListofRNA.php" method="get">
				<input type="hidden" name="token" value="<?php echo $token; ?>" />
				<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align: right">SNPs in the pre-miRNA except seed:</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" placeholder="hsa-mir-449b" name="terms" value="hsa-mir-449b"/>
					</div>
					<div class="col-sm-2">
						<input type="hidden" name="hash" value=<?php echo $_COOKIE['cookie']?>></input>
						<button class="btn btn-primary" type="submit">Search</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="panel panel-info" name="Search miRNA in ohter species">
		<div class="panel-heading">
			<h3 class="panel-title">Search miRNA in other species</h3>
		</div>
		<div class="panel-body headedBox">
			<form class="form-horizontal" role="form" action="theListofRNA.php" method="get">
				<input type="hidden" name="token" value="<?php echo $token; ?>" />
				<div class="form-group">
					<label class="col-sm-5 control-label">
						Enter a miRNA accession, name or SNP ID:
					</label>
					<div class="col-sm-2">
						<input type="text" name="terms" class="form-control">
					</div>
					<div class="col-sm-1">
						<input type="hidden" name="hash" value=<?php echo $_COOKIE['cookie']?>></input>
						<button class="btn btn-primary" type="submit">Search</button>
					</div>
					<div class="col-sm-2">
						<select name="species" class="form-control">
							<option value="chicken">chicken</option>
							<option value="chimp">chimp</option>
							<option value="cow">cow</option>
							<option value="dog">dog</option>
							<option value="horse">horse</option>
							<option value="mouse">mouse</option>
							<option value="rattus">rattus</option>
							<option value="zebrafish">zebrafish</option>
						</select>
					</div>

				</div>
			</form>
		</div>
	</div>

	<div class="panel panel-info" name="Targets search">
		<div class="panel-heading">
			<h3 class="panel-title">Targets Search</h3>
		</div>
		<div class="panel-body headedBox">
			<div class="col-md-6" style="border-right:3px solid rgb(100,207,250)">
				<p style="color:green"><strong>Resulted by SNP in miRNA seed region</strong></p>
				<form class="form-horizontal" role="form" action="Targets.php" method="get" name="mirnaSearch2">
					<input type="hidden" name="token" value="<?php echo $token; ?>" />
					<div class="form-group">
						<label class="col-sm-8 control-label">Browse by gene(e.g. ICMT):</label>
						<div class="col-sm-4">
							<input class="form-control" type="text" name="gene">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-8 control-label">Browse by miNRA(e.g. hsa-miR-33a-3p):</label>
						<div class="col-sm-4">
							<input class="form-control" type="text" name="mirna">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-8 control-label">Browse by SNP ID(e.g. rs77809319):</label>
						<div class="col-sm-4">
							<input class="form-control" type="text" name="snp">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-9">
							<input type="hidden" name="hash" value=<?php echo $_COOKIE['cookie']?>></input>
							<button class="btn btn-primary" type="submit" name="gainorlost" value="gain">Gain</button>
							<button class="btn btn-danger" type="submit" name="gainorlost" value="lost">Loss</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-6">
				<p style="color:green"><strong>Resulted by SNP in UTR region</strong></p>
				<form class="form-horizontal" role="form" name="mirnaSearch" method="get" action="geneTargets.php">
					<input type="hidden" name="token" value="<?php echo $token; ?>" />
					<div class="form-group">
						<label class="col-sm-8 control-label">Browse by gene(e.g. AGTR1):</label>
						<div class="col-sm-4">
							<input class="form-control" type="text" name="gene">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-8 control-label">Browse by miNRA(e.g. hsa-miR-155-5p):</label>
						<div class="col-sm-4">
							<input class="form-control" type="text" name="mirna">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-8 control-label">Browse by SNP ID(e.g. rs5186):</label>
						<div class="col-sm-4">
							<input class="form-control" type="text" name="snp">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-9">
							<input type="hidden" name="hash" value=<?php echo $_COOKIE['cookie']?>></input>
							<button class="btn btn-primary" type="submit" name="gainorlost" value="gain">Gain</button>
							<button class="btn btn-danger" type="submit" name="gainorlost" value="loss">Loss</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

	<?
	include "footerinclude.php";
	?>
