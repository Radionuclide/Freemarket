
  <form enctype="multipart/form-data" action="upload.php" method="post">
   <input type="file" name="photo">
   <input type="submit" value="Отправить">

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  print_r($_FILES);
  if($_FILES["photo"]["size"] > 1024*3*1024) {
     echo ("Размер файла превышает три мегабайта");
     exit;
   }
   // Проверяем загружен ли файл
    if(is_uploaded_file($_FILES["photo"]["tmp_name"])) {
      echo $_FILES["photo"]["tmp_name"] . "<br>";
      move_uploaded_file($_FILES["photo"]["tmp_name"], "C:\Apache\upload\\".$_FILES["photo"]["name"]);
    } else
      echo("Ошибка загрузки файла");
}
?>
</body>
</html>