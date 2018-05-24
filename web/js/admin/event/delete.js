// for event_delete function
(function () {
    /**
     * 削除機能
     *****************************************************************************************************/
    // 削除前確認画面モーダルウィンドウ表示時の設定（モーダルウィンドウ自体はBootstrap3利用）
    document.querySelectorAll('.delete-event').forEach(function (deleteButton) {
        deleteButton.addEventListener('click', function() {
            // 確認画面にテキスト追加・削除対象ID設定処理
            var targetId      = deleteButton.parentNode.parentNode.querySelector('#id').value;
            var eventNameAttr = deleteButton.parentNode.parentNode.querySelector('#eventName');
            document.querySelector('#eventDeleteModal .modal-body').textContent = eventNameAttr.value + ' を削除しますか？';
            document.querySelector('#eventDeleteModal #execDelete').value = targetId;
        }, false);
    });

    // 削除実行イベント
    document.getElementById('execDelete').addEventListener('click', function() { // TODO: 一覧画面では存在しない要素なのでエラーとなる
        var ajax = new XMLHttpRequest();

        ajax.open('GET', '/admin/event/delete.php?id=' + this.getAttribute('value'), true);
        ajax.onreadystatechange = execDelete;
        ajax.send(null);

        function execDelete() {
            if(ajax.readyState === XMLHttpRequest.DONE && ajax.status === 200) {
                window.alert('削除しました');
                location.replace('/admin/event');
            }
        };
    }, false);
})();