// for event_detail function
(function () {
  /**
   * イベント詳細画面
   *****************************************************************************************************/
   // イベント一覧ページで各イベントエリアをクリックした時の処理
   document.querySelectorAll('.event').forEach(function (value) {
     value.addEventListener('click', function() {
       // イベント詳細モーダル画面に情報を取得する（オブジェクトに集約）
       var event = {
         name:              this.querySelector('input[name="event_name"]').value,
         img:               this.querySelector('input[name="main_image_path"]').value,
         comment:           this.querySelector('input[name="comment"]').value,
         placeName:         this.querySelector('input[name="place_name"]').value,
         dateFrom:          this.querySelector('input[name="date_from"]').value,
         dateTo:            this.querySelector('input[name="date_to"]').value,
         closingDays:       this.querySelector('input[name="closing-days"]').value,
         businessTime:      this.querySelector('input[name="business-time"]').value,
         entryFee:          this.querySelector('input[name="entry-fee"]').value,
         url:               this.querySelector('input[name="url"]').value,
         zipCode:           this.querySelector('input[name="zip-code"]').value,
         address:           this.querySelector('input[name="address"]').value,
         accessInformation: this.querySelector('input[name="access-information"]').value
       }

       var detail = document.getElementById('eventDetailModal');
       detail.querySelector('h5').textContent                = event.name;
       detail.querySelector('.comment').innerHTML            = event.comment; // 改行が必要なのでtextContentはNG
       detail.querySelector('img').src                       = event.img;
       detail.querySelector('.place-name').textContent       = event.placeName;
       detail.querySelector('.duration').textContent         = event.dateFrom + ' - ' + event.dateTo;
       detail.querySelector('.closing-days').textContent     = '( 休館日：' + event.closingDays + ' )';
       detail.querySelector('.business-time').textContent    = event.businessTime;
       detail.querySelector('.entry-fee').textContent        = event.entryFee;
       detail.querySelector('.url').setAttribute('href', event.url);
       detail.querySelector('.url').textContent              = event.url;
       detail.querySelector('.zip-code').textContent         = event.zipCode;
       detail.querySelector('.address').textContent          = event.address;
       detail.querySelector('.access-information').innerHTML = event.accessInformation;

       // イベント詳細モーダル画面を表示する
       this.querySelector('button').click();

       // Google Map表示
       var mapDiv = document.getElementById('googleMap');
       var map = new google.maps.Map( mapDiv, { zoom: 15 });
       // 会場名を元に緯度経度を取得
       var geocoder = new google.maps.Geocoder();
       geocoder.geocode({'address':event.placeName}, function (results, status) { // 住所だと緯度経度が正確でない（マーカーがずれる）ため会場名で取得
         if (status == google.maps.GeocoderStatus.OK) {
           // 変換した緯度・経度情報を地図の中心に表示
           map.setCenter(results[0].geometry.location);

           // マーカー表示
           var marker = new google.maps.Marker({
             map: map,
             position: results[0].geometry.location,
             title: event.placeName
           });
         } else {
           console.log('Geocode was not successful for the following reason: ' + status);
         }
       });
     }, false);
   });
})();
