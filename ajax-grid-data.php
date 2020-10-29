<?php

 include "funcs/conn.php";

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 => 'id',
    1 => 'nfactura', 
	2 => 'fechafactura',
	3 => 'fechaingreso',
    4 => 'nombre',
    5 => 'rut',  
    6 => 'nombre_admin',  
    7 => 'monto_iva'  
);

// getting total number records without any search
$sql = "SELECT id, nfactura, fechafactura, fechaingreso, nombre, rut, nombre_admin, monto_iva ";
$sql.=" FROM pmtfacturas";
$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT id, nfactura, fechafactura, fechaingreso, nombre, rut, nombre_admin, monto_iva ";
	$sql.=" FROM pmtfacturas";
	$sql.=" WHERE nfactura LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
	$sql.=" OR fechafactura LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR fechaingreso LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR nombre LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR rut LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR nombre_admin LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR monto_iva LIKE '".$requestData['search']['value']."%' ";
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO"); // again run query with limit
	
} else {	

	$sql = "SELECT id, nfactura, fechafactura, fechaingreso, nombre, rut, nombre_admin, monto_iva ";
	$sql.=" FROM pmtfacturas";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO");
	
}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	$nestedData[] = $row["id"];
    $nestedData[] = $row["nfactura"];
    $nestedData[] = date("d/m/Y", strtotime($row["fechafactura"]));
    $nestedData[] = date("d/m/Y", strtotime($row["fechaingreso"]));
    $nestedData[] = $row["nombre"];
    $nestedData[] = $row["rut"];
    $nestedData[] = $row["nombre_admin"];
    $nestedData[] = $row["monto_iva"];
    $nestedData[] = '';		
	
	$data[] = $nestedData;
    
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
