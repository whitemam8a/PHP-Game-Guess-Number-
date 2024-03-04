<?php
session_start();

if (!isset($_SESSION['rand_number'])) {
  $_SESSION['rand_number'] = rand(1, 100);
}

// unset($_SESSION['rand_number']);

?>
<html>

<head>
  <title>l7.PHP-сценарий, угадывающий число </title>
</head>

<body>
  <h1>Игра "Угадай число!"</h1>
  <h3>Угадай случайное число от 1 до 100</h3>
  <form method="post" action="">
    <p>Введите число:
      <input type="text" name="guess" />
      <input type="submit" value="Input" />
    </p>
  </form>
  <?php
  $attempts = [];
  if (!isset($_SESSION['attempts'])) {
    $_SESSION['attempts'] = [];
  }

  $message = "Hello, lets play the game!";


  if (isset($_POST['guess'])) {
    $_SESSION['attempts'][] = $_POST['guess'];
    if ($_POST['guess'] < $_SESSION['rand_number']) {
      $message = "<p style='color: red;'>Не правильно</p>" . "<p>Загаданное число больше, чем " . $_POST['guess'] . "</p>";
    } elseif ($_POST['guess'] > $_SESSION['rand_number']) {
      $message = "<p style='color: red;'>Не правильно</p>" .  "<p>Загаданное число меньше, чем " . $_POST['guess'] . "</p>";
    } else {
      $message = "<p style='color: green'>Вы угадали. Число было " . $_SESSION['rand_number'] . "</p>";
      unset($_SESSION['rand_number']);
      unset($_SESSION['attempts']);
      // $attempts = [];
    }
    // $_SESSION['attempts'][] = $attempts;
  }
  echo "<p>$message </p>";
  if (isset($_SESSION['attempts'])) {
    echo "<p>Веденные числа: <br>";
    foreach ($_SESSION['attempts'] as $number) {
      echo $number . " ";
    }
    echo "</p>";
  } else {
    // echo "<p>Вы еще не вводили числа.</p>";
  }
  ?>


</body>

</html>