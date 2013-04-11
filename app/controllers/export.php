<?php

class App_Controllers_Export extends Library_Controller {

	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		redirect('/');
	}
	
	public function xml() {
		$entries = parent::loadModel('Entries')->getAllEntries();
		
		$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><guestbookEntries></guestbookEntries>');
		foreach ($entries as $entry) {
			$txml = $xml->addChild('entry');
			$txml->addAttribute('id', $entry->ID);
			$txml->addAttribute('status', $entry->Status);
			$txml->addChild('date', $entry->Date);
			$txml->addChild('name', $entry->Name);
			$txml->addChild('email', $entry->EMail);
			$txml->addChild('url', $entry->Website);
			$txml->addChild('valudation', $entry->Valuation);
			$txml->addChild('comment', htmlentities($entry->Message));
		}
		$this->view->xml = $xml->asXML();
		
		$this->view->renderView('export' . DS . 'xml', false);
	}
	
	
	public function img($year = 0) {
		$year = ($year === 0) ? date('Y') : $year;
		
		(array) $entries = parent::loadModel('Entries')->getAllEntriesFomeTheYear($year, 'Date', 'ASC');
		
		$months = array('Jan', 'Feb', 'M&#228;r', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez');
		$countMonts = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
		$countAll = 0;
		
		foreach ($entries as $entry) {
			$month = date('n', strtotime($entry->Date));
			$countMonts[$month-1]++;
			$countAll++;
		}
		
		/* Create and populate the pData object */ 
		$MyData = new pData();
		
		$MyData->addPoints($countMonts, 'Anzahl der G&#228;stebuch-Eintr&#228;ge');
		$MyData->setAxisName(0, 'Neuen G&#228;stebuch-Eintr&#228;ge');
		
		$MyData->setSerieWeight('Anzahl der G&#228;stebuch-Eintr&#228;ge', 2); 
		
		$MyData->addPoints($months, 'Monate');
		$MyData->setAbscissa('Monate');


		/* Create the pChart object */ 
		$myPicture = new pImage(800, 280, $MyData); 

		/* Add a border to the picture */ 
		$myPicture->drawRectangle(0,0,799,279,array('R' => 0, 'G' => 0, 'B' => 0)); 

		/* Write the chart title */  
		$myPicture->setFontProperties(array('FontName' => 'public' . DS . 'fonts' . DS  . 'helveticaneuemedium.ttf', 'FontSize' => 11)); 
		
		$myPicture->drawText(228, 43, 'Neue G&#228;stebuch-Eintr&#228;ge in ' . $year, array('FontSize' => 20, 'Align' => TEXT_ALIGN_BOTTOMMIDDLE)); 

		/* Set the default font */ 
		$myPicture->setFontProperties(array('FontName' => 'public' . DS . 'fonts' . DS  . 'helveticaneuemedium.ttf', 'FontSize' => 10)); 

		/* Define the chart area */ 
		$myPicture->setGraphArea(60, 50, 780, 250); 

		/* Draw the scale */ 
		$scaleSettings = array('XMargin' => 10, 'YMargin' => 10, 'Floating' => TRUE, 'GridR' => 200, 'GridG' => 200, 'GridB' => 200, 'DrawSubTicks' => TRUE, 'CycleBackground' => TRUE); 
		$myPicture->drawScale($scaleSettings);

		/* Draw the line chart */ 
		$myPicture->drawLineChart();
		$myPicture->drawPlotChart(array("DisplayValues"=>TRUE,"PlotBorder"=>TRUE,"BorderSize"=>2,"Surrounding"=>-60,"BorderAlpha"=>80));

		/* Write the chart legend */ 
		$myPicture->drawLegend(550, 37, array('Style'=>LEGEND_NOBORDER, 'Mode'=>LEGEND_HORIZONTAL)); 

		/* Render the picture (choose the best way) */ 
		$myPicture->autoOutput(); 
	}
	
	
	public function pdf() {
		$entries = parent::loadModel('Entries')->getAllEntries();
		
		require_once ROOT . DS . 'config' . DS . 'tcppdf_config.php';
		
		//var_dump('$pdf');
		$pdf = new TCPDF ('P', 'mm', 'A4', true, 'UTF-8', false);
		
		// set document information
		$pdf->SetCreator('TCPDF');
		$pdf->SetAuthor('Florian Rusch');
		$pdf->SetTitle('Gästebuch System');
		$pdf->SetSubject('Ein XML-Projekt von Florian Rusch (IT10B)');
		$pdf->SetKeywords('Gästebuch, System, XML, Florian, Rusch, IT10B');

		// set default header data
		$pdf->SetHeaderData(null, 0, 'Gästebuch System', 'by Florian Rusch (IT10B)', array(0,0,0), array(0,0,0));
		$pdf->setFooterData($tc=array(0,0,0), $lc=array(0,0,0));

		// set header and footer fonts
		$pdf->setHeaderFont(Array('helvetica', '', 10));
		$pdf->setFooterFont(Array('helvetica', '', 8));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont('courier');

		//set margins
		$pdf->SetMargins(15, 27, 15);
		$pdf->SetHeaderMargin(10);
		$pdf->SetFooterMargin(10);

		//set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, 25);

		//set image scale factor
		$pdf->setImageScale(1.25);

		//set some language-dependent strings
		$pdf->setLanguageArray($l);

		// ---------------------------------------------------------

		// set default font subsetting mode
		$pdf->setFontSubsetting(true);

		// Set font
		// dejavusans is a UTF-8 Unicode font, if you only need to
		// print standard ASCII chars, you can use core fonts like
		// helvetica or times to reduce file size.
		$pdf->SetFont('dejavusans', '', 14, '', true);

		// Add a page
		// This method has several options, check the source code documentation for more information.
		$pdf->AddPage();

		// set text shadow effect
		//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

		// Set some content to print
		$html = '<h1>Gästebuch Einträge</h1>';
		$html .= '<div style="font-size:12px; padding-top: 20px;">';
			$html .= '<hr />';

			foreach ($entries as $entry) {
				if ($entry->Status == 1) {

					$html .= '<b>Name:</b> ';
					if (!empty($entry->Website)) {
						$html .= '<a href="http://' . $entry->Website . '">' . $entry->Name . '</a>';
					} else {
						$html .= $entry->Name;
					}
					$html .= '<br />';

					$html .= '<b>Datum:</b> ' . $entry->Date . '<br />';
					$html .= '<b>Bewertung:</b> ' . ($entry->Valuation+1) . '<br />';

					$html .= '<b>Beitrag:</b><br />';
					$html .= $entry->Message;
					$html .= '<br /><br /><hr />';
				}
			}
		$html .= '</div>';
		
		// Print text using writeHTMLCell()
		$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);

		// ---------------------------------------------------------

		// Close and output PDF document
		// This method has several options, check the source code documentation for more information.
		$pdf->Output('gaestebuch-eintraege.pdf', 'I');
	}
}

?>