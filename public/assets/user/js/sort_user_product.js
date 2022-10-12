$(document).ready(function () {
  $("th.sort").click(function (e) {
    e.preventDefault();
    var type = $(this).data("type");
    var value = $(this).data("value");
    var route = $(this).attr("route");
    if (type == "asc") {
      $(this).data("type", "desc");
    }
    if (type == "desc") {
      $(this).data("type", "asc");
    }
    $.ajax({
      url: route,
      type: "GET",
      data: {
        type: type,
        value: value,
      },
      success: function (data) {
        $("#tableProduct").html(data.html);
      },
      error: function (xhr) {
        console.log(xhr.responseText);
      },
    });
  });
});
