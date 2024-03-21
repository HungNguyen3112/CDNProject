<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

include_once( $base_dir ."services/postServices.php");

$action =  $_POST['action'];

$services = new PostServices();
$data = null;

switch ($action) {
  case 'getDetailsPost':
    if ($_POST['id']) $data = $services->GetPostDetailsById($_POST['id'], $_POST['isCount']);
    break;
  case 'getPostsByQuery':
    $data = $services->GetPostsByQuery($_POST['cats'], $_POST['currentPosts'], $_POST['page']);
    break;
  case 'getPostsDashboard':
    $data = $services->GetDataDashboard();
    break;
  default:
    $data = $services->GetDataResponse(400, [], 'Failed');
    break;
}

echo json_encode($data);
