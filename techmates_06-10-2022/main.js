// Back to top button index
$(window).scroll(function () {
  if ($(this).scrollTop() > 100) {
    $(".back-to-top").fadeIn("slow");
  } else {
    $(".back-to-top").fadeOut("slow");
  }
});
$(".back-to-top").click(function () {
  $("html, body").animate({ scrollTop: 0 }, 1500, "easeInOutExpo");
  return false;
});

// Back to top button product
$(window).scroll(function () {
  if ($(this).scrollTop() > 100) {
    $(".wat1").fadeIn("slow");
  } else {
    $(".awt").fadeOut("slow");
  }
});
$(".wat1").click(function () {
  $("html, body").animate({ scrollTop: 0 }, 1500, "easeInOutExpo");
  return false;
});
