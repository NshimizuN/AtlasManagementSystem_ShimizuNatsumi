$(function () {
  //ボタン要素を取得
  const buttonOpen = document.getElementById('modalOpen');
  //モーダル全体要素を取得
  const modal = document.getElementById('easyModal');
  //閉じる要素を取得
  const buttonClose = document.getElementsByClassName('modalClose')[0];

  // ボタンがクリックされた時
  buttonOpen.addEventListener('click', modalOpen);
  function modalOpen() {
    modal.style.display = 'block';
  }

  // 閉じるがクリックされた時
  buttonClose.addEventListener('click', modalClose);
  function modalClose() {
    modal.style.display = 'none';
  }

  // モーダルコンテンツ以外がクリックされた時
  addEventListener('click', outsideClose);
  function outsideClose(e) {
    if (e.target == modal) {
      modal.style.display = 'none';
    }
  }

});
