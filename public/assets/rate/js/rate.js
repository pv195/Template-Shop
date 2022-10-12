$(document).ready(function () {
  $(".ratings_stars").hover(
    function () {
      $(this).prevAll().andSelf().addClass("ratings_hover");
    },
    function () {
      $(this).prevAll().andSelf().removeClass("ratings_hover");
    }
  );

  $(".ratings_stars").click(function () {
    let authenticated = $("#authenticated").val();
    if (authenticated) {
      var rate = $(this).attr("value_rate");
      var route = $(this).closest(".vote").attr("route");
      var productId = $(this).closest(".vote").attr("id");
      if ($(this).hasClass("ratings_over")) {
        $(".ratings_stars").removeClass("ratings_over");
        $(this).prevAll().andSelf().addClass("ratings_over");
      } else {
        $(this).prevAll().andSelf().addClass("ratings_over");
      }
      $.ajax({
        url: route,
        type: "GET",
        data: {
          rate: rate,
          productId: productId,
        },
        success: function (data) {
          alert(data);
        },
      });
    } else {
      alert(trans("messages.rate.login"));
    }
  });
});
