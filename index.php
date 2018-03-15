
<?php
$page_title="miRNASNP_v2: miRNA related SNP";
	   include "head.php";
	?>

<div id="content">
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title" >Welcome to the miRNASNP database</h3>
				</div>
				<div class="panel-body text-justify" style="font-size: 16px">
					<span class="top" style="width:auto"> M</span>icroRNAs (miRNAs) are endogenous and regulatory non-coding RNAs by targeting mRNAs for cleavage or translational repression. SNPs in pre-miRNAs or target sites will affect miRNA function and be related with diseases or biological processes. miRNASNP aims to provide a resource of the miRNA-related SNPs, which includes SNPs in pre-miRNAs of human and other species, and target gain and loss by SNPs in miRNA seed regions or 3'UTR of target mRNAs.
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">New features in miRNASNP V2</h3>
				</div>
				<div class="panel-body text-justify">
					<ol id="new-feature" style="margin:10px 0;">
						<li>Potential functional SNPs increase to 365994;</li>
						<li>Experimental validated miRNA-gene interaction;</li>
						<li>Expression and correlation of miRNAs and genes;</li>
						<li>Minor allele frequency (MAF) and GWAS information of SNPs;</li>
						<li>Multiple filters to prioritize functional SNP selection;</li>
<li>Tools to predict the effect of miRNA related SNP.</li>
					</ol>
				</div>
			</div>
		</div>
	</div>

	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title"><strong>Database</strong></h3>
		</div>
		<div class="panel-body" style="background-image: url('image/background.png')">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<a href="snphumanpremir.php" class="thumbnail" style="border: none">
						<img src="image/pre-miRNA.jpg">
					</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 ">
					<a href="geneTargets.php" class="thumbnail" style="border: none">
						<img src="image/3utr.jpg">
					</a>
				</div>
				<div class="col-md-4 col-md-offset-4">
					<a href="Targets.php" class="thumbnail" style="border: none">
						<img src="image/seed.jpg">
					</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 col-md-offset-1">
					<a href="home_species.php" class="thumbnail" style="border: none">
						<img src="image/ohterspecies.jpg">
					</a>
				</div>
				<div class="col-md-4 col-md-offset-2">
					<a href="home_flanking.php" class="thumbnail" style="border: none">
						<img src="image/flanking.jpg">
					</a>
				</div>
			</div>

		</div>
	</div>


	<div class="panel panel-info" >
		<div class="panel-heading">
			<h3 class="panel-title"><strong>Tools</strong></h3>
		</div>
		<div class="panel-body">
			<div class="row">
				<a href="online.php#gene"><div class="col-md-4">
					<div class="thumbnail">
						<img src="image/service_in_gene_interaction.png" alt="service_in_gene_interaction" style="height: 100px;display: block">
					</div>
					<div class="caption">
						<p style="font-size: 16px;text-align: center">SNP in gene impact on</p>
						<p style="font-size: 16px;text-align: center">miRNA:mRNA interaction</p>
					</div>
				</div></a>
				<a href="online.php#seed"><div class="col-md-4">
					<div class="thumbnail">
						<img src="image/service_in_miRNA_interaction.png" alt="service_in_miNRA_interaction" style="height: 100px;display: block">
					</div>
					<div class="caption">
						<p style="font-size: 16px;text-align: center">SNP in miRNA impact on</p>
						<p style="font-size: 16px;text-align: center">miRNA:mRNA interaction</p>
					</div>
				</div></a>
				<a href="online.php#structure"><div class="col-md-4">
					<div class="thumbnail">
						<img src="image/service_in_miRNA_structure.png" alt="service_in_miNRA_structure" style="height: 100px;display: block">
					</div>
					<div class="caption">
						<p style="font-size: 16px;text-align: center">SNP in miRNA impact on</p>
						<p style="font-size: 16px;text-align: center"> the structure of pre-miRNA</p>
					</div>
				</div></a>
			</div>
		</div>
	</div>


	<div class="panel panel-info default-font" style="margin-top:20pt;">
		<div class="panel-heading">
			<h3 class="panel-title"><strong>Publication for citation</strong></h3>
		</div>
		<div class="panel-body" >
			<a href="http://www.ncbi.nlm.nih.gov/pubmed/?term=25877638" target=_blank>An update of miRNASNP database for better SNP selection by GWAS data, miRNA expression and online tools</a><br />
			Jing Gong, Chunjie Liu, Wei Liu, Yuliang Wu, Zhaowu Ma, Hu Chen, and An-Yuan Guo.&nbsp;&nbsp;&nbsp;&nbsp;Database published online April 15, 2015, 2015: bav029<br />
			<a href="http://www.ncbi.nlm.nih.gov/pubmed/22045659" target=_blank>Genome-Wide Identification of SNPs in MicroRNA Genes and the SNP Effects on MicroRNA Target Binding and Biogenesis</a><br/>
			J Gong, Y Tong, HM Zhang, K Wang, T Hu, G Shan, J Sun*, and AY Guo*.&nbsp;&nbsp;&nbsp;&nbsp;Human Mutation 2011;DOI: 10.1002/humu.21641
		</div>
	</div>

</div>

<?
include "footerinclude.php";

?>

