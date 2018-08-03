(function () {
  // ナビゲーションメニューをクリックしてカテゴリでソート
  document.getElementById('all').addEventListener('click', function () {
    $('.category').show('fast');
  }, false);
  document.getElementById('art').addEventListener('click', function () {
    $('.category').hide('fast');
    $('.art').show('fast');
  }, false);
  document.getElementById('design').addEventListener('click', function () {
    $('.category').hide('fast');
    $('.design').show('fast');
  }, false);
  document.getElementById('advertisement').addEventListener('click', function () {
    $('.category').hide('fast');
    $('.advertisement').show('fast');
  }, false);
})();
