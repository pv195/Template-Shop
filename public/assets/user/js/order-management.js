$(document).ready(function () {
  $(".status_product")
    .unbind("click")
    .click(function (e) {
      var type = $(this).data("type");
      var route = $(this).attr("route");
      $(".status_product").removeClass("tab-active");
      $(this).addClass("tab-active");
      $.ajax({
        url: route,
        type: "GET",
        data: {
          type: type,
        },
        success: function (data) {
          $("#container_list_order").html(data);
          console.log(data);
        },
        error: function (xhr) {
          console.log(xhr.responseText);
        },
      });
    });

  $(".orderDetail")
    .unbind("click")
    .click(function (e) {
      const id = $(this).attr("data-id");
      var route = $(this).attr("route");
      $.ajax({
        url: route,
        type: "GET",
        data: {
          id: id,
        },
        success: function (data) {
          console.log(data);
          $(".details").html(data);
        },
        error: function (xhr) {
          console.log(xhr.responseText);
        },
      });
    });

  setTimeout(function () {
    $("div.order-alert").remove();
  }, 3000);
});
