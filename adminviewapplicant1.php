<?php
include 'db/server.php';

	
	if(isset($_POST['deny'])){
    $remarks1 = $_POST['remarks1'];
    //$connect = mysqli_connect("localhost", "d0l310_aep", "d0l310_aep", "d0l310_aep");
    $connect = mysqli_connect("localhost", "root", "", "d0l310_aep");
	$select_query = "SELECT user_status,status_id,aep_user_status.tin,aep_number,remarks,date_created,date_approved FROM `aep_user_status` JOIN aep_user_details on aep_user_status.tin = aep_user_details.tin WHERE aep_user_status.tin = '".$_POST["tin"]."'";
	$results = mysqli_query($connect,$select_query);
		while($row = mysqli_fetch_assoc($results)){
        $status_id  = $row['status_id'];
        $tin = $row['tin'];
        $aep_number = $row['aep_number'];
        $user_status = $row['user_status'];
        $remarks = $row['remarks'];
        $date_created = $row['date_created'];
        $date_approved = $row['date_approved'];
        date_default_timezone_set("Asia/Manila");
		}
		$query = $connect->query("UPDATE `aep_user_status` SET
        remarks = '" . $remarks1 . "',
        date_approved = '".date("Y-m-d h:i:sa")."' WHERE tin ='".$tin."'") or die($connect->error);
        $query1 = $connect->query("UPDATE `aep_user_details` SET
        user_status = 'DENIED' WHERE tin ='" . $tin . "'") or die($connect->error);; 
}


if(isset($_POST['approved'])){
    $tin = $_POST['tin'];
    $aep = $_POST['aep'];
    $remarks1 = $_POST['remarks1'];
    //$connect = mysqli_connect("localhost", "d0l310_aep", "d0l310_aep", "d0l310_aep");  
    $connect = mysqli_connect("localhost", "root", "", "d0l310_aep");
	$select_query = "SELECT user_status,status_id,aep_user_status.tin,aep_number,remarks,date_created,date_approved FROM `aep_user_status` JOIN aep_user_details on aep_user_status.tin = aep_user_details.tin WHERE aep_user_status.tin = '" . $_POST["tin"] . "'";
	$results = mysqli_query($connect,$select_query);
		while($row = mysqli_fetch_assoc($results)){
        $status_id  = $row['status_id'];
        $tin = $row['tin'];
        $aep_number = $row['aep_number'];
        $user_status = $row['user_status'];
        $remarks = $row['remarks'];
        $date_created = $row['date_created'];
        $date_approved = $row['date_approved'];
		date_default_timezone_set("Asia/Manila");
		}
		$query = $connect->query("UPDATE `aep_user_status` SET	
                aep_number = '".$aep."',
                remarks = '" . $remarks1 . "',
                date_approved = '".date("Y-m-d h:i:sa")."' WHERE tin ='".$tin."';") or die($connect->error);
        $query1 = $connect->query("UPDATE `aep_user_details` SET
        user_status = 'APPROVED' WHERE tin ='" . $tin . "'") or die($connect->error);;;
}

if(isset($_POST['foreval'])){
    $tin = $_POST['tin'];
    $remarks1 = $_POST['remarks1'];
    $connect = mysqli_connect("localhost", "d0l310_aep", "d0l310_aep", "d0l310_aep");  
	$select_query = "SELECT user_status,status_id,aep_user_status.tin,aep_number,remarks,date_created,date_approved FROM `aep_user_status` JOIN aep_user_details on aep_user_status.tin = aep_user_details.tin WHERE aep_user_status.tin = '" . $_POST["tin"] . "'";
	$results = mysqli_query($connect,$select_query);
		while($row = mysqli_fetch_assoc($results)){
        $status_id  = $row['status_id'];
        $tin = $row['tin'];
        $aep_number = $row['aep_number'];
        $user_status = $row['user_status'];
        $remarks = $row['remarks'];
        $date_created = $row['date_created'];
        $date_approved = $row['date_approved'];
		date_default_timezone_set("Asia/Manila");
		}
        $query = $connect->query("UPDATE `aep_user_status` SET remarks = '".$remarks1."' WHERE tin ='".$tin."';") or die($connect->error);
        $query1 = $connect->query("UPDATE `aep_user_details` SET
       user_status = 'FOR EVALUATION' WHERE tin ='" . $tin . "'") or die($connect->error);; ;
        
    }
    
if (isset($_POST['remarksa'])) {
    $tin = $_POST['tin'];
    $remarks1 = $_POST['remarks1'];
    $connect = mysqli_connect("localhost", "d0l310_aep", "d0l310_aep", "d0l310_aep");
    $select_query = "SELECT user_status,status_id,aep_user_status.tin,aep_number,remarks,date_created,date_approved FROM `aep_user_status` JOIN aep_user_details on aep_user_status.tin = aep_user_details.tin WHERE aep_user_status.tin = '" . $_POST["tin"] . "'";
    $results = mysqli_query($connect, $select_query);
    while ($row = mysqli_fetch_assoc($results)) {
        $status_id  = $row['status_id'];
        $tin = $row['tin'];
        $aep_number = $row['aep_number'];
        $user_status = $row['user_status'];
        $remarks = $row['remarks'];
        $date_created = $row['date_created'];
        $date_approved = $row['date_approved'];
        date_default_timezone_set("Asia/Manila");
    }
    $query = $connect->query("UPDATE `aep_user_status` SET remarks = '" . $remarks1 . "' WHERE tin ='" . $tin . "';") or die($connect->error);;
}

    


/*if (isset($_POST['view'])) {


    $tin1 = $_POST['tin1'];

    $connect = mysqli_connect("localhost", "d0l310_aep", "", "d0l310_aep");
    $viewquery = "SELECT * FROM `aep_user_details` JOIN aep_user_details_2 ON aep_user_details.tin = aep_user_details_2.tin JOIN aep_user_details_3 ON aep_user_details_2.tin = aep_user_details_3.tin JOIN aep_user_employment on aep_user_details_3.tin = aep_user_employment.tin JOIN aep_user_status ON aep_user_status.tin = aep_user_employment.tin WHERE aep_user_details.tin = '".$tin1."'";
    $viewresults = mysqli_query($connect, $viewquery);

    while ($row = mysqli_fetch_assoc($viewresults)) {

        $_SESSION["tin"] = $row["tin"];
        $_SESSION["fname"] = $row["fname"];
        $_SESSION["mname"] = $row["mname"];
        $_SESSION["lname"] = $row["lname"];
        $_SESSION["nationality"] = $row["nationality"];
        $_SESSION["gender"] = $row["gender"];
        $_SESSION["tin"] = $row["tin"];
        $_SESSION["b_date"] = $row["b_date"];
        $_SESSION["place_of_birth"] = $row["place_of_birth"];
        $_SESSION["application_type"] = $row["application_type"];
        $_SESSION["passport_no"] = $row["passport_no"];
        $_SESSION["place_issuance"] = $row["place_issuance"];
        $_SESSION["date_issuance"] = $row["date_issuance"];
        $_SESSION["expiration_date"] = $row["expiration_date"];
        $_SESSION["visa"] = $row["visa"];
        $_SESSION["visa_validity"] = $row["visa_validity"];
        $_SESSION["highest_educ"] = $row["highest_educ"];
        $_SESSION["course"] = $row["course"];
        $_SESSION["address_ph"] = $row["address_ph"];
        $_SESSION["contact_no"] = $row["contact_no"];
        $_SESSION["email_add"] = $row["contact_no"];
        $_SESSION["permanent_add_abroad"] = $row["permanent_add_abroad"];
        $_SESSION["position"] = $row["position"];
        $_SESSION["assignment"] = $row["assignment"];
        $_SESSION["name_of_company"] = $row["name_of_company"];
        $_SESSION["company_address"] = $row["company_address"];
        $_SESSION["company_contact"] = $row["company_contact"];
        $_SESSION["company_email"] = $row["company_email"];
        $_SESSION["nature"] = $row["nature"];
        $_SESSION["aep_number"] = $row["aep_number"];
        $_SESSION["user_status"] = $row["user_status"];
        $_SESSION["date_created"] = $row["date_created"];
        $_SESSION["date_approved"] = $row["date_approved"];
        



        # code...
    }

    //echo $_SESSION['tin';

    header("Location:adminviewapplicant.php");
    exit;
}*/
