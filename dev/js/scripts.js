/* global password */
/// <reference path="../../typings/jquery/jquery.d.ts"/>

$(document).ready(function() {
  var topicID = $("body").data("topic-id");
  
  // toggle intro panel
  $("[data-toggle='intro']").on("click", function() {
    $(".intro").toggleClass("active");
  });
  
  // toggle info panel
  $("[data-toggle='info']").on("click", function() {
    $(".info").toggleClass("active");
  });
  
  // toggle admin forms
  toggleForms();
  $(".form-switch button").each(function() {
    $(this).on("click", function() {
      $(this).siblings("button").removeClass("active");
      $(this).addClass("active");
      toggleForms();
    });
  });
  
  $("[data-hide='noticeText']").on("click", function() {
    $(".form-switch div").hide();
  });
  
  $("[name='category']").on("change", function() {
    console.log("HERE");
    switch ($(this).val()) {
      case "":
        $("[type='file']").removeClass("blue orange pink");
        break;
      case "My dream is":
        $("[type='file']").attr("class", "blue");
        break;
      case "My favorite class is":
        $("[type='file']").attr("class", "orange");
        break;
      case "My hobbies are":
        $("[type='file']").attr("class", "pink");
        break;
      default:
    }
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

function toggleForms() {
  $("form").hide();
  var activeForm = $(".form-switch .active").data("toggle");
  $("form[data-name='" + activeForm + "']").show();
}