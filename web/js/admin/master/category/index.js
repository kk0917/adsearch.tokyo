(function () {
  /**
   * 編集機能
   *****************************************************************************/
  document.querySelectorAll('.edit').forEach(function (editButton) {
    editButton.addEventListener('click', function() {
      // 編集モーダル画面に編集対象IDとカテゴリ名をセット
      var targetId     = editButton.parentNode.parentNode.querySelector('td:nth-child(1)').innerText;
      var categoryName = editButton.parentNode.parentNode.querySelector('td:nth-child(2)').innerText;
      document.querySelector('input[name="id"]').value = targetId;
      document.querySelector('#categoryEditModal input[name="name"]').value = categoryName;
    }, false);
  });
  // Bootstrap3:modal不具合対応
    // 1. モーダル多層表示時に、オーバレイ->モーダル->オーバーレイ->モーダル->オーバーレイ...と交互に重なるようCSS:z-index値調整
  document.getElementById('categoryEditArea').addEventListener('click', function(event) {
    if (event.target.getAttribute('data-toggle') == 'modal') {
      window.setTimeout(function () { // オーバーレイ要素が</body>直前に追加されるのを待つ
        // Bootstrap3モーダル要素CSS:z-index初期値を設定
        var defaultZindexValOfOverlay = 1040;
        var defaultZindexValOfModal = 1050;

        // イベント編集に関わるモーダル要素を取得
        var overlay     = document.querySelectorAll('.modal-backdrop');       // オーバーレイ要素は増減する
        var modalWindow = document.querySelectorAll('#categoryEditArea .modal'); // モーダル画面要素は増減しない

        if (overlay.length >= 2) { // 多層表示時に限り各モーダル要素のCSS:z-index値を調整
          for (var i = 0; i < modalWindow.length; i++) {
            var addValue = i == 0 ? 0 : 10 * (1 + i);

            // 要素の増減有無に応じたz-indexの設定をする必要がある
            if (i < overlay.length) { overlay[i].style.zIndex = defaultZindexValOfOverlay + addValue; }
            if (modalWindow[i].classList.contains('in')) { modalWindow[i].style.zIndex = defaultZindexValOfModal + addValue; }
          }
        }
      }, 200); // モーダル要素が表示（classに in が追加される）されるのをこのミリ秒まで待つ必要がある
    }
  }, false);
    // 2. 確認モーダル閉じた際に入力モーダルがスクロール不可になる問題を解決
  $('#categoryEditConfirmModal').on('hidden.bs.modal', function () {
    $('body').addClass('modal-open');
  });

  // バリデーションエラーメッセージモーダル画面を閉じる時に一緒に更新前確認モーダル画面も閉じる
  document.getElementById('closeEditErrorModal').addEventListener('click', function() {
    document.getElementById('editBackToInput').click();
  }, false);

  // 更新実行イベント
  document.getElementById('execUpdate').addEventListener('click', function() {
    var updateCategory = document.editCategoryForm;
    var sendData = new FormData(updateCategory);

    var ajax = new XMLHttpRequest();
    ajax.open('POST', '/admin/master/category/edit.php', true);
    ajax.onreadystatechange = execUpdate;
    //ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8'); // POST送信する場合はurlencodeする必要無し
    ajax.send(sendData);

    function execUpdate() {
      if(ajax.readyState === XMLHttpRequest.DONE) {
        if (ajax.status === 200) {
          window.alert('更新しました。');
          // location.reload();
        } else {
          // エラーメッセージをモーダル画面で表示
            // エラーメッセージをエラーモーダル画面内に挿入
          var errors         = JSON.parse(ajax.responseText);
          var errorModalBody = document.querySelector('#categoryEditValidationErrorModal .modal-body');
          errorModalBody.innerHTML = ''; // bodyの中身をキレイにしておく
          errors.forEach(function (error) {
            var p = document.createElement('p');
            p.textContent = '・' + error;
            errorModalBody.appendChild(p);
          });
            // モーダル画面を表示させるために強制的にクリックイベントを発生させる
          document.getElementById('triggerEditErrorModal').click();
        }
      }
    };
  }, false);

  /**
   * 削除機能
   *****************************************************************************/

  // 削除前確認画面モーダルウィンドウの表示テキスト追加・削除対象ID設定処理（モーダルウィンドウ自体はBootstrap3利用）
  document.querySelectorAll('.delete-category').forEach(function (deleteButton) {
    deleteButton.addEventListener('click', function() {
      var targetId = deleteButton.parentNode.parentNode.querySelector('td:nth-child(1)').innerText;
      var td       = deleteButton.parentNode.parentNode.querySelector('td:nth-child(2)');
      document.querySelector('#categoryDeleteModal .modal-body').textContent = td.textContent + ' を削除しますか？';
      document.querySelector('#categoryDeleteModal #execDelete').value = targetId;
    }, false);
  });

  // 削除実行イベント
  document.getElementById('execDelete').addEventListener('click', function() {
    var ajax = new XMLHttpRequest();

    ajax.open('GET', '/admin/master/category/delete.php?id=' + this.getAttribute('value'), true);
    ajax.onreadystatechange = execDelete;
    ajax.send(null);

    function execDelete() {
      if(ajax.readyState === XMLHttpRequest.DONE) {
        if (ajax.status === 200) {
          window.alert('削除しました');
          location.reload();
        }
      }
    };
  }, false);
})();
