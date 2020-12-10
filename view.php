<?php
  $link = mysqli_connect("localhost", "root", "ROOTROOT", "dbp");
  $query = "SELECT category, prdlstNm, allergy FROM food limit 100";
  $result = mysqli_query($link, $query);
  $twit_info = "";

  while ($row = mysqli_fetch_array($result)) {
    $filtered = array(
      'category' => htmlspecialchars($row['category']),
      'prdlstNm' => htmlspecialchars($row['prdlstNm']),
      'allergy' => htmlspecialchars($row['allergy'])
    );
      $twit_info .= '<tr>';
      $twit_info .= '<td>'.$filtered['category'].'</td>';
      $twit_info .= '<td>'.$filtered['prdlstNm'].'</td>';
      $twit_info .= '<td>'.$filtered['allergy'].'</td>';
      $twit_info .= '</tr>';
  }
  
  // 할당된 리소스 해제
  mysqli_free_result($result);
  mysqli_close($link);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>dbp final</title>
    <link rel=stylesheet href="style.css" type="text/css">
</head>
<body>
  <div id="table_container">
    <div id="table_title">View Result!</div>
    <table class="data">
      <tr>
        <th>category</th>
        <th>prdlstNm</th>
        <th>allergy</th>
      </tr>
      <?= $twit_info ?>
    </table>
  </div>

</body>
</html>
