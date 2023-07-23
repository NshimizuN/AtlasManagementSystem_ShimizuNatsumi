// ユーザープロフィール 選択科目のプルダウン
$(function () {
  $('.search_conditions').click(function () {
    $('.search_conditions_inner').slideToggle();
  });

  $('.subject_edit_btn').click(function () {
    $('.subject_inner').slideToggle();
    $(this).toggleClass('open', 200);
  });

});

// 条件追加のプルダウン
$(function () {
  $('.category_conditions').click(function () {
    $('.conditions-box').slideToggle();
  });

  $('.conditions-title-box').click(function () {
    $('.conditions-box').slideToggle();
    $(this).toggleClass('open', 200);
  });
});
