$(document).ready(function () {

  $("main#spapp > section").height($(document).height() - 60);

  var app = $.spapp({ pageNotFound: 'error_404' }); // initialize

  // define routes
  app.route({ view: 'main', load: 'main.html' });
  app.route({ view: 'reviews', load: 'reviews.html' });

  // run app
  app.run();

});