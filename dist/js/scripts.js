function imagesLoaded(){setTimeout(function(){$(".gallery").slick("slickNext")},5e3)}function toggleForms(){$("form").hide();var i=$(".form-switch .active").data("toggle");$("form[data-name='"+i+"']").show()}$(document).ready(function(){var i=$("body").data("topic-id");$("[data-toggle='intro']").on("click",function(){$(".intro").toggleClass("active")}),$(".info").on("click",function(){$(this).toggleClass("active")}),toggleForms(),$(".form-switch button").each(function(){$(this).on("click",function(){$(this).siblings("button").removeClass("active"),$(this).addClass("active"),toggleForms()})}),$.get("includes/get-images.php?topic_id="+i,function(i){i=i.split(","),$(".gallery").slick({adaptiveHeight:!1,arrows:!1,autoplay:!0,autoplaySpeed:5e3,cssEase:"ease",dots:!1,draggable:!1,fade:!0,infinite:!0,pauseOnHover:!1,slidesToShow:1,slidesToScroll:1,speed:1e3,swipe:!1,touchMove:!1});for(var t=1,e=0;e<i.length;e++)"img/uploads/"+i[e]!=$(".gallery").find("img").attr("src")&&($(".gallery").slick("slickAdd",'<img src="img/uploads/'+i[e]+'" />'),$(".slick-track img").last().load(function(){t++,t==i.length&&imagesLoaded()}))})});