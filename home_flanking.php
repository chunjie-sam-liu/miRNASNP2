
<?
$page_title="miRNASNP: miRNA related SNP";
	   include "head.php";
	?>


<div id="content">

 <div style="text-align: justify;font-size: 18px;margin-top:20px"> <span class="top" style="width:auto"> M</span>icroRNAs (miRNAs) are endogenous ~22 nt non-coding RNAs which play important regulatory roles in animals and plants by targeting mRNAs for cleavage or translational repression. Some SNPs in pre-microRNAs, flanking regions or target sites have been demonstrated to affect certain physiological processes or related with diseases. The aim of this website is to provide a resource of the miRNA-related SNPs, which included SNPs in human pre-miRNAs and miRNA flanks, SNPs in other species's miRNAs, and target gain and loss by SNPs in miRNA seed regions or 3'UTR of target mRNAs. Thus, Five major modules are provided in this database and users can browse or search it in different levels.
</div>
  <br/>

<div id="choice2" style="background-image:url(image/backimagenew.jpg); background-repeat: no-repeat; margin-top:20px;">
   <div id="" style="margin-left:350px;cursor:pointer" >
     <a href="index.php"> <img src="image/newoption2.jpg"  /></a>
   </div>
   <div style="margin-left:55px;margin-top:100px">
              <p style="font-family:Arial, Helvetica, sans-serif; font-size:24px">We can also browse by chromosome in human </p>
	          <img src="image/cho2.PNG" usemap="#chomap" border="0"  />	 
			  <br/><br/><br/><br/><br/> <br/><br/> <br/><br/> 
   </div>
