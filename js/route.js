(function ($) {
  var app = $.sammy(function () {
    this.get("/", function () {
      loadPage("home.php");
    });

    this.get("#/about", function () {
      loadPage("about.php");
    });
    this.get("#/test/:id", function () {
      loadPage("test.php?id=" + this.params["id"]);
    });
  });

  $(function () {
    app.run();
  });
})(jQuery);

function loadPage(path) {
  $("#body").load(path);
}
