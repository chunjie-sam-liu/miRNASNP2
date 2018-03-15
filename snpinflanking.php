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
if (preg_match("/[\'\(\):;=\"<>]/", urldecode($_SERVER["QUERY_STRING"]))) {
    echo '<script>
        alert("Input is illegal, you are return back ^.^!");
        // window.history.back();
        document.location.href="/miRNASNP2";
    </script>';
    exit;
}


?>
<?
$page_title="SNP in flanking";
 include_once "head.php";
?>

<div id="content">
	<h2 class="quicksearch">SNP in human miRNA flanks (1kb) </h2>
<?
   $miRNA=$_GET["id"];
   include "connectinclude.php";
   $sqlcontrol1="select * from table8_flank_down where miRNAid='".$miRNA."' order by distance";
   $result = mysql_query($sqlcontrol1);

   $sqlcontrol2="select count(*) from table8_flank_down where miRNAid='".$miRNA."'";
   $result2= mysql_query($sqlcontrol2);
   $row2 = mysql_fetch_array($result2);
   $count=$row2["count(*)"];

   $sqlcontrol4="select * from table4_miRNA_SNP where premir='".$miRNA."'";
   $result4=mysql_query($sqlcontrol4);

   ?>
  <span class="flanking"><? echo $miRNA; ?></span>
	<div style="border:2px solid rgb(196,227,243);margin:5px 0;">
		<img src='snpline.php?id=<? echo $miRNA ?>' width="100%">
	</div>

	<table class="table table-hover table-bordered" >
		<tr class="info">
			<th>SNP ID</th>
			<th>SNP Position</th>
			<th>Chromosome</th>
			<th style="text-align:center">Allele</th>
			<th style="text-align:center">Distance relative <br />to 5' pre-miRNA</th>
			<th width="100" style="text-align:center">Location to pre-miRNA</th>
		</tr>
   <?
   $l=0;
   $p=0;
   while($row = mysql_fetch_array($result))
   {
     if($row["loc"]=='Down'&&$p==0){
		 while($row4 = mysql_fetch_array($result4))
	    {
		 ?>
        <tr>
          <td><a href="http://www.ncbi.nlm.nih.gov/projects/SNP/snp_ref.cgi?rs=<? echo $row["snp_id"]; ?>" target="_blank">
		      <? echo $row4["snp_id"]; ?>
		     </a>
		  </td>
		  <td><? echo $row4["snp_pos"]; ?>
		  </td>
		  <td><? echo $row4["chr"]; ?>
		  </td>
		  <td style="text-align:center"><? echo $row4["ref_allele"]; ?>
		  </td>
		  <td style="text-align:center"><? echo $row4["on_premir"]; ?>
		  </td>
		  <td style="text-align:center"><? echo "in"; ?>
		  </td>
	     </tr>
         <?
	   }
	   $p=1;
	  }
	 ?>
       <tr >
          <td><a href="http://www.ncbi.nlm.nih.gov/projects/SNP/snp_ref.cgi?rs=<? echo $row["snp_id"]; ?>" target="_blank">
		        <? echo $row["snp_id"]; ?>
			   </a>
		  </td>
		  <td><? echo $row["snp_pos"]; ?>
		  </td>
		  <td><? echo $row["chr"] ?>
		  </td>
		  <td style="text-align:center"><? echo $row["refallele"]; ?>
		  </td>
		  <td style="text-align:center"><? echo $row["distance"]; ?>
		  </td>
		  <td style="text-align:center"><?
							echo $row["loc"]."stream";
						?>
		  </td>
	   </tr>
     <?
   }
   ?>
   </table>
</div>


<?
include "footerinclude.php";
?>
