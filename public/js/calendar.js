$(function () {

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
    $('.modal-inner-day span').text(getData);
    $('.modal-inner-day input').val(getData);
    $('.modal-inner-part span').text(getPart);
    $('.modal-inner-part input').val(getPart);
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
