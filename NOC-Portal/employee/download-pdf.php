  

<?php 
  error_reporting(0);
    $page = 'view-record.php';
    $title = 'View Record | NOC Portal';
    $description = 'Clearance Certificate Portal - NOC App';
	$keywords = '';

	// Include Login Parse File
    include('../partials/parseCreateRequest.php'); 

	// Include ParseProfle page
    include_once('../partials/parseProfile.php');

    include('../include/seven/sev/mpdf.php');

    include('session-restrict-emplooyee.php');


    

	// redirect user to login page if they're not logged in
	// if (empty($_SESSION['id'] || isCookieValid($db))) {
	// 	if($_SESSION['role'] === '0'){
	// 		header('location: ../login.php');
	// 		die;
	// 	}
	// }
	guard();
?>


<?php

     $id = $_GET['id'];
     $sql = "SELECT * FROM request WHERE req_id = '$id' AND type = 'Approved'";
     $stmt = $db->prepare($sql);
     $stmt->execute();

     $result = $stmt->fetchAll();
     foreach($result as $row) 
      
      {                    
        $html = '<!doctype html>
        <html lang="en">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <title>Clearance Certificate</title>
            </head>
            <body style="font-size:11px;line-height: 140%;"> 
                <header><div class="container">
        <div class="brand text-center" style="width: 15%;
        height: 5%;padding-left:40%" >
            <img src="../EXTRA FILES/aai.png" alt="AAI logo"  class="logo-header" style="">
            <p>
                
                <span class="english">Airports Authority of India</span>
            </p>
        </div>

        <div class="heading text-center">
            <h4 class="title" style="padding-left:36%" >CLEARANCE CERTIFICATE</h4>
            <p><b>Application for obtaining Clearance Certificate on account of Superannuation/Transfer</b></p>
        </div>
    </div>
</header>

<main>
    <div class="container mt-6">
        <p class="text-center">I, request you to kindly issue me clearance certificate on account of my <span class="underline">Transfer/Superannuation</span></p>

        <div class="row">
            <div class="col-6">
                <p class="text-left">Vide lettr No: <span class="underline">'.$row['letter_no'].'</span></p>
            </div>

            <div class="col-6">
                <p class="text-right">Dated: <span class="underline">'.$row['updated_at'].'</span></p>
            </div>
        </div>
    </div>
    
    <section>
        <div class="container">
            <p>My particulars are submitted as under, I declared that nothing is outstanding against me.</p>
            
            <div class="row">
                <!-- 1 Field -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-2">
                          <p>Employee No.: <span class="underline">78787</span></p>
                        </div>
                    </div>
                </div>

                <!-- 2 Field -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-2">
                          <p>Name  : <span class="underline">'.$row['name'].'</span></p>
                        </div>
                        <div class="col-10 text-left">
                        </div>
                    </div>
                </div>

                <!-- 3 Field -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-2">
                          <p>Designation : <span class="underline">'.$row['designation'].'</span></p> 
                        </div>
                        <div class="col-10 text-left">
                        </div>
                    </div>
                </div>

                <!-- 4 Field -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-2">
                          <p>Deptt./Section  : <span class="underline">'.$row['department'].'</span></p>
                        </div>
                    </div>
                </div>

                <!-- 5 Field -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-2">
                          <p>Station   : <span class="underline">RHQ ER</span></p>
                        </div>
                    </div>
                </div>

                <!-- 5 Field -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-2">
                          <p>Signature : <span class="underline">'.$row['name'].'</span></p>
                        </div>
                        <div class="col-10 text-left">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data -->
            <div class="table-responsive assits-table mt-4">
                <table class="table table-bordered border-top mb-0" style="width:100%;">
                    <thead>
                        <tr class="text-center">
                            <th>Sl.</th>
                            <th>Deptt./Section</th>
                            <th>Details of Outstanding</th>
                            <th>* Certifying Authority</th>
                            <th>Signature with Office Stamp</th>
                        </tr>
                    </thead>
  
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                <span class="underline">Outstanding dues</span>: <br>
                                - Car advance <br>
                                - HBA (House Building) <br>
                                - Any other.
                            </td>
                            <td></td>
                            <td class="text-center">cash Section</td>
                            <td class="text-center">
                                Authority Name <br>
                                Designation <Br>
                                Date of Approval <br>
                                <small>Generated through Clearance Portal</small>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Return of Airport Entry Pass</td>
                            <td></td>
                            <td class="text-center">Security Section</td>
                            <td class="text-center">
                                Authority Name <br>
                                Designation <Br>
                                Date of Approval <br>
                                <small>Generated through Clearance Portal</small>
                            </td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>Return of Medical Card</td>
                            <td></td>
                            <td class="text-center">HRM Deptt.</td>
                            <td class="text-center">
                                Authority Name <br>
                                Designation <Br>
                                Date of Approval <br>
                                <small>Generated through Clearance Portal</small>
                            </td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td>AAI Library</td>
                            <td></td>
                            <td class="text-center">Official Language <br> in-Charge</td>
                            <td class="text-center">
                                Authority Name <br>
                                Designation <Br>
                                Date of Approval <br>
                                <small>Generated through Clearance Portal</small>
                            </td>
                        </tr>

                        <tr>
                            <td>5</td>
                            <td>
                                <span class="underline">Return of stationery</span>: <br>
                                - Key to the drawers <br>
                                - Confidential boxes, Almirah
                            </td>
                            <td></td>
                            <td class="text-center">Superior Officers, whom She/he report</td>
                            <td class="text-center">
                                Authority Name <br>
                                Designation <Br>
                                Date of Approval <br>
                                <small>Generated through Clearance Portal</small>
                            </td>
                        </tr>

                        <tr>
                            <td>6</td>
                            <td>
                                <span class="underline">Return of</span>: <br>
                                - Telephone inst. <br>
                                - Mobile Phones
                            </td>
                            <td></td>
                            <td class="text-center">Communication (Ops.)</td>
                            <td class="text-center">
                                Authority Name <br>
                                Designation <Br>
                                Date of Approval <br>
                                <small>Generated through Clearance Portal</small>
                            </td>
                        </tr>

                        <tr>
                            <td>7</td>
                            <td>
                                <span class="underline">Return of Computer accessories</span>: <br>
                                - Key to the drawers <br>
                                - confidential boxes, Almirah
                            </td>
                            <td></td>
                            <td class="text-center">IT Deptt.</td>
                            <td class="text-center">
                                Authority Name <br>
                                Designation <Br>
                                Date of Approval <br>
                                <small>Generated through Clearance Portal</small>
                            </td>
                        </tr>

                        <tr>
                            <td>8</td>
                            <td>
                                <span class="underline">Handover of</span>: <br>
                                - Company Accommodation <br>
                                - EMC
                            </td>
                            <td></td>
                            <td class="text-center">E & R Section</td>
                            <td class="text-center">
                                Authority Name <br>
                                Designation <Br>
                                Date of Approval <br>
                                <small>Generated through Clearance Portal</small>
                            </td>
                        </tr>

                        <tr>
                            <td>9</td>
                            <td>Return of ICAO documents taken from AIS Section</td>
                            <td></td>
                            <td class="text-center">AIS Section / ATM Deptt.</td>
                            <td class="text-center">
                                Authority Name <br>
                                Designation <Br>
                                Date of Approval <br>
                                <small>Generated through Clearance Portal</small>
                            </td>
                        </tr>

                        <tr>
                            <td>10</td>
                            <td>Return of drawing instruments</td>
                            <td></td>
                            <td class="text-center">Chief Draughtsman</td>
                            <td class="text-center">
                                Authority Name <br>
                                Designation <Br>
                                Date of Approval <br>
                                <small>Generated through Clearance Portal</small>
                            </td>
                        </tr>

                        <tr>
                            <td>11</td>
                            <td>Engg. Library</td>
                            <td></td>
                            <td class="text-center">Engg. Section</td>
                            <td class="text-center">
                                Authority Name <br>
                                Designation <Br>
                                Date of Approval <br>
                                <small>Generated through Clearance Portal</small>
                            </td>
                        </tr>

                        <tr>
                            <td>12</td>
                            <td>Theft & Credit Society</td>
                            <td></td>
                            <td class="text-center"></td>
                            <td class="text-center">
                                Authority Name <br>
                                Designation <Br>
                                Date of Approval <br>
                                <small>Generated through Clearance Portal</small>
                            </td>
                        </tr>

                        <tr>
                            <td>13</td>
                            <td>Submission of PRA Report for subordinate Official for the current year</td>
                            <td></td>
                            <td class="text-center">PAR Section/next in-Charge</td>
                            <td class="text-center">
                                Authority Name <br>
                                Designation <Br>
                                Date of Approval <br>
                                <small>Generated through Clearance Portal</small>
                            </td>
                        </tr>

                        <tr>
                            <td>14</td>
                            <td>Completion of PAR/PMS for Staff (Online/Offline)</td>
                            <td></td>
                            <td class="text-center">Self Certificate</td>
                            <td class="text-center">
                                Authority Name <br>
                                Designation <Br>
                                Date of Approval <br>
                                <small>Generated through Clearance Portal</small>
                            </td>
                        </tr>

                        <tr>
                            <td>15</td>
                            <td>Any other Deptt./Section</td>
                            <td></td>
                            <td class="text-center"></td>
                            <td class="text-center">
                                Employee Name <br>
                                <small>Generated through Clearance Portal</small>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="text-center mt-4">
              <p>* The list of Clearance to be obtained by the employee is only indicative any may add / after any of the section / Deptt. as per requirement of the Region / Airport / Establishment.</p>

              <p>Sri / Smt. / Ku. <span class="underline">'.$row['name'].'</span> having obtained clearance from all concerned, the dues on retirement may be realeased <span class="underline">Released Date</span></p>
            </div>
        </div>
    </section>
</main>

<table style="width:100%;font-size:12px;">
  
  <tr>
    <td style="font-size:17px;">Dated :</td>
    <td style="padding-left:340px;font-size:17px;">Signature :</td>
    <td style="font-size:17px;"></td>
  </tr>
  br
  <tr>
    <td style="font-size:17px;">Place:</td>
    <td style="padding-left:340px;font-size:17px;">Name:</td>
    <td style="font-size:17px;"></td>
  </tr>
  <tr>
    <td style="font-size:17px;"></td>
    <td style="padding-left:340px;font-size:17px;">Deptt.</td>
    <td style="font-size:17px;"></td>
  </tr>
</table>



</body>
</html>';
        } 
 
    $html .= '</tbody></table>';
	$mpdf = new mPDF();
	$mpdf->WriteHTML($html);

	//call watermark content aand image
	$mpdf->SetWatermarkText('MIX BLACK PDF');
	$mpdf->showWatermarkText = true;
	$mpdf->watermarkTextAlpha = 0.3;


	//save the file put which location you need folder/filname
	$mpdf->Output("../PDF/mixblack-employee.pdf", 'F');


	//out put in browser below output function
	$mpdf->Output();


    

?>
