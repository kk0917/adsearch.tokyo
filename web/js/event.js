// for event function
(function () {

  /**
   * イベント一覧画面：tr(行)全体のクリッカブル&リンク先ページ遷移処理
   *****************************************************************************************************/
  document.querySelectorAll('tr[data-href]').forEach(function (tr) {
    tr.addEventListener('click', function(event) {
      // tr内のaタグのクリックは除く
      var a = tr.querySelector('a');
      if (event.target !== a) {
        window.location.assign('/admin/event/detail.php?id=' + event.target.closest('tr').getAttribute('data-href'));
      }
    }, false);
  });

  /**
   * イベント一覧画面：開催中・開催予定イベントと過去イベントの表示切り替え処理
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
   * イベント一覧画面：テーブル表示切替
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

  /**
   * イベント詳細画面：編集画面切り替え処理
   ****************************************************************************************************/
  if (document.querySelector('.editEvent')) {
    // 編集するボタンクリック時の処理
    document.querySelectorAll('.editEvent').forEach(function (editButton) {
      editButton.addEventListener('click', function(event) {
        event.preventDefault();

        // submitボタンの切り替え
        document.querySelectorAll('.editEvent').forEach(function (element) {
          element.value = '編集を実行する';
          element.classList.remove('btn-centering');
          element.classList.remove('btn-primary');
          element.classList.add('btn-warning');

          var div                = document.createElement('div');
          div.className          = 'btn-centering';
          var cancelButton       = document.createElement('button');
          cancelButton.innerText = 'やめる';
          cancelButton.className = 'btn btn-default cancelButton';

          element.parentNode.insertBefore(div, element);
          div.appendChild(cancelButton);
          div.appendChild(element);
        });
    
        // イベント名
        var eventName = document.querySelector('input[name="eventName"]');
        eventName.parentNode.removeChild(eventName.parentNode.firstChild);
        eventName.setAttribute('type', 'text');
    
        // カテゴリー
        // 
    
        // 開催日
        var dateFrom = document.querySelector('input[name="dateFrom"]');
        dateFrom.parentNode.removeChild(dateFrom.parentNode.firstChild);
        dateFrom.setAttribute('type', 'text');

        // 最終日
        var dateTo = document.querySelector('input[name="dateTo"]');
        dateTo.parentNode.removeChild(dateTo.parentNode.firstChild);
        dateTo.setAttribute('type', 'text');

        // 入場料
        var entryFee = document.querySelector('input[name="entryFee"]');
        entryFee.parentNode.removeChild(entryFee.parentNode.firstChild);
        entryFee.setAttribute('type', 'text');

        // 営業時間
        var businessTime = document.querySelector('input[name="businessTime"]');
        businessTime.parentNode.removeChild(businessTime.parentNode.firstChild);
        businessTime.setAttribute('type', 'text');

        // 休館日

        // 開催場所

        // 詳細URL

        // 詳細情報

        // ステータス

        // メイン画像

        // リスト画像

        // キャンセルボタンクリック時の処理
        document.querySelectorAll('.cancelButton').forEach(function (cancelButton) {
          cancelButton.addEventListener('click', function() {
            // submitボタンの切り替え
              // キャンセルボタンの削除
            document.querySelectorAll('.cancelButton').forEach(function (button) {
              button.parentNode.removeChild(button.parentNode.firstChild);
            });

            // 編集実行ボタン -> 編集ボタンに戻す
            document.querySelectorAll('.editEvent').forEach(function (button) {
              button.value = '編集する';
              button.classList.remove('btn-warning');
              button.classList.add('btn-primary');
              button.classList.add('btn-centering');
            });

            // イベント名
            var span       = document.createElement('span');
            span.innerText = eventName.value;
            eventName.parentNode.insertBefore(span, eventName);
            eventName.setAttribute('type', 'hidden');

            // カテゴリー

            // 開催日

            // 最終日

            // 入場料

            // 営業時間

            // 休館日

            // 開催場所

            // 詳細URL

            // 詳細情報

            // ステータス

            // メイン画像

            // リスト画像


          }, false);
        });

      }, false);
    });
  }
})();