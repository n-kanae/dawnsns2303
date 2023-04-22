$(function () {
  //クリックで動く
  $('.name').click(function () {
    $(this).toggleClass('active');
    $('.g-nav').slideToggle();
    $('.arrow').toggleClass('active');
  });
});
