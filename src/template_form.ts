$(function() {

    // button
    const btn_add = $('.btn-add');  // 追加ボタン
    const btn_remove = $('.btn-remove');  // 削除ボタン
  
    // add
    btn_add.click(function() {
      
      const text = $('.text').last();  // 最後尾にあるinput
  
        text
        $('.text')
        .add()  // 追加
        .val('')  // valueも追加されるので削除する
        .insertAfter(text);  // inputを最後尾に追加
        //.insertAfter('.text');
      
      if ($('.text').length >= 1) {
        $(btn_remove).show();  // inputが1つ以上あるときに削除ボタンを表示
      }
  
    });
  
    // remove
      btn_remove.click(function() {
    
      $('.text')
        .last()
        .remove();
  
      if ($('.text').length < 2) {
        btn_remove.hide();  // inputが2つ未満のときに削除ボタンを非表示
      }
      
    });
  });

