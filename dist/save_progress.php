<?php
    $planid = $_POST['planid'];
    $progress = $_POST['progress'];
    
    $list = array('planid'=>$planid, 'progress'=>$progress);
    // 明示的に指定しない場合は、text/html型と判断される
    header("Content-type: application/json; charset=UTF-8");
    //JSONデータを出力
    echo json_encode($list);
?>