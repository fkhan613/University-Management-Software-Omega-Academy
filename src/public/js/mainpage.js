// Wait for window load
$(window).load(function () {
  // Animate loader off screen
  $(".spinner").fadeOut("slow");
  $(".spinner-container").fadeOut("slow");
});

var title = document.querySelector("#title");
title = title.lenght;

function type(){
  while (true) {
    new TypeIt("#title", {
      lifeLike: false,
      speed: 0,
    })
      .type("W")
      .pause(173)
      .type("e")
      .pause(114)
      .type("l")
      .pause(90)
      .type("c")
      .pause(113)
      .type("o")
      .pause(124)
      .type("m")
      .pause(100)
      .type("e")
      .pause(122)
      .type(" ")
      .pause(167)
      .type("t")
      .pause(65)
      .type("o")
      .pause(104)
      .type(" ")
      .pause(214)
      .type("T")
      .pause(155)
      .type("h")
      .pause(73)
      .type("e")
      .pause(107)
      .type(" ")
      .pause(255)
      .type("O")
      .pause(151)
      .type("m")
      .pause(385)
      .type("e")
      .pause(191)
      .type("g")
      .pause(236)
      .type("a")
      .pause(304)
      .type(" ")
      .pause(272)
      .type("A")
      .pause(206)
      .type("c")
      .pause(168)
      .type("a")
      .pause(150)
      .type("d")
      .pause(132)
      .type("e")
      .pause(41)
      .type("m")
      .pause(168)
      .type("y")
      .pause(348)
      .type(".")
      .pause(1481)
      .delete(1)
      .pause(501)
      .delete(1)
      .pause(46)
      .delete(1)
      .pause(31)
      .delete(1)
      .pause(30)
      .delete(1)
      .pause(31)
      .delete(1)
      .pause(31)
      .delete(1)
      .pause(151)
      .delete(1)
      .pause(145)
      .delete(1)
      .pause(136)
      .delete(1)
      .pause(132)
      .delete(1)
      .pause(118)
      .delete(1)
      .pause(130)
      .delete(1)
      .pause(155)
      .delete(1)
      .pause(627)
      .type("B")
      .pause(154)
      .type("e")
      .pause(173)
      .type("s")
      .pause(195)
      .type("t")
      .pause(213)
      .type(" ")
      .pause(182)
      .type("A")
      .pause(177)
      .type("c")
      .pause(158)
      .type("a")
      .pause(182)
      .type("d")
      .pause(123)
      .type("e")
      .pause(103)
      .type("m")
      .pause(187)
      .type("y")
      .pause(653)
      .type(".")
      .go();
  }
}

type();



