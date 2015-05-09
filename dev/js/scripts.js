/// <reference path="../../typings/jquery/jquery.d.ts"/>

$(document).ready(function() {
  $("[data-toggle='intro']").on("click", function() {
    $(".intro").toggleClass("active");
  });
  $(".info").on("click", function() {
    $(this).toggleClass("active");
  });
});