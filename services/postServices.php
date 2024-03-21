<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
include $base_dir . 'config/app.php';
include_once $base_dir . 'config/ExecuteQuery.php';
include_once $base_dir . 'model/Model.php';
$constants = require $base_dir . 'utils/CONSTANTS.php';

class PostServices
{
  private $_executeDb;

  public function __construct()
  {
    $db = new DatabaseConnection();
    $this->_executeDb = new ExecuteQuery($db->GetConnectionDB());
  }

  public function GetPostDetailsById(int $id, $isCount = false)
  {
    try {
    $sqlQuery = "SELECT * FROM posts Where Id = '" . $id . "'";

    $executeDb = $this->_executeDb;
 
    $result = $executeDb->execute($sqlQuery);

    if (!$result) return $this->GetDataResponse(400, [], 'Failed');
    
    $result = $result[0];

    // if ($isCount) {
    //   $views = $result['views'] + 1;
    //   $result['views'] = $views;
    //   $sqlUpdateViews = "UPDATE Posts set views = " . $views . " where id = " . $result['id'];

    //   $resultUpdate = $executeDb->execute($sqlUpdateViews, true);
    // }

    $postModel = new Post;
    $postModel->setContent($result['content']);
    $postModel->setPostDescription($result['description']);
    $postModel->setId($result['id']);
    $postModel->setPostSlug($result['slug']);
    $postModel->setPostTitle($result['title']);

    $dataFinal = $this->GetDataResponse(200, $postModel);
    return $dataFinal;

    } catch (\Throwable $th) {
      return $this->GetDataResponse(400, [],  $th->getMessage());
    }
  }

  public function GetPostsByQuery($topics = [], $currentPosts = [], $page = 1, $results_per_page = 3)
  {
    try {
      $executeDb = $this->_executeDb;

      $query = "SELECT %s from post_topic as pt 
                inner join topics as t on pt.topic_id = t.id
                inner join posts as p on pt.post_id = p.id";

      $whereClause = "";

      if (count($topics) > 0) {
        $whereClause .= " where t.id in (" . implode(",", $topics) . ")";
      }

      if (count($currentPosts) > 0) {
        $queryPosts = "p.id not in (" . implode(",", $currentPosts) . ")";
        $whereClause .= trim($whereClause) !== "" ? " and" . " " . $queryPosts : " where" . " " . $queryPosts;
      }

      if ($whereClause != '') {
        $query .= $whereClause;
      }

      //build query count post
      $totalPosts = $this->GetCountPosts($query, $executeDb);
      $totalPages = ceil($totalPosts / $results_per_page);

      //query select
      $querySelect = 't.id as topic_id, t.name as topic_name, t.slug as topic_slug, p.id as post_id, p.title as post_title, p.slug as post_slug, p.description as post_description, p.content as post_content';

      //query pagination
      $queryPagination = "limit " . $results_per_page . " offset " . ($page - 1) * $results_per_page;

      $query = str_replace('%s', $querySelect, $query);
      
      $query .= " " . $queryPagination;
    
      $data = $executeDb->execute($query);
  
      if (!$data) {
        return $this->GetDataResponse(400, [], 'Failed');
      } 

      $dataReturn = [
        'totalPosts' => $totalPosts,
        'totalPages' => $totalPages,
        'data' => $this->MapDataByTopic($data)
      ];

      $dataFinal = $this->GetDataResponse(200, $dataReturn);

      return $dataFinal;

    } catch (\Throwable $th) {
      return $this->GetDataResponse(400, [], $th->getMessage());
    }
    
  }

  public function GetDataDashboard () {
    try {
      $executeDb = $this->_executeDb;

      $query = "SELECT t.id as topic_id, t.name as topic_name, t.slug as topic_slug, p.id as post_id, p.title as post_title, p.slug as post_slug, p.description   as post_description, p.content as post_content from post_topic as pt 
      inner join topics as t on pt.topic_id = t.id
      inner join posts as p on pt.post_id = p.id";

      $result = $executeDb->execute($query);

      if (!$result) return $this->GetDataResponse(400, [], 'Failed');

      $resultMapping = $this->MapDataByTopic($result);
      
      $dataFinal = $this->GetDataResponse(200, $resultMapping);

      return $dataFinal;

    } catch (\Throwable $th) {
      return $this->GetDataResponse(400, [], $th->getMessage());
    }
  }

  #region private
  private function GetCountPosts($query = "", $sqlExecute) : int {
    $count = 0;
    if (empty($query)) return $count;

    $cloneQuery = $query;

    $cloneQuery = str_replace('%s', 'count(distinct p.id) as count', $cloneQuery);

    $res = $sqlExecute->execute($cloneQuery);
    
    if (!empty($res)) $count = $res[0]['count'];
    return $count;
  }

  private function MapDataByTopic($data) {
    if (empty($data)) return $data;
    $map = [];
    foreach ($data as $item) {
    $topicName = $item['topic_name'];
    if (!isset($map[$topicName])) { 
        $map[$topicName] = [
            "id" => $item['topic_id'],
            "name" => $item['topic_name'],
            "slug" => $item['topic_slug'],
            "posts" => []
        ];
    }
    unset($item['topic_name'], $item['topic_id'], $item['topic_slug']);
    $postModel = new Post;
    $postModel->setContent($item['post_content']);
    $postModel->setPostDescription($item['post_description']);
    $postModel->setId($item['post_id']);
    $postModel->setPostSlug($item['post_slug']);
    $postModel->setPostTitle($item['post_title']);
    $map[$topicName]['posts'][] = $postModel;
    }
    return $map;
  }

  public function GetDataResponse ($status = 200, $data = [], $error = null) {

    $dataDefault = [
      'status'=> '',
      'data' => [],
      'error' => null
    ];

    if ($status) $dataDefault['status'] = $status;

    if (!empty($data)) $dataDefault['data'] = $data;

    if ($error) $dataDefault['error'] = $error;

    return $dataDefault;
  }
  #endRegion
}
