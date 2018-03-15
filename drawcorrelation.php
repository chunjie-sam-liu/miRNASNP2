<?php

$ip="********"
$user="********"
$password="********"
$db="********"
$conn=mysql_connect($ip,$user,$password) or die("Cannot connect to server!".mysql_error());
mysql_select_db($db,$conn) or die("Cannot select database!".mysql_error());

$name = array("ACC",
	"BLCA",
	"BRCA",
	"CESC",
	"COAD",
	"DLBC",
	"HNSC",
	"KICH",
	"KIRC",
	"KIRP",
	"LGG",
	"LIHC",
	"LUAD",
	"LUSC",
	"MESO",
	"OV",
	"PAAD",
	"PCPG",
	"PRAD",
	"READ",
	"SARC",
	"SKCM",
	"THCA",
	"UCS");


$id = $_GET['id'];
$sql = "select * from correlation where id = '" . $id . "'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);
$row = array_slice($row, 3);

$count = count($row);

$im = @imagecreatetruecolor(980, 420) or die('cant initialize new GD image stream');
$background = imagecolorallocatealpha($im, 255, 255, 255, 127);
imagefill($im, 0, 0, $background);
$linecolor = imagecolorallocatealpha($im, 0, 0, 0, 100);

$i = 0;
$x = 0;
while($i<=255) {
	$r = $i;
	$g = 255 - $i;
	$b = 0;

	$color = imagecolorallocatealpha($im, $r, $g, $b, 120);
	imagefilledrectangle($im, 220 + $x, 80, 270 + $x +2, 100, $color);
	$i++;
	$x += 2;
}



$marginLeft = 90;
$gap = 8;
$width = 25;
function get_max($data){
	$max = -1;
	foreach($data as $item){
		if($item == 'NA'){continue;}
		else{ 
			if($item > $max) $max = $item;
		}
	}
	return $max;
}
$max = get_max($row);

$min = min($row);
$length = $max - $min;
$ratio = 255 / ($length);

imagestring($im, 5, 165, 85, "$min", $linecolor);
imagestring($im, 5, 800, 85, "$max", $linecolor);


for($i = 0; $i<$count; $i++){
	$r = ($row[$i]-$min)  * $ratio;
	$g = 255 - $r;
	$b = 0;

	$fillcolor = imagecolorallocatealpha($im,$r,$g,$b,120);
	$x1 = round($i*($gap + $width) + $gap + $marginLeft, 3);
	if($row[$i] == 'NA') $y1 = 280;
	else $y1 = 200;

	imagefilledrectangle($im,$x1, $y1, round($x1 + $width,3), 280, $fillcolor);
	imagestring($im,3,$x1, 280, $name[$i], $linecolor);
	imagestringup($im,3,$x1+6, 190, $row[$i], $linecolor);
}
imageline($im, 90, 280, 890, 280, $linecolor);


header('Content-type: image/png');
imagepng($im);
imagedestroy($im);




?>
