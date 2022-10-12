$(document).ready(function () {
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });
  $("a#add").click(function () {
    var link = $(this).attr("route");
    var id = $(this).closest("div.single-product").find("p#idProduct").text();
    $.ajax({
      type: "POST",
      url: link,
      data: {
        id: id,
      },
      success: function (data) {
        alert(data);
      },
      error: function (xhr) {
        console.log(xhr.responseText);
      },
    });
  });
});

$(document).ready(function () {
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });
  $("a#addCart").click(function () {
    var link = $(this).attr("route");
    var id = $(this).closest("div.blog-detail").find("p#idProduct").text();
    $.ajax({
      type: "POST",
      url: link,
      data: {
        id: id,
      },
      success: function (data) {
        alert(data);
      },
      error: function (xhr) {
        console.log(xhr.responseText);
      },
    });
  });
});
