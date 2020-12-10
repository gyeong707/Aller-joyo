<?php
///
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>dbp final</title>
    <link rel=stylesheet href="style.css" type="text/css">
</head>
<body>
  <span id="headinfo">SSWU 4-2 DBP</span>
  <div id="container">
    <div id="board">
      <img src="images/egg.png" class="img_egg">
      <img src="images/meal.png" class="img_meal">
      <img src="images/milk.png" class="img_milk">
      <img src="images/peach.png" class="img_peach">

      <span id="board_title">Do you have a food <sapn class="high-text">allergy</sapn>?</span>
      <div id="borad_content">
        <span class="content">We will show the ingredients of the product.</span><br>
        <span class="content"><sapn class="high-text">Here, Select the product category!</span></span>
        <div id="board_category"> Available Category : ALL, 라면, 만두, 떡볶이, 빵 </div>
      </div>
      <div id="form-container">
        <form action="view.php" method="POST">
            <select name = "category" id="form_select">
              <option value="all">&nbsp&nbspALL</option>
              <option value="ramen">&nbsp&nbsp라면</option>
              <option value="mandoo">&nbsp&nbsp만두</option>
              <option value="ttekbokki">&nbsp&nbsp떡볶이</option>
              <option value="bread">&nbsp&nbsp빵</option>
            </select><br>
            <input type="submit" value="Submit" id="form_submit"><br><br>
        </form>
      </div>
    </div>
  </div>
  <div id="team_info">Team6 : 강미경, 김수빈, 김혜지, 이혜린</div>

</body>
</html>
