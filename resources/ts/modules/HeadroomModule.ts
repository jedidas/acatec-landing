import Headroom from "headroom.js";

export default function HeadroomModule() {
  var body = document.querySelector("body");

  if (body) {
    var headroom = new Headroom(body, {
      offset: 400,
    });
    headroom.init();
  }
}
