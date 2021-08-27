<?php
  // index.jsからuserid, start, stopを取得
  $userid = $_GET["userid"];
  $start = $_GET["start"];
  $end = $_GET["end"];

  // 本来はデータベースからlistに代入
  $list = array(
    array(
      "planid" => "1",  // planidは適当につけたので変えて問題なし
      "title" => "何でも相談会",
      "start" => "2021-08-19T13:00:00",
      "end" => "2021-08-19T17:00:00",
      "color" => "#EDAD0B"
    ),
    array(
      "planid" => "2",
      "title" => "ミーティング",
      "start" => "2021-08-24T10:00:00",
      "end" => "2021-08-24T11:00:00",
      "color" => "#257e4a"
    ),
    array(
      "planid" => "3",
      "title" => "HackU",
      "start" => "2021-08-28",
      "end" => "2021-08-28",
      "color" => "#99CFE5"
    )
  );
  // 明示的に指定しない場合は、text/html型と判断される
  header("Content-type: application/json; charset=UTF-8");
  //JSONデータを出力
  echo json_encode($list);
?>