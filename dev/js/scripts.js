/// <reference path="../../typings/jquery/jquery.d.ts"/>

$(document).ready(function() {
  // toggle intro slide
  $("[data-toggle='intro']").on("click", function() {
    $(".intro").toggleClass("active");
  });
  
  // toggle info slide
  $(".info").on("click", function() {
    $(this).toggleClass("active");
  });
  
// AJAX to request array of image addresses
  var prev = parseInt($(".category-title .arrow.up").parent("a").attr("href").split("=")[1]);
  var next = parseInt($(".category-title .arrow.down").parent("a").attr("href").split("=")[1]);
  var ignore = $(".gallery").find("img").attr("src");
  var topicID;
  
  // determine current topic for AJAX request
  if (next > prev || next == 1)
    topicID = prev + 1;
  else
    topicID = 1;
  
  // AJAX to retrieve list of topic gallery images
  $.get("getImages.php?topic_id=" + topicID, function(imageList) {
    imageList = imageList.split(",");
    
    // initialize Slick slider
    $('.gallery').slick({
      adaptiveHeight: false,
      arrows: false,
      autoplay: true,
      autoplaySpeed: 5000,
      cssEase: 'ease',
      dots: false,
      draggable: false,
      fade: true,
      infinite: true,
      pauseOnHover: false,
      slidesToShow: 1,
      slidesToScroll: 1,
      speed: 5000,
      swipe: false,
      touchMove: false
    });
    
    // populate gallery with all other images
    for (var i = 0; i < imageList.length; i++)
      if ("img/uploads/" + imageList[i] != ignore)
        $('.gallery').slick('slickAdd', '<img src="img/uploads/' + imageList[i] + '" />');
    
    // force advance
    setTimeout(function() {
      $(".gallery").slick('slickNext');
    }, 5000);
  });
});