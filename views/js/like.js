// いいね用のJavaScript

 $(function() {
     // いいねがクリックされたとき
     $('.js-Like').click(function() {
         const this_obj = $(this);
         const Like_id = $(this).data('Like-id');
         const Like_count_obj = $(this).parent().find('.js-Like-count');
         let Like_count = Number(Like_count_obj.html());
         if (Like_id) {
             // いいね!取り消し
             // いいね!カウントを減らす
             Like_count--;
             Like_count_obj.html(Like_count);
             this_obj.data('Like-id', null);
             // いいね!ボタンの色をグレーに変更
             $(this).find('img').attr('src', '../views/img/icon-heart.svg');
         } else {
             // いいね!付与
             // いいね!カウントを増やす
             Like_count++;
             Like_count_obj.html(Like_count);
             this_obj.data('Like-id', true);
             // いいね!ボタンの色を青に変更
             $(this).find('img').attr('src', '../views/img/icon-heart-twitterblue.svg');
         }
     })
 })