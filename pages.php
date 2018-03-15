<?
if(!function_exists(pages)){ 

function pages($total,$displaypg=20,$url=''){
global $page,$firstcount,$pagenav,$_SERVER;

$GLOBALS["displaypg"]=$displaypg;
$page=$_GET['page'];
if(!$page) $page=1;
if(!$url){ $url=$_SERVER["REQUEST_URI"];}

$parse_url=parse_url($url);
$url_query=$parse_url["query"];
if($url_query){
$url_query=ereg_replace("(^|&)page=$page","",$url_query);
$url=str_replace($parse_url["query"],$url_query,$url);
if($url_query) $url.="&page"; else $url.="page";
}else {
$url.="?page";
}

$lastpg=ceil($total/$displaypg);
$page=min($lastpg,$page);
$prepg=$page-1; 
$nextpg=($page==$lastpg ? 0 : $page+1); 
$firstcount=($page-1)*$displaypg;


echo "<div style='text-align:right'>";
$pagenav="Record <B>".($total?($firstcount+1):0)."</B>-<B>".min($firstcount+$displaypg,$total)."</B> ，totally $total records.<br>";

if($lastpg<=1) return false;


$pagenav.=" <a href='$url=1'>First</a> ";
if($prepg) $pagenav.=" <a href='$url=$prepg'> Previous </a> "; else $pagenav.=" Previous ";
if($nextpg) $pagenav.=" <a href='$url=$nextpg'> Next </a> "; else $pagenav.=" Next ";
$pagenav.=" <a href='$url=$lastpg'> Last </a> ";

$pagenav.="　Go to page<select name='topage' size='1' onchange='window.location=\"$url=\"+this.value'>\n";
for($i=1;$i<=$lastpg;$i++){
if($i==$page) $pagenav.="<option value='$i' selected>$i</option>\n";
else $pagenav.="<option value='$i'>$i</option>\n";
}
$pagenav.="</select> ，totally $lastpg pages";
echo "</div>";
}
}
?>
