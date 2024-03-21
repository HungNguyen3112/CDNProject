<?php
 interface IPostServices {

   public function GetPostDetailsById(int $id, $isCount = false);

   public function GetPostsByQuery($topics = [], $currentPosts = [], $page = 1, $results_per_page = 3);

   public function GetDataDashboard ();

   public function GetDataResponse($status = 200, $data = [], $error = null);
 }
?>