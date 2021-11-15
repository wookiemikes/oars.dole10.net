<?php
session_start();
//$connect = mysqli_connect("localhost", "d0l310_aep", "d0l310_aep", "d0l310_aep");
$connect = mysqli_connect("localhost", "root", "", "d0l310_aep");


$columns = array('user_det_id','fname','mname','lname','nationality', 'company_id', 'user_status','tin');

$query = "SELECT * FROM `aep_user_details` where company_id = '".$_SESSION['company_id']."' ";

if (isset($_POST["search"]["value"])) {
    $query .= '
    AND user_status = "PENDING"
    OR user_status = "FOR EVALUATION"
    AND ( user_det_id  = "%' . $_POST["search"]["value"] . '%"
	OR fname LIKE "%' . $_POST["search"]["value"] . '%" 
    OR mname LIKE "%' . $_POST["search"]["value"] . '%" 
    OR lname LIKE "%' . $_POST["search"]["value"] . '%" 
    OR nationality LIKE "%' . $_POST["search"]["value"] . '%" )
	';
}

if (isset($_POST["order"])) {
    $query .= 'ORDER BY ' . $columns[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . '';
} else {
    $query .= 'ORDER BY company_id DESC ';
}

$query1 = '';

if ($_POST["length"] != -1) {
    $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while ($row = mysqli_fetch_array($result)) {

    $sub_array = array();
    $sub_array[] = $row["fname"] . $row["mname"] . $row["lname"];
    $sub_array[] = $row["nationality"];
    $sub_array[] = $row["application_type"];
    $sub_array[] = $row["user_status"];
    $sub_array[] = "<form action='dashboardviewapplicant.php' method='POST'>
                      <input type='hidden' name='id_comp' value='" . $row["id_comp"] . "'>
                      <input type='hidden' name='company_id' value='" . $row["company_id"] . "'>
					  <input type='submit' class ='btn btn-sm btn-info btn-block' name ='view' id = 'submit' value ='VIEW (?)'>
					</form> ";
    $data[] = $sub_array;
}
function get_all_data($connect)
{
    $query = "SELECT * FROM aep_user_details WHERE company_id ='" . $_SESSION['company_id'] . "' ";
    $result = mysqli_query($connect, $query);
    return mysqli_num_rows($result);
}

$output = array(
    "draw"    => intval($_POST["draw"]),
    "recordsTotal"  =>  get_all_data($connect),
    "recordsFiltered" => $number_filter_row,
    "data"    => $data
);

echo json_encode($output);
