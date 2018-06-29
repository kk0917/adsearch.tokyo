// for event_edit function
(function () {
  /**
   * イベント編集機能
   *****************************************************************************************************/
  // Bootstrap3:modal不具合対応
    // 1. モーダル多層表示時に、オーバレイ->モーダル->オーバーレイ->モーダル->オーバーレイ...と交互に重なるようCSS:z-index値調整
  document.getElementById('eventEditArea').addEventListener('click', function(event) {
    if (event.target.getAttribute('data-toggle') == 'modal') {
      window.setTimeout(function () { // オーバーレイ要素が</body>直前に追加されるのを待つ
        // Bootstrap3モーダル要素CSS:z-index初期値を設定
        var defaultZindexValOfOverlay = 1040;
        var defaultZindexValOfModal = 1050;

        // イベント編集に関わるモーダル要素を取得
        var overlay     = document.querySelectorAll('.modal-backdrop');       // オーバーレイ要素は増減する
        var modalWindow = document.querySelectorAll('#eventEditArea .modal'); // モーダル画面要素は増減しない

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
  $('#eventEditConfirmModal').on('hidden.bs.modal', function () {
    $('body').addClass('modal-open');
  });

  // メイン画像・リスト画像選択時のプレビュー表示
  document.querySelectorAll('input[name="updateMainImage"], input[name="updateListImage"]').forEach(function (selectButton) {
    selectButton.addEventListener('change', function (event) {
      var imgElem = '';
      switch (event.target.name) {
         case 'updateMainImage':
           imgElem = 'previewUpdateMainImage';
           break;
         case 'updateListImage':
           imgElem = 'previewUpdateListImage';
           break;
      }
      var preview = document.getElementById(imgElem);

      var reader = new FileReader();
      reader.addEventListener('load', function (event) {
        preview.setAttribute('src', event.target.result);
      });
      // 画像が選択された時はファイルをDataURLとして読み込み、画像がキャンセルされた時はプレビューを削除する
      event.target.files[0] ? reader.readAsDataURL(event.target.files[0]) : preview.setAttribute('src', event.target.result);
    }, false);
  });

  // 更新前確認画面モーダルウィンドウ表示時の設定（モーダルウィンドウ自体はBootstrap3利用）
  // var editButton = document.getElementById('editConfirm');
  // editButton.addEventListener('click', function() {
  //
  //   // 確認画面にテキスト追加・更新対象ID設定処理
  //   var targetId      = editButton.parentNode.parentNode.querySelector('input[name="id"]').value;
  //   var eventNameAttr = editButton.parentNode.parentNode.querySelector('input[name="eventName"]');
  //   document.querySelector('#eventEditConfirmModal .modal-body').textContent = eventNameAttr.value + ' を更新しますか？';
  //   document.querySelector('#eventEditConfirmModal #execUpdate').value = targetId;
  // }, false);

  // バリデーションエラーメッセージモーダル画面を閉じる時に一緒に更新前確認モーダル画面も閉じる
  document.getElementById('closeErrorModal').addEventListener('click', function() {
    document.getElementById('backToInput').click();
  }, false);

  // 更新実行イベント
  document.getElementById('execUpdate').addEventListener('click', function() {
    var updateEvent = document.editEventForm;
    var sendData = new FormData(updateEvent);

    var ajax = new XMLHttpRequest();
    ajax.open('POST', '/admin/event/edit.php', true);
    ajax.onreadystatechange = execUpdate;
    //ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8'); // POST送信する場合はurlencodeする必要無し
    ajax.send(sendData);

    function execUpdate() {
      if(ajax.readyState === XMLHttpRequest.DONE) {
        if (ajax.status === 200) {
          window.alert('更新しました。');
          location.reload();
        } else {
          // 更新確認モーダル画面（and オーバーレイ）を閉じる
          // document.getElementById('eventEditConfirmModal').classList.remove('in');
          // var overlays = document.body.querySelectorAll('.modal-backdrop');
          // var lastOverlay = overlays[(overlays.length - 1)]
          // lastOverlay.parentNode.removeChild(lastOverlay);

          // エラーメッセージをモーダル画面で表示
            // エラーメッセージをエラーモーダル画面内に挿入
          var errors         = JSON.parse(ajax.responseText);
          var errorModalBody = document.querySelector('#eventEditValidationErrorModal .modal-body');
          errorModalBody.innerHTML = ''; // bodyの中身をキレイにしておく
          errors.forEach(function (error) {
            var p = document.createElement('p');
            p.textContent = '・' + error;
            errorModalBody.appendChild(p);
          });
            // モーダル画面を表示させるために強制的にクリックイベントを発生させる
          document.getElementById('triggerErrorModal').click();
        }
      }
    };
  }, false);
})();
