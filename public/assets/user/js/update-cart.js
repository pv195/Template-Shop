$(document).ready(function () {
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });
  var subTotal = $("span.subTotal").text();
  var total = 0;
  $(".up").click(function () {
    var id = $(this).closest("tr").find("p.productId").text();
    var price = $(this).closest("tr").find("span.productPrice").text();
    var quantity = $(this).closest("tr").find("input.quantity").val();
    quantity = parseInt(quantity) + 1;
    total = (parseFloat(price) * parseFloat(quantity)).toFixed(1);
    $(this).closest("tr").find("input.quantity").val(quantity);
    $(this).closest("tr").find("span.totalCart").text(total);
    subTotal = (parseFloat(subTotal) + parseFloat(price)).toFixed(1);
    $("span.subTotal").text(subTotal);
    var link = $(this).attr("route");
    $.ajax({
      type: "POST",
      url: link,
      data: {
        id: id,
        quantity: quantity,
      },
    });
  });
  $(".down").click(function () {
    var id = $(this).closest("tr").find("p.productId").text();
    var price = $(this).closest("tr").find("span.productPrice").text();
    var quantity = $(this).closest("tr").find("input.quantity").val();
    quantity = parseFloat(quantity) - 1;
    if (quantity == 0) {
      if (confirm("Are You Sure to delete this")) {
        $(this).closest("tr").remove();
      } else {
        quantity = parseFloat(quantity) + 1;
        subTotal = (parseFloat(subTotal) + parseFloat(price)).toFixed(1);
      }
    }
    total = (parseFloat(price) * parseFloat(quantity)).toFixed(1);
    $(this).closest("tr").find("input.quantity").val(quantity);
    $(this).closest("tr").find("span.totalCart").text(total);
    subTotal = (parseFloat(subTotal) - parseFloat(price)).toFixed(1);
    $("span.subTotal").text(subTotal);
    var link = $(this).attr("route");
    $.ajax({
      type: "POST",
      url: link,
      data: {
        id: id,
        quantity: quantity,
      },
    });
  });
  $(".delete").click(function () {
    var id = $(this).closest("tr").find("p.productId").text();
    var price = $(this).closest("tr").find("span.productPrice").text();
    var quantity = $(this).closest("tr").find("input.quantity").val();
    subTotal = (
      parseFloat(subTotal) -
      parseFloat(price) * parseFloat(quantity)
    ).toFixed(1);
    $("span.subTotal").text(subTotal);
    quantity = 0;
    $(this).closest("tr").remove();
    var link = $(this).attr("route");
    $.ajax({
      type: "POST",
      url: link,
      data: {
        id: id,
        quantity: quantity,
      },
    });
  });
});