</div>

 <div style="display:none">
  <img src="image/cho2.PNG" usemap="#chomap" border="0"  /> 
  <map name="chomap" id="chomap">
  <area shape="rect" coords="0,129,10,149" href="theListofRNA.php?terms1=flanking&chr=chr1&requir=chr" alt="1" />
  <area shape="rect" coords="31,132,41,152" href="theListofRNA.php?terms1=flanking&chr=chr2&requir=chr" alt="2" />
  
    <area shape="rect" coords="65,130,75,150" href="theListofRNA.php?terms1=flanking&chr=chr3&requir=chr" alt="3" />
    <area shape="rect" coords="98,131,108,151" href="theListofRNA.php?terms1=flanking&chr=chr4&requir=chr" alt="4" />
    <area shape="rect" coords="132,130,142,150" href="theListofRNA.php?terms1=flanking&chr=chr5&requir=chr" alt="5" />
    <area shape="rect" coords="165,129,175,149" href="theListofRNA.php?terms1=flanking&chr=chr6&requir=chr" alt="6" />
    <area shape="rect" coords="198,128,208,148" href="theListofRNA.php?terms1=flanking&chr=chr7&requir=chr" alt="7" />
    <area shape="rect" coords="230,129,240,149" href="theListofRNA.php?terms1=flanking&chr=chr8&requir=chr" alt="8" />
    <area shape="rect" coords="263,125,273,145" href="theListofRNA.php?terms1=flanking&chr=chr9&requir=chr" alt="9" />
    <area shape="rect" coords="297,129,307,149" href="theListofRNA.php?terms1=flanking&chr=chr10&requir=chr" alt="10" />
    <area shape="rect" coords="329,126,339,146" href="theListofRNA.php?terms1=flanking&chr=chr11&requir=chr" alt="11" />
    <area shape="rect" coords="362,128,376,148" href="theListofRNA.php?terms1=flanking&chr=chr12&requir=chr" alt="12" />
    <area shape="rect" coords="396,127,409,147" href="theListofRNA.php?terms1=flanking&chr=chr13&requir=chr" alt="13" />
    <area shape="rect" coords="431,126,441,146" href="theListofRNA.php?terms1=flanking&chr=chr14&requir=chr" alt="14" />
    <area shape="rect" coords="462,126,477,146" href="theListofRNA.php?terms1=flanking&chr=chr15&requir=chr" alt="15" />
    <area shape="rect" coords="495,127,511,147" href="theListofRNA.php?terms1=flanking&chr=chr16&requir=chr" alt="16" />
    <area shape="rect" coords="528,127,543,147" href="theListofRNA.php?terms1=flanking&chr=chr17&requir=chr" alt="17" />
    <area shape="rect" coords="561,127,576,147" href="theListofRNA.php?terms1=flanking&chr=chr18&requir=chr" alt="18" />
    <area shape="rect" coords="595,128,610,148" href="theListofRNA.php?terms1=flanking&chr=chr19&requir=chr" alt="19" />
    <area shape="rect" coords="625,127,645,147" href="theListofRNA.php?terms1=flanking&chr=chr20&requir=chr" alt="20" />
	 <area shape="rect" coords="662,127,672,147" href="theListofRNA.php?terms1=flanking&chr=chr21&requir=chr" alt="21" />
	  <area shape="rect" coords="695,125,705,145" href="theListofRNA.php?terms1=flanking&chr=chr22&requir=chr" alt="22" />
	   <area shape="rect" coords="728,128,738,148" href="theListofRNA.php?terms1=flanking&chr=chrX&requir=chr" alt="X" />
	    <area shape="rect" coords="790,105,805,125" href="theListofRNA.php?terms1=flanking&chr=chrY&requir=chr" alt="Y" />
	
  <area shape="rect" coords="1,4,12,117" href="theListofRNA.php?terms1=flanking&chr=chr1&requir=chr" alt="1" />
  <area shape="rect" coords="32,9,44,116" href="theListofRNA.php?terms1=flanking&chr=chr2&requir=chr" alt="2" />
    <area shape="rect" coords="65,26,73,114" href="theListofRNA.php?terms1=flanking&chr=chr3&requir=chr" alt="3" />
    <area shape="rect" coords="98,34,108,114" href="theListofRNA.php?terms1=flanking&chr=chr4&requir=chr" alt="4" />
    <area shape="rect" coords="132,34,142,114" href="theListofRNA.php?terms1=flanking&chr=chr5&requir=chr" alt="5" />
    <area shape="rect" coords="165,39,175,114" href="theListofRNA.php?terms1=flanking&chr=chr6&requir=chr" alt="6" />
    <area shape="rect" coords="199,44,209,114" href="theListofRNA.php?terms1=flanking&chr=chr7&requir=chr" alt="7" />
    <area shape="rect" coords="230,52,240,117" href="theListofRNA.php?terms1=flanking&chr=chr8&requir=chr" alt="8" />
    <area shape="rect" coords="266,55,276,115" href="theListofRNA.php?terms1=flanking&chr=chr9&requir=chr" alt="9" />
    <area shape="rect" coords="295,53,305,113" href="theListofRNA.php?terms1=flanking&chr=chr10&requir=chr" alt="10" />
    <area shape="rect" coords="329,55,339,115" href="theListofRNA.php?terms1=flanking&chr=chr11&requir=chr" alt="11" />
    <area shape="rect" coords="360,57,374,117" href="theListofRNA.php?terms1=flanking&chr=chr12&requir=chr" alt="12" />
    <area shape="rect" coords="396,57,409,117" href="theListofRNA.php?terms1=flanking&chr=chr13&requir=chr" alt="13" />
    <area shape="rect" coords="431,59,441,119" href="theListofRNA.php?terms1=flanking&chr=chr14&requir=chr" alt="14" />
    <area shape="rect" coords="460,65,475,115" href="theListofRNA.php?terms1=flanking&chr=chr15&requir=chr" alt="15" />
    <area shape="rect" coords="495,71,511,116" href="theListofRNA.php?terms1=flanking&chr=chr16&requir=chr" alt="16" />
    <area shape="rect" coords="527,73,542,118" href="theListofRNA.php?terms1=flanking&chr=chr17&requir=chr" alt="17" />
    <area shape="rect" coords="562,75,577,120" href="theListofRNA.php?terms1=flanking&chr=chr18&requir=chr" alt="18" />
    <area shape="rect" coords="593,72,608,117" href="theListofRNA.php?terms1=flanking&chr=chr19&requir=chr" alt="19" />
    <area shape="rect" coords="630,75,640,120" href="theListofRNA.php?terms1=flanking&chr=chr20&requir=chr" alt="20" />
	<area shape="rect" coords="661,75,671,120" href="theListofRNA.php?terms1=flanking&chr=chr21&requir=chr" alt="21" />
	<area shape="rect" coords="695,77,705,122" href="theListofRNA.php?terms1=flanking&chr=chr22&requir=chr" alt="22" />
	<area shape="rect" coords="727,43,741,121" href="theListofRNA.php?terms1=flanking&chr=chrX&requir=chr" alt="X" />
	<area shape="rect" coords="790,50,815,95" href="theListofRNA.php?terms1=flanking&chr=chrY&requir=chr" alt="Y" />
  </map></div>
  
  
</div>


<?
include "footerinclude.php";

?>

