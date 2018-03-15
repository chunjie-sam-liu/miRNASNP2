     
	<?
$page_title="download";	 
  include "head.php";
	?>

<div id="content">
<br>
<h3 class="STYLE3"> <strong> PDF of primary pre-miRNA Secondary Structure for Download </strong></h3>
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
Click right button to save
<?
 include "connectinclude.php";
 $sqlcontrol4="select distinct(premir) from table4_miRNA_SNP order by premir";
 $result4 = mysql_query($sqlcontrol4);
 ?> 
 <table> 
 <?
 $i=0;

 while($row4 = mysql_fetch_array($result4))
 {if($i==6) {?> </tr> <?  $i=0; }
  if($i==0)
  {?><tr>
   <?
   }
   ?><td>
	  <a href="wild_pdf/<? echo $row4["premir"]; ?>.pdf">
      <?
	     echo $row4["premir"];
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
