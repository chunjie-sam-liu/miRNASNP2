
<?
 require_once 'head.php';
?>

<script type="text/javascript">
function inini(content)
{var a="<img  src='";
 var c="'><input type='button' value='close' onclick='loadBox.hide()'/>";
 var d=a.concat(content);
 var e=d.concat(c);
loadBox.init();
loadBox.boxContent=e;
}


</script>
<script type="text/javascript">
 window.onload=window.onresize=function(){
 if(document.getElementById("left").clientHeight<document.getElementById("content").clientHeight){
 document.getElementById("left").style.height=document.getElementById("content").offsetHeight+"px";fsetHeight+"px";
 }
 else{
 document.getElementById("content").style.height=document.getElementById("left").offsetHeight+"px";fsetHeight+"px";
 }
 }


//<![CDATA[
//弹出层 by ChenLiang v1.0
function LightBox(boxWidth,boxHeight,boxContent)
{
this.boxWidth=boxWidth;
this.boxHeight=boxHeight;
this.boxContent=boxContent;
var bgLayer,boxLayer;
var documentHtml=document.documentElement;
var documentHtml1=document.body;
this.createBgLayer=function()
{
bgLayer = document.createElement("div");
with (bgLayer)
{
className="bgLayer";
style.width=documentHtml.scrollWidth+"px";

style.height=documentHtml.scrollHeight+"px";

style.display="none";
}
document.body.insertBefore(bgLayer,document.body.firstChild);
};
this.createBox=function(){
boxLayer = document.createElement("div");
with (boxLayer)
{
className = "boxLayer";
style.width=this.boxWidth + "px";
style.height = this.boxHeight +"px";
style.display="none";
};
document.body.insertBefore(boxLayer,document.body.firstChild);
};
this.init= function()
{
this.createBgLayer();
this.createBox();
}
// if IE 6.0
function hideShowSelect(obj)
{
if (	window.navigator.userAgent.indexOf("MSIE 6.0") > 0)
{
var selectDom = document.getElementsByTagName("select");
for 	(var i = 0; i < selectDom.length ; i++)
{
if (obj)
sele	ctDom[i].style.display="none";
else
selectDom[i].style.display="";
}
}
};
this.show = function()
{
hideShowSelect(true);
boxLayer.innerHTML=this.boxContent;
bgLayer.style.display = "block";
boxLayer.style.display = "block";
boxLayer.style.left = documentHtml.offsetWidth /2 - boxLayer.offsetWidth/2 +"px";
boxLayer.style.top = documentHtml.scrollTop + documentHtml.offsetHeight/2 - this.boxHeight/2 -30 + "px";
}
this.hide = function()
{
hideShowSelect(false);
bgLayer.style.display = "none";
boxLayer.style.display = "none";
}
}
//]]>
</script>
<script type="text/javascript">
//调用方法
var loadBox= new LightBox(500,500);

</script>
<style type="text/css">


