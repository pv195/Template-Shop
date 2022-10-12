$(document).ready(function () {
  $("#filter").change(function () {
    let filter = $(this).children("option:selected").val();
    let route = $(this).attr("route");
    $.ajax({
      type: "GET",
      url: route,
      data: {
        filter: filter,
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
