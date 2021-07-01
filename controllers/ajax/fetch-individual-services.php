<?php 
		require_once('init.php');
	require_once('../classes/service.class.php');


	$limit = $_POST['limit'];
	$page = $_POST['page'];
	$id = $_POST['id'];



	if(empty($limit) || empty($page)){
		$status = array('status' => 'error' );
		echo json_encode($status);
		die();
	}

	$service = new Service;
	// $service->displayIndividualDetails($id, $limit, $page);

    $service->fetchAllIndividualDetails($id);

	$individual_details = $service->displayIndividualDetails($id, $limit, $page);
	$status = array('status' => 'success', 'data' => $individual_details , 'total' => $service->individual_services->rowCount());
	echo json_encode($status);

?>