.bgLayer{ background:#000; opacity:0.5; filter:alpha(opacity=50);z-index:10001;position:absolute;left:0;top:0;}
.boxLayer{ background:#fff; border:4px solid #ccc; overflow:hidden; zoom:1; z-index:10002; position:absolute;padding:8px;}
.boxLayer p{padding:5px 0;text-align:center;}
.alldenglu{
    width:260px;}
.denglu {
font-size: 14px;
margin-bottom:6px;
color: #999999;
}
</style>
<style type="text/css">
<!--
.tabletitle{font-family:Arial, Helvetica, sans-serif;
       font-size:20px;
       font-weight:bold;
	   color:#3E1400;
	   background-color:#D9D9D9;

	   }
.menu1 {
     font-family: "宋体";
     font-size: 14px;
     font-weight: bold;
     color: #FFFFFF;
     text-decoration: none;
     background-color: #990000;
     cursor:hand;
}
.menu2 {
     font-family: "宋体";
     font-size: 14px;
     font-weight: bold;
     color: #990000;
     text-decoration: none;
     background-color: #FFFFFF;
     cursor:hand;


}
.left1{font-family:Arial, Helvetica, sans-serif;
       font-size:15px;
       font-weight:bold;
	   color:#3E1400;
	   background-color:#D9D9D9;

	  }
.left2{font-family:Arial, Helvetica, sans-serif;
       font-size:15px;
       font-weight:bold;
	   color:#3E1400;
	   background-color:#E8E8E8;

	   }
.right1{font-family:Arial, Helvetica, sans-serif;
        font-size:12px;
        color:#000000;
		background-color:#FFE3D9;


	   }
.right2{font-family:Arial, Helvetica, sans-serif;
        font-size:12px;
        color:#000000;
		background-color:#F6F6F6;

		}
.sidebar1 { float:left; padding:0; margin:0; text-align:left; }
.sidebar1 ul { list-style:none; padding:0; margin:0; text-align:center }
.sidebar1 li { float:left; height:24px; margin:0; padding:0 3px; background:#fff; }
.sidebar1 a { color:#000;font-size:12px;}
.sidebar1 a:hover { color:#f60; }
.sidebar1 .active a { color:#f00; font-size:24px; font-family:Arial, Helvetica, sans-serif}
.sidebar1 .unactive a { color:#000033; font-size:24px; font-family:Arial, Helvetica, sans-serif}
.endContent { margin-top:6px; height:230px; font-size:12px; line-height:180%;}
.endContent a { float:left; height:24px; }
-->
</style>
<script type="text/javascript">
  var D=new Function('obj','return document.getElementById(obj)');
  function showDiv(sobj,num,total)
  { var tri="trianglefold"+num;
    var triu="triangleunfold"+num;
    D(tri).style.display="none";
	D(triu).style.display="block";
    for(var id = 1;id<=total;id++)
	{  try{ var ss = sobj + id;
             var nss = sobj + "nav" + id;
             var tri="trianglefold"+id;
             var triu="triangleunfold"+id;
			 if(id==num)
			 { D(ss).style.display="block";
			   D(nss).className="active";
			 }
			 else
			 { D(ss).style.display="none";
               D(nss).className="unactive";
			   D(tri).style.display="block";
	           D(triu).style.display="none";
			 }
          }
	  catch(e)
	     {
		 }
   }
  }
  function changefold(pp)
  {var id1="mirnafold";
   var id2="mirnaunfold";
   if(pp==1)
     {D(id1).style.display="none";
	  D(id2).style.display="block";
	 }
	 else
	 {D(id1).style.display="block";
	  D(id2).style.display="none";
	 }
   }
   function changefold2(pp)
  {var id1="mirnafold2";
   var id2="mirnaunfold2";
   if(pp==1)
     {D(id1).style.display="none";
	  D(id2).style.display="block";
	 }
	 else
	 {D(id1).style.display="block";
	  D(id2).style.display="none";
	 }
   }
  var sobj1;
  var num1;
  var total1;
  function hidDivact(s,nMin)
  {  var obj=document.getElementById(s);
     var h = parseInt(obj.offsetHeight);
     if (h > nMin){
      obj.style.height = (h - 20)+"px";
        clearTimeout(act);
      act = setTimeout("hidDivact('"+s+"',"+nMin+")", 10);
     	counttime++;
      }
	  else
	  { try{var ss=sobj1+num1;
        var nss=sobj1+"nav"+num1;
		var tri="trianglefold"+num1;
		var triu="triangleunfold"+num1;
		D(ss).style.display="none";
		D(nss).className="unactive";
		D(tri).style.display="block";
	    D(triu).style.display="none";
	       }
	   catch(e)
	      {
	      }

	  }
   }
  function hidDiv(sobj,num,total)
  {sobj1=sobj;
   num1=num;
   total1=total;
   hidDivact('snpcontent',0);

  }



</script>
<script language="JavaScript">
function tabit1(id,cid) {
tab1.className="menu2";
id.className="menu1";
ctab1.style.display="none";
cid.style.display="";
}
function tabit2(id,cid) {
tab1.className="menu2";
tab2.className="menu2";
id.className="menu1";
ctab1.style.display="none";
ctab2.style.display="none";
cid.style.display="";
}
function tabit3(id,cid) {
tab1.className="menu2";
tab2.className="menu2";
tab3.className="menu2";
id.className="menu1";
ctab1.style.display="none";
ctab2.style.display="none";
ctab3.style.display="none";
cid.style.display="";
}
function tabit4(id,cid) {
tab1.className="menu2";
tab2.className="menu2";
tab3.className="menu2";
tab4.className="menu2";
id.className="menu1";
ctab1.style.display="none";
ctab2.style.display="none";
ctab3.style.display="none";
ctab4.style.display="none";
cid.style.display="";
}
function tabit5(id,cid) {
tab1.className="menu2";
tab2.className="menu2";
tab3.className="menu2";
tab4.className="menu2";
tab5.className="menu2";
id.className="menu1";
ctab1.style.display="none";
ctab2.style.display="none";
ctab3.style.display="none";
ctab4.style.display="none";
ctab5.style.display="none";
cid.style.display="";
}
function tabit6(id,cid) {
tab1.className="menu2";
tab2.className="menu2";
tab3.className="menu2";
tab4.className="menu2";
tab5.className="menu2";
tab6.className="menu2";
id.className="menu1";
ctab1.style.display="none";
ctab2.style.display="none";
ctab3.style.display="none";
ctab4.style.display="none";
ctab5.style.display="none";
ctab6.style.display="none";
cid.style.display="";
}
function tabit7(id,cid) {
tab1.className="menu2";
tab2.className="menu2";
tab3.className="menu2";
tab4.className="menu2";
tab5.className="menu2";
tab6.className="menu2";
tab7.className="menu2";
id.className="menu1";
ctab1.style.display="none";
ctab2.style.display="none";
ctab3.style.display="none";
ctab4.style.display="none";
ctab5.style.display="none";
ctab6.style.display="none";
ctab7.style.display="none";
cid.style.display="";
}
function tabit8(id,cid) {
tab1.className="menu2";
tab2.className="menu2";
tab3.className="menu2";
tab4.className="menu2";
tab5.className="menu2";
tab6.className="menu2";
tab8.className="menu2";
id.className="menu1";
ctab1.style.display="none";
ctab2.style.display="none";
ctab3.style.display="none";
ctab4.style.display="none";
ctab5.style.display="none";
ctab6.style.display="none";
ctab7.style.display="none";
ctab8.style.display="none";
cid.style.display="";
}
function tabit9(id,cid) {
tab1.className="menu2";
tab2.className="menu2";
tab3.className="menu2";
tab4.className="menu2";
tab5.className="menu2";
tab6.className="menu2";
tab7.className="menu2";
tab8.className="menu2";
tab9.className="menu2";
id.className="menu1";
ctab1.style.display="none";
ctab2.style.display="none";
ctab3.style.display="none";
ctab4.style.display="none";
ctab5.style.display="none";
ctab6.style.display="none";
ctab7.style.display="none";
ctab8.style.display="none";
ctab9.style.display="none";
cid.style.display="";
}
function tabit10(id,cid) {
tab1.className="menu2";
tab2.className="menu2";
tab3.className="menu2";
tab4.className="menu2";
tab5.className="menu2";
tab6.className="menu2";
tab7.className="menu2";
tab8.className="menu2";
tab9.className="menu2";
tab10.className="menu2";
id.className="menu1";
ctab1.style.display="none";
ctab2.style.display="none";
ctab3.style.display="none";
ctab4.style.display="none";
ctab5.style.display="none";
ctab6.style.display="none";
ctab7.style.display="none";
ctab8.style.display="none";
ctab9.style.display="none";
ctab10.style.display="none";
cid.style.display="";
}
function tabit11(id,cid) {
tab1.className="menu2";
tab2.className="menu2";
tab3.className="menu2";
tab4.className="menu2";
tab5.className="menu2";
tab6.className="menu2";
tab7.className="menu2";
tab8.className="menu2";
tab9.className="menu2";
tab10.className="menu2";
tab11.className="menu2";
id.className="menu1";
ctab1.style.display="none";
ctab2.style.display="none";
ctab3.style.display="none";
ctab4.style.display="none";
ctab5.style.display="none";
ctab6.style.display="none";
ctab7.style.display="none";
ctab8.style.display="none";
ctab9.style.display="none";
ctab10.style.display="none";
ctab11.style.display="none";
cid.style.display="";
}
function tabit12(id,cid) {
tab1.className="menu2";
tab2.className="menu2";
tab3.className="menu2";
tab4.className="menu2";
tab5.className="menu2";
tab6.className="menu2";
tab7.className="menu2";
tab8.className="menu2";
tab9.className="menu2";
tab10.className="menu2";
tab11.className="menu2";
tab12.className="menu2";
id.className="menu1";
ctab1.style.display="none";
ctab2.style.display="none";
ctab3.style.display="none";
ctab4.style.display="none";
ctab5.style.display="none";
ctab6.style.display="none";
ctab7.style.display="none";
ctab8.style.display="none";
ctab9.style.display="none";
ctab10.style.display="none";
ctab11.style.display="none";
ctab12.style.display="none";
cid.style.display="";
}
function tabit13(id,cid) {
tab1.className="menu2";
tab2.className="menu2";
tab3.className="menu2";
tab4.className="menu2";
tab5.className="menu2";
tab6.className="menu2";
tab7.className="menu2";
tab8.className="menu2";
tab9.className="menu2";
tab10.className="menu2";
tab11.className="menu2";
tab12.className="menu2";
tab13.className="menu2";
id.className="menu1";
ctab1.style.display="none";
ctab2.style.display="none";
ctab3.style.display="none";
ctab4.style.display="none";
ctab5.style.display="none";
ctab6.style.display="none";
ctab7.style.display="none";
ctab8.style.display="none";
ctab9.style.display="none";
ctab10.style.display="none";
ctab11.style.display="none";
ctab12.style.display="none";
ctab13.style.display="none";
cid.style.display="";
}
function tabit14(id,cid) {
tab1.className="menu2";
tab2.className="menu2";
tab3.className="menu2";
tab4.className="menu2";
tab5.className="menu2";
tab6.className="menu2";
tab7.className="menu2";
tab8.className="menu2";
tab9.className="menu2";
tab10.className="menu2";
tab11.className="menu2";
tab12.className="menu2";
tab13.className="menu2";
tab14.className="menu2";
id.className="menu1";
ctab1.style.display="none";
ctab2.style.display="none";
ctab3.style.display="none";
ctab4.style.display="none";
ctab5.style.display="none";
ctab6.style.display="none";
ctab7.style.display="none";
ctab8.style.display="none";
ctab9.style.display="none";
ctab10.style.display="none";
ctab11.style.display="none";
ctab12.style.display="none";
ctab13.style.display="none";
ctab14.style.display="none";
cid.style.display="";
}
function tabit15(id,cid) {
tab1.className="menu2";
tab2.className="menu2";
tab3.className="menu2";
tab4.className="menu2";
tab5.className="menu2";
tab6.className="menu2";
tab7.className="menu2";
tab8.className="menu2";
tab9.className="menu2";
tab10.className="menu2";
tab11.className="menu2";
tab12.className="menu2";
tab13.className="menu2";
tab14.className="menu2";
tab15.className="menu2";
id.className="menu1";
ctab1.style.display="none";
ctab2.style.display="none";
ctab3.style.display="none";
ctab4.style.display="none";
ctab5.style.display="none";
ctab6.style.display="none";
ctab7.style.display="none";
ctab8.style.display="none";
ctab9.style.display="none";
ctab10.style.display="none";
ctab11.style.display="none";
ctab12.style.display="none";
ctab13.style.display="none";
ctab14.style.display="none";
ctab15.style.display="none";
cid.style.display="";
}
var act;
function over1(s,nMax){

  var obj=document.getElementById(s);
  var h = parseInt(obj.offsetHeight);

  var k1=document.getElementById('pre').scrollHeight;
  nMax=0+k1;
  var k2=document.getElementById('mat').scrollHeight;
  nMax=nMax+k2+120;
  var k3=document.getElementById('tar').scrollHeight;
  nMax=nMax+k3+100;

  if (h < nMax){
    obj.style.height = (h + 20)+"px";
    clearTimeout(act);
    act = setTimeout("over('"+s+"',"+nMax+")", 10);
  }
}
function over(s,nMax){

  var obj=document.getElementById(s);
  var h = parseInt(obj.offsetHeight);

  if (h < nMax){
    obj.style.height = (h + 20)+"px";
    clearTimeout(act);
    act = setTimeout("over('"+s+"',"+nMax+")", 10);
  }
}
function out(s,nMin)
{
  var obj=document.getElementById(s);
  var h = parseInt(obj.offsetHeight);
  if (h > nMin)
   {
    obj.style.height = (h - 20)+"px";
    clearTimeout(act);
    act = setTimeout("out('"+s+"',"+nMin+")", 10);
	}
}
</script>

<?
include "connectinclude.php";

$thisdirname = dirname(__FILE__);
$thisfile = $thisdirname . "/miRNA_species_short_name2";

if(file_exists($thisfile)){
        if(($speciesNames = fopen($thisfile,"r"))== true){
	        $shortLong = array();
        	while(!feof($speciesNames)){
                	$line = fgets($speciesNames);
	                list($short,$long) = explode("\t",$line);
        	        $shortLong[$short] = $long;
        	}
        	fclose($speciesNames);
	}
}


$ID=$_GET["id"];
$regex='/[#$%^&*()+=\[\]\';,.\/{}|":<>?~\\\\]/';
if (empty($ID) || preg_match_all($regex,$ID))
{
	echo '<script>alert("Please input correct ");
	document.location.href="/miRNASNP2";</script>';
	exit;
}
$sqlcontrol4="select * from table4_miRNA_SNP where premir='".$ID."'";
$result4 = mysql_query($sqlcontrol4);
$i=1;
 while($row4 = mysql_fetch_array($result4)){
	 $on_premir[$i]=$row4["on_premir"];
	 $snp_pos[$i]=$row4["snp_pos"];
	 $snp_chr[$i]=$row4["chr"];
	 $snp_id[$i]=$row4["snp_id"];
	 $snp_strand[$i]=$row4["snp_strand"];// no snp_strand info in table4...
	 $allele[$i]=$row4["ref_allele"]; // why repeat ref_allele
	 $ref_allele[$i]=$row4["ref_allele"];

	 $sqlcontrol6="select * from table6_energy where snp ='".$row4["snp_id"]."'";
	 $result6=mysql_query($sqlcontrol6);
	 $row6=mysql_fetch_array($result6);
	 $preenergy[$i]=$row6["energy"];
	 $snp_energy[$i]=$row6["snp_energy"];
	 $changed_energy[$i]=$row6["changed_energy"];
	 $i++;
 }
 $total=$i-1;
 $p=1;

$sqlcontrol1="select * from table1_pre_miRNA where id='".$ID."'";
$sqlcontrol2="select * from table2_mature_miRNA where premiRNA_id='".$ID."'";
$sqlcontrol3="select * from table3_hairpin where Id='".$ID."'";
$sqlcontrol4="select * from table4_miRNA_SNP where premir='".$ID."'";
$sqlcontrol5="select * from table5_miRNA_target where id='".$ID."'";
$result1 = mysql_query($sqlcontrol1);
$result2 = mysql_query($sqlcontrol2);
$result3 = mysql_query($sqlcontrol3);
$result5 = mysql_query($sqlcontrol5);
$row1=mysql_fetch_array($result1);
$row2=mysql_fetch_array($result2);
$row3=mysql_fetch_array($result3);
$row5=mysql_fetch_array($result5);
$mytdadd=850;
if($row5["target"]!="") $mytdadd=1000;
?>

<div class="content">
<h2 class="quicksearch">Detail information of <? echo $row1["id"];?></h2>

<!--microRNA information-->
<div name="miRNA information" >
	<!--table of miRNA information-->
	<div class="panel panel-info">

		<div class="panel-heading">
			<h4>miRNA information</h4>
		</div>
		<div class="panel-body">
 <table id="pre" class="table table-hover table-bordered">
	 <tr>
		 <td colspan="2" class="success" style="text-align: center"><span style="font-size: 20px" >
				 <strong>Pre-miRNA</strong></span>
		 </td>
	 </tr>
	 <tr>
		 <td style="font-size: 18px;" width="200px"><strong>ID:</strong> </td>
		 <td >
			 <? echo $row1["id"]; ?>
			 <span style="float:right;clear;">
				 <a href="http://www.mirbase.org/cgi-bin/mirna_entry.pl?acc=<? echo $row1["acc"] ?>" title="miRBase" target="_blank" >
					 <img src="image/mirnabase.JPG" border="0"/>
				 </a>
			 </span>
		  </td>
	 </tr>
	 <tr >
		 <td style="font-size: 18px;"><strong>Accession:</strong></td>
		 <td>
			 <a href ="http://www.mirbase.org/cgi-bin/mirna_entry.pl?acc=<? echo $row1["acc"]?>" target="_blank"><? echo $row1["acc"]; ?></a>
		 </td>
	 </tr>
	 <tr>
		 <td style="font-size: 18px;font-weight: bold">Chr Position:</td>
		 <td >
			 <?$location = substr($row1["chr"],3) .":". $row1["start"] ."-". $row1["end"];?>
			 <a href= "http://asia.ensembl.org/Homo_sapiens/Location/View?l=<? echo $location?> " target="_blank">
				 <?
				 echo $row1["chr"].":".$row1["start"]."-".$row1["end"]; ?>&nbsp;(GRCh37)&nbsp;&nbsp;<? echo "[".$row1["strand"]."]"; ?>
			 </a>
		 </td>
	 </tr>
	 <tr>
		 <td style="font-size: 18px;font-weight: bold"> Host Gene: </td>
		 <td >
			 <? if($row1["host"]=="Null")echo "intergenic";else echo $row1["host"];?>
		 </td>
	 </tr>
	 <tr>
	 <td style="font-size: 18px;font-weight: bold">Cluster </td>
	 <td >
		 <strong> 5kb: </strong>
		 <? if($row1["5kbcluster"]!="Null" ) echo $row1["5kbcluster"]; else echo "No microRNA in this cluster" ?> <br/>
		 <strong> 10kb: </strong>
		 <? if($row1["10kbcluster"]!="Null") echo $row1["10kbcluster"]; else echo "No microRNA in this cluster" ?><br/>
	 </td>
	</tr>
	 <tr>
		 <td style="font-size: 18px;font-weight: bold"> Conservation:</td>
		 <td >
			 <? if($row1["conservation"]=="Null")echo "Human Specific";else echo $row1["conservation"];?>
		 </td>
	 </tr>
	 <tr>
		 <td style="font-size: 18px;font-weight: bold">Orthology Species:</td>
		 <td >
			 <?
			 if($row1["species"]=="Null")
				 echo "Human Specific";
			 $array = explode(";", $row1["species"]);
			 $i=0;
			 $ppp=0;
			 ?>
			 <table>
				 <tr>
					 <?
					 while($array[$i]!=""){
					 echo "<td>";

					 $this_short = substr($array[$i],0,3);
					 if($this_short){
						 echo "<a target='_blank' href='http://www.mirbase.org/cgi-bin/mirna_entry.pl?acc=" . $array[$i] ."'>";
						 echo "<b>$shortLong[$this_short]:</b>";
					 }

					 echo $array[$i];
					 $ppp++;
					 echo "&nbsp;&nbsp";
					 echo "</a>";
					 echo "</td>";
					 $i++;
					 if($ppp==3){?>
				 </tr>
				 <tr>
					 <?
					 $ppp=0;
					 }
					 }?>
				 </tr>
			 </table>
		 </td>
	 </tr>
	  <tr>
		  <td style="font-size: 18px;font-weight: bold"> Sequence :</td>
		  <td >
			  <?
			  $i=0;$j=0;
			  while($row1["seq"][$i]!=""){
				  echo $row1["seq"][$i];
				  $i++;
				  $j++;
				  if($j==75){
					  ?><br/>
					  <?
					  $j=0;
				  }
			  }?>
		  </td>
	  </tr>
 </table>

 <!--table of mature miRNA-->
 <table id="mat" class="table table-hover table-bordered">
	 <tr>
		 <td colspan="2" class="success" style="text-align: center">
			 <span style="font-size: 20px;font-weight: bold">Mature miRNA</span>
		 </td>
	 </tr>
 <? $sqlcontrol9="select * from table2_mature_miRNA where premiRNA_id='".$ID."'";
    $result9 = mysql_query($sqlcontrol9);
 while($row9=mysql_fetch_array($result9)){?>
	 <?
	 $sql = "select * from mirna_expression where mature_miRNA_id = '".$row9["mature_miRNA_id"]."'";
	 $result = mysql_query($sql);

	 $row = mysql_fetch_row($result);

	 $maxrow = array_slice($row,2,count($row)-2);
	 $maxH = max($maxrow);


	 $result = mysql_query($sql);
	 $rowKey = array_keys(mysql_fetch_assoc($result));
	 ?>
	 <tr>
		 <td style="font-size: 18px;font-weight: bold" width="200"> ID:</td>
		 <td><? echo $row9["mature_miRNA_id"]; ?></td>
	 </tr>
	 <tr>
		 <td style="font-size: 18px;font-weight: bold">Sequence:</td>
		 <td >
			 <span style="color:red;font-weight: bold"><? echo $row9["seq"]; ?></span> <? echo $row9["start_on_pre"]."-".$row9["end_on_pre"]; ?>
		 </td>
	 </tr>
	 <tr>
		 <td style="font-size: 18px;font-weight: bold"> Position:</td>
		 <td><b></b>
			 <?$location = substr($row1["chr"],3) .":". $row9["start_on_chr"] ."-". $row9["end_on_chr"];?>
			 <a href= "http://asia.ensembl.org/Homo_sapiens/Location/View?l=<? echo $location?> " target="_blank">
				 <? echo $row1["chr"] . ":" . $row9["start_on_chr"]."-".$row9["end_on_chr"]."[".$row9["strand"]."]";?>
			 </a>
		 </td>
	 </tr>

	 <?if(!empty($row)){
		 ?>
		 <tr>
			 <td style="font-size: 18px;">
				<strong>Expression:</strong><span class="glyphicon glyphicon-question-sign red" data-toggle="popover" data-content="Expression data is from TCGA(RPKM);Click table to show abbreviation" data-original-title="Search Notice" data-trigger="hover" data-placement="bottom"></span>&nbsp;&nbsp;<button data-toggle="collapse" data-target="#abbr" aria-expanded="true" aria-controls="abbr" class="btn btn-default btn-sm">table</button>
			 </td>
			 <td>
				 <?for($i=2; $i<count($row);$i++){
					 if($row[$i]>0){
						 $ratio = $row[$i] / $maxH;
					 }else{
						 $ratio=0;
					 }
					 $height = $ratio * 30;
					 ?>
					 <div class="expression" data-toggle="tooltip" data-triggle="hover" data-placement="bottom" data-original-title="sample:<?echo $rowKey[$i];?>; expression:<?echo $row[$i];?>" style="height: <?echo $height;?>px;"></div>
				 <?}?>
			 </td>
		 </tr>
		 <?}?>
 <? }?>
 </table>

 <div class="panel panel-primary collapse " id="abbr">
	<div class="panel-body">
		<strong>ACC:</strong>Adrenocortical_carcinoma</br>
		<strong>BLCA:</strong>Bladder_Urothelial_Carcinoma</br>
		<strong>BRCA:</strong>Breast_invasive_carcinoma</br>
		<strong>CESC:</strong>Cervical_squamous_cell_carcinoma_and_endocervical_adenocarcinoma</br>
		<strong>COAD:</strong>Colon_adenocarcinoma</br>
		<strong>DLBC:</strong>Lymphoid_Neoplasm_Diffuse_Large_B-cell_Lymphoma</br>
		<strong>ESCA:</strong>Esophageal_carcinoma</br>
		<strong>HNSC:</strong>Head_and_Neck_squamous_cell_carcinoma</br>
		<strong>KICH:</strong>Kidney_Chromophobe</br>
		<strong>KIRC:</strong>Kidney_renal_clear_cell_carcinoma</br>
		<strong>KIRP:</strong>Kidney_renal_papillary_cell_carcinoma</br>
		<strong>LAML:</strong>Acute_Myeloid_Leukemia</br>
		<strong>LGG:</strong>Brain_Lower_Grade_Glioma</br>
		<strong>LIHC:</strong>Liver_hepatocellular_carcinoma</br>
		<strong>LUAD:</strong>Lung_adenocarcinoma</br>
		<strong>LUSC:</strong>Lung_squamous_cell_carcinoma</br>
		<strong>MESO:</strong>Mesothelioma</br>
		<strong>OV:</strong>Ovarian_serous_cystadenocarcinoma</br>
		<strong>PAAD:</strong>Pancreatic_adenocarcinoma</br>
		<strong>PCPG:</strong>Pheochromocytoma_and_Paraganglioma</br>
		<strong>PRAD:</strong>Prostate_adenocarcinoma</br>
		<strong>READ:</strong>Rectum_adenocarcinoma</br>
		<strong>SARC:</strong>Sarcoma</br>
		<strong>SKCM:</strong>Skin_Cutaneous_Melanoma</br>
		<strong>STAD:</strong>Stomach_adenocarcinoma</br>
		<strong>THCA:</strong>Thyroid_carcinoma</br>
		<strong>UCEC:</strong>Uterine_Corpus_Endometrial_Carcinoma</br>
		<strong>UCS:</strong>Uterine_Carcinosarcoma</br>
	</div>
</div>
		</div>
	</div>
 <?
 if($row5["target"]!=""){
	 $display="block";
 }
 else{
	 $display="none";
 }
 ?>

 <!--table of fuck; because table5 is empty-->
<table id="tar" class="table table-hover table-bordered" style="display:<? echo $display ?>">
	<tr>
		<td colspan="2" class="success" style="text-align: center;font-weight: bold;font-size: 18px"><span>miRNA validated target</span></td>
	</tr>
	<tr>
		<td style="font-size: 18px;font-weight: bold" width="200"> ID: </td>
		<td><? echo $row1["id"]; ?>  </td>
	</tr>
	<tr>
		<td style="font-size: 18px;font-weight: bold"> Target: </td>
		<td> <? echo $row5["target"]; ?>  </td>
	</tr>
	<tr>
		<td style="font-size: 18px;font-weight: bold"> Source: </td>
		<td >
			<a href="http://watson.compbio.iupui.edu:8080/miR2Disease/index.jsp" target="_blank">miR2Disease</a>
&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="http://diana.cslab.ece.ntua.gr/tarbase/" target="_blank">
				TarBase
			</a>
		</td>
	</tr>
 </table>

</div>

 <? $strand=$row1['strand']; ?>
<!--SNP information-->
<div class="panel panel-info">
<div class="panel-heading">
	<h4>SNP information</h4>
</div>
<div class="panel-body" >
<?
$sql = "select * from snphumanpremir where premir='".$ID."'";
$result = mysql_query($sql);
$flag = 0;
$flag2 = 0;
$ld_num = 0;
$population = array();
$gwas = array();
$snp = array();
$tagPos = 0;
while($row = mysql_fetch_array($result)){
	$tmp = array($row['snp_id'], $row['position']);
	array_push($snp,$tmp);

	if($row['ld_num'] >0 && $flag == 0){
		$ld_num = $row['ld_num'];
		$array = explode(',',$row['ld_id']);
		$ld_id = $array[0];
		$sql_pop = "select * from population_LD_regions where id='".$ld_id."'";
		$result_pop = mysql_query($sql_pop);
		$population = mysql_fetch_row($result_pop);
		$tagPos = $population[3];
		$population = array_slice($population,4,11);
		for($i = 0; $i<=10; $i++){
			$array = explode('_', $population[$i]);
			$population[$i] = $array;
		}
		$flag++;
	}
	if($row['ld_num'] > 0 && $flag2 == 0){
		$array = explode(',',$row['ld_id']);
		for($i = 0; $i <count($array); $i++){
			$sql_pop = "select * from population_LD_regions where id='" . $array[$i] . "'";
			$result_pop = mysql_query($sql_pop);
			$tag = mysql_fetch_array($result_pop);
			$tag = $tag['ld_id'];
			if($tag) {
				$sql_tag = "select * from gwas_catalog where id = '".$tag."'";
				$result_tag = mysql_query($sql_tag);
				$array = mysql_fetch_row($result_tag);
				array_push($gwas,$array);
			}
		}
		$flag2++;
	}

}
session_start();
$_SESSION['population'] = $population;
$_SESSION['tagPos'] = $tagPos;
$_SESSION['snp'] = $snp;
?>
<!--	ld and draw ld-->
<?if($ld_num > 0){?>
<div class="panel panel-primary">
	<div class="panel-heading" style="padding: 0 10px;">SNP in GWAS LD</div>
	<div class="panel-body">

	<div name = 'ld'>
		<div class="row" style="margin:10px 0;">
			<div class="col-md-8">
				<div class="thumbnail">
					<img src="draw_gwas.php?pop=<? $population;?>">
					<div class="caption" style="text-align: center;">Blue vertical line points out the GWAS tagSNP, red vertical line locates the queried SNP in GWAS LD regions. If tagSNP is the same as queried SNP, it only shows a red line.</div>
				</div>
			</div>
			<div class="col-md-4 pop_table">
				<table class="table table-bordered pop">
					<thead>
					<tr>
						<th rowspan="2" class="pop-td">Population</th>
						<th colspan="2" class="pop-td">(R<sup>2</sup>>=0.8)</th>
					</tr>
					<tr>
						<th class="pop-td">Start</th>
						<th class="pop-td">End</th>
					</tr>
					</thead>
					<tbody>
					<tr><td>ASW</td><td><?echo $population[0][0]?></td><td><?echo $population[0][1]?></td></tr>
					<tr><td>CEU</td><td><?echo $population[1][0]?></td><td><?echo $population[1][1]?></td></tr>
					<tr><td>CHB</td><td><?echo $population[2][0]?></td><td><?echo $population[2][1]?></td></tr>
					<tr><td>CHD</td><td><?echo $population[3][0]?></td><td><?echo $population[3][1]?></td></tr>
					<tr><td>GIH</td><td><?echo $population[4][0]?></td><td><?echo $population[4][1]?></td></tr>
					<tr><td>JPT</td><td><?echo $population[5][0]?></td><td><?echo $population[5][1]?></td></tr>
					<tr><td>LWK</td><td><?echo $population[6][0]?></td><td><?echo $population[6][1]?></td></tr>
					<tr><td>MEK</td><td><?echo $population[7][0]?></td><td><?echo $population[7][1]?></td></tr>
					<tr><td>MKK</td><td><?echo $population[8][0]?></td><td><?echo $population[8][1]?></td></tr>
					<tr><td>TSI</td><td><?echo $population[9][0]?></td><td><?echo $population[9][1]?></td></tr>
					<tr><td>YRI</td><td><?echo $population[10][0]?></td><td><?echo $population[10][1]?></td></tr>
					</tbody>
				</table>
			</div>
		</div>
		<div name="ld_table">
			<table class="table table-bordered pop">
				<thead>
				<tr>
					<th>Tag SNP</th>
					<th>Pubmed</th>
					<th>Risk Allele</th>
					<th>Risk Allele Frequency</th>
					<th>Disease/Trait</th>
					<th>Reported Genes</th>
					<th>p-Value</th>
					<th>OR or beta[95%CI]</th>
				</tr>
				</thead>
				<tbody>
				<?for($i = 0; $i < count($gwas); $i++){?>
					<tr>
						<td><?echo $gwas[$i][5] ?></td>
						<td><?echo $gwas[$i][1] ?></td>
						<td><? $array = explode('-',$gwas[$i][4]);if($array[1]=='?')echo '-';else echo $array[1]; ?></td>
						<td><?echo $gwas[$i][6] ?></td>
						<td><?echo $gwas[$i][2] ?></td>
						<td><?echo $gwas[$i][3] ?></td>
						<td><?echo $gwas[$i][7] ?></td>
						<td><?echo $gwas[$i][8] ?></td>
					</tr>
				<?}?>
				</tbody>
			</table>
		</div>
	</div>

	</div>
</div>
<?}?>

<div class="panel panel-primary">
	<!--hairpin-->
	<div class="panel-heading" style="padding: 0 10px;">snp in miRNA seed region Hairpin structure</div>
	<div class="panel-body">
	<div name="hairpin" class="row">
	<div style="float:left;" name="snp table"class="col-md-7">
		<div style="margin-top:10px;">
			<spn style="font-size:20px;font-weight: bold;">Hairpin: mature sequence is shown in red</spn>
			<?
			$str=$row3['hairpin_seq'];
			$str=str_replace(' ','_', $str);
			$str=str_replace("\n",'$',$str);
			$p=array();
			$point=array();
			for($ppl=1;$ppl<=$total;$ppl++){
				$p[$ppl]=0;
			}
			for($ppl=1;$ppl<=$total;$ppl++){
				$point[$ppl]=0;
				if($strand=="+"||$strand="-"){
					for($j=5+(strlen($str)-6)/5;$j<4+(strlen($str)-6)/5*2;$j++){
						if($str[$j]!='-' && $str[$j-(strlen($str)-6)/5]!='-'){
							$p[$ppl]++;
							if($p[$ppl]==$on_premir[$ppl]){
								if($str[$j]!='_') $point[$ppl]=$j;
								else $point[$ppl]=$j-(strlen($str)-6)/5;
							}
						}
					}
					if($str[8+(strlen($str)-6)/5*3-5]!='_'){
						$p[$ppl]++;
						if($p[$ppl]==$on_premir[$ppl]){
							$point[$ppl]=$j;
						}
					}
					for($j=(strlen($str)-6)/5*4+3;$j>=5+(strlen($str)-6)/5*3;$j--){
						if($str[$j]!='-'&&$str[$j+(strlen($str)-6)/5]!='-'){
							$p[$ppl]++;
							if($p[$ppl]==$on_premir[$ppl]){
								if($str[$j]!='_')$point[$ppl]=$j;
								else$point[$ppl]=$j+(strlen($str)-6)/5;
							}
						}
					}
				}
				else{
					for($j=5+(strlen($str)-6)/5*3;$j<4+(strlen($str)-6)/5*4;$j++){
						if($str[$j]!='-'&&$str[$j+(strlen($str)-6)/5]!='-'){
							$p[$ppl]++;
							if($p[$ppl]==$on_premir[$ppl]){
								if($str[$j]!='_') $point[$ppl]=$j;
								else $point[$ppl]=$j+(strlen($str)-6)/5;
							}
						}
					}
					if($str[5+(strlen($str)-6)/5*3-2]!='_'){
						$p[$ppl]++;
						if($p[$ppl]==$on_premir[$ppl]){
							$point[$ppl]=$j;
						}
					}
					for($j=(strlen($str)-6)/5*2;$j>=5+(strlen($str)-6)/5*1;$j--){
						if($str[$j]!='-'&&$str[$j-(strlen($str)-6)/5]!='-'){
							$p[$ppl]++;
							if($p[$ppl]==$on_premir[$ppl]){
								if($str[$j]!='_') {$point[$ppl]=$j;}
								else {$point[$ppl]=$j-(strlen($str)-6)/5;}
							}
						}
					}
				}
			}

			$snpchange=array();
			for($ppl=1;$ppl<=$total;$ppl++){
				if($row1["strand"]==$snp_strand[$ppl]){
					$st1=$allele[$ppl];
					$st1=str_replace("T","U",$st1);
				}
				else{
					$st1=$allele[$ppl];
					for($k=0;$k<strlen($st[$ppl]);$k++){
						if($st1[$k]=="C") $st1[$k]="G";
						else if($st1[$k]=="G") $st1[$k]="C";
						else if($st1[$k]=="A") $st1[$k]="U";
						else if($st1[$k]=="T") $st1[$k]="A";
					}
				}
				$st1=$snp_id[$ppl]."(".$st1.")";
				$snpchange[$ppl]=$st1;
			}?>
			<table border="0" cellpadding="0">
				<tr>
			<?
			for($i=4;$i<strlen($str)-1;$i++){
			if($str[$i]=='$'){?>
				</tr>
				<tr height="32px"><?}
					else if($str[$i]=='_'){?>
						<td>
						<?echo " ";?>
						</td>
					<?}
					else{
						$p3=array();
						$p4=0;
						for($ppl=1;$ppl<=$total;$ppl++){
							if($i==$point[$ppl]){
								$p4++;
								$p3[$p4]=$ppl;
							}
						}
						if($p4>=1){?>
						<td title="<? for($ppl=1;$ppl<=$p4;$ppl++)echo $snpchange[$p3[$ppl]]." ";?>">
							<a onClick="showDiv('left',<? echo $p3[1] ?>,<? echo $total ?>);over('snpcontent',500)" style="cursor:pointer;color:#CC00FF;font-size:30px" ><?echo "<b>".$str[$i]."</b>";?>
							</a>
							</td><?}
						else{
							if($str[$i]>='A'&&$str[$i]<='Z') {?>
								<td><?echo "<font color='red'>".$str[$i]."</font>";?></td><?}
							else{?>
								<td><?echo $str[$i];?></td><?}
						}
					}
					}
			?>
				</tr>
			</table>
		</div>
		<div>
		  <table width="500px"  >
		   <? for($pl=1;$pl<=$total;$pl++){
				 if(($pl+1)%2==0){?><tr><? }?>
			   <td>
				   <div style="float:left">
					   <div id="trianglefold<? echo $pl ?>" style="display:block;cursor:pointer">
					   </div>
					   <div id="triangleunfold<? echo $pl ?>" style="display:none;cursor:pointer">
					  </div>
				   <div id="leftnav<? echo $pl ?>" class="unactive" style="cursor:pointer">
						<a href="javascript:void(0);"
						 onclick="javascript:showDiv('left',<? echo $pl ?>,<? echo $total ?>);over('snpcontent',500)" target="_self">
						<span style="font-weight: bold;color:red;font-size:24px;text-decoration: underline"><? echo $snp_id[$pl]; ?></span>
						</a>
					  </div>
				   </td>
				   <? if($pl%2==0)
						 { ?> </tr> <? }
				}?>
			  </tr>
		  </table>
		  </div>
	</div>
	<!--image of snp information-->
		<div class="col-md-5">
			<div  class="thumbnail">
				<img src="<? echo 'wild_png/'.$ID.'.png' ?>" >
				<div class="caption" style="text-align: center;">
					Structure of wild miRNA
				</div>
			</div>
		</div>
	</div>
<hr >
<!--snp id detail information-->
<div id="snpcontent" style="margin-left:15px;" >
  <? for($pl=1;$pl<=$total;$pl++){
	  $sql = "select * from snp_gmaf where snp_id = '".$snp_id[$pl]."'";
	  $result= mysql_query($sql);
	  $row = mysql_fetch_array($result);
	  ?>
	  <div id="left<? echo $pl ?>" style="display:none;" >
		  <div style="float:left;">
			  <table class="table table-hover table-bordered">
				  <tr >
					  <td colspan="2" style="text-align:center;font-weight:bold;font-size:20px;" class="success">
						  <? echo $snp_id[$pl]; ?> Information
					  </td>
				  </tr>
				  <tr>
					  <td style="font-size: 18px;font-weight: bold" width="200px"> SNP ID: </td>
					  <td >
						  <a href="http://www.ncbi.nlm.nih.gov/projects/SNP/snp_ref.cgi?rs=<? echo $snp_id[$pl]; ?>" target="_blank">
				 <? echo $snp_id[$pl];?>
						  </a>
					  </td>
				  </tr>
				  <tr>
					  <td style="font-size: 18px;font-weight: bold">Position:</td>
					  <td ><? echo $snp_chr[$pl].":".$snp_pos[$pl]; ?> </td>
				  </tr>
				  <tr>
					  <td style="font-size: 18px;font-weight: bold">SNP Loc relative to pre-miR: </td>
					  <td><? echo $on_premir[$pl]; ?></td>
				 </tr>
				  <tr>
					  <td style="font-size: 18px;font-weight: bold">Ref-allele:</td>
					  <td><? echo $allele[$pl];?></td>
				  </tr>
				  <tr>
					  <td style="font-size: 18px;font-weight: bold">GMAF:</td>
					  <td><? if($row['ref']){
							  echo $row['ref']."/".$row['alt'];
						  }
						  ?></td>
				  </tr>
				  <tr>
					 <td style="font-size: 18px;font-weight: bold">Energy change: </td>
					 <td > <b> Primary miRNA Eenergy </b>&nbsp;:&nbsp; <? echo $preenergy[$pl]; ?> kcal/mol  <br/>
					  <b>SNP-miRNA Eenergy</b>&nbsp;:&nbsp;<? echo $snp_energy[$pl]; ?>kcal/mol  <br/>
 <b>△△G</b>&nbsp;:&nbsp;<? echo $changed_energy[$pl]; ?>kcal/mol <br/>
					 </td>
				 </tr>
			  </table>
		  </div>
		  <div style="margin-left:700px;background-image:url(<? echo 'snp_png/'.$ID.'_'.$snp_id[$pl].'.png' ?>)">
			  <img src="image/placeholder.png" >
		  </div>
		  <div style="margin-left:750px;font-size:16px;">Structure of SNP  miRNA</div>
	  </div>
  <?}?>
</div>
</div>
</div>
</div>

<!--do not know teh table for-->
<!--
  <table width="800px"  border="1" style="margin-top:100px;display:none" >
    <tr>
     <?/* for($pl=1;$pl<=$total;$pl++)
     {
     */?>
      <td class="menu<?/* if($pl==1) echo "1";else echo "2"; */?>"  id="tab<?/* echo $pl;*/?>" name="tab<?/* echo $pl;*/?>"
	      onClick="<?/* echo "tabit".$total."(tab".$pl.",ctab".$pl.")"*/?>">
	        <?/* echo $snp_id[$pl]; */?>
	  </td>
     <?/*
     }
     */?>
   </tr>
   <?/*
   $pl=1;
   for($pl=1;$pl<=$total;$pl++)
   {
   */?>
     <tr >
       <td id="ctab<?/* echo $pl*/?>" name="ctab<?/* echo $pl*/?>"  colspan="<?/* echo $total*/?>" bgcolor="#FFFFFF">
	      <div style="float:left;">
            <div style="font-family:arial;font-size:14px">
			 <b>
	           SNP_ID: <?/* echo $snp_id[$pl];*/?>   <br/>
               Position:<?/* echo $snp_chr[$pl].":".$snp_pos[$pl]; */?> <br/>
	           SNP Loc relative to pre-miR: <?/* echo $on_premir[$pl]; */?> <br/>

	           Ref-allele:<?/* echo $allele[$pl];*/?>   <br/>
	           Energy change: <br/>
	           &nbsp;&nbsp; Primary miRNA Eenergy : <?/* echo $preenergy[$pl]; */?> kcal/mol  <br/>
	           &nbsp;&nbsp; SNP-miRNA Eenergy:<?/* echo $snp_energy[$pl]; */?>kcal/mol  <br/>
	           &nbsp;&nbsp; <?/* echo $changed_energy[$pl]; */?>kcal/mol <br/>
	        </b>
	      </div>
        <?/* $sqlcontrol7="select * from table7_snp_freq where snp_id ='".$snp_id[$i]."'";
           $result7 = mysql_query($sqlcontrol7);
           $row7=mysql_fetch_array($result7);
           if($row7["ASW"]!="")
           {
        */?>
	    <h4> SNP_Freq: </h4>
        <table border="1">
        <tr>
	     <td>ASW</td>
		 <td>CEU</td>
		 <td>CHB</td>
		 <td>CHD</td>
		 <td>GIH</td>
		 <td>JPT</td>
		 <td>LWK</td>
		 <td>MEX</td>
		 <td>MKK</td>
		 <td>TSI</td>
		 <td>YRI</td>
        </tr>
	    <tr>
	     <td><?/* echo $row7["ASW"]; */?></td>
		 <td><?/* echo $row7["CEU"]; */?></td>
		 <td><?/* echo $row7["CHB"]; */?></td>
		 <td><?/* echo $row7["CHD"]; */?></td>
		 <td><?/* echo $row7["GIH"]; */?></td>
		 <td><?/* echo $row7["JPT"]; */?></td>
		 <td><?/* echo $row7["LWK"]; */?></td>
		 <td><?/* echo $row7["MEX"]; */?></td>
		 <td><?/* echo $row7["MKK"]; */?></td>
		 <td><?/* echo $row7["TSI"]; */?></td>
         <td><?/* echo $row7["YRI"]; */?></td>
		</tr>
	    </table>
	     <?/*
          }
         */?>
      </div>
  <div style="margin-left:330px;white-space:pre;font-size:12px;font-family:Arial, Helvetica, sans-serif">
   <b>Hairpin:</b>
  <?/*
  $str=$row3['hairpin_seq'];
  $str=str_replace(' ','_', $str);
  $str=str_replace("\n",'$',$str);
  $p=array();
  $point=array();
  for($ppl=1;$ppl<=$total;$ppl++)
  {$p[$ppl]=0;
  }
  for($ppl=1;$ppl<=$total;$ppl++)
  {
  $point[$ppl]=0;
  if($strand=="+")
  { for($j=2+(strlen($str)-3)/5;$j<1+(strlen($str)-3)/5*2;$j++)
       {if($str[$j]!='-'&&$str[$j-(strlen($str)-3)/5]!='-')
		  {$p[$ppl]++;
           if($p[$ppl]==$on_premir[$ppl])
		      {if($str[$j]!='_')
			      $point[$ppl]=$j;
			   else
			      $point[$ppl]=$j-(strlen($str)-3)/5;
			  }
		  }
	   }
	if($str[2+(strlen($str)-3)/5*3-2]!='_')
	     {$p[$ppl]++;
		   if($p[$ppl]==$on_premir[$ppl])
		    {
			  $point[$ppl]=$j;
			}
		 }
	for($j=(strlen($str)-3)/5*4;$j>=2+(strlen($str)-3)/5*3;$j--)
	  {if($str[$j]!='-'&&$str[$j+(strlen($str)-3)/5]!='-')
		 {$p[$ppl]++;
          if($p[$ppl]==$on_premir[$ppl])
			 {if($str[$j]!='_')
			    $point[$ppl]=$j;
			  else
			    $point[$ppl]=$j+(strlen($str)-3)/5;
			 }
		 }
	  }
  }
  else
  {for($j=2+(strlen($str)-3)/5*3;$j<1+(strlen($str)-3)/5*4;$j++)
	 {if($str[$j]!='-'&&$str[$j+(strlen($str)-3)/5]!='-')
		 {$p[$ppl]++;
          if($p[$ppl]==$on_premir[$ppl])
		    {if($str[$j]!='_')
			   $point[$ppl]=$j;
			 else
			   $point[$ppl]=$j+(strlen($str)-3)/5;
			}
		 }
	 }
   if($str[2+(strlen($str)-3)/5*3-2]!='_')
	 {$p[$ppl]++;
	   if($p[$ppl]==$on_premir[$ppl])
		  {$point[$ppl]=$j;
		  }
	 }
   for($j=(strlen($str)-3)/5*2;$j>=2+(strlen($str)-3)/5*1;$j--)
	    {if($str[$j]!='-'&&$str[$j-(strlen($str)-3)/5]!='-')
		    {$p[$ppl]++;
             if($p[$ppl]==$on_premir[$ppl])
			  {if($str[$j]!='_')
			     $point[$ppl]=$j;
			   else
			     $point[$ppl]=$j+(strlen($str)-3)/5;
			  }
		    }
		}
  }

  }
  $snpchange=array();
  for($ppl=1;$ppl<=$total;$ppl++)
  {
   if($row1["strand"]==$snp_strand[$ppl])
   {  $st1=$allele[$ppl];
      $st1=str_replace("T","U",$st1);
   }
   else
   {$st1=$allele[$ppl];
    for($k=0;$k<strlen($st[$ppl]);$k++)
      {if($st1[$k]=="C")
     	    $st1[$k]="G";
	    else
	      if($st1[$k]=="G")
	  	      $st1[$k]="C";
	      else
		      if($st1[$k]=="A")
			       $st1[$k]="U";
		      else
			     if($st1[$k]=="T")
			         $st1[$k]="A";
       }
    }
	$st1=$snp_id[$ppl]."(".$st1.")";
	$snpchange[$ppl]=$st1;

   }
   */?> <table border="0" cellpadding="0"> <tr>
   <?/*
   for($i=1;$i<strlen($str)-1;$i++)
    {
	   if($str[$i]=='$')
	     {*/?></tr><tr><?/*
	     }
	   else
	     if($str[$i]=='_')
	    	{*/?><td><?/*
			 echo " ";
			 */?></td><?/*
			}
	      else
		     {$p3=array();
			  $p4=0;
			  for($ppl=1;$ppl<=$total;$ppl++)
			  {if($i==$point[$ppl])
			     {$p4++;
			      $p3[$p4]=$ppl;
				 }
              }
			  if($p4>=1)
		        {*/?><td title="<?/* for($ppl=1;$ppl<=$p4;$ppl++)echo $snpchange[$p3[$ppl]]." ";*/?>"><a onClick="showDiv('left',<?/* echo $p3[1] */?>,<?/* echo $total */?>);over('snpcontent',700)" style="cursor:pointer;color:#9900CC;font-size:36px"><?/*
				    echo $str[$i];
				 */?></a></td><?/*
				}
		        else
		        {if($str[$i]>='A'&&$str[$i]<='Z')
				 {*/?><td><?/*
		           echo "<font color='red'>".$str[$i]."</font>";
				  */?></td><?/*
				 }
		         else
		             {*/?><td><?/*
					  echo $str[$i];
		              */?></td><?/*
					 }
				}



		    }

	}



  */?>
  </tr>
  </table>
  <br/>
  <br/>
  <br/>
  <br/>
  <?/*
  */?>
  </div>

  <div><div  id="oDiv" onClick="loadBox.init();inini('wild_png/<?/* echo $ID */?>.png');loadBox.show()"

     style="position:relative; height:200px; width:200px;  float:left;

          filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?/* echo 'wild_png/'.$ID.'_'.$snp_id[$pl].'.png' */?>', sizingMethod='scale');" >
      </div>
	 <?/* $new_ID=$ID."_".$snp_id[$pl]; */?>
	 <div id="oDiv" onClick="loadBox.init();inini('snp_png/<?/* echo $new_ID */?>.png');loadBox.show();"

     style="position:relative; height:200px; width:200px;

          filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?/* echo 'snp_png/'.$ID.'_'.$snp_id[$pl].'.png' */?>', sizingMethod='scale');" >
      </div>
  <input type="button" value="" onClick="loadBox.init();inini('wild_png/<?/* echo $ID */?>.png');loadBox.show()"/>
  </div>
  </td>
  </tr>
  <?/* } */?>




  </table>
-->
</div>

<?php include("footerinclude.php") ?>
