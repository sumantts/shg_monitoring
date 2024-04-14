<?php
#https://www.geeksforgeeks.org/how-to-create-a-table-in-pdf-file-from-external-text-files-using-php/

require('fpdf.php');

class PDF extends FPDF {
    var $B=0;
    var $I=0;
    var $U=0;
    var $HREF='';
    var $ALIGN='';

	// Get data from the text file
	function getDataFrmFile($file) {

		// Read file lines
		$lines = file($file);
	
		// Get a array for returning output data
		$data = array();
	
		// Read each line and separate the semicolons
		foreach($lines as $line)
			$data[] = explode(';', chop($line));
		return $data;
	}

	// Simple table
	function getSimpleTable($header, $data) {
	
		// Header
		foreach($header as $column)
			$this->Cell(40, 8, $column, 1);
		$this->Ln(); // Set current position
	
		// Data
        //echo json_encode($data);

		foreach($data as $row) {
			foreach($row as $col)
				$this->Cell(40, 6, $col, 1);
			$this->Ln(); // Set current position
		}
	}

	// Get styled table
	function getStyledTable($header, $data) {
	
		// Colors, line width and bold font
		$this->SetFillColor(255, 0, 0);
		$this->SetTextColor(255);
		$this->SetDrawColor(128, 0, 0);
		$this->SetLineWidth(.3);
		$this->SetFont('', 'B');
	
		// Header
		$colWidth = array(40, 35, 40, 45);
		for($i = 0; $i < count($header); $i++)
			$this->Cell($colWidth[$i], 7, 
						$header[$i], 1, 0, 'C', 1);
		$this->Ln();
	
		// Setting text color and color fill
		// for the background
		$this->SetFillColor(224, 235, 255);
		$this->SetTextColor(0);
		$this->SetFont('');
	
		// Data
		$fill = 0;
		foreach($data as $row) {
		
			// Prints a cell, first 2 columns are left aligned
			$this->Cell($colWidth[0], 6, $row[0], 'LR', 0, 'L', $fill);
			$this->Cell($colWidth[1], 6, $row[1], 'LR', 0, 'L', $fill);
		
			// Prints a cell,last 2 columns are right aligned
			$this->Cell($colWidth[2], 6, number_format($row[2]), 
						'LR', 0, 'R', $fill);
			$this->Cell($colWidth[3], 6, number_format($row[3]), 
						'LR', 0, 'R', $fill);
			$this->Ln();
			$fill=!$fill;
		}
		$this->Cell(array_sum($colWidth), 0, '', 'T');
	}

    function WriteHTML($html)
    {
        //HTML parser
        $html=str_replace("\n",' ',$html);
        $a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e)
        {
            if($i%2==0)
            {
                //Text
                if($this->HREF)
                    $this->PutLink($this->HREF,$e);
                elseif($this->ALIGN=='center')
                    $this->Cell(0,5,$e,0,1,'C');
                else
                    $this->Write(5,$e);
            }
            else
            {
                //Tag
                if($e[0]=='/')
                    $this->CloseTag(strtoupper(substr($e,1)));
                else
                {
                    //Extract properties
                    $a2=explode(' ',$e);
                    $tag=strtoupper(array_shift($a2));
                    $prop=array();
                    foreach($a2 as $v)
                    {
                        if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                            $prop[strtoupper($a3[1])]=$a3[2];
                    }
                    $this->OpenTag($tag,$prop);
                }
            }
        }
    }
    function OpenTag($tag,$prop)
    {
        //Opening tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,true);
        if($tag=='A')
            $this->HREF=$prop['HREF'];
        if($tag=='BR')
            $this->Ln(5);
        if($tag=='P')
            $this->ALIGN=$prop['ALIGN'];
        if($tag=='HR')
        {
            if( !empty($prop['WIDTH']) )
                $Width = $prop['WIDTH'];
            else
                $Width = $this->w - $this->lMargin-$this->rMargin;
            $this->Ln(2);
            $x = $this->GetX();
            $y = $this->GetY();
            $this->SetLineWidth(0.4);
            $this->Line($x,$y,$x+$Width,$y);
            $this->SetLineWidth(0.2);
            $this->Ln(2);
        }
    }

    function CloseTag($tag)
    {
        //Closing tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,false);
        if($tag=='A')
            $this->HREF='';
        if($tag=='P')
            $this->ALIGN='';
    }

    function SetStyle($tag,$enable)
    {
        //Modify style and select corresponding font
        $this->$tag+=($enable ? 1 : -1);
        $style='';
        foreach(array('B','I','U') as $s)
            if($this->$s>0)
                $style.=$s;
        $this->SetFont('',$style);
    }

    function PutLink($URL,$txt)
    {
        //Put a hyperlink
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
    }
}//end class
	// Instantiate a PDF object
	$pdf = new PDF();

	// Column titles given by the programmer
	$header = array('Name','City','Age','Salary(In thousands)');

	// Get data from the text files
	$data = $pdf->getDataFrmFile('employees.txt');

	// Set the font as required
	$pdf->SetFont('Arial', '', 14);

    $table_html = '<table border="1">: <tr><th>First_Name</th><th>Last_Name</th><th>Marks</th></tr> <tr><td>Sonoo</td><td>Jaiswal</td><td>60</td></tr> <tr><td>James</td><td>William</td><td>80</td></tr> <tr><td>Swati</td><td>Sironi</td><td>82</td></tr> <tr><td>Chetna</td><td>Singh</td><td>72</td></tr> </table>';

	// Add a new page
	$pdf->AddPage();
	$pdf->getSimpleTable($header,$data);
	$pdf->AddPage();
	$pdf->getStyledTable($header,$data);
    $pdf->AddPage();
    $pdf->WriteHTML($table_html);
	$pdf->Output();
?>
