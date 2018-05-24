// for event_edit function
(function () {
  /**
   * イベント編集機能
   *****************************************************************************************************/
  // Bootstrap3:modal不具合対応
    // 1. モーダル多層表示時に、オーバレイ->モーダル->オーバーレイ->モーダル->オーバーレイ...と交互に重なるようCSS:z-index値調整
  document.getElementById('eventEditArea').addEventListener('click', function(event) {
    window.setTimeout(function () { // オーバーレイ要素が</body>直前に追加されるのを待つ
      // Bootstrap3モーダル要素CSS:z-index初期値を設定
      var defaultZindexValOfOverlay = 1040;
      var defaultZindexValOfModal = 1050;

      // イベント編集に関わるモーダル要素を取得
      var overlay     = document.querySelectorAll('.modal-backdrop');
      var modalWindow = document.querySelectorAll('#eventEditArea .modal');

      if (overlay.length == 2) { // 多層表示時に限り各モーダル要素のCSS:z-index値を調整
        for (var i = 1; i < overlay.length; i++) { // 最下層のオーバーレイ＆モーダルより上のオーバーレイ＆モーダルに適用
          var addValue = 10 * i
          overlay[i].style.zIndex     = defaultZindexValOfOverlay + addValue;
          modalWindow[i].style.zIndex = defaultZindexValOfModal + addValue;
        }
      }
    }, 10);
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
          window.alert(JSON.parse(ajax.responseText));

          // 更新確認モーダル画面（and オーバーレイ）を閉じる
          document.getElementById('eventEditConfirmModal').classList.remove('in');
          var overlays = document.body.querySelectorAll('.modal-backdrop');
          var lastOverlay = overlays[(overlays.length - 1)]
          lastOverlay.parentNode.removeChild(lastOverlay);
        }
      }
    };
  }, false);
})();
