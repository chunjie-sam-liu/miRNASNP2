#!/usr/bin/perl
#gongjing 2013-06-11 used to get the target gain and loss;

$seq1=$ARGV[0];
if($ARGV[2]){
$seq2=$ARGV[1];
$uniq_code=$ARGV[2];
}else{
$seq2="";
$uniq_code=$ARGV[1];
}

$data_file="online_set_2/";
$out_file="online_result_2/";
$utr_m=$data_file."3UTR_sequence_UCSC20130404_for_M2";
$utr_t=$data_file."3UTR_sequence_UCSC20130404_for_T2";
$targetscan=$data_file."targetscan_60.pl";
$target_G_L_pl=$data_file."get_target_G_L_online.pl";
$get_join_targets=$data_file."get_join_targets.pl";
$seq1_for_M=$out_file."seq1_for_M";
$seq1_for_T=$out_file."seq1_for_T";
$seq2_for_M=$out_file."seq2_for_M";
$seq2_for_T=$out_file."seq2_for_T";
$seq1_target=$out_file."seq1_target.".$uniq_code;
$seq2_target=$out_file."seq2_target.".$uniq_code;
$seq_target_loss=$out_file."seq_target_loss.".$uniq_code;
$seq_target_gain=$out_file."seq_target_gain.".$uniq_code;

open(OUT1,">$seq1_for_M") ;
open(OUT2,">$seq1_for_T") ;
open(OUT3,">$seq2_for_M") ;
open(OUT4,">$seq2_for_T") ;

$seq1=~s/[^ACTGUactgu]//;
$seq2=~s/[^ACTGUactgu]//;

$seq1_t=substr($seq1,1,7);
$seq2_t=substr($seq2,1,7);

print OUT1 ">SEQ1\n$seq1\n";
print OUT2 "SEQ1\t$seq1_t\t9606\n";
print OUT3 ">SEQ2\n$seq2\n";
print OUT4 "SEQ2\t$seq2_t\t9606\n";

$seq1_Targetsccan_re=$out_file."seq1_re_T";
$seq2_Targetsccan_re=$out_file."seq2_re_T";
$seq1_Miranda_re=$out_file."seq1_re_M";
$seq2_Miranda_re=$out_file."seq2_re_M";

`perl $targetscan $seq1_for_T $utr_t  $seq1_Targetsccan_re`;
`/usr/local/src/miRanda-3.3a/src/miranda $seq1_for_M $utr_m  -en -10 > $seq1_Miranda_re`;
if($ARGV[2]){
`perl $targetscan $seq2_for_T   $utr_t  $seq2_Targetsccan_re`;
`/usr/local/src/miRanda-3.3a/src/miranda   $seq2_for_M  $utr_m  -en -10 >$seq2_Miranda_re`;

`perl $target_G_L_pl $seq1_Targetsccan_re $seq1_Miranda_re $seq2_Targetsccan_re $seq2_Miranda_re $seq_target_loss $seq_target_gain`;
`perl $get_join_targets $seq1_Targetsccan_re $seq1_Miranda_re $seq1_target`;
`perl $get_join_targets $seq2_Targetsccan_re $seq2_Miranda_re $seq2_target`;
}else{
`perl $get_join_targets $seq1_Targetsccan_re $seq1_Miranda_re $seq1_target`;
}
`chmod 777 online_result_2/*`
#`find ../online_result_2/ -type f -mtime +0.1 -exec rm -f {} \;`
