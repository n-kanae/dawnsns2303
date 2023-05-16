$(function () {
  //クリックで動く
  $('.name').click(function () {
    $(this).toggleClass('active');
    $('.g-nav').slideToggle();
    $('.arrow').toggleClass('active');
  });
});

const buttonOpen = document.getElementById('modalOpen');
const modal = document.getElementById('easyModal');
const buttonClose = document.getElementsByClassName('modalClose')[0];

// ボタンがクリックされた時
$(function () {
  $('.modalOpen').click(function () {
    let buttonOpen = $(this).data('target');
    let modal = document.getElementById(buttonOpen);
    modal.style.display = 'block';

    // バツ印がクリックされた時
    $('.modalClose').click(function () {
      modal.style.display = 'none';
    });

    // モーダルコンテンツ以外がクリックされた時
    addEventListener('click', outsideClose);

    function outsideClose(e) {
      if (e.target == modal) {
        modal.style.display = 'none';
      }
    }
  });
});
