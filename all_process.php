<?php
  $link = mysqli_connect("localhost", "root", "kimhj0314", "dbp");

  $filtered_allergy = '';
  $print_allergy = '';
  $allergy = $_POST['allergy'];

  for ($i = 0; $i < count($allergy); $i++) {
    $print_allergy .= $allergy[$i];
    $filtered_allergy .= $allergy[$i];

    if($i < count($allergy) - 1) {
      $print_allergy .= ", ";
      $filtered_allergy .= "|";
    }
  };

  $filtered_nutrient = '';
  $filtered_nutrient = mysqli_real_escape_string($link, $_POST['nutrient']);
  $filtered_nutrient_array = explode(',', $filtered_nutrient);

  $filtered_nutrient_query = '';
  $print_nutrient = '';

  if ($filtered_nutrient_array[0] == '') {
    $filtered_nutrient_query = '';
    $print_nutrient = $print_allergy;
  }
  else {
    for ($i = 0; $i < count($filtered_nutrient_array); $i++) {
      $print_nutrient .= $filtered_nutrient_array[$i];
      $filtered_nutrient_query .= $filtered_nutrient_array[$i];

      if($i < (count($filtered_nutrient_array) - 1)){
        $print_nutrient .= ", ";
        $filtered_nutrient_query .= "|";
      }
    }

    $print_nutrient = $print_allergy.", ".$print_nutrient;
  }

    $category = mysqli_real_escape_string($link, $_POST['category']);

    if ($filtered_nutrient_query == '') {
      if($category == "all"){
          $print_category = "전체";
          $query = "SELECT prdlstNm, rawmtrl ,allergy, category FROM food WHERE
          NOT REGEXP_LIKE(allergy, '{$filtered_allergy}') and NOT REGEXP_LIKE(rawmtrl, '{$filtered_allergy}')";
      }
      else{
          $print_category = $category;
          $query = "SELECT prdlstNm, rawmtrl ,allergy, category FROM food WHERE category LIKE '%{$category}%' and
          NOT REGEXP_LIKE(allergy, '{$filtered_allergy}') and NOT REGEXP_LIKE(rawmtrl, '{$filtered_allergy}')";
      }
    } else {
      if($category == "all"){
          $print_category = "전체";
          $query = "SELECT prdlstNm, rawmtrl ,allergy, category FROM food WHERE
          NOT REGEXP_LIKE(rawmtrl, '{$filtered_nutrient_query}') and NOT REGEXP_LIKE(allergy, '{$filtered_allergy}') and NOT REGEXP_LIKE(rawmtrl, '{$filtered_allergy}')";
      }
      else{
          $print_category = $category;
          $query = "SELECT prdlstNm, rawmtrl ,allergy, category FROM food WHERE category LIKE '%{$category}%' and
          NOT REGEXP_LIKE(rawmtrl, '{$filtered_nutrient_query}') and NOT REGEXP_LIKE(allergy, '{$filtered_allergy}') and NOT REGEXP_LIKE(rawmtrl, '{$filtered_allergy}')";
      }
    }

    $result = mysqli_query($link, $query);
    $totalrownum = mysqli_num_rows($result);
    $food_info = '';
    while($row = mysqli_fetch_array($result)) {
      $food_info .= '<tr>';
      $food_info .= '<td width="180px">'.$row['prdlstNm'].'</td>';
      $food_info .= '<td width="100px">'.$row['category'].'</td>';
      $food_info .= '<td width="180px">'.$row['allergy'].'</td>';
      $food_info .= '<td>'.$row['rawmtrl'].'</td>';
      $food_info .= '</tr>';
    }

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
<span class="back_button"><a href="index.php">메인으로 돌아가기</a></span>
    <div id="table_container">
    <div id="table_title">Result Table</div>
        <div class="filtered_info">
            다음은 <span class="filtered_value"><<?=$print_category?>></span> 카테고리의 결과입니다. <br>
            선택하신 <span class="filtered_value"><?=$print_nutrient?></span> 성분은 제외했습니다.
        </div>
        <div class="filter_form">
            <form action="all_process.php" method="POST">
                <div class="allergy_filter_info">
                    <span class="AppleR">식품 알러지</span>가 있으세요?<br>
                    체크해주시면 해당 성분이 첨가되지 않은 결과만을 보여드릴게요.
                </div><br>
                <div class="allergy_filter_title"><label>* 알러지 유발 성분 필터링*</label><br><span class="multiple_vote">(복수선택 가능)</span></div>
                <input type="checkbox" name="allergy[]" value="대두">대두
                <input type="checkbox" name="allergy[]" value="땅콩">땅콩
                <input type="checkbox" name="allergy[]" value="밀">밀
                <input type="checkbox" name="allergy[]" value="쇠고기">쇠고기
                <input type="checkbox" name="allergy[]" value="돼지고기">돼지고기
                <input type="checkbox" name="allergy[]" value="닭고기">닭고기
                <br>
                <input type="checkbox" name="allergy[]" value="새우">새우
                <input type="checkbox" name="allergy[]" value="오징어">오징어
                <input type="checkbox" name="allergy[]" value="우유">우유
                <input type="checkbox" name="allergy[]" value="조개">조개
                <input type="checkbox" name="allergy[]" value="토마토">토마토
                <input type="checkbox" name="allergy[]" value="선택없음">선택없음
                <input type="hidden" name="category" value=<?=$category?>>
                <br><br>
                <div class="allergy_filter_title"><label>* 일반 성분 필터링 *</label></div>
                <input type="text" name="nutrient" placeholder="  제외할 성분 이름을 입력하세요. ex) 치즈,양파" class="form_search">
                <br>
                <input type="submit" value="검색하기" class="form_search_submit">
            </form>
        </div>
        <div class="table_rownum">총 <?=$totalrownum?> 개의 행이 검색되었습니다.</div>
        <table class="data">
        <tr>
            <th>이름</th>
            <th>카테고리</th>
            <th>알러지</th>
            <th>성분</th>
        </tr>
        <?= $food_info ?>
        </table>
    </div>

</body>

</html>
