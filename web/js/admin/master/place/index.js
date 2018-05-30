// for place index function
(function () {
  /**
   * 会場一覧画面：tr(行)全体のクリッカブル&リンク先ページ遷移処理
   *****************************************************************************************************/
  document.querySelectorAll('tr[data-href]').forEach(function (tr) {
    tr.addEventListener('click', function(event) {
      // tr内のaタグのクリックは除く
      var a = tr.querySelector('a');
      if (event.target !== a) {
        window.location.assign('/admin/master/place/detail.php?id=' + event.target.closest('tr').getAttribute('data-href'));
      }
    }, false);
  });
})();
