// for event function
(function () {
  
  /**
   * tr(行)全体のクリッカブル&リンク先ページ遷移処理
   *****************************************************************************************************/
  document.querySelectorAll('tr[data-href]').forEach(function (tr) {
    tr.addEventListener('click', function(event) {
      // tr内のaタグのクリックは除く
      if (event.target !== 'a') {
        window.location.assign('/admin/event/detail.php?id=' + event.target.closest('tr').getAttribute('data-href'));
      }
    }, false);
  });

  /**
   * 開催中・開催予定イベントと過去イベントの表示切り替え処理
   *****************************************************************************************************/
  document.querySelectorAll('.nav-tabs li').forEach(function (li) {
    // ページロード時に開催中・開催予定イベントを初期表示
    switchTable(li);

    li.addEventListener('click', function(event) {
      // li内a要素の初期動作をキャンセル
      event.preventDefault();

      // 全liタブのactiveクラスを一旦削除し、クリックされたliタブにactiveクラスを設定
      document.querySelectorAll('.nav-tabs li').forEach(function (li2) {
        li2.classList.remove('active');
      });
      this.classList.add('active');

      switchTable(this);
    }, false);
  });

  /**
   * イベントテーブル表示切替
   * 
   * @param {elem} li クリックされたタブ
   */
  function switchTable(li) {
    // クリックされたliタブに該当する方のテーブルを表示
    var upcomingTable = document.getElementById('upcomingEvents');
    var pastEvents    = document.getElementById('pastEvents');

    if (li.classList.contains('upcoming') && li.classList.contains('active')) {
      pastEvents.style.display    = 'none';
      upcomingTable.style.display = 'block';
    } else if (li.classList.contains('past') && li.classList.contains('active')) {
      upcomingTable.style.display = 'none';
      pastEvents.style.display    = 'block';
    }
  }
})();