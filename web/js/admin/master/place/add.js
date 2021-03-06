// for place_add function
(function () {
  /**
   * 会場追加機能
   *****************************************************************************************************/
  // Bootstrap3:modal不具合対応
    // 1. モーダル多層表示時に、オーバレイ->モーダル->オーバーレイ->モーダル->オーバーレイ...と交互に重なるようCSS:z-index値調整
  document.getElementById('placeAddArea').addEventListener('click', function(place) {
    if (place.target.getAttribute('data-toggle') == 'modal') {
      window.setTimeout(function () { // オーバーレイ要素が</body>直前に追加されるのを待つ
        // Bootstrap3モーダル要素CSS:z-index初期値を設定
        var defaultZindexValOfOverlay = 1040;
        var defaultZindexValOfModal = 1050;

        // 会場追加に関わるモーダル要素を取得
        var overlay     = document.querySelectorAll('.modal-backdrop');       // オーバーレイ要素は増減する
        var modalWindow = document.querySelectorAll('#placeAddArea .modal'); // モーダル画面要素は増減しない

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
  $('#placeAddConfirmModal').on('hidden.bs.modal', function () {
    $('body').addClass('modal-open');
  });

  // メイン画像・リスト画像選択時のプレビュー表示
  document.querySelectorAll('input[name="updateMainImage"], input[name="updateSubImage"]').forEach(function (selectButton) {
    selectButton.addEventListener('change', function (place) {
      var imgElem = '';
      switch (place.target.name) {
         case 'updateMainImage':
           imgElem = 'previewUpdateMainImage';
           break;
         case 'updateSubImage':
           imgElem = 'previewUpdateSubImage';
           break;
      }
      var preview = document.getElementById(imgElem);

      var reader = new FileReader();
      reader.addEventListener('load', function (place) {
        preview.setAttribute('src', place.target.result);
      });
      // 画像が選択された時はファイルをDataURLとして読み込み、画像がキャンセルされた時はプレビューを削除する
      place.target.files[0] ? reader.readAsDataURL(place.target.files[0]) : preview.setAttribute('src', place.target.result);
    }, false);
  });

  // バリデーションエラーメッセージモーダル画面を閉じる時に一緒に更新前確認モーダル画面も閉じる
  document.getElementById('closeErrorModal').addEventListener('click', function() {
    document.getElementById('backToInput').click();
  }, false);

  // 追加実行イベント
  document.getElementById('execAdd').addEventListener('click', function() {
    var addPlace = document.addPlaceForm;
    var sendData = new FormData(addPlace);

    var ajax = new XMLHttpRequest();
    ajax.open('POST', '/admin/master/place/add.php', true);
    ajax.onreadystatechange = execAdd;
    //ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8'); // POST送信する場合はurlencodeする必要無し
    ajax.send(sendData);

    function execAdd() {
      if(ajax.readyState === XMLHttpRequest.DONE) {
        if (ajax.status === 200) {
          window.alert('追加しました。');
          location.reload();
        } else {
          // エラーメッセージをモーダル画面で表示
            // エラーメッセージをエラーモーダル画面内に挿入
          var errors         = JSON.parse(ajax.responseText);
          var errorModalBody = document.querySelector('#placeAddValidationErrorModal .modal-body');
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
