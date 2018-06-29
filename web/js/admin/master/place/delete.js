// for event_delete function
(function () {
    /**
     * 削除機能
     *****************************************************************************************************/
    // 削除前確認画面モーダルウィンドウ表示時の設定（モーダルウィンドウ自体はBootstrap3利用）
    document.querySelectorAll('.delete-place').forEach(function (deleteButton) {
        deleteButton.addEventListener('click', function() {
            // 確認画面にテキスト追加・削除対象ID設定処理
            var targetId      = deleteButton.parentNode.parentNode.querySelector('#id').value;
            var placeNameAttr = deleteButton.parentNode.parentNode.querySelector('#name');
            document.querySelector('#placeDeleteConfirmModal .modal-body').textContent = placeNameAttr.value + ' を削除しますか？';
            document.querySelector('#placeDeleteConfirmModal #execDelete').value = targetId;
        }, false);
    });

    // 削除実行イベント
    document.getElementById('execDelete').addEventListener('click', function() { // TODO: 一覧画面では存在しない要素なのでエラーとなる
        var ajax = new XMLHttpRequest();

        ajax.open('GET', '/admin/master/place/delete.php?id=' + this.getAttribute('value'), true);
        ajax.onreadystatechange = execDelete;
        ajax.send(null);

        function execDelete() {
            if(ajax.readyState === XMLHttpRequest.DONE) {
                if (ajax.status === 200) {
                  window.alert('削除しました');
                  location.replace('/admin/master/place');
                } else {
                  window.alert('エラーが発生しました。はじめからやり直してください。');
                  location.replace();
                }
            }
        };
    }, false);
})();
