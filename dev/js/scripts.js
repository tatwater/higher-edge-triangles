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
});