/// <reference path="../../typings/jquery/jquery.d.ts"/>

$(document).ready(function() {
  $("[data-toggle='intro']").on("click", function() {
    $(".intro").toggleClass("active");
  });
  $(".info").on("click", function() {
    $(this).toggleClass("active");
  });
    
  $('.gallery').slick({
    adaptiveHeight: false,
    autoplay: true,
    autoplaySpeed: 3000,
    cssEase: 'ease',
    fade: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    speed: 500
  });
  
  // AJAX to request array of image addresses
  var prev = parseInt($(".category-title .arrow.up").parent("a").attr("href").split("=")[1]);
  var next = parseInt($(".category-title .arrow.down").parent("a").attr("href").split("=")[1]);
  var topicID;
  
  if (next > prev || next == 1)
    topicID = prev + 1;
  else
    topicID = 1;
    
  console.log(topicID);
    
  var ignore = $(".gallery").find("img").attr("src");
  
  $.get("getImages.php?topic_id=" + topicID, function(imageList) {
    imageList = imageList.split(",");
    
    for (var i = 0; i < imageList.length; i++)
      if ("img/uploads/" + imageList[i] != ignore) {
        console.log(imageList[i]);
        $('.gallery').slick('slickAdd', '<img src="img/uploads/' + imageList[i] + '" />');
      }
  });
});