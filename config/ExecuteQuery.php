<?php
class ExecuteQuery {
  private $conn;

  public function __construct($_conn)
  {
    $this->conn = $_conn;
  }

  public function execute($queryString = '', $isUpdate = false, $params = []) {
    try {
      if (!$this->conn) return;
      
      $db = $this->conn;
     
      $smtp = $db->query($queryString);

      if (empty($smtp) || !$smtp) {
        die("Error in query execution: " . $db->error);
      }

      if ($isUpdate) {
        return $smtp;
      }

      $result = $smtp->fetch_all(MYSQLI_ASSOC);

      return $result;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

   private function bindParams($stmt, $params)
    {
        $paramTypes = "";
        $paramValues = [];

        foreach ($params as $param) {
            $paramTypes .= $param[0];
            $paramValues[] = $param[1];
        }

        $stmt->bind_param($paramTypes, ...$paramValues);
    }
}
?>