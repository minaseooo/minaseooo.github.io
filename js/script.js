/*ハンバーガーメニュー
(function () {
  $('#js-buttonHamburger').click(function () {
    $('body').toggleClass('is-drawerActive');

    if ($(this).attr('aria-expanded') == 'false') {
      $(this).attr('aria-expanded', true);
    } else {
      $(this).attr('aria-expanded', false);
    }
  });
}) ();*/ 


//アコーディオンをクリックした時の動作
$('.title').on('click', function() {//タイトル要素をクリックしたら
	var findElm = $(this).next(".box");//直後のアコーディオンを行うエリアを取得し
	$(findElm).slideToggle();//アコーディオンの上下動作
    
	if($(this).hasClass('close')){//タイトル要素にクラス名closeがあれば
		$(this).removeClass('close');//クラス名を除去し
	}else{//それ以外は
		$(this).addClass('close');//クラス名closeを付与
	}
});


  //modaal  
  //画像をクリックしたら現れる画面の設定  
$(".gallery-list").modaal({
  fullscreen:'true', //フルスクリーンモードにする
  before_open:function(){// モーダルが開く前に行う動作
    $('html').css('overflow-y','hidden');/*縦スクロールバーを出さない*/
  },
  after_close:function(){// モーダルが閉じた後に行う動作
    $('html').css('overflow-y','scroll');/*縦スクロールバーを出す*/
  }
});

$('.modal').modaal({
  type: 'inline',
  hide_close: false, // 閉じるボタンの表示・非表示の制御する
  background: '#000', // 背景オーバーレイの色を設定
  overlay_opacity: 0.8, // 背景オーバーレイの透明度を設定
  overlay_close: true, // 背景オーバーレイをクリックしてモーダルが閉じるかどうかの制御
  animation_speed: 100, // トリガーをクリックしてから、モーダルが表示されるまでのスピード
  background_scroll: false, // モーダルを開いている間、背景をスクロールできるかどうか
  width: 400, // モーダルの幅を設定
  height: 300, // モーダルの高さを設定
});

$('.js-modal-close , .modaal-content , .hide-area').on('click', function () {
  // モーダルを閉じる
  $('.modal').modaal('close');
})


// スクロールフェードイン
function showElementAnimation() {

  var element = document.getElementsByClassName('fade-in');
  if (!element) return;

  var showTiming = window.innerHeight > 768 ? 200 : 60;
  var scrollY = window.pageYOffset;
  var windowH = window.innerHeight;

  for (var i = 0; i < element.length; i++) {
      var elemClientRect = element[i].getBoundingClientRect(); var elemY = scrollY + elemClientRect.top; if (scrollY + windowH - showTiming > elemY) {
          element[i].classList.add('scroll-in');
      } else if (scrollY + windowH < elemY) {
      }
  }
}
showElementAnimation();
window.addEventListener('scroll', showElementAnimation);

