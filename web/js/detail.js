// for event_detail function
(function () {
  /**
   * イベント詳細画面
   *****************************************************************************************************/
   // イベント一覧ページで各イベントエリアをクリックした時の処理
   document.querySelectorAll('.event').forEach(function (value) {
     value.addEventListener('click', function() {
       showEventDetail(this);
     }, false);
   });

  // PDFを出力する
  document.getElementById('createPdf').addEventListener('click', function () {
    createPdf();
  }, false);

  /**
   * イベント詳細モーダル画面を表示する
   *
   * @param {objecr} targetEvent クリックしたイベント要素
   */
  function showEventDetail(targetEvent) {
    // イベント詳細モーダル画面に情報を取得する（オブジェクトに集約）
    var event = {
      name:              targetEvent.querySelector('input[name="event_name"]').value,
      img:               targetEvent.querySelector('input[name="main_image_path"]').value,
      comment:           targetEvent.querySelector('input[name="comment"]').value,
      placeName:         targetEvent.querySelector('input[name="place_name"]').value,
      dateFrom:          targetEvent.querySelector('input[name="date_from"]').value,
      dateTo:            targetEvent.querySelector('input[name="date_to"]').value,
      closingDays:       targetEvent.querySelector('input[name="closing-days"]').value,
      businessTime:      targetEvent.querySelector('input[name="business-time"]').value,
      entryFee:          targetEvent.querySelector('input[name="entry-fee"]').value,
      url:               targetEvent.querySelector('input[name="url"]').value,
      zipCode:           targetEvent.querySelector('input[name="zip-code"]').value,
      address:           targetEvent.querySelector('input[name="address"]').value,
      accessInformation: targetEvent.querySelector('input[name="access-information"]').value
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
    targetEvent.querySelector('button').click();

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
  }

  /**
   * PDF出力機能 by pdfmake
   */
  function createPdf() {
    var eventName         = document.querySelector('.modal-body h5').textContent;
    var mainImage         = document.getElementById('mainImage');
    var dataUrl           = imageToBase64(mainImage, "image/png");
    var comment           = document.querySelector('.comment').textContent;
    var placeName         = document.querySelector('.place-name').textContent;
    var period            = document.querySelector('.duration').textContent + '\n' + document.querySelector('.closing-days').textContent;
    var businessTime      = document.querySelector('.business-time').textContent;
    var entryFee          = document.querySelector('.entry-fee').textContent;
    var url               = document.querySelector('.url').getAttribute('href');
    var zipCode           = document.querySelector('.zip-code').textContent;
    var address           = document.querySelector('.address').textContent;
    var accessInformation = document.querySelector('.access-information').textContent;

    pdfMake.fonts = {
      GenShin: {
        normal: 'GenShinGothic-Normal-Sub.ttf',
        bold: 'GenShinGothic-Normal-Sub.ttf',
        italics: 'GenShinGothic-Normal-Sub.ttf',
        bolditalics: 'GenShinGothic-Normal-Sub.ttf'
      }
    }
    defaultStyle = 'GenShin'

    var docDefinition = {
      header: {
        columns: [
          { text: 'http://adsearch.tokyo', style: 'header' }
        ]
      },

      content: [
        { text: eventName, style: 'eventName' },
        { image: dataUrl, width: 515, height: 343 },
        { text: comment, style: 'comment' },
        {
          table: {
            // headers are automatically repeated if the table spans over multiple pages
            // you can declare how many rows should be treated as headers
            headerRows: 1,
            widths: [ 100, '*' ],

            body: [
              [ { text: '会場' }, placeName ],
              [ { text: '開催期間' }, period ],
              [ { text: '開館時間' }, businessTime ],
              [ { text: '入場料' }, entryFee ],
              [ { text: '詳細URL' }, url ],
              [ { text: 'アクセス' }, zipCode + '\n' +  address + '\n' + accessInformation ]
            ]
          }
        }
      ],

      footer: {
        columns: [
          { text: 'http://adsearch.tokyo', style: 'footer' }
        ]
      },

      defaultStyle: {
        font: defaultStyle
      },

      styles: {
        header: {
          margin: [ 10, 10, 0, 0 ],
          alignment: 'left'
        },
        eventName: {
          fontSize: 22,
          bold: true,
          margin: [0, 0, 0, 10]
        },
        mainImage: {
          width: 300,
          height: 200
        },
        comment: {
          margin: [0, 10, 0, 10]
        },
        tableHeader: {
          background: '#CCCCCC'
        },
        footer: {
          margin: [ 0, 0, 10, 0 ],
          alignment: 'right'
        }
      }
    };

    pdfMake.createPdf(docDefinition).open();
  }

  /**
   * メイン画像img要素からdataUrlを取得する
   *
   * @param   {object} imageElem HTMLImageElement メイン画像img要素
   * @param   {string} mime_type 画像タイプ "image/png", "image/jpeg" etc
   * @returns {string} dataURL   PDF出力で使うdataURL
   */
  function imageToBase64(imageElem, mimeType) {
    // New Canvas
    var canvas = document.createElement('canvas');
    canvas.width = imageElem.width;
    canvas.height = imageElem.height;

    // Draw
    var ctx = canvas.getContext('2d');
    ctx.drawImage(imageElem, 0, 0, 870, 580);

    // Image Base64
    return canvas.toDataURL(mimeType);
  }
})();
