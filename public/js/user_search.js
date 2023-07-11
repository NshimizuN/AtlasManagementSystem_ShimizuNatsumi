$(function () {
  $('.search_conditions').click(function () {
    $('.search_conditions_inner').slideToggle();
  });

  $('.subject_edit_btn').click(function () {
    $('.subject_inner').slideToggle();
  });

});

// 掲示板 カテゴリーのプルダウン
$(function () {
  $("ul.sub").hide();
  $("ul.menu li").hover(function () {
    $("ul:not(:animated)", this).slideDown("fast")
  },
    function () {
      $("ul", this).slideUp("fast");
    })

});
