

/* View in fullscreen */
function openFullscreen(elem) {
  if (elem.requestFullscreen !== null) {
    elem.requestFullscreen();
  } else if (elem.webkitRequestFullscreen !== null) { /* Safari */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen !== null) { /* IE11 */
    elem.msRequestFullscreen();
  }
}

/* Close fullscreen */
function closeFullscreen() {
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.webkitExitFullscreen) { /* Safari */
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) { /* IE11 */
    document.msExitFullscreen();
  }
}


$(document).ready(function () {
  // elem = document.documentElement;

  // if (elem === null) {
  //     alert("elem is Null");
  // }

  // if (elem.requestFullscreen === null) {
  //     alert("requestFullscreen is Null");
  // }

  // if (elem.webkitRequestFullscreen === null) {
  //     alert("webkitRequestFullscreen is Null");
  // }

  // if (elem.msRequestFullscreen === null) {
  //     alert("msRequestFullscreen is Null");
  // }

  // openFullscreen(elem);


  $('#carousel-prd-stat').carousel({
    interval: 10000
  });

  $('#carousel-chart').carousel({
    interval: 10000
  });

  $('#carousel-picture').carousel({
    interval: 5000
  });

  // $('.noti-marquee').marquee({
  //   // Duration of the animation
  //   duration: 5000,

  //   // Space in pixels between the tickers
  //   gap: 20,

  // });
});

