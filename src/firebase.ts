import { firebaseConfig } from './firebase_config.js'
import { post } from './modules.js'

firebase.initializeApp(firebaseConfig);

const uiConfig = {
    callbacks: {
      signInSuccessWithAuthResult: function(authResult, redirectUrl) {
        return true;
      },
      uiShown: function() {
        document.getElementById('loader').style.display = 'none';
      }
    },
    signInFlow: 'popup',
    signInSuccessUrl: 'temp.php',
    signInOptions: [
      firebase.auth.GoogleAuthProvider.PROVIDER_ID,
      firebase.auth.EmailAuthProvider.PROVIDER_ID,
    ],
};

if (location.pathname === '/Hack_U_2021_Vol1/dist/login.php') {
  var ui = new firebaseui.auth.AuthUI(firebase.auth());
  ui.start('#firebaseui-auth-container', uiConfig);
}
// 非ログイン時、強制的にログインページへ
firebase.auth().onAuthStateChanged(function (user) {
  if (!user && location.pathname !== '/Hack_U_2021_Vol1/dist/login.php') {
      window.location.href = '/Hack_U_2021_Vol1/dist/login.php';
  }
});
// ログイン後に直接「/home/<user_id>」に飛べないので代替処置
// 我ながら頭悪いと思う
if (location.pathname === '/Hack_U_2021_Vol1/dist/temp.php') {
  firebase.auth().onAuthStateChanged(function (user) {
    const data = {"userid": user.uid, "username": user.displayName}
    post('/Hack_U_2021_Vol1/dist/index.php', data)
  });
}