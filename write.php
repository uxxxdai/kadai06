<?php

$name = $_POST["name"];
$birthPlace = $_POST["birthPlace"];
$sex = $_POST["sex"];
$age = $_POST["age"];
$study_hours = $_POST["study_hours"];

//記入時間取得
date_default_timezone_set("Asia/Tokyo");
$time = date("Y/m/d H:i:s");

// ファイルopen
$file = fopen("data/data.txt","a");

// ファイルをカンマにして書き込み
fwrite($file, "$time, $name, $birthPlace, $sex, $age, $study_hours\n");

//ファイルに保存
fclose($file);
?>


<html>

<head>
    <meta charset="utf-8">
    <title>File書き込み</title>
</head>

<body>

    <h1>書き込みしました。</h1>
    <h2>./data/data.txt を確認しましょう！</h2>

    <ul>
        <li><a href="read.php">確認する</a></li>
        <li><a href="input.php">戻る</a></li>
    </ul>
</body>

</html>
