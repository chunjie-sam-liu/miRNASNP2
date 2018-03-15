#!/usr/bin/perl
#gongjing 2013-07-09 used to get the target gain and loss;


$seq1=$ARGV[0];
$seq2=$ARGV[1];
$data_file="online_set_3/";
$plot_pl=$data_file."2_get_color_for_seqence.pl";
$seq1_for_RNAfold = $data_file."seq1_for_RNAfold";
$seq2_for_RNAfold = $data_file."seq2_for_RNAfold";
$seq1_for_RNAplot = $data_file."seq1_for_RNAplot";
$seq2_for_RNAplot = $data_file."seq2_for_RNAplot";


open(OUT1,">$seq1_for_RNAfold") ;
open(OUT2,">$seq2_for_RNAfold") ;
open(OUT3,">$seq1_for_RNAplot") ;
open(OUT4,">$seq2_for_RNAplot") ;


$seq1=~s/[^ACTGUactgu]//;
$seq2=~s/[^ACTGUactgu]//;

# print $seq1, "\n";
# print $seq2, "\n";

@seq1=split(//,$seq1);
@seq2=split(//,$seq2);
$varation_pos=200;
for($i=0;$i<=$#seq1;$i++){
	if($seq1[$i] ne $seq2[$i]){
		$varation_pos=$i;
	}
}

# print $seq1, "\n";
# print $seq2, "\n";


print OUT1 ">SEQ1\n$seq1\n";
print OUT2 ">SEQ2\n$seq2\n";
print OUT3 "SEQ1\t$seq1\t$varation_pos\n";
print OUT4 "SEQ2\t$seq2\t$varation_pos\n";

close OUT1;
close OUT2;
close OUT3;
close OUT4;

$seq1_RNAfold_re=$data_file."seq1_RNAfold_re";
$seq2_RNAfold_re=$data_file."seq2_RNAfold_re";
$seq1_RNAplot_re=$data_file."seq1_RNAplot_re";
$seq2_RNAplot_re=$data_file."seq2_RNAplot_re";

`/home/liucj/tools/ViennaRNA-lite/RNAfold < $seq1_for_RNAfold > $seq1_RNAfold_re`;
`/home/liucj/tools/ViennaRNA-lite/RNAfold < $seq2_for_RNAfold > $seq2_RNAfold_re`;
# print "perl $plot_pl $seq2_for_RNAplot", "\n";
# print "perl $plot_pl $seq1_for_RNAplot", "\n";
`perl $plot_pl $seq1_for_RNAplot`;
`perl $plot_pl $seq2_for_RNAplot`;
`chmod 777 ./online_set_3/SEQ*`;
`chmod 777 ./online_set_3/seq*`;
#`rm /home/gongj/miRNASNP_public_html_v2/online_set_3/SEQ1.*`;
#`rm /home/gongj/miRNASNP_public_html_v2/online_set_3/SEQ2.*`;
#`rm /home/gongj/miRNASNP_public_html_v2/online_set_3/SEQ1_*`;
#`rm /home/gongj/miRNASNP_public_html_v2/online_set_3/SEQ2_*`;
#`rm /home/gongj/miRNASNP_public_html_v2/online_set_3/seq*`

