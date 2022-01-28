/////////////////////////////////////
// フォロー用のJavaScript
///////////////////////////////////////
 
$(function () {
    $('.js-follow').click(function () {
        const this_obj = $(this);
        const followed_user_id = $(this).data('followed-user-id');
        const follow_id = $(this).data('follow-id');
        cache: false
        if (follow_id) {
            // フォロー取り消し
            $.ajax({
                url: 'follow.php',
                type: 'POST',
                data: {
                    'follow_id': follow_id
                },
                timeout: 10000
            })
                // 取り消し成功
                .done(() => {
                    // フォローボタンを白にする
                    this_obj.addClass('btn-reverse');
                    // フォローボタンの文言変更
                    this_obj.text('フォローする');
                    // フォローIDを削除
                    this_obj.data('follow-id', null);
                })
                // 取り消し失敗
                .fail((data) => {
                    alert('処理中にエラーが発生しました。');
                    console.log(data);
                });
        } else {
            // フォローする
            $.ajax({
                url: 'follow.php',
                type: 'POST',
                data: {
                    'followed_user_id': followed_user_id
                },
                timeout: 10000
            })
                // フォロー成功
                .done((data) => {
                    // フォローボタンを青にする
                    this_obj.removeClass('btn-reverse');
                    // フォローボタンの文言変更
                    this_obj.text('フォローを外す');
                    // フォローIDを付与
                    this_obj.data('follow-id', data['follow_id']);
                })
                // フォロー失敗
                .fail((data) => {
                    alert('処理中にエラーが発生しました。');
                    console.log(data);
                });
        }
    })
});