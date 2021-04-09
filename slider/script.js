var counter = 1;
function slideShowNextStart(target) {
  var images = document.querySelectorAll(".slideContainer");
  var dots = document.querySelectorAll(".slideShowDots");
  if (counter < images.length) counter++;
  else counter = 1;

  for (var i = 0; i < images.length; i++) {
    images[i].classList.add("inActive");
    images[i].classList.remove("active");
    dots[i].classList.remove("activeDot");
    dots[i].classList.add("inActiveDot");
  }
  var id, dotId;
  if (target > 0) {
    id = "slideImage_" + target;
    dotId = "dot_" + target;
  } else {
    id = "slideImage_" + counter;
    dotId = "dot_" + counter;
  }
  document.getElementById(id).classList.add("active");
  document.getElementById(id).classList.remove("inActive");
  document.getElementById(dotId).classList.add("activeDot");
  document.getElementById(dotId).classList.remove("inActiveDot");
}

function slideShowPrevStart(target) {
  var images = document.querySelectorAll(".slideContainer");
  var dots = document.querySelectorAll(".slideShowDots");
  if (counter > 1) counter--;
  else counter = images.length;

  for (var i = 0; i < images.length; i++) {
    images[i].classList.add("inActive");
    images[i].classList.remove("active");
    dots[i].classList.remove("activeDot");
    dots[i].classList.add("inActiveDot");
  }
  var id, dotId;
  if (target > 0) {
    id = "slideImage_" + target;
    dotId = "dot_" + target;
  } else {
    id = "slideImage_" + counter;
    dotId = "dot_" + counter;
  }
  document.getElementById(id).classList.add("active");
  document.getElementById(id).classList.remove("inActive");
  document.getElementById(dotId).classList.add("activeDot");
  document.getElementById(dotId).classList.remove("inActiveDot");
}
document.querySelector(".slideShowNext").addEventListener("click", function () {
  slideShowNextStart(0);
});

document.querySelector(".slideShowPrev").addEventListener("click", function () {
  slideShowPrevStart(0);
});

setInterval(slideShowNextStart, 4000);
