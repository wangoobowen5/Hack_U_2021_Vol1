<?php
    $planid = $_POST['planid'];

    $list = array(
        'goal' => '内容書き出し:10,スライド:20',
        'progress' => '内容書き出し:10,スライド:0,発表練習:0',
        'task' => '内容書き出し:20,スライド:60,発表練習:20'
    );
    // 明示的に指定しない場合は、text/html型と判断される
    header("Content-type: application/json; charset=UTF-8");
    //JSONデータを出力
    echo json_encode($list);
?>