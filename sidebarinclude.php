<?
?>

 <div style="margin-left:10px;padding-top:10px;">
       Link to <a href="http://www.bioguo.org/miRNASNP" target="_blank">miRNASNP v1.0</a>
       <form action="theListofRNA.php"  method="get">
           <input type="hidden" name="token" value="<?php echo $token; ?>" />
	             <input type="text" name="terms" value="hsa-mir-125a" style="width:100px"/>
				 <input type="submit" value="Quick" />
				  (e.g. hsa-mir-125a or rs12975333 )
       </form>
	 </div>
     <div style="padding-top:0px; margin-top:0px"><img src="image/sidebar.png" border="0" usemap="#sidemap" />
              <map name="sidemap" id="sidemap">
	          <area shape="rect" coords="6,74,127,102" href="index.php" alt="homepage" />
              <area shape="rect" coords="43,220,125,250" href="search.php" alt="search" />
	          <area shape="rect" coords="51,296,165,320" href="document.php" alt="document" />
	          <area shape="rect" coords="30,147,135,170" href="online.php" alt="download" />
	          <area shape="rect" coords="27,369,119,395" href="aboutus.php" alt="aboutus" />
	          </map>
    </div>
    <div style="margin-left:15px;width:150px; font-size:14px">
        <b>Stats:</b><br/>
        Homo sapiens
         <li><a href="http://www.mirbase.org/" target="_blank">miRBase</a>: release 19 </li>
         <li><a href="http://www.ncbi.nlm.nih.gov/projects/SNP/" target="_blank">dbSNP</a> version: 137</li>
         Other species:
         <li>see <a href="document.php" target="_blank">document</a> </li>
    </div>
