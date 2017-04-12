$(document).ready(function(){

  function sidebarRezice(){
    var alturaTotal = $(window).height();
    $("#sidebar").css('height', (alturaTotal-120));
  }
  if ($('#sidebar').length) {
    sidebarRezice();
  $("#sidebar").mCustomScrollbar({theme:"minimal-dark"});
  $(window).resize(function() {
    sidebarRezice();
      $("#sidebar").mCustomScrollbar({theme:"minimal-dark"});
    });

    setTimeout(function(){
      $(".categoria_dump").hide();
      var cat = '<h3 class="title_cat">Categorías</h3>';
      $("#sidebar").prepend(cat);
      $('#sidebar').hcSticky({
        top: 70,
        onStart:function(){

        },
        onStop:function(){
          //console.log('Finalizando...');
        }
      });
    }, 200);
  }
  if ($('#sidebar_cnt').length) {
    setTimeout(function(){
      $('#sidebar_cnt').hcSticky({
        top: 0,
        onStart:function(){
          console.log('iniciando...');
        },
        onStop:function(){
          console.log('Finalizando...');
        }
      });
    }, 200);
  }
});

var obj = new Object();
obj = {
 sliderHome: function(){
  $('.slider-banner').slick({
    centerMode: true,
    centerPadding: '400px',
    dots: true,
    responsive: [
      {
        breakpoint: 1600,
        settings: {
          arrows: false,
          centerMode: true,
          centerPadding: '300px',
          slidesToShow: 1
        }
      },
      {
        breakpoint: 1400,
        settings: {
          arrows: false,
          centerMode: true,
          centerPadding: '200px',
          slidesToShow: 1
        }
      },
      {
        breakpoint: 1200,
        settings: {
          arrows: false,
          centerMode: true,
          centerPadding: '100px',
          slidesToShow: 1
        }
      },
      {
        breakpoint: 992,
        settings: {
          arrows: false,
          centerMode: true,
          centerPadding: '80px',
          slidesToShow: 1
        }
      },
      {
        breakpoint: 768,
        settings: {
          arrows: false,
          centerMode: true,
          centerPadding: '40px',
          slidesToShow: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          centerMode: true,
          centerPadding: '0px',
          slidesToShow: 1
        }
      }
    ]
  });
 },
 menuMovil: function(){
  var slideout = new Slideout({
    'panel': document.getElementById('wrapper'),
    'menu': document.getElementById('menu'),
    'padding': 256,
    'tolerance': 70
  });
  document.querySelector('.js-slideout-toggle').addEventListener('click', function() {
    slideout.toggle();
  });

  document.querySelector('.menu').addEventListener('click', function(eve) {
    if (eve.target.nodeName === 'A') { slideout.close(); }
  });
 },
 accordion: function(){
  function toggleChevron(e) {
    $(e.target).prev('.panel-heading').find("span").toggleClass('icon-down icon-up');
  }
  $('#accordion').on('hidden.bs.collapse', toggleChevron);
  $('#accordion').on('shown.bs.collapse', toggleChevron);
 },
  expandSearch:function(){
    var a=$(".sb-icon-search"),b=$(".sb-search-input"),c=$(".sb-search"),d=!1;
    a.click(function(){
      0==d?(c.addClass("sb-search-open"),b.focus(),d=!0):(c.removeClass("sb-search-open"),b.focusout(),d=!1)
    }),a.mouseup(function(){
      return!1
    }),c.mouseup(function(){
      return!1
    }),$(document).mouseup(function(){
      1==d&&($(".sb-icon-search").css("display","block"),a.click())
    })
  },
  ratingJS: function(valScore,statusEdit){
    $('#start_biia').raty({
      click: function(score, evt) {
        if(!og.saveCalificacion && !statusEdit){
            $.ajax({
              method: "POST",
              url: "/site/producto/calificacion",
              data:{'productoid':$(this).attr('class'),'score':score}
            }).done(function() {
                og.saveCalificacion = true;
            });
        }
      },
      'score':valScore
    });
  },
  respuestaUnica: function(element){
    var itemsId = $(element+' ul li a');
    itemsId.click(function(event){
      event.preventDefault();
      var items = $(this);
      var dataId = items.data('idp');
      itemsId.removeClass('active');
      items.addClass('active');
      itemsId.find('input').val('');
      items.find('input').val(dataId);
    });
  },
  respuestaMultiple: function(element){
    var multId = $(element+' ul li a');
    multId.click(function(event){
      event.preventDefault();
      var mult = $(this);
      var dataMultId = mult.data('idp');
      if($(this).hasClass('active')){
        mult.removeClass('active');
        mult.find('input').val('');
      }else{
        mult.addClass('active');
        mult.find('input').val(dataMultId);
      }
    });
  }
}
