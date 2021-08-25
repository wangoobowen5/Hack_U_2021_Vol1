<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.8.1/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/ui/4.8.1/firebase-ui-auth.js"></script>
    <link type="text/css" rel="stylesheet" href="https://www.gstatic.com/firebasejs/ui/4.8.1/firebase-ui-auth.css" />
    <link rel="stylesheet" href="./css/login.css">

</head>
<body>
    <div id="firebaseui-auth-container"></div>
    <script src="./script/firebase.js" type="module"></script>
    <h1>ラクスケ</h1>

    <div class="formwrapper">
        <h2>ログイン</h2>
        <form action="" method="post">
            <div class="setting">
                <input type="text" id="username" name="username" placeholder="ユーザーネーム" class="text_login">
            </div>

            <div class="setting">
                <input type="password" id="passward" name="passward" placeholder="パスワード" class="text_login">
            </div>    

            <div class="setting">
                <input type="submit" value="ログイン" class="login_button">
            </div>
            <p><a href="#">新規登録</a></p>
            <p><a href="#">パスワード忘れたかい?</a></p>
        </form>
    </div>
</body>
</html>