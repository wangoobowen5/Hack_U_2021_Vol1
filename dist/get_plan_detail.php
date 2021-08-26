<?php
    $planid = $_POST['planid'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    
    $list = array('planid'=>$planid, 'start'=>$start, 'end'=>$end);
    // 明示的に指定しない場合は、text/html型と判断される
    header("Content-type: application/json; charset=UTF-8");
    //JSONデータを出力
    echo json_encode($list);
?>