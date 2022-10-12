$(document).ready(function () {
  $("a#replyButton").click(function () {
    var userName = $(this).closest("div.button").find("input#userName").val();
    var parentId = $(this).closest("div.button").find("input#parentId").val();
    $("input#parent_id").val(parentId);
    $("h2.reply-title").text("Reply to " + userName + "'s comment");
  });

  $("li.edit-parent-comment").click(function () {
    var parentId = $(this).closest("div.content").find("input#productId").val();
    $("div#form-" + parentId).attr("style", "display: block");
    $("p#" + parentId).css("display", "none");
  });

  $(".cancel-parent-comment").click(function () {
    var parentId = $(this).closest("div.content").find("input#productId").val();
    $("div#form-" + parentId).attr("style", "display: none");
    $("p#" + parentId).css("display", "block");
  });

  $("li.edit-comment").click(function () {
    var childId = $(this).closest("div.content").find("input#productId").val();
    $("div#form-" + childId).attr("style", "display: block");
    $("p#" + childId).css("display", "none");
  });

  $(".cancel-comment").click(function () {
    var childId = $(this).closest("div.content").find("input#productId").val();
    $("div#form-" + childId).attr("style", "display: none");
    $("p#" + childId).css("display", "block");
  });
});
