// for manager function
(function () {
  /**
   * 編集画面
   *****************************************************************************************************/

  // 編集ボタンクリック時の編集画面ページ遷移
  document.querySelectorAll('.edit').forEach(function (editButton) {
    editButton.addEventListener('click', function() {
      window.location.assign('/admin/staff/edit.php?id=' + editButton.getAttribute('value'));
    }, false);
  });

  /**
   * 削除機能
   *****************************************************************************************************/

  // 削除前確認画面モーダルウィンドウの表示処理
  document.querySelectorAll('.delete').forEach(function (deleteButton) {
    deleteButton.addEventListener('click', function() {
      var td = deleteButton.parentNode.parentNode.querySelector('td:nth-child(2)');
      document.querySelector('#modalTemplate p').textContent = td.textContent + ' を削除しますか？';
      
      // モーダルウィンドウ内の表示要素を取得
      var source = document.querySelector('#modalTemplate').innerHTML;

      // bodyタグ直前にオーバーレイ要素とモーダルウィンドウ要素を挿入
      var overlay = document.createElement('div');
      overlay.setAttribute('id', 'modalOverlay');

      var modalWindow = document.createElement('div');
      modalWindow.setAttribute('id', 'modalWindow');
      modalWindow.innerHTML = 
        '<div class="modalClose">×</div>'
      + '<div id="modalContents">'
        + source
      + '</div>';

      // モーダル内削除ボタンに必要な値を設定
      var modalDeleteButton = modalWindow.querySelector('#modalContents button');
      modalDeleteButton.setAttribute('id', 'execDelete'); // 削除実行時のトリガーとしてidをセット
      modalDeleteButton.setAttribute('value', deleteButton.getAttribute('value')); // 削除するmanager.id
      modalDeleteButton.textContent = '削除する';

      document.body.appendChild(overlay);
      document.body.appendChild(modalWindow);

      // 非表示にしていたオーバーレイ要素とモーダルウィンドウ要素をフェードイン表示
      var modalElements = document.querySelectorAll('#modalOverlay, #modalWindow');
      modalElements.forEach(function (element, index) {
        element.style.display = 'block';
        element.style.opacity = 0;

        if (index === 0) { // to overlay
          element.style.height = window.innerHeight + 'px';
          element.style.opacity = 0.7;

        } else if (index === 1) {
          element.style.opacity = 1;
        }
      });

      // ブラウザウィンドウの高さ変更に合わせてオーバーレイ要素の高さを調整する
      window.addEventListener('resize', function() {
        var modalOverlay = document.getElementById('modalOverlay');
        if (modalOverlay.style.display === 'block') {
          modalOverlay.style.height = window.innerHeight;
        }
      }, false);

      // モーダル閉じるボタンorオーバーレイをクリック時にモーダルウィンドウを閉じる
      document.querySelectorAll('#modalOverlay, .modalClose').forEach(function (clickElement) {
        clickElement.addEventListener('click', function() {
          document.querySelectorAll('#modalWindow, #modalOverlay').forEach(function (removeElement) {
            // TODO: add fade out animation...
            removeElement.parentNode.removeChild(removeElement);
          });
        }, false);
      });

      // 削除実行イベント
      document.getElementById('execDelete').addEventListener('click', function() {
        var ajax = new XMLHttpRequest();
        
        ajax.open('GET', '/admin/staff/delete.php?id=' + this.getAttribute('value'), true);
        ajax.onreadystatechange = execDelete;
        ajax.send(null);
        
        function execDelete() {
          if(ajax.readyState === XMLHttpRequest.DONE && ajax.status === 200) {
            window.alert('削除しました');
            location.reload();
          }
        };
      }, false);
    }, false);
  });
})();