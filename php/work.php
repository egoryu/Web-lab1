<?php
session_start();

$start = microtime(true);

$x = $_GET['x'];
$y = $_GET['y'];
$r = $_GET['r'];
$t = $_GET['time'];

$check = 0;
$fail = false;
$y = preg_replace("/,/", ".", $y);
$mistake = "";

if (!(is_numeric($x))) {
    $fail = true;
    $mistake .= "Не корректное значение x\n";
}
elseif (!is_numeric($y) || $y <= -3 || $y >= 5) {
    $fail = true;
    $mistake .= "Не корректное значение y\n";
}
elseif (!is_numeric($r)) {
    $fail = true;
    $mistake .= "Не корректное значение z\n";
} elseif (!(is_numeric($x))) {
    $fail = true;
    $mistake .= "Не корректное значение timezone-offset\n";
}

if ($x >= 0 && $x <= $r && $y >= 0 && $y <= $r)
    $check=1;
elseif ($x <= 0 && $y <= 0 && $y >= -(2 * $x + $r))
    $check=1;
elseif ($x <= 0 && $y >= 0 && sqrt($x * $x + $y * $y) <= $r)
    $check=1;

$finish = microtime(true);
$time = number_format($finish-$start,6);

$dt = date("H:i:s", time()-$t*60);

$data = [
    "validate" => !$fail,
    "xval" => $x,
    "yval" => $y,
    "rval" => $r,
    "curtime" => $dt,
    "exectime" => $time,
    "hitres" => $check,
    "mistake" => $mistake
];

if ($data['validate'])
    $_SESSION['data'][] = $data;

echo json_encode($data);
?>