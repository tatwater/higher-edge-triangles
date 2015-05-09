/// <reference path="../../typings/jquery/jquery.d.ts"/>

$(document).ready(function() {
  $(".info").on("click", function() {
    $(this).toggleClass("active");
  });
});