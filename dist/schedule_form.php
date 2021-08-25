<?php
    $startDate = $_GET['date'];
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/schedule_form.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-analytics.js"></script>
        <script src="https://www.gstatic.com/firebasejs/8.8.1/firebase-auth.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>予定登録</title>
    </head>
    
    <body>
        <div class="title">
            <h1>ラクスケ</h1>
		</div>

        <div class="front">
            <a href="./index.php" class="home">ホーム</a>
            <a href="./template.php" class="calendar">テンプレート</a>
            <a href="./user.php" class="btn-circle-border-simple"></a>
        </div>
        <hr color="black" class="line">

        <div class="background">
            <br>

            <div class="schedule-title">
                <h3>予定の登録</h3>
                <br>
                <input type="text" id="schedule-name" name="schedule-name" placeholder="タイトル" class="schedule-name">
            </div>

            <div class="template">
                <h3>テンプレート</h3> 
                <select id="template-list" name="template-list">
                    <option value="" hiden>テンプレートを選択</option>
                    <option value="hung-out">遊びの計画</option>
                    <option value="report">レポート</option>
                    <option value="presentation">プレゼン準備</option>
                    <option value="time-keeper">会議のタイムキーパー</option>                    
                </select>          
            </div>
            <div class="wrapper-text">
                <h4>いつから</h4>
                <h4></h4>
                <h4>いつまで</h4>
            </div>
            <div class="wrapper-form">
                <input type="text" id="start-date" class="date_text" value=<?= $startDate ?>>  
                <div class="wave"><h4>〜</h4></div>
                <input type="text" id="end-date" class="date_text"> 
            </div>            
            <br>
            <div class="wrapper-cancel-register">
                <a href="./index.php" class="form-cancel-button">キャンセル</a>
                <button class="form-register-button" id="form-register-button">登録</button>
            </div>
            
            <p>以下の内容が登録されます。</p>
            <p>・～～～～～～～～～～～～～：20%</p>
            <p>・～～～～～～～～～～～～～：30%</p>
            <p>・～～～～～～～～～～～～～：50%</p>  
        </div>

        <script src="./script/firebase.js" type="module"></script>
        <script src="./script/schedule_form.js" type="module"></script>
    </body>
</html>