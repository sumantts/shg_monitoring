<?php
require('html_table.php');
require('../assets/php/sql_conn.php');

$pdf = new PDF();
$pdf->AddPage('L');
$pdf->SetFont('Arial','',12);

$StfId = $_GET['StfId'];
$MeetingDt = $_GET['MeetingDt'];
$GrpSBAc = $_GET['GrpSBAc'];

		
$meeting_datas = array();
$group_name = '';
$subtotal = 0;
$agent_name = '';


//Get Cas Bank Fig
$query = "CALL usp_PrintMeetingReceipt('".$StfId."', '".$GrpSBAc."', '".$MeetingDt."')";
mysqli_multi_query($con, $query);
do {
    if ($result = mysqli_store_result($con)) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            //printf("%s\n", $row[0]);
            $CollDt = $row['CollDt'];
            $AcNo = $row['AcNo'];
            $AgntNm = $row['AgntNm'];
            $GrpNm = $row['GrpNm'];
            $Member_Name = $row['Member_Name'];
            $CollAmt = $row['CollAmt']; 
            $group_name = $row['GrpNm'];
            $subtotal = $subtotal + $CollAmt;
            $agent_name = $row['AgntNm'];

            $meeting_data = new stdClass();
            $meeting_data->CollDt = $CollDt;
            $meeting_data->AcNo = $AcNo;
            $meeting_data->AgntNm = $AgntNm;
            $meeting_data->GrpNm = $GrpNm;
            $meeting_data->Member_Name = $Member_Name;
            $meeting_data->CollAmt = $CollAmt;

            array_push($meeting_datas, $meeting_data);
        }
    }
    if (mysqli_more_results($con)) {
    }
} while (mysqli_next_result($con));


$dnld_f_name = 'meeting_data_report.pdf';

$html = '';
$html .= '<table border="1">
<tr><td width="400" align="CENTER">Bagnan Mahila Bikash CCSL</td></tr>
<tr><td width="400" align="CENTER">Collection Date: '.date('d-M-Y', strtotime($MeetingDt)).'</td></tr>
<tr><td width="400" align="CENTER">Group Name: '.$group_name.'</td></tr>
<tr><td width="400" align="CENTER">S/B A/c No.: '.$GrpSBAc.'</td></tr>
<tr><td width="400" align="CENTER">Amount: '.$subtotal.'</td></tr>
<tr><td width="400" align="CENTER">Agent Name: '.$agent_name.'</td></tr>
<tr><td width="400">--------------------------------</td></tr>
<tr>
<td width="100" height="30" align="CENTER">Sl.</td><td width="200" height="30" align="CENTER">Member Name</td><td width="100" height="30" align="CENTER">Amount</td>
</tr>
<tr><td width="400">--------------------------------</td></tr>';

if(sizeof($meeting_datas) > 0){
    $slno = 0;
    for($i = 0; $i < sizeof($meeting_datas); $i++){
        $slno = $i + 1;
        $html .= '<tr><td width="100" height="30" align="CENTER">'.$slno.'. </td><td width="200" height="30" align="CENTER">'.$meeting_datas[$i]->Member_Name.'</td><td width="100" height="30" align="CENTER">'.$meeting_datas[$i]->CollAmt.'/-</td></tr>';
        $html .= '<tr><td width="400">--------------------------------</td></tr>';
    }
}

$html .= '</table>';

$pdf->WriteHTML($html);
//$pdf->Output();
//$pdf->Output('I', $dnld_f_name); //I: Show only
$pdf->Output('D', $dnld_f_name); //D: Force download


?>