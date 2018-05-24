(function () {
  /**
   * Ajax通信中ローディング画像の表示
   ******************************************************************/
  $(document).ajaxStart(function () {
    $('#loading').fadeIn();
  });

  /**
   * バリデーションのロジックModel
   *
   * @param attrs
   * @constructor
   ******************************************************************/
  var ValidationModel = function (attrs) {
    this.val = '';
    // 使用するvalidation patternを設定するオブジェクト
    this.attrs = {
      required: '',
      maxlength: 8,
      minlength: 4
    }
    this.listeners = {
      valid: [],
      invalid: []
    }
  };
  ValidationModel.prototype.set = function (val) {
    if (this.val === val) return;
    this.val = val;
    this.validate();
  };
  ValidationModel.prototype.validate = function () {
    var val;
    this.errors = []; // バリデーションエラーが出た項目を保存しておく配列

    // 各バリデーション判定メソッドをValidationから取り出しvalの引数を渡して実行する
    for (var key in this.attrs) {
      if (!this[key](val)) this.errors.push(key);
    }

    // バリデーション後、this.errorsの中身が空（エラーが無い）ならvalidイベントを通知し、空でなければinvalidイベントを通知する
    this.trigger(!this.errors.length ? 'valid' : 'invalid');
  }
  ValidationModel.prototype.on = function (event, func) {
    this.listeners[event].push(func);
  };
  ValidationModel.prototype.trigger = function (event) {
    $.each(this.listeners[event], function () { // TODO: Pure JavaScript置換
      this();
    });
  };
  // 判定処理
    // 必須
  ValidationModel.prototype.required = function () {
    return this.val !== '';
  };
    // 最大文字数
  ValidationModel.prototype.maxlength = function (num) {
    return num >= this.val.length;
  }
    // 最少文字数
  ValidationModel.prototype.minlength = function (num) {
    return num <= this.val.length;
  };


  /**
   * バリデーションのエラーメッセージView反映処理
   *
   * @param elem フォーム内各入力項目
   * @constructor
   ******************************************************************/
  var ValidationView = function (elem) {
    this.initialize(elem);
    this.handleEvents();
  };
  ValidationView.prototype.initialize = function (elem) {
    this.elem = elem;
    this.list = this.elem.nextElementSibling.

    // 各フォームのバリデーション属性(data-*)に必須requiredがあった場合はobjにプロパティとして追加する
    var obj = $(elem).data();
    if (elem.hasAttribute('data-required')) {
      obj['required'] = '';
    }

    // バリデーションModelにバリデーション属性を持つオブジェクトを引数に渡してインスタンス化
    this.validationModel = new ValidationModel(obj);
  };
  // DOMイベントを登録する
  ValidationView.prototype.handleEvents = function () {
    var self = this;

    this.elem.addEventListener('keyup', function (event) {
      self.onkeyup(event);
    });

    this.model.addEventListener('valid', function() {
      self.onValid();
    }, false);

    this.model.addEventListener('invalid', function() {
      self.onInvalid();
    }, false);
  };
  // keyupイベント発生時の処理
  ValidationView.prototype.onKeyup = function (event) {
    this.model.set(event.currentTarget.value);
  };

  ValidationView.prototype.onValid = function() {
    this.elem.classList.remove('error');
  };

  ValidationView.prototype.onInvalid = function() {
    var self = this;
    this.elem.classList.add('error');
    this.
  }
})();
