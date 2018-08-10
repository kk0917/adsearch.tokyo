(function () {
  // ナビゲーションメニューをクリックしてカテゴリでソート
    // all
  document.getElementById('all').addEventListener('click', function () {
    $('.category').fadeIn('fast');
  }, false);
    // art
  document.getElementById('art').addEventListener('click', function () {
    $('.category').fadeOut('fast');
    $('.art').fadeIn('fast');
  }, false);
    // design
  document.getElementById('design').addEventListener('click', function () {
    $('.category').fadeOut('fast');
    $('.design').fadeIn('fast');
  }, false);
    // advertisement
  document.getElementById('advertisement').addEventListener('click', function () {
    $('.category').fadeOut('fast');
    $('.advertisement').fadeIn('fast');
  }, false);
})();
