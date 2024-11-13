<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лаб9</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <img src="pollogo.png" alt="Политех">
        <h1>Вариант 7</h1>
        <p>Шпарик 231-362</p>
    </header>
    <main>
        <?php
        $con=0;
        $start_x = 0;
        $step = 1;
        $count = 30;
        $min_value = -1000000;
        $max_value = 1000000;
        $layout_type = 'E'; 
        $text = '';
        function calculateFunction($x) {
            if ($x <= 10) {
                return ($x == 5) ? "error" : (6 / ($x - 5)) * $x - 5;
            } elseif ($x > 10 && $x < 20) {
                return (($x ** 2) - 1) * $x + 7;
            } else {
                return 4 * $x + 5;
            }
        }
        $values = [];
        $sum = 0;

        for ($i = 0, $x = $start_x; $i < $count; $i++, $x += $step) {
            $f = calculateFunction($x);

            if ($f === "error" || $f >= $max_value || $f < $min_value) {
                continue;
            }
            
            $f = round($f, 3);
            $values[] = ["x" => $x, "f" => $f];
            $sum += $f;
        }

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
                $text = "A.	Простая верстка текстом, без таблиц и блоков";
                foreach ($values as $value) {
                    $con+=1;
                    if($con==6){
                        echo "f(5)= error <br>";
                    }
                    echo "f(" . $value["x"] . ") = " . $value["f"] . "<br>";
                }
                break;
            case 'B':
                $text = "B.	Маркированный список.";
                echo "<ul>";
                foreach ($values as $value) {
                    $con+=1;
                    if($con==6){
                        echo "<li>f(" . "5" . ") = " . "error" . "</li>";
                    }
                    echo "<li>f(" . $value["x"] . ") = " . $value["f"] . "</li>";
                }
                echo "</ul>";
                break;
            case 'C':
                $text = "C. Нумированный список."; 
                echo "<ol>";
                foreach ($values as $value) {
                    $con+=1;
                    if($con==6){
                        echo "<li>f(" . "5" . ") = " . "error" . "</li>";;
                    }
                    echo "<li>f(" . $value["x"] . ") = " . $value["f"] . "</li>";
                }
                echo "</ol>";
                break;
            case 'D':
                $text = "D.	Табличная верстка";
                echo "<table border='1' cellpadding='5' cellspacing='0' style='border: 1px solid black;'>";
                echo "<tr><th>#</th><th>x</th><th>f(x)</th></tr>";
                foreach ($values as $index => $value) {
                    $con+=1;
                    if($con==6){
                        echo "<tr><td>" . ($index + 1) . "</td><td>" . "5" . "</td><td>" . "error" . "</td></tr>";
                    }
                    echo "<tr><td>" . ($index + 1) . "</td><td>" . $value["x"] . "</td><td>" . $value["f"] . "</td></tr>";
                }
                echo "</table>";
                break;
            case 'E':
                $text = 'E.	Блочная верстка. ';
                foreach ($values as $value) {
                    $con+=1;
                    if($con==6){
                        echo "<div class='block'>f(" . "5" . ") = " . "error" . "</div>";
                    }
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
    </main>
    <footer>
        <p>Тип вёрстки: <?php echo $text; ?></p>
    </footer>
</body>
</html>