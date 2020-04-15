
<?php 

$page = 'approved-request.php';
    $title = 'Approved Request | NOC Portal';
    $description = 'Clearance Certificate Portal - NOC App';
	$keywords = '';
 
	// Include ParseProfle page
    include_once('../partials/parseProfile.php');
    include('../include/seven/sev/mpdf.php');
    
 
	include('session-restrict-hod.php');

 
   guard();
?>


<?php
 $user_id=$_SESSION['id'];
 $id = $_GET['id'];
 $sql = "SELECT *,tracker.status as tracker_status FROM tracker INNER JOIN request on tracker.req_id = request.req_id WHERE tracker.tr_id = $id AND tracker.hod_id = $user_id AND tracker.status = 'Approved'";
 $stmt = $db->prepare($sql);
 $stmt->execute();

 $result = $stmt->fetchAll();
 foreach($result as $row) 
 
  {                    
    $html = '<table style="border:1px solid black;font-size:103px;font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 80%;">
    <tr>
    <td style="border:1px solid black;font-size:13px;">Status</td>
    <td style="border:1px solid black;font-size:13px;" class="pdf_border">'.$row['tracker_status'].'</td> 
    </tr>  


    


    <tr>
    <td style="border:1px solid black;font-size:13px;">REQUEST FOR</td>
    <td style="border:1px solid black;font-size:13px;" class="pdf_border">'.$row['purpose'].'</td> 
    </tr> 


    <tr>
    <td style="border:1px solid black;font-size:13px;">TRANSFER LETTER NO.	</td>
    <td style="border:1px solid black;font-size:13px;" class="pdf_border">'.$row['letter_no'].'</td> 
    </tr> 


    <tr>
    <td style="border:1px solid black;font-size:13px;">TRANSFER LETTER DATE	</td>
    <td style="border:1px solid black;font-size:13px;" class="pdf_border">'.$row['letter_date'].'</td> 
    </tr> 



    <tr>
    <td style="border:1px solid black;font-size:13px;">TRANSFER DUE DATE	</td>
    <td style="border:1px solid black;font-size:13px;" class="pdf_border">'.$row['due_date'].'</td> 
    </tr> 



    <tr>
    <td style="border:1px solid black;font-size:13px;">EMPLOYEE NO.	</td>
    <td style="border:1px solid black;font-size:13px;" class="pdf_border">'.$row['emp_no'].'</td> 
    </tr> 


    <tr>
    <td style="border:1px solid black;font-size:13px;">NAME</td>
    <td style="border:1px solid black;font-size:13px;" class="pdf_border">'.$row['name'].'</td> 
    </tr> 


    <tr>
    <td style="border:1px solid black;font-size:13px;">DESIGNATION</td>
    <td style="border:1px solid black;font-size:13px;" class="pdf_border">'.$row['designation'].'</td> 
    </tr> 


    <tr>
    <td style="border:1px solid black;font-size:13px;">DEPARTMENT/SECTION	</td>
    <td style="border:1px solid black;font-size:13px;" class="pdf_border">'.$row['department'].'</td> 
    </tr> 

    <tr>
    <td style="border:1px solid black;font-size:13px;">EMAIL ID	</td>
    <td style="border:1px solid black;font-size:13px;" class="pdf_border">'.$row['email'].'</td> 
    </tr> 

    <tr>
    <td style="border:1px solid black;font-size:13px;">MOBILE NO.	</td>
    <td style="border:1px solid black;font-size:13px;" class="pdf_border">'.$row['phone'].'</td> 
    </tr> 

    <tr>
    <td style="border:1px solid black;font-size:13px;">REPORTING OFFICE NAME	</td>
    <td style="border:1px solid black;font-size:13px;" class="pdf_border">'.$row['rep_name'].'</td> 
    </tr> 
    
    <tr>
    <td style="border:1px solid black;font-size:13px;">REPORTING OFFICE DESIGNATION	</td>
    <td style="border:1px solid black;font-size:13px;" class="pdf_border">'.$row['rep_designation'].'</td> 
    </tr> 

    <tr>
    <td style="border:1px solid black;font-size:13px;">REPORTING OFFICE EMAIL ID</td>
    <td style="border:1px solid black;font-size:13px;" class="pdf_border">'.$row['rep_email'].'</td> 
    </tr> 

    <tr>
    <td style="border:1px solid black;font-size:13px;">REPORTING OFFICE MOBILE NO.	</td>
    <td style="border:1px solid black;font-size:13px;" class="pdf_border">'.$row['rep_phone'].'</td> 
    </tr> 
    
   ';
    } 

$html .= '</tbody></table>';
$mpdf = new mPDF();
$mpdf->WriteHTML($html);

//call watermark content aand image
$mpdf->SetWatermarkText('MIX BLACK PDF');
$mpdf->showWatermarkText = true;
$mpdf->watermarkTextAlpha = 0.3;


//save the file put which location you need folder/filname
$mpdf->Output("../PDF/mixblack-hod.pdf", 'F');


//out put in browser below output function
$mpdf->Output();


?>
