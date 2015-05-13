/* global password */
/// <reference path="../../typings/jquery/jquery.d.ts"/>

$(document).ready(function() {
  var topicID = $("body").data("topic-id");
  
  // toggle intro panel
  $("[data-toggle='intro']").on("click", function() {
    $(".intro").toggleClass("active");
  });
  
  // toggle info panel
  $(".info").on("click", function() {
    $(this).toggleClass("active");
  });
  
  // AJAX to retrieve list of gallery image names
  $.get("includes/get-images.php?topic_id=" + topicID, function(imageList) {
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
      speed: 1000,
      swipe: false,
      touchMove: false
    });
    
    // populate gallery with all images that aren't the placeholder
    var numLoaded = 1;
    for (var i = 0; i < imageList.length; i++)
      if ("img/uploads/" + imageList[i] != $(".gallery").find("img").attr("src")) {
        $('.gallery').slick('slickAdd', '<img src="img/uploads/' + imageList[i] + '" />');
        $(".slick-track img").last().load(function() {
          numLoaded++;
          if (numLoaded == imageList.length)
            imagesLoaded();
        });
      }
  });
});

function imagesLoaded() {
  // Force gallery advance
  setTimeout(function() {
    $(".gallery").slick('slickNext');
  }, 5000);
}