$(function () {
  // //ボタン要素を取得
  // const buttonOpen = document.getElementById('modalOpen');
  // //モーダル全体要素を取得
  // const modal = document.getElementById('easyModal');
  // //閉じる要素を取得
  // const buttonClose = document.getElementsByClassName('modalClose')[0];

  // // ボタンがクリックされた時
  // buttonOpen.addEventListener('click', modalOpen);
  // function modalOpen() {
  //   modal.style.display = 'block';
  // }

  // // がクリックされた時
  // buttonClose.addEventListener('click', modalClose);
  // function modalClose() {
  //   modal.style.display = 'none';
  // }

  // // モーダルコンテンツ以外がクリックされた時
  // addEventListener('click', outsideClose);
  // function outsideClose(e) {
  //   if (e.target == modal) {
  //     modal.style.display = 'none';
  //   }
  // }

  //スクール予約 キャンセル確認モーダル
  //「リモ○ボタンを押したら」
  $('.delete-modal-open').on('click', function () {
    //モーダルを表示
    $('.js-modal').fadeIn();
    // var getDatam =変数getData、$(this)=delete-modal-open(クリックしたデータ)
    //attr(属性値)をvar getDataへ格納する
    var getData = $(this).attr('getData');
    var getPart = $(this).attr('getPart');
    var reserve_settings = $(this).attr('reserve_settings');
    //modal-inner-date内のspanタグを指定 .val(getData)を挿入
    $('.modal-inner-date p').text(getData);
    $('.modal-inner-date p').text(getPart);
    //５５行目 キャンセルの挙動 reserve_settingsを値として入れる
    $('.delete-modal-hidden').val(reserve_settings);
    return false;
  });
  //閉じるボタンを押したら
  $('.js-modal-close').on('click', function () {
    //モーダルを閉じる
    $('.js-modal').fadeOut();
    return false;
  });

});
