<?php
// アンケートフォームから送信されたデータを受け取る

// フォームの各入力項目（name属性）からデータを取得（POST送信）
// 万が一値が未設定でもエラーが出ないように「?? ''（空文字）」で初期化する
$name = $_POST["name"] ?? '';
$email = $_POST["email"] ?? '';
$animal = $_POST["animal"] ?? '';
$goodChange = $_POST["good_change"] ?? '';
$ageAdopted = $_POST["age_adopted"] ?? '';
$troubles = $_POST["troubles"] ?? '';

// すべての項目にデータが入っているか確認
if ($name && $email && $animal && $goodChange && $ageAdopted && $troubles) {
    // CSV形式の1行データを作る（カンマ区切り）
    // 各項目をカンマでつないで1行にまとめる（最後に改行 \n を追加）
    $line = $name . ',' . $email . ',' . $animal .  ',' . $goodChange . ',' .  $ageAdopted . ',' . $troubles . PHP_EOL;
    // ファイルに追記（FILE_APPENDは追記。上書きではない！！）
    // __DIR__ はこのPHPファイルがあるフォルダの絶対パスを指している
    file_put_contents(__DIR__ . '/data/data.csv', $line, FILE_APPEND);
    // 登録後にread.phpへジャンプする！
    header("Location: read.php");
    exit; // これ以降の処理をストップする（念のためいれるといい）
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <title>入力エラー！ペットアンケート</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New&display=swap" rel="stylesheet">
</head>

<body>
    <header class="main-page-header">
        <h1>🐾 入力エラー</h1>
    </header>

    <div class="error-message-inline">
        <p>入力内容に不備があります。もう一度やり直してください。</p>
    </div>

    <p><a href="index.php">← アンケートに戻る</a></p>
</body>

</html>