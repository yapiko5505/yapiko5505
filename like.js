// いいね用のJavaScript

 $(function() {
     // いいねがクリックされたとき
     $('.js-Like').click(function() {
         const this_obj = $(this);
         const tweet_id = $(this).data('tweet-id');
         const Like_id = $(this).data('Like-id');
         const Like_count_obj = $(this).parent().find('.js-Like-count');
         let Like_count = Number(Like_count_obj.html());
         if (Like_id) {
             // いいね!取り消し
             $.ajax ({
                 url: 'like.php',
                 type: 'POST',
                 data: {
                     'Like_id' : Like_id
                 },
                 timeout: 10000
             })
            //  取り消しが成功
            .done(() => {
                            //  いいね！カウントを減らす
                            Like_count--;
                            Like_count_obj.html(Like_count);
                            this_obj.data('Like-id', null);
                            // いいね!ボタンの色をグレーに変更
                            $(this).find('img').attr('src', '../views/img/icon-heart.svg');

                        })
                        .fail((data) => {
                            alert('処理中にエラーが発生しました。');
                            console.log(data);
                        })            
            
         } else {
             // いいね!付与
             $.ajax ({
                url: 'like.php',
                type: 'POST',
                data: {
                    'tweet_id' : tweet_id
                },
                timeout: 10000
            })
            // いいね！が成功
            .done((data) => {
                // いいね!カウントを増やす
                Like_count++;
                Like_count_obj.html(Like_count);
                this_obj.data('Like-id', data['Like_id']);
                // いいね!ボタンの色を青に変更
                $(this).find('img').attr('src', '../views/img/icon-heart-twitterblue.svg');
            })
            .fail((data) => {
                alert('処理中にエラーが発生しました。');
                console.log(data);
            })

         }
     })
 })