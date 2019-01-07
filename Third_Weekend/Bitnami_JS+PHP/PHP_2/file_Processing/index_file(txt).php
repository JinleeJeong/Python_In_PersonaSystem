<?php
    $conn = mysqli_connect("localhost", "root", "cwsok045");
    mysqli_select_db($conn, 'opentutorials');
    $result = mysqli_query($conn, "SELECT * FROM topic");

?>

<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="http://localhost/Project/PHP_2/file_Processing/style.css">
</head>
<body id="target">
    <header>

        <h1><a href="http://localhost/Project/PHP_2/file_Processing/index_file(txt).php">JavaScript</a></h1>
  </header>
    <nav>
        <ol>
    <?php
      while($row = mysqli_fetch_assoc($result)){
      echo '<li><a href="index_file(txt).php?id='.$row['id'].'">'.htmlspecialchars($row['title']).'</a></li>'."\n";
      }
    ?>
        </ol>
    </nav>
    <div id="control">
      <a href="write.php">쓰기</a>

    </div>


  <article>
  <?php
  if(empty($_GET['id'])=== false) {
    $sql = "SELECT topic.id, title, user.name, description FROM topic LEFT JOIN user ON topic.author = user.id WHERE topic.id=".$_GET['id'];
    $result_text = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result_text);
    echo '<h2>'.htmlspecialchars($row['title']).'</h2>';
    echo '<p>'.htmlspecialchars($row['name']).'</p>';
    echo strip_tags($row['description'], '<h1><h2><h3><h4><h5><a><p><li><ul>');
    }
  ?>

  </article>
</body>
</html>


<!--
1) mysqli_connect(local, id, pw);
2) mysqli_select_db($conn, dbName);
3) mysqli_query($conn, sentence);
4) mysqli_fetch_assoc($conn, sentence);
$_GET, $_POST
get Address index


@ SELECT title,name FROM topic LEFT JOIN user ON topic.author = user.id 해석

topic테이블과 user테이블을 왼쪽에 있는 topic테이블을 기준으로 JOIN한다.
topic테이블의 author와 user테이블의 id가 같게 정렬한다.
JOIN되어 만들어진 가상테이블에 collum이 title과 name인 것만 출력한다. -->
