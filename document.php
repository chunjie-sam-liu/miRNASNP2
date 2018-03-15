<?php 
$page_title="miRNASNP:document";
include "head.php";
?>

<script src="js/holder.js"></script>
<div id="content">
<h2 class="quicksearch">miRNASNP v2.0 document</h2>
<hr />
<div class='document'>
	<div>
		<p>
			<strong><i>miRNASNP 2.0</i></strong>
			is released. In miRNASNP v2.0, we have updated our previous database based on miRBase 19 and dbSNP 137 and added several new features in this version, including:
		</p>
		<ul>
			<li>expression level and expression correlation of miRNAs and target genes in different tissues,</li>
			<li>linking SNPs to the results of genome-wide association studies (GWAS),</li>
			<li>integrating validated miRNA-mRNA interactions supported by experimental methods,</li>
			<li>adding multiple filters to prioritize functional SNPs.</li>
		</ul>
		<p>In addition, as a supplement of the database, we have added three flexible online tools to analyze the influence of novel variants on miRNA:mRNA binding.</p>
	</div>
	<div>
		<p><span class="document">Expression level and expression correlation of miRNAs and target genes in different tissues</span></p>
		<p>
			The function of a miRNA or protein-coding gene is dependent on its expression, which is usually tissue specific. Since miRNA negatively regulated mRNA expression, combining the expressions of miRNAs and their potential targets was a good way to improve the miRNA target prediction. So in v2, we provided the expression level and expression correlation of miRNAs and target genes in different tissues based on TCGA data for better selection of miRNA-mRNA interaction. miRNA and mRNA expression data of different cancers were downloaded from TCGA (<a href="https://tcga-data.nci.nih.gov/tcga/findArchives.htm" target="_blank">https://tcga-data.nci.nih.gov/tcga/findArchives.htm</a>). We calculated the average expression of each miRNA and mRNA based on TCGA RNA-seq level 3 normalized data. Then, we chose the samples which both have miRNA and mRNA expression data. Next,  the expression correlation (Pearson correlation R) between each miRNA and mRNA was calculated by R script.
		</p>
		<div class="image"><img src="image/document_v2-3.png" width="800" class='img-thumbnail' /></div>
		<div class="image"><img src="image/document_v2-4.png" width="800" class='img-thumbnail' /></div>
		<div class="image"><img src="image/col.png" width="800" class='img-thumbnail' /></div>
	</div>
	<div>
		<p><span class="document">Linking SNPs to the results of genome-wide association studies (GWAS)</span><p>
		<p>
			GWAS tagSNPs were downloaded from GWAS catalog website and Haploview were downloaded from Broad Institute. Then, for each tagSNP, we used Haploview to obtain its LD regions in different populations (setting LD analysis regions ±500kb around SNP position and  R<sup>2</sup>&gt;0.8). The used populations include ASW, CHB, CEU, CHD, JPT, TSI, YRI, LWK, MEX, MKK and GIH. By comparing the chromosome coordinates of SNPs and GWAS LD regions, we identified SNPs in GWAS LD regions.
		</p>
		<div class="image"><img src="image/gwas.png" width="800" class='img-thumbnail' /></div>
	</div>
	<div>
		<p><span class="document">Integrating validated miRNA-mRNA interactions supported by experimental methods</span></p>
		<p>
			We downloaded all experimentally verified human miRNA targets from the databases of TarBase (<a href="http://diana.cslab.ece.ntua.gr/tarbase/" target="_blank">http://diana.cslab.ece.ntua.gr/tarbase/</a>), starBase (<a href="http://starbase.sysu.edu.cn/" target="_blank">http://starbase.sysu.edu.cn/</a>), miRecords (<a href="http://mirecords.biolead.org/" target="_blank">http://mirecords.biolead.org/</a>), miRTarBase (<a href="http://mirtarbase.mbc.nctu.edu.tw/" target="_blank">http://mirtarbase.mbc.nctu.edu.tw/</a>) and miR2Disease (<a href="http://watson.compbio.iupui.edu:8080/miR2Disease/" target="_blank">http://watson.compbio.iupui.edu:8080/miR2Disease/</a>). MiRNA names were uniformed by miRBase nomenclature, while gene name was used the gene symbol. 
		</p>
	</div>
	<div>
		<p><span class="document"><a name='cor' style='color:black'>Adding multiple filters to prioritize functional SNPs</a></span></p>
		<p>
			A new user-friendly web interface was designed for miRNASNP v2.0 allowing users to quickly browse and search all data in the database. In addition, we added multiple filters to prioritize functional SNPs. For example, on the "SNP in human pre-miRNAs" page, users can filter candidate SNPs by limiting a user-defined region, the minor allele frequency (MAF) of SNP, the energy change or GWAS LD regions.
		</p>
		<div class="image"><img src="image/document_v2-1.png" width="800" class='img-thumbnail' /></div>
		<p>
			Filtration through negative correlation of miRNA expression and gene expression in different cancer(data from TCGA) is useful, but it's not feasible for <span class='btn btn-danger help-block'>Gain</span> search, because interaction loss occurs when SNPs take place in wild miRNA seed region or mRNA 3' UTR, these interaction data are experiment validated and can be collected from public dababases and literatures; however, interaction gain is the result of mutation in seed or mRNA 3' UTR, the data is not available.
		</p>
		<p>
			For now, correlation filtration can be filtered by correlation of miRNA and gene &lt; -0.2, the number in the correlation column is the most negatively correlated value among different samples, user can click number to present correlation value of all samples.
		</p>
		<div class="image"><img src="image/document_v2-2.png" width="800" class='img-thumbnail' /></div>
	</div>
<div>

<h2 class="quicksearch">miRNASNP v1.0 document</h2>
<hr />
<p><strong><em>miRNASNP</em></strong> aims at providing the lastest resource of the miRNAs related SNPs such as SNPs in miRNAs precursors,flanking regions and target genes' 3'UTR, which possible affect the interaction of miRNA/target. Five major modules are provided in  our website. Users can go to each module by clicking the corresponding bar on the homepage.</p>

<div class="image"><img src="image/document_home.jpg" width="780" height="503" /></div>

<span class="document">First module: SNPs in human pre-miRNAs</span>
	<p></p>
<p>This module contains SNPs in human pre-miRNAs and relative information refer to miRNA or SNP. Users can easily get the infomation of miRNA host, cluster, sequence, validated target data and SNP location, energy change and so on.</p>
 <ul>
      <li>
        <span class="red">SNP categories</span>: We further classified SNPs in pre-miRNAs into in_seed, in_mature excluding the seed region and pre-miRNA excluding the mature region by their location. 

      </li>
      <li><span class="red">miRNA host information </span>was gained by  mapping each miRNA genomic location to gene location and then miRNAs were classified into genic and intergenic miRNAs.</li>
      <li><span class="red">Cluster</span>: If the distance from one miRNA to another miRNA was less than 5kbs, the two miRNAs are in 5kb cluster. Similarity, if the distance between two miRNAs was less than 10kb, the two miRNAs are in 10kb cluster.</li>
      <li> <span class="red">Validated target</span>: We downloaded all experimentally verified human target genes from the <a href="http://diana.cslab.ece.ntua.gr/tarbase/">TarBase database </a>and <a href="http://www.mir2disease.org/">miR2Disease database</a>.</li>
        <li><span class="red">Minimum free energies</span> of pre-miRNAs were completed by RNAfold tool.</li>
	  <li><span class="red">Photos of the secondary stucture</span> of pre-miRNA were done by RNAplot tool. Users can download the photoes here.</li>
<p><a href="download_PDF1.php">PDF of wild pre-miRNA secondary structure</a></p>
<p><a href="download2.php">PDF of SNP pre-miRNA secondary structure</a></p>


</ul>

<div class="image"><img src="image/document_m12.jpg" width="799" height="2164" /></div>
<p>&nbsp;</p>
<span class="document">Second module: SNPs in human miRNA flanking regions</span>
	<p></p>
<p>This module displays the SNPs in the human miRNA flanking regions. The red horizontal line represents the precursor miRNA and black horizontal lines represent this miRNA 1kb flanking regions. Vertical lines represent SNPs in this region.</p>
<div class="image"><img src="image/document_m2.jpg" width="808" height="449" /></div>
<p>&nbsp;</p>
<span class="document">Third module: SNPs in other species</span>
	<p></p>
<p>This module provides SNPs in other 8 species. miRNA&nbsp;infomation&nbsp;of&nbsp;9&nbsp;species&nbsp;was&nbsp;downloaded&nbsp;from&nbsp;the&nbsp;miRBase&nbsp;database (Release&nbsp;16.0)
    
        <a href="http://www.mirbase.org/index.shtml">http://www.mirbase.org/index.shtml</a>. 
   
    SNPs&nbsp;coordinate&nbsp;genomic&nbsp;information&nbsp;were&nbsp;downloaded&nbsp;from&nbsp;NCBI&nbsp;ftp&nbsp;database (<a href="ftp://ftp.ncbi.nlm.nih.gov/snp/">ftp://ftp.ncbi.nlm.nih.gov/snp/</a>). 
    
 
</p>
<div class="image"><img src="image/document_m3.jpg" width="712" height="404" /></div>

<span class="document">Fourth module: targets gain/loss by SNP in miRNA seed</span>
	<p></p>
<p>This module provides the effect of SNPs in miRNA seed regions. For SNPs in miRNA seed region, we got miRNA wild sequence and SNP allele sequence. Then, we used two target prediction tools (targetscan<a href="http://www.targetscan.org/vert_50/">http://www.targetscan.org</a>/)and miranda <a href="http://www.microrna.org/microrna/getDownloads.do">(http://www.microrna.org)</a> to predict their target sites respectively. Four categories of results are recorded as wild targescan site (WT), wild miranda site (WM), SNP targetscan site (ST) and SNP miranda site (SM). If one miRNA's target gene shows in both WT and WM, but not in either ST or SM, we called that the miRNA lost this target gene. On the contrary, if one target shows in both ST and SM, but not in either WT or WM, we called the miRNA gained one target gene.
  <div class="image"><img src="image/document_m4.jpg" width="777" height="374" /></div>
</p>

<span class="document">Fifth module: targets gain/loss by SNP in gene's 3'UTR</span>
<p></p>
	<p>This module provides the effect of SNPs in genes' 3'UTRs.
 For SNPs in one gene UTR, we got wild type 3'UTR sequence and corresponding SNP 3'UTR sequence. Then, we used two target prediction tools (targetscan and miranda) to predict their target sites respectively. Four categories of results are recorded as wild targescan site (WT), wild miranda site (WM), SNP targetscan site (ST), SNP miranda site (SM). If one target site shows in both WT and WM, but not in either ST or SM, we called that the gene lost this target site. On the contrary, if one target both show in ST and SM, but not in either WT or WM, we called the gene gained one target site. 
</p>
<div class="image"><img src="image/document_m5.jpg" width="768" height="464" /></div>
</p>

<p></p>
<span class="document">Binding energy change by SNPs in our dataset</span><p></p>
<p>
In order to increase the accuracy of our prediction, we further used RNAhybrid to quantitative measure the binding energy change between wild-miRNA/target and SNP-miRNA/target. For each miRNA/target loss or gain pair, we obtained the sequence (+/-50 bp) of target site and used RNAhybrid (Kruger and Rehmsmeier, 2006) to calculate the minimum hybridization energy of the miRNA-target interaction.  The averages of energy changes caused by SNPs were 11.5 kcal/mol and 11.7 kcal/mol in target loss and target gain dataset, respectively. The 25%, 50%, 75% energy change of all pairs are <2.3, <10, <20 kcal/mol respectively. Users can choose their interested data according to their need. 
</p>
<div class="image"><img src="image/energy_change.png" /></div>
</div>
<?
include "footerinclude.php";

?>
				 		   

