<?php
session_start();

// Функция для генерации случайного числа
function generateRandomNumber($min, $max)
{
  return rand($min, $max);
}

// Функция для проверки попытки угадать число
function checkGuess($guess, $randomNumber)
{
  if ($guess == $randomNumber) {
    echo "Поздравляем! Вы угадали число $randomNumber!";
    $_SESSION['attempts'][] = $guess;
    unset($_SESSION['randomNumber']);
    unset($_SESSION['attempts']);
  } elseif ($guess < $randomNumber) {
    echo "Загаданное число больше, чем $guess<br>";
    $_SESSION['attempts'][] = $guess;
  } else {
    echo "Загаданное число меньше, чем $guess<br>";
    $_SESSION['attempts'][] = $guess;
  }
}

// Проверяем, началась ли игра
if (!isset($_SESSION['randomNumber'])) {
  $_SESSION['randomNumber'] = generateRandomNumber(0, 100);
  $_SESSION['attempts'] = [];
}

// Проверяем, была ли отправлена форма с попыткой угадать число
if (isset($_POST['guess'])) {
  $guess = intval($_POST['guess']);
  checkGuess($guess, $_SESSION['randomNumber']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Угадай число</title>
</head>

<body>
  <h1>Угадай число от 0 до 100</h1>
  <form method="post">
    <label for="guess">Введите вашу попытку: </label>
    <input type="number" id="guess" name="guess" min="0" max="100" required>
    <button type="submit">Проверить</button>
  </form>
  <h2>Попытки:</h2>
  <?php
  if (isset($_SESSION['attempts'])) {
    sort($_SESSION['attempts']);
    foreach ($_SESSION['attempts'] as $attempt) {
      echo "$attempt ";
    }
  }
  ?>
</body>

</html>