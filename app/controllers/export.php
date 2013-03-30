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
			$txml->addChild('comment', $entry->Message);
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
		$myPicture->setFontProperties(array('FontName' => 'public/fonts/HelveticaNeue-Medium.ttf', 'FontSize' => 11)); 
		$myPicture->drawText(228, 43, 'Neue G&#228;stebuch-Eintr&#228;ge in ' . $year, array('FontSize' => 20, 'Align' => TEXT_ALIGN_BOTTOMMIDDLE)); 

		/* Set the default font */ 
		$myPicture->setFontProperties(array('FontName' => 'public/fonts/HelveticaNeue-Medium.ttf', 'FontSize' => 10)); 

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
}

?>