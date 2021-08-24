<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/schedule_form.css">

        <title>ラクスケ</title>
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
                <h3 style="display:inline;">予定登録</h3><br>
                <input type="text" id="" name="" placeholder="タイトル" class="schedule-name"/>
		    </div>

            <div class="template">
                <h3 style="display:inline;">テンプレート</h3> 
                <select name="template-list" >
                    <option value="" hiden>テンプレートを選択</option>
                    <option value="hung-out">遊びの計画</option>
                    <option value="report">レポート</option>
                    <option value="presentation">プレゼン準備</option>
                    <option value="time-keeper">会議のタイムキーパー</option>                    
                </select>          
            </div>
            <div class="wrapper-term">
                <div class="term-begining">
                    <p><h4>いつから</h4></p>
                    <input type="text" id="flatpickr">             
                </div>
                <div class="namisen"><h3>～</h3></div>
                <div class="term-end">
                    <p><h4>いつまで</h4></p>
                    <input type="text" id="flatpickr">             
                </div>
            </div>
            <br>
            <div class="wrapper-cancel-register">
                <button type="submit" class="form-cancel-button">キャンセル</button>
                <button type="submit" class="form-register-button">登録</button>
            </div>
            
            <p>以下の内容が登録されます。</p>
            <p>・～～～～～～～～～～～～～：20%</p>
            <p>・～～～～～～～～～～～～～：30%</p>
            <p>・～～～～～～～～～～～～～：50%</p>  
           
            
            
        </div>
        <script>
            flatpickr("#flatpickr", {locale:"ja", minDate:"today"});
        </script>
    </body>
</html>