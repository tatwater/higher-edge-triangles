/// <reference path="../../typings/jquery/jquery.d.ts"/>

$(document).ready(function() {
  $(".intro").on("click", function() {
    $(this).toggleClass("active");
  });
  $(".info").on("click", function() {
    $(this).toggleClass("active");
  });
});