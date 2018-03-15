   
	<?
$page_title="download";	 
  include "head.php";
	?>

<div id="content">
<br>
<h3 class="STYLE3"> <strong>PDF  of SNP pre-miRNA Secondary Structure for Download</strong></h3>
<br/>
<p>Click right button to save
<?
 include "connectinclude.php";
 $sqlcontrol4="select * from table4_miRNA_SNP order by premir";
 $result4 = mysql_query($sqlcontrol4);
 ?> 
 
<table> 
  <?
 $i=0;

 while($row4 = mysql_fetch_array($result4))
 {if($i==4) {?> </tr> <?  $i=0; }
  if($i==0)
  {?><tr>
   <?
   }
   ?><td>
	  <a href="snp_pdf/<? echo $row4["premir"]."_".$row4["snp_id"]; ?>.pdf">
      <?
	     echo $row4["premir"]."_".$row4["snp_id"];
	  ?>
	  </a>
	  </td>
   <?  	
   $i++;
  }   
?>
</table>
</td>
</div>
<?
include "footerinclude.php";

?>
