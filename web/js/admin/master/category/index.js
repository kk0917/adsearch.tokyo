(function () {
  /**
   * 削除機能
   *****************************************************************************************************/

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
