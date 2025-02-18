<?php
    require_once 'temp/vendor/autoload.php';  
    use Dompdf\Dompdf; 
    $dompdf = new Dompdf();

    // Load HTML content 
    // $dompdf->loadHtml('<h1>Welcome to niceshipest.com</h1>'); 
     
    // Load html file 
    //$html = file_get_contents("temp/index_new.html"); 
	
	$html = file_get_contents("monthly_bill_gen/testing_new.html"); 
//	echo $html;
    $dompdf->loadHtml($html); 
     
    $dompdf->setPaper('A4', 'landscape'); 
	//$dompdf->setPaper('A4', 'portrait'); 
    $dompdf->render(); 
    //$dompdf->stream("Monthly Bill", array("Attachment" => 0));
	$FileNameofPDF = 'testing_new';
	$FileLocationName = 'monthly_bill_gen/'.$FileNameofPDF.'.pdf';
	$dompdf->stream($FileNameofPDF.".pdf", array("Attachment" => true));
	$output = $dompdf->output();
	file_put_contents($FileLocationName, $output);
	
    /*file_put_contents($FileLocationName, $output);
	
	header('Content-type: application/pdf');
	header('Content-Disposition: inline; filename="file.pdf"');
	header('Content-Transfer-Encoding: binary');
	header('Content-Length: ' . filesize($FileLocationName));
	header('Accept-Ranges: bytes');
	readfile($FileLocationName);*/
?>