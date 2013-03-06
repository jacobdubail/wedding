var $bg         = $("#bg"),
    $container  = $('#masonry'),
    $filters    = $("#filters"),
    n           = 3,
    win_width   = $(window).width(),
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

function addBackstretch() {
  $bg.backstretch([
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0189.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0330.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0035.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0366.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0261.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0344.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0083.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0307.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0052.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0115.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0289.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0027.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0150.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0281.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0191.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0198.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0206.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0254.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0097.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0273.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0232.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0283.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0287.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0143.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0166.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0074.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0318.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0126.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0335.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0108.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0351.jpg",
      "/wp-content/themes/wedding/i/bg/JacobDanielle_0031.jpg"
    ], {
    fade: 750,
    duration: 7000
  });
}

if ( win_width > 768 ) {
  addBackstretch();
}


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

  if ( $(window).width() >= 768 ) {
    addBackstretch();
  }

});






$filters.on( 'click', 'a', function(e) {
    var $this    = $(this),
        selector = $this.attr('data-filter');
    //e.preventDefault();

    $container.isotope({ filter: selector });

    if ( $("body").hasClass('single-foxyshop_product') ) {
      window.location = "/registry#" + selector.substring(1);
      return;
    }

    $this
      .parent()
      .siblings()
      .removeClass('active')
      .end()
      .addClass('active');
  });

function get_current_filter() {
  var hash = window.location.hash;
  if ( hash ) {
    $filters.find( '.' + hash.substring(1) ).trigger('click');
    // window.location.hash = '';
  }
}
get_current_filter();


function set_current_filter() {
  var classList = $("body").attr("class").split(/\s+/);

  for (var i = 0; i < classList.length; i++) {
    if ( classList[i] === 'activity' ) {
      $filters.children().removeClass('active');
      $filters.find('.activity').parent().addClass('active');
    } else if ( classList[i] === 'lodging' ) {
      $filters.children().removeClass('active');
      $filters.find('.lodging').parent().addClass('active');
    } else if ( classList[i] === 'dining' ) {
      $filters.children().removeClass('active');
      $filters.find('.dining').parent().addClass('active');
    } else if ( classList[i] === 'transportation' ) {
      $filters.children().removeClass('active');
      $filters.find('.transportation').parent().addClass('active');
    }
  }
}
set_current_filter();




$(".entry img").parent().colorbox({
  maxWidth  : '90%',
  maxHeight : '90%'
});


// $("body").on( 'keydown', function (event) {

//     if ( event.keyCode === 37 ) { // left
//       $(".left").addClass('hover');
//     } else if ( event.keyCode === 39 ) { // right
//       $(".right").addClass('hover');
//     } else if ( event.keyCode === 38 || event.keyCode === 40 ) {
//       $(".up,.down").addClass('hover');
//     }

// }).on('keyup', function() {
//   var dir = null;
//   $("#controls li").removeClass('hover');
//   if ( event.keyCode === 37 ) { // left
//       dir = 'left';
//     } else if ( event.keyCode === 39 ) { // right
//       dir = 'right';
//     } else if ( event.keyCode === 38 || event.keyCode === 40 ) {
//       dir = 'resume';
//     }

//     if ( dir === 'left' ) {
//       $bg
//         .data('backstretch')
//         .pause()
//         .prev();
//     } else if ( dir === 'right' ) {
//       $bg
//         .data('backstretch')
//         .pause()
//         .next();
//     } else if ( dir === 'resume' ) {
//       $bg.data('backstretch').resume();
//     }
// });

$("#content_toggle").on('click', 'a', function() {
  $(".page-wrap").toggleClass('content_toggle');
  $(this).toggleClass('active');
});

// $("#controls").on('hover', function() {
//   $(this)
//     .toggleClass('active');
// });


