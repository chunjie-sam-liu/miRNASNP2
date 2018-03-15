<?php

$page_title="Targets";
include "head.php";
require_once "connectinclude.php";

?>


	<div id="content">
		<h2 class="quicksearch"> Download </h2>
		<div class="panel panel-primary">
			<div class="panel-collapse collapse in" id="collapseZero" role="tabpanel" aria-labelledby="headingZero">
				<div class="panel-body">
					<table class="table table-hover table-bordered">
						<tr >
							<th>miRNA target gain by SNPs in seed regions</th>
							<td style="color:red" ><a href="download/miRNA_targets_gain_by_SNPs_in_seed_regions.txt"  target="_blank" >miRNA targets gain by SNPs in seed regions</a></td>
						</tr>
						<tr >
							<th>miRNA target lost by SNPs in seed regions</th>
							<td style="color:red" ><a href="download/miRNA_targets_loss_by_SNPs_in_seed_regions.txt"  target="_blank" >miRNA targets loss by SNPs in seed regions</a></td>
						</tr>
						<tr >
							<th>miRNA gain by SNPs in gene 3' UTR </th>
							<td style="color:red" ><a href="download/miRNA_gain_by_SNPs_in_gene_3utr.txt"  target="_blank" >miRNA gain by SNPs in gene 3' UTR</a></td>
						</tr>
						<tr >
							<th>miRNA lost by SNPs in gene 3' UTR</th>
							<td style="color:red" ><a href="download/miRNA_loss_by_SNPs_in_gene_3utr.txt"  target="_blank" >miRNA lost by SNPs in gene 3' UTR</a></td>
						</tr>
						<tr >
							<th>SNPs in human pre-miRNA regions</th>
							<td style="color:red" ><a href="download/snp_in_human_premir.txt"  target="_blank" >SNPs in human pre-miRNA regions</a></td>
						</tr>
						<tr >
							<th>SNPs in human miRNA seed region</th>
							<td><a href="download/snp_in_human_miRNA_seed_region.txt" target="_blank">SNPs in human seed region</a></td>
						</tr>
						<tr >
							<th>SNPs located in GWAS LD regions</th>
							<td><a href="download/SNP_located_in_ld_region.txt" target="_blank">SNPs located in GWAS LD regions</a></td>
						</tr>
						<tr >
							<th>miRNA expression in different cancer from TCGA</th>
							<td><a href="download/mirna_expression_TCGA_disease.txt" target="_blank">miRNA expression</a></td>
						</tr>
						<tr >
							<th>gene expression in different cancer from TCGA</th>
							<td><a href="download/gene_expression_TCGA_disease.txt" target="_blank">Gene expression</a></td>
						</tr>
						<tr>
							<th>SNPs in mouse miRNAs</th>
							<td><a href="download/snp_in_mouse_miRNAs.txt">SNPs in mouse miRNAs</a></td>
						</tr>
						<tr>
							<th>SNPs in chimpanzee miRNAs</th>
							<td><a href="download/snp_in_chimp_miRNAs.txt">SNPs in chimpanzee miRNAs</a></td>
						</tr>
							<th>SNPs in zebrafish miRNAs</th>
							<td><a href="download/snp_in_zebrafish_miRNAs.txt">SNPs in zebrafish miRNAs</a></td>
						</tr>
							<th>SNPs in rattus miRNAs</th>
							<td><a href="download/snp_in_rattus_miRNAs.txt">SNPs in rattus miRNAs</a></td>
						</tr>
							<th>SNPs in cow miRNAs</th>
							<td><a href="download/snp_in_cow_miRNAs.txt">SNPs in cow miRNAs</a></td>
						</tr>
							<th>SNPs in dog miRNAs</th>
							<td><a href="download/snp_in_dog_miRNAs.txt">SNPs in dog miRNAs</a></td>
						</tr>
							<th>SNPs in chicken miRNAs</th>
							<td><a href="download/snp_in_chicken_miRNAs.txt">SNPs in chicken miRNAs</a></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>

<?
include "footerinclude.php";

?>
