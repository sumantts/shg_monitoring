<?php
require('html_table.php');
require('../assets/php/sql_conn.php');

$pdf = new PDF();
$pdf->AddPage('L');
$pdf->SetFont('Arial','',12);

$fromDate = $_GET['fromDate'];
$uptoDate = $_GET['uptoDate'];
$groupAcNo = $_GET['groupAcNo'];
$GroupId = $_GET['GroupId'];
$cbTitle2 = $_GET['cbTitle2'];
		
$cb_rows = array();

$OpnCash = '';
$OpnBank = '';
$ClsCash = '';
$ClsBank = '';

$sTotalRCash = 0;
$sTotalRBank = 0;
$sTotalPCash = 0;
$sTotalPBank = 0;

$TotalRCash = 0;
$TotalRBank = 0;
$TotalPCash = 0;
$TotalPBank = 0;

//Get Cas Bank Fig
$query = "CALL usp_GetCasBankFig('".$GroupId."', '".$fromDate."', '".$uptoDate."')";
mysqli_multi_query($con, $query);
do {
    if ($result = mysqli_store_result($con)) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            //printf("%s\n", $row[0]);
            $OpnCash = number_format($row['OpnCash'], 2);
            $OpnBank = number_format($row['OpnBank'], 2);
            $ClsCash = number_format($row['ClsCash'], 2);
            $ClsBank = number_format($row['ClsBank'], 2);
        }
    }
    if (mysqli_more_results($con)) {
    }
} while (mysqli_next_result($con));

//View Cash Book
$query = "CALL usp_ViewCashBook('".$GroupId."', '".$fromDate."', '".$uptoDate."')";
mysqli_multi_query($con, $query);
do {
    if ($result = mysqli_store_result($con)) {				
        if(mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                //printf("%s\n", $row[0]);
                $SlNo = $row['SlNo'];
                $RDate =$row['RDate'];
                $RParti = $row['RParti'];
                $RCash = $row['RCash'];
                $RBank = $row['RBank'];
                $PDate =$row['PDate'];
                $PParti = $row['PParti'];
                $PCash = $row['PCash'];
                $PBank = $row['PBank'];

                $cb_row = new stdClass();
                $cb_row->SlNo = $SlNo;
                
                $cb_row->RDate = ($RDate != null)? date('d-m-Y', strtotime($RDate)) : '&nbsp;';
                $cb_row->RParti = ($RParti != null)? $RParti : '&nbsp;';
                $cb_row->RCash = ($RCash != null)? $RCash : '0.00';
                $cb_row->RBank = ($RBank != null)? $RBank : '0.00';
                $cb_row->PDate = ($PDate != null)? date('d-m-Y', strtotime($PDate)) : '&nbsp;';
                $cb_row->PParti = ($PParti != null)? $PParti : '&nbsp;';
                $cb_row->PCash = ($PCash != null)? $PCash : '0.00';
                $cb_row->PBank = ($PBank != null)? $PBank : '0.00';

                array_push($cb_rows, $cb_row);

                $sTotalRCash = $sTotalRCash + $RCash;
                $sTotalRBank = $sTotalRBank + $RBank;
                $sTotalPCash = $sTotalPCash + $PCash;
                $sTotalPBank = $sTotalPBank + $PBank;
            }
        }
    }
    if (mysqli_more_results($con)) {
    }
} while (mysqli_next_result($con));

$sTotalRCash = number_format($sTotalRCash, 2);
$sTotalRBank = number_format($sTotalRBank, 2);
$sTotalPCash = number_format($sTotalPCash, 2);
$sTotalPBank = number_format($sTotalPBank, 2);


$TotalRCash = number_format($sTotalRCash + $OpnCash, 2);
$TotalRBank = number_format($sTotalRBank + $OpnBank, 2);
$TotalPCash = number_format($sTotalPCash + $ClsCash, 2);
$TotalPBank = number_format($sTotalPBank + $ClsBank, 2);

