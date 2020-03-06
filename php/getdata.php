<?php
  include "dbVars.php";
  $q     = $_GET['q'];
  $q     = filter_var($q, FILTER_SANITIZE_STRING);
  $con   = mysqli_connect($servername, $username, $password, $database);
  if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
  }
  $sql   = "SELECT * FROM images WHERE image_tag LIKE '$q%' ORDER BY RAND()";
  $result = mysqli_query($con, $sql);
  if (mysqli_num_rows($result) == 0){
    echo "<p>Geen resultaat</p>";
  }else{
    while($row = mysqli_fetch_array($result)){
      echo '<div class="card">';
      echo '<img src="uploads/' . $row['image_url'] . '" alt="' . $row['image_url'] . '" class="modaalButton">';
      echo '</div>';
      echo '<div class="album modaal">';
      echo '<img src="uploads/' . $row['image_url'] . '" alt="' . $row['image_url'] . '">';
      echo '<article>';
      echo '<span class="bold">Title:</span><br>';
      echo $row['image_title'] . '<br>';
      echo '<span class="bold">Description:</span><br>';
      echo $row['image_description'] . '<br>';
      echo '<span class="bold">Tag:</span><br>';
      echo $row['image_tag'];
      echo '</article>';
      echo '</div>';
    }
  }
  mysqli_close($con);
?>
