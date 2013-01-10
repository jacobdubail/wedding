var $bg         = $("#bg"),
    $container  = $('#masonry'),
    n           = 3,
    getcolcount = function() {

      var w_w   = $(window).width();


      if ( w_w <= 480 ) {
        return 1;
      } else if ( w_w <= 768 && w_w > 480 ) {
        return 2;
      } else if ( w_w <= 1024 && w_w > 768) {
        return 2;
      } else if ( w_w <= 1200 && w_w > 1024) {
        return 3;
      } else {
        return 4;
      }
    };

n = getcolcount();

$container.imagesLoaded( function() {
  $container.isotope({
    itemSelector : '.item',
    masonry      : { columnWidth: $container.width() / n }
  });
});

$(window).smartresize(function(){
  n = getcolcount();

  $container.isotope({
    itemSelector : '.item',
    masonry      : { columnWidth: $container.width() / n }
  });

});



$('#filters').on( 'click', 'a', function(e) {
    var $this    = $(this),
        selector = $this.attr('data-filter');
    e.preventDefault();

    $container.isotope({ filter: selector });

    $this
      .parent()
      .siblings()
      .removeClass('active')
      .end()
      .end()
      .addClass('active');


  });




$bg.backstretch([
//    "/wp-content/themes/wedding/i/bg/291.jpg",
//    "/wp-content/themes/wedding/i/bg/121.jpg",
    "/wp-content/themes/wedding/i/bg/610.jpg",
    "/wp-content/themes/wedding/i/bg/271.jpg",
    "/wp-content/themes/wedding/i/bg/401.jpg",
    "/wp-content/themes/wedding/i/bg/421.jpg",
    "/wp-content/themes/wedding/i/bg/710.jpg",
    "/wp-content/themes/wedding/i/fore/151.jpeg",
    "/wp-content/themes/wedding/i/fore/501.jpeg",
    "/wp-content/themes/wedding/i/fore/481.jpeg",
    "/wp-content/themes/wedding/i/fore/201.jpeg",
    "/wp-content/themes/wedding/i/fore/341.jpeg",
    "/wp-content/themes/wedding/i/fore/371.jpeg",
    "/wp-content/themes/wedding/i/fore/101.jpeg",
    "/wp-content/themes/wedding/i/fore/511.jpeg"
  ], {
  fade: 750,
  duration: 7000
}).touchwipe({
  wipeLeft  : function() {
    $bg
      .data('backstretch')
      .prev();
  },
  wipeRight : function() {
    $bg
      .data('backstretch')
      .next();
  },
  wipeUp    : function() {
    $bg
      .data('backstretch')
      .prev();
  },
  wipeDown  : function() {
    $bg
      .data('backstretch')
      .next();
  }
});

$("body").on( 'keydown', function (event) {

    if ( event.keyCode === 37 ) { // left
      $(".left").addClass('hover');
    } else if ( event.keyCode === 39 ) { // right
      $(".right").addClass('hover');
    } else if ( event.keyCode === 38 || event.keyCode === 40 ) {
      $(".up,.down").addClass('hover');
    }

}).on('keyup', function() {
  var dir = null;
  $("#controls li").removeClass('hover');
  if ( event.keyCode === 37 ) { // left
      dir = 'left';
    } else if ( event.keyCode === 39 ) { // right
      dir = 'right';
    } else if ( event.keyCode === 38 || event.keyCode === 40 ) {
      dir = 'resume';
    }

    if ( dir === 'left' ) {
      $bg
        .data('backstretch')
        .pause()
        .prev();
    } else if ( dir === 'right' ) {
      $bg
        .data('backstretch')
        .pause()
        .next();
    } else if ( dir === 'resume' ) {
      $bg.data('backstretch').resume();
    }
});

$("#content_toggle").on('hover', function() {
  $("body").toggleClass('toggle_hover');
}).on('click', function() {
  $(".page-wrap").toggleClass('content_toggle');
  $(this).text('+');
});

$("#controls").on('hover', function() {
  $(this)
    .toggleClass('active');
});


