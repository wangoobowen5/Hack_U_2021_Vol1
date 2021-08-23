<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/user.css">
    <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.8.1/firebase-auth.js"></script>
    <title>Document</title>
</head>
<body>
    <header>
        <div class="header-rapper common-rapper">
            <div class="title">
                <h1><a href="./index.html" class="title-link">ラクスケ</a></h1>
            </div>
            <nav>
                <a href="./index.html" class="home nav-link">ホーム</a>
                <a href="./template.html" class="calendar nav-link">テンプレート</a>
                <a href="./user.php" class="btn-circle-border-simple nav-link"></a>
            </nav>
        </div>
    </header>

    <main>
        <div class="main-rapper common-rapper">
            <div class="main-content flex">
                <div class="main-user flex">
                    <div class="btn-circle-border-simple"></div>
                    <h2 class="user-name">ユーザー名</h2>
                </div>
                <p><button class="logout-button common-button">ログアウト</button></p>
            </div>
            <div class="main-content">
                <div class="schedule-area flex">
                    <div class="schedule-description">
                        <h3 class="schedule-title">予定を追加しても良い時間</h3>
                        <p class="schedule-text">入力した時間に自動で予定を追加します。</p>
                    </div>
                    <p><button class="schedule-update-button">更新</button></p>
                </div>
                <div class="schedule-time flex">
                    <div class="begin">
                        <h3 class="begin-text">始まり</h3>
                        <div class="begin-input"></div>
                    </div>
                    <h3>〜</h3>
                    <div class="end">
                        <h3 class="end-text">始まり</h3>
                        <div class="end-input"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="./script/firebase.js" type="module"></script>
    <script src="./script/index.js" type="module"></script>
</body>
</html>