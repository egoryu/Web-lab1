<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Лабораторная работа по Web-программированию №1</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/cookielib/src/cookie.min.js" crossorigin="anonymous"></script>
</head>
<body>

<table id="main-table">
    <tr>
        <td id="header-plate" colspan="2">
            Никитин Егор Алексеевич<br> Группа P32111 <br> Вариант: 1709
        </td>
    </tr>
    <tr>
        <th class="title-plate">Визуализация</th>
        <th class="title-plate">Ввод данных</th>
    </tr>
    <tr>
        <td class="image-container">
            <img class="image" src="png/areas.png">
        </td>
        <td class="content-plate">
            <form id="former" action="">
                <table id="input-grid">
                    <tr>
                        <td>
                            <label>Выберите X:</label>
                        </td>
                        <td>
                            <input class="x-radio" type="radio" name="x" value="-3">-3
                            <input class="x-radio" type="radio" name="x" value="-2">-2
                            <input class="x-radio" type="radio" name="x" value="-1">-1
                            <input class="x-radio" type="radio" checked="checked" name="x" value="0">0
                            <input class="x-radio" type="radio" name="x" value="1">1
                            <input class="x-radio" type="radio" name="x" value="2">2
                            <input class="x-radio" type="radio" name="x" value="3">3
                            <input class="x-radio" type="radio" name="x" value="4">4
                            <input class="x-radio" type="radio" name="x" value="5">5
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Введите Y:
                        </td>
                        <td>
                            <input id="y-textinput" type="text" maxlength="10" autocomplete="off" placeholder="-3..5" name="y" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Выберите R:
                        </td>

                        <td>
                            <div>
                                <select id='r-value' name="r">
                                    <option value="1">1</option>
                                    <option value="1.5">1.5</option>
                                    <option value="2">2</option>
                                    <option value="2.5">2.5</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input class="button" type="submit" value="submit">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <span class="text-error invisible" id="error"></span>
                        </td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
    <tr>
        <th class="title-plate" colspan=2>Результат</th>
    </tr>
    <tr>
        <td colspan=2>
            <table id="result-table">
                <tr class="table-header">
                    <th class="coords-col">X</th>
                    <th class="coords-col">Y</th>
                    <th class="coords-col">R</th>
                    <th class="time-col">Current time</th>
                    <th class="time-col">Execution time</th>
                    <th class="hit-col">Hit result</th>
                </tr>
                <?php foreach($_SESSION['data'] as $row): ?>
                <tr>
                    <td><?= $row['xval'] ?></td>
                    <td><?= $row['yval'] ?></td>
                    <td><?= $row['rval'] ?></td>
                    <td><?= $row['curtime'] ?></td>
                    <td><?= $row['exectime'] ?></td>
                    <td><?= $row['hitres'] ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </td>
    </tr>
</table>
<script src="js/script.js"></script>
</body>
</html>