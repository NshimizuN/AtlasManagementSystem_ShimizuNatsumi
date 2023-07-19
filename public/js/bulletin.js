$(function () {
  $('.main_categories').click(function () {
    var category_id = $(this).attr('category_id');
    $('.category_num' + category_id).slideToggle();
  });

  //いいねボタンを押す
  $(document).on('click', '.like_btn', function (e) {
    e.preventDefault();
    $(this).addClass('un_like_btn');
    $(this).removeClass('like_btn');
    var post_id = $(this).attr('post_id');
    var count = $('.like_counts' + post_id).text();
    var countInt = Number(count);
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      method: "post",
      url: "/like/post/" + post_id,
      data: {
        post_id: $(this).attr('post_id'),
      },
    }).done(function (res) {
      console.log(res);
      $('.like_counts' + post_id).text(countInt + 1);
    }).fail(function (res) {
      console.log('fail');
    });
  });

  //いいねボタン いいね解除
  $(document).on('click', '.un_like_btn', function (e) {
    e.preventDefault();
    $(this).removeClass('un_like_btn');
    $(this).addClass('like_btn');
    var post_id = $(this).attr('post_id');
    var count = $('.like_counts' + post_id).text();
    var countInt = Number(count);

    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      method: "post",
      url: "/unlike/post/" + post_id,
      data: {
        post_id: $(this).attr('post_id'),
      },
    }).done(function (res) {
      $('.like_counts' + post_id).text(countInt - 1);
    }).fail(function () {

    });
  });

  //編集モーダル
  $('.edit-modal-open').on('click', function () {
    $('.js-modal').fadeIn();
    var post_title = $(this).attr('post_title');
    var post_body = $(this).attr('post_body');
    var post_id = $(this).attr('post_id');
    $('.modal-inner-title input').val(post_title);
    $('.modal-inner-body textarea').text(post_body);
    $('.edit-modal-hidden').val(post_id);
    return false;
  });
  $('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });

});

$('post-btn').hover(
  function () {
    $(this).css('color', 'red');
  },
  function () {
    $(this).css('color', '');
  }
);

// 投稿 ホバーして色を変える
$(function () {
  $('.post-btn').hover(function () {
    $(this).css('opacity', '1.0');
    $(this).css('transition', '0.3s');
  },
    function () {
      $(this).css('opacity', '');
      $(this).css('transition', '0.3s');
    });
});

// いいねした投稿 ホバーして色を変える
$(function () {
  $('.like-posts-btn').hover(function () {
    $(this).css('opacity', '1.0');
    $(this).css('transition', '0.3s');
  },
    function () {
      $(this).css('opacity', '');
      $(this).css('transition', '0.3s');
    });
});

// 自分の投稿 ホバーして色を変える
$(function () {
  $('.my-post-btn').hover(function () {
    $(this).css('opacity', '1.0');
    $(this).css('transition', '0.3s');
  },
    function () {
      $(this).css('opacity', '');
      $(this).css('transition', '0.3s');
    });
});

// 検索ボタン ホバーして色を変える
$(function () {
  $('.posts-search-btn').hover(function () {
    $(this).css('opacity', '1.0');
    // $(this).css('transform', 'scale(1.2)');
    $(this).css('transition', '0.3s');
  },
    function () {
      $(this).css('opacity', '');
      // $(this).css('transform', '');
      $(this).css('transition', '0.3s');
    });
});


// 掲示板 カテゴリーのプルダウン

$(function () {
  $('.toggle dt').on('click', function () {
    $(this).next('dd').slideToggle();
  })
});

// $(function () {
//   $('.sub_category').css("display", "none");
//   $('.main_category').on('click', function () {
//     $(this).next().slideToggle();
//   })
// });

//前回まで
// $(function () {
//   $('.main_category').click(function () {
//     // var category_id = $(this).attr('category_id');
//     $('.sub_inner').slideToggle();
//     $(this).toggleClass('open', 200);
//   });
// });

// $(function () {
//   $('.main_categories').click(function () {
//     var category_id = $(this).attr('category_id');
//     $('.category_num' + category_id).slideToggle();
//   });
