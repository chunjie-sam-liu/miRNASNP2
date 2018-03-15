<?

session_start();
$population = $_SESSION['population'] ;
$tagPos = $_SESSION['tagPos'];
$snp = $_SESSION['snp'];
//Draw plate;
$im = @imagecreatetruecolor(800, 545) or die('cant initialize new GD image stream');
$background = imagecolorallocatealpha($im, 255, 255, 255, 127);
imagefill($im, 0, 0, $background);
$linecolor = imagecolorallocatealpha($im, 0, 0, 0, 100);

$count = count($population);
$max = 0;
$min = 100000000000;
for($i =0; $i<$count;$i++){
	if(!($population[$i][0] == '' || $population[$i][1] == '')){
		if ($max < $population[$i][1]) {
			$max = $population[$i][1];
		}
		if ($min > $population[$i][0]) {
			$min = $population[$i][0];
		}
	}
}
$length = $max - $min;
$ratio = 600 / $length;
$width = 20;
$gap = 20;
$fillcolor = imagecolorallocatealpha($im,92,184,92,0);
for($i = 0; $i < $count; $i++) {
	$x1 = 100 + ($population[$i][0] - $min) * $ratio;
	$x2 = 100 + ($population[$i][1] - $min) * $ratio;
	$y1 = 50 + ($width + $gap) * $i;
	$y2 = $y1 + $width;
if(!($population[$i][0] == '' || $population[$i][1] == '')) {
	imagefilledrectangle($im, $x1, $y1, $x2, $y2, $fillcolor);
}
}

$snpcolor = imagecolorallocatealpha($im,217,83,79,0);
$snpWidth = 10;
$snpGap = 5;

for($i = 0; $i < count($snp); $i++){
	$j = 0;
	$x1 = 100 + ($snp[$i][1] - $min) * $ratio;
	while($y2 < 500) {
		$y1 = ($snpGap + $snpWidth) * $j;
		$y2 = $y1 + $snpWidth;
		imagefilledrectangle($im, $x1, $y1, $x1 + 1, $y2, $snpcolor);
		$j++;
	}
	imagestring($im,3,$x1-30,$y2 + $i * 12,$snp[$i][0],$linecolor);
}


$snpcolor = imagecolorallocatealpha($im,66,139,202,0);
$tagGap = 5;
$tagWidth = 10;
$x1 = 100 + ($tagPos - $min) * $ratio;
$j=0;
$y2=0;
while($y2 < 500) {
	$y1 = ($tagGap + $tagWidth) * $j;
	$y2 = $y1 + $snpWidth;
	imagefilledrectangle($im, $x1, $y1, $x1 + 1, $y2, $snpcolor);
	$j++;
}

imagestring($im, 5, 40, 50, "ASW", $linecolor);
imagestring($im, 5, 40, 90, "CEU", $linecolor);
imagestring($im, 5, 40, 130, "CHB", $linecolor);
imagestring($im, 5, 40, 170, "CHD", $linecolor);
imagestring($im, 5, 40, 210, "GIH", $linecolor);
imagestring($im, 5, 40, 250, "JPT", $linecolor);
imagestring($im, 5, 40, 290, "LWK", $linecolor);
imagestring($im, 5, 40, 330, "MEK", $linecolor);
imagestring($im, 5, 40, 370, "MKK", $linecolor);
imagestring($im, 5, 40, 410, "TSI", $linecolor);
imagestring($im, 5, 40, 450, "YRI", $linecolor);




//draw rectangle

header('Content-type: image/png');
imagepng($im);
imagedestroy($im);

?>
?>