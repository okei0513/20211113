<?php
$id = $_POST['id'];
$title = $_POST['title'];
$writting = $_POST['writting'];
$request = $_POST['request'];
$instagram = $_POST['instagram'];
// var_dump($_POST);
// exit();
//DBの接続
session_start(); // セッションの開始
include('functions.php'); // 関数ファイル読み込み
check_session_id(); // idチェック関数の実行
$pdo = connect_to_db();

$user_id = $_GET['user_id'];
$group_id = $_GET['group_id'];
// $_SERVER["REQUEST_URI"];
// var_dump($_GET);
// exit();
$sql = 'SELECT user.id, user.user_code, user.mail, user.password, user.name AS user_name, group.id,group.group_code,group.name AS group_name,group_member.id,group_member.group_id,group_member.user_id FROM group_member LEFT OUTER JOIN `group` ON group_member.group_id = group.id INNER JOIN user ON group_member.user_id = user.id WHERE user_id=:user_id AND group_id=:group_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':group_id', $group_id, PDO::PARAM_STR);
$status = $stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
foreach ($result as $record) {
    // var_dump($result);
    // exit();
}
$sql = 'SELECT * FROM staff_page LEFT OUTER JOIN `group` ON staff_page.group_id = group.id INNER JOIN user ON staff_page.user_id = user.id WHERE user_id=:user_id AND group_id=:group_id ';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':group_id', $group_id, PDO::PARAM_STR);
$status = $stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
// idを指定して更新するSQLを作成（UPDATE文）
$sql = 'UPDATE staff_page SET title=:title, writting=:writting, request =:request, instagram=:instagram WHERE user_id=:user_id AND group_id=:group_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':group_id', $group_id, PDO::PARAM_STR);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':writting', $writting, PDO::PARAM_INT);
$stmt->bindValue(':request', $request, PDO::PARAM_STR);
$stmt->bindValue(':instagram', $instagram, PDO::PARAM_STR);
$status = $stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
foreach ($result as $row) {
}

// 各値をpostで受け取る
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
} else {
    // 正常に実行された場合は一覧ページファイルに移動し，処理を実行する
    header("Location:staff_read.php?user_id={$record["user_id"]}&group_id={$record["group_id"]}");
    exit();
}
