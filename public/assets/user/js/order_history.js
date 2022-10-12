$(document).ready(function () {
  $(".order-tab")
    .unbind("click")
    .click(function () {
      $(".order-tab").removeClass("custom-tab-active");
      $(this).addClass("custom-tab-active");
      var status = $(this).data("value");
      var route = $(this).attr("route");
      $.ajax({
        url: route,
        type: "GET",
        data: {
          statusId: status,
        },
        success: function (data) {
          $("#tableOrder").html(data);
        },
      });
    });

  var statusId = $("div.stepper").attr("id");
  var classConfirmed = $(".ti-check").addClass("stepper__step-icon-success");
  var cssConfirmed = $(".confirmed").css({ "font-weight": "bold", "color": "#f7941d" });
  var classDelivering = $(".ti-truck").addClass("stepper__step-icon-success");
  var cssDelivering = $(".delivering").css({ "font-weight": "bold", "color": "#f7941d" });
  var classDelivered = $(".ti-package").addClass("stepper__step-icon-success");
  var cssDelivered = $(".delivered").css({ "font-weight": "bold", "color": "#f7941d" });
 
  if (statusId == 0) {
    $(".confirmed").css({ "font-weight": "normal", "color": "rgba(0,0,0,.8)" });
    $(".ti-check").removeClass("stepper__step-icon-success");
    $(".delivering").css({ "font-weight": "normal", "color": "rgba(0,0,0,.8)" });
    $(".ti-truck").removeClass("stepper__step-icon-success");
    $(".delivered").css({"font-weight": "normal", "color": "rgba(0,0,0,.8)"});
    $(".ti-package").removeClass("stepper__step-icon-success");
    $(".stepper__line-foreground").css("width", "0%");
  } else if (statusId == 1) {
    classConfirmed;
    cssConfirmed;
    $(".delivering").css({ "font-weight": "normal", "color": "rgba(0,0,0,.8)" });
    $(".ti-truck").removeClass("stepper__step-icon-success");
    $(".delivered").css({ "font-weight": "normal", "color": "rgba(0,0,0,.8)" });
    $(".ti-package").removeClass("stepper__step-icon-success");
    $(".stepper__line-foreground").css("width", "30%");
  } else if (statusId == 2) {
    classConfirmed;
    cssConfirmed;
    classDelivering;
    cssDelivering;
    $(".delivered").css({ "font-weight": "normal", "color": "rgba(0,0,0,.8)" });
    $(".ti-package").removeClass("stepper__step-icon-success");
    $(".stepper__line-foreground").css("width", "60%");
  } else {
    classConfirmed;
    cssConfirmed;
    classDelivering;
    cssDelivering;
    classDelivered;
    cssDelivered;
    $(".stepper__line-foreground").css("width", "90%");
  }
});
