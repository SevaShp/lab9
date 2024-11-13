<?php
// Инициализация параметров
$start_x = 0;
$step = 1;
$count = 30;
$min_value = -1000; // Установите минимальное значение для более широкого диапазона
$max_value = 1000;  // Установите максимальное значение для более широкого диапазона
$layout_type = 'D'; 

// Функция для вычисления значения функции
function calculateFunction($x) {
    if ($x <= 10) {
        return ($x == 5) ? "error" : (6 / ($x - 5)) * $x - 5;
    } elseif ($x > 10 && $x < 20) {
        return (($x ** 2) - 1) * $x + 7;
    } else {
        return 4 * $x + 5;
    }
}

// Переменные для анализа значений функции
$values = [];
$sum = 0;

// Вычисление значений функции
for ($i = 0, $x = $start_x; $i < $count; $i++, $x += $step) {
    $f = calculateFunction($x);

    // Проверка на ошибки и допустимые пределы значений
    if ($f === "error" || $f >= $max_value || $f < $min_value) {
        continue;
    }

    // Округление до 3 знаков и добавление в массив значений
    $f = round($f, 3);
    $values[] = ["x" => $x, "f" => $f];
    $sum += $f;
}

// Проверка, есть ли значения в массиве
if (!empty($values)) {
    $max = max(array_column($values, 'f'));
    $min = min(array_column($values, 'f'));
    $avg = round($sum / count($values), 3);
} else {
    echo "<p>Нет значений функции в заданном диапазоне.</p>";
    $max = $min = $avg = $sum = 0;
}

// Вывод значений в зависимости от типа верстки
switch ($layout_type) {
    case 'A':
        foreach ($values as $value) {
            echo "f(" . $value["x"] . ") = " . $value["f"] . "<br>";
        }
        break;
    case 'B':
        echo "<ul>";
        foreach ($values as $value) {
            echo "<li>f(" . $value["x"] . ") = " . $value["f"] . "</li>";
        }
        echo "</ul>";
        break;
    case 'C':
        echo "<ol>";
        foreach ($values as $value) {
            echo "<li>f(" . $value["x"] . ") = " . $value["f"] . "</li>";
        }
        echo "</ol>";
        break;
    case 'D':
        echo "<table border='1' cellpadding='5' cellspacing='0' style='border: 1px solid black;'>";
        echo "<tr><th>#</th><th>x</th><th>f(x)</th></tr>";
        foreach ($values as $index => $value) {
            echo "<tr><td>" . ($index + 1) . "</td><td>" . $value["x"] . "</td><td>" . $value["f"] . "</td></tr>";
        }
        echo "</table>";
        break;
    case 'E':
        foreach ($values as $value) {
            echo "<div class='block'>f(" . $value["x"] . ") = " . $value["f"] . "</div>";
        }
        break;
}

// Вывод статистики
if (!empty($values)) {
    echo "<p>Максимум: $max</p>";
    echo "<p>Минимум: $min</p>";
    echo "<p>Среднее: $avg</p>";
    echo "<p>Сумма: $sum</p>";
}
?>