<?php



$ip="********"
$user="********"
$password="********"
$db="********"
$conn=mysql_connect($ip,$user,$password) or die("Cannot connect to server!".mysql_error());
mysql_select_db($db,$conn) or die("Cannot select database!".mysql_error());


$id = $_GET['id'];
$flag= $_GET['flag'];
if($flag == 'gene') {
	$sql = "select * from gene_expression where id = '" . $id . "'";
	$name = array(
		"ACC",
		"BLCA",
		"BRCA",
		"CESC",
		"COAD",
		"DLBC",
		"GBM",
		"HNSC",
		"KICH",
		"KIRC",
		"KIRP",
		"LAML",
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
		"UCEC",
		"UCS"
	);
	$gap = 10;
	$width = 24;
	$unit = "RPKM";
}
if($flag=='mirna'){
	$sql = "select * from mirna_expression where id = '" . $id . "'";
	$name = array(
		"ACC",
		"BLCA",
		"BRCA",
		"CESC",
		"COAD",
		"DLBC",
		"ESCA",
		"HNSC",
		"KICH",
		"KIRC",
		"KIRP",
		"LAML",
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
		"STAD",
		"THCA",
		"UCEC",
		"UCS"
	);
	$gap = 11;
	$width = 22;
	$unit = "RPM";
}

$axis = 40;

$result = mysql_query($sql);
$row = mysql_fetch_row($result);
$row = array_slice($row, 2);
$count = count($row);


$max = max($row);
$divide = $max > 100 ? ($max > 1000 ? ($max > 5000 ? ($max > 10000? 5000:1000) : 500) : 100) : 10;
$first = ceil($max / $divide);
$maxH = $first * $divide;
$ratioH = round(400 / $maxH, 3);
$picHeight = 420;



$im = @imagecreatetruecolor(980, $picHeight) or die('cant initialize new GD image stream');
$background = imagecolorallocatealpha($im, 255, 255, 255, 127);
imagefill($im, 0, 0, $background);
$linecolor = imagecolorallocatealpha($im, 0, 0, 0, 100);


for ($i = 0; $i <= $first; $i++) {
	imageline($im, 40, ($first - $i) * $divide * $ratioH + 10, 46, ($first - $i) * $divide * $ratioH + 10, $linecolor);
	imagestring($im,
		3,
		0,
		($first - $i) * $divide * $ratioH,
		$i * $divide,
		$linecolor
	);
}
imageline($im, 43, 10, 43, 410, $linecolor);
imageline($im, 40, 410, 980, 410, $linecolor);
imagestring($im, 3, 47, 1, "/ $unit", $linecolor);


for($i = 0; $i<$count; $i++){
	$r = mt_rand(0,255);
	$g = mt_rand(0, 255);
	$b = mt_rand(0, 255);
	$fillcolor = imagecolorallocatealpha($im,$r,$g,$b,120);
	$x1 = round($i*($gap + $width) + $gap + $axis, 3);
	$y1 = round(($maxH - $row[$i])* $ratioH, 3);
	imagefilledrectangle($im,$x1, $y1, round($x1 + $width,3), round(410,3), $fillcolor);
	if($y1<8 * strlen($name[$i]) ) $y1 = 9 * strlen($name[$i]);
	imagestringup($im,5,$x1+$width * 1.4 /5, $y1-5, $name[$i], $linecolor);
}

header('Content-type: image/png');
imagepng($im);
imagedestroy($im);

?>