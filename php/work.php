<?php
$start = microtime(true);

$x = $_GET['x'];
$y = $_GET['y'];
$r = $_GET['r'];

$check = false;
$fail = false;
$y = preg_replace("/,/", ".", $y);
$mistake = "";

if (!(is_numeric($x))) {
    $fail = true;
    $mistake .= "Не корректное значение x\n";
}
elseif ($y<-3 || $y>5 || !is_numeric($y)) {
    $fail = true;
    $mistake .= "Не корректное значение y\n";
}
elseif (!is_numeric($r)) {
    $fail = true;
    $mistake .= "Не корректное значение z\n";
}

if ($x >= 0 && $x <= $r && $y >= 0 && $y <= $r)
    $check=true;
elseif ($x <= 0 && $y <= 0 && $y >= -(2 * $x + $r))
    $check=true;
elseif ($x <= 0 && $y >= 0 && sqrt($x * $x + $y * $y) <= $r)
    $check=true;

$finish = microtime(true);
$time = number_format($finish-$start,6);

$dt = new DateTime("now", new DateTimeZone('Europe/Moscow'));

$jsonData = json_encode([
    "validate" => !$fail,
    "xval" => $x,
    "yval" => $y,
    "rval" => $r,
    "curtime" => $dt->format("H:i:s"),
    "exectime" => $time,
    "hitres" => $check,
    "mistake" => $mistake
]);

echo $jsonData;
?>