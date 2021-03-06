<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/template_form.css">
        <link rel="icon" href="image/logo.svg" type="image/svg+xml">
        <title>テンプレートの登録</title>
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

            <form action="" method="post">
                <div class="template">
                    <label for="name"><h3>テンプレートの登録</h3></label>
                    <br>
                    <input type="text" id="name" name="name" placeholder="タイトル" class="text_title">
                </div>
                <br>
                <div class="template">
                    <h3>タスク</h3>
                    <br>
                    <label for="task">タスク1</label>
                    <label for="pct" class="pct">割合</label>
                    <br>
                    <input type="text" id="task" name="task" class="text_task">
                    <input type="text" id="pct" name="pct" class="text_pct">%
                    <p class="task_sum">タスクの割合は合計で100%にしてください</p>
                </div>
                <div class="btn_position">
                    <a href="./template.php" class="btn_cancel">キャンセル</a>
                    <input type="submit" value="登録" class="submit">
                </div>
            </form>
        </div>
    </body>

</html>