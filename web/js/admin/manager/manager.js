// for manager function
(function () {
  /**
   * 追加画面
   *****************************************************************************************************/

  // 追加ボタンクリック時の編集画面ページ遷移
  document.querySelectorAll('.add').forEach(function (editButton) {
    editButton.addEventListener('click', function() {
      window.location.assign('/admin/manager/add.php');
    }, false);
  });

  /**
   * 編集画面
   *****************************************************************************************************/

  // 編集ボタンクリック時の編集画面ページ遷移
  document.querySelectorAll('.edit').forEach(function (editButton) {
    editButton.addEventListener('click', function() {
      window.location.assign('/admin/manager/edit.php?id=' + editButton.getAttribute('value'));
    }, false);
  });

  /**
   * 削除機能
   *****************************************************************************************************/

  // 削除前確認画面モーダルウィンドウの表示テキスト追加・削除対象ID設定処理（モーダルウィンドウ自体はBootstrap3利用）
  document.querySelectorAll('.delete-manager').forEach(function (deleteButton) {
    deleteButton.addEventListener('click', function() {
      var targetId = deleteButton.parentNode.parentNode.querySelector('td:nth-child(1)').innerText;
      var td       = deleteButton.parentNode.parentNode.querySelector('td:nth-child(2)');
      document.querySelector('#managerDeleteModal .modal-body').textContent = td.textContent + ' を削除しますか？';
      document.querySelector('#managerDeleteModal #execDelete').value = targetId;
    }, false);
  });

  // 削除実行イベント
  document.getElementById('execDelete').addEventListener('click', function() {
    var ajax = new XMLHttpRequest();

    ajax.open('GET', '/admin/manager/delete.php?id=' + this.getAttribute('value'), true);
    ajax.onreadystatechange = execDelete;
    ajax.send(null);

    function execDelete() {
      if(ajax.readyState === XMLHttpRequest.DONE && ajax.status === 200) {
        window.alert('削除しました');
        location.reload();
      }
    };
  }, false);
})();