$fromDateN = date('d-m-Y', strtotime($fromDate));
$uptoDateN = date('d-m-Y', strtotime($uptoDate));

$dnld_f_name = 'cash_book_for_'.$groupAcNo.'_from_'.date('d_m_Y', strtotime($fromDate)).'_to_'.date('d_m_Y', strtotime($uptoDate)).'.pdf';

$html = '';
$html .= '<table border="1">
<tr><td colspan="2" width="1000" align="CENTER">Cash Book For The Period '.$fromDateN.' To '.$uptoDateN.'</td></tr>
<tr><td colspan="2" width="1000" align="CENTER">'.$cbTitle2.'</td></tr>
<tr><td colspan="2" width="1000" align="CENTER">Group S/B A/c No.: '.$groupAcNo.'</td></tr>
<tr><td colspan="2" width="500" align="CENTER">Receipt</td><td colspan="2" width="500" align="CENTER">Payment</td></tr>
<tr>
<td width="100" height="30" align="CENTER">Date</td><td width="200" height="30" align="CENTER">Particulars</td><td width="100" height="30" align="CENTER">Cash</td><td width="100" height="30" align="CENTER">Bank</td>
<td width="100" height="30" align="CENTER">Date</td><td width="200" height="30" align="CENTER">Particulars</td><td width="100" height="30" align="CENTER">Cash</td><td width="100" height="30" align="CENTER">Bank</td>
</tr>';

if(sizeof($cb_rows) > 0){
for($i = 0; $i < sizeof($cb_rows); $i++){
$html .= '<tr><td width="100" height="30">'.$cb_rows[$i]->RDate.'</td><td width="200" height="30">'.$cb_rows[$i]->RParti.'</td><td width="100" height="30" align="RIGHT">'.$cb_rows[$i]->RCash.'</td><td width="100" height="30" align="RIGHT">'.$cb_rows[$i]->RBank.'</td><td width="100" height="30">'.$cb_rows[$i]->PDate.'</td><td width="200" height="30">'.$cb_rows[$i]->PParti.'</td><td width="100" height="30" align="RIGHT">'.$cb_rows[$i]->PCash.'</td><td width="100" height="30" align="RIGHT">'.$cb_rows[$i]->PBank.'</td></tr>';
}
}

$html .= '<tr>
<td width="100" height="30">Subtotal</td><td width="200" height="30">&nbsp;</td><td width="100" height="30" align="RIGHT">'.$sTotalRCash.'</td><td width="100" height="30" align="RIGHT">'.$sTotalRBank.'</td>
<td width="100" height="30">Subtotal</td><td width="200" height="30">&nbsp;</td><td width="100" height="30" align="RIGHT">'.$sTotalPCash.'</td><td width="100" height="30" align="RIGHT">'.$sTotalPBank.'</td>
</tr>
<tr>
<td width="100" height="30">Opening</td><td width="200" height="30">&nbsp;</td><td width="100" height="30" align="RIGHT">'.$OpnCash.'</td><td width="100" height="30" align="RIGHT">'.$OpnBank.'</td>
<td width="100" height="30">Closing</td><td width="200" height="30">&nbsp;</td><td width="100" height="30" align="RIGHT">'.$ClsCash.'</td><td width="100" height="30" align="RIGHT">'.$ClsBank.'</td>
</tr>
<tr>
<td width="100" height="30">Total</td><td width="200" height="30">&nbsp;</td><td width="100" height="30" align="RIGHT">'.$TotalRCash.'</td><td width="100" height="30" align="RIGHT">'.$TotalRBank.'</td>
<td width="100" height="30">Total</td><td width="200" height="30">&nbsp;</td><td width="100" height="30" align="RIGHT">'.$TotalPCash.'</td><td width="100" height="30" align="RIGHT">'.$TotalPBank.'</td>
</tr>
</table>';

$pdf->WriteHTML($html);
//$pdf->Output();
//$pdf->Output('I', $dnld_f_name); //I: Show only
$pdf->Output('D', $dnld_f_name); //D: Force download


?>