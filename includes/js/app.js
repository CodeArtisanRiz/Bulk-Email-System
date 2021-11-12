$(function () {
  $("#message-form").submit(function (e) {
    e.preventDefault();
    var form = this;
    $(".info-msg").text("sending email...");

    $.ajax({
      url: "./emailHandler.php",
      data: $(form).serializeArray(),
      method: "POST",
    }).done(function (response) {
      $(".info-msg").html(response);
    });
  });
});
