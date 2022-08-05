import { DOM } from "../utils/dom";

export class Touchable {
  static touchableClass = ".touchable";
  static touchedClass = ".touched";

  static addTouchedListener() {
    document.addEventListener("DOMContentLoaded", () => {
      const touchables = DOM.all(Touchable.touchableClass) || [];

      if (touchables.empty()) return;

      Touchable.addTouchListener(touchables);
      Touchable.addUntouchListener();
    });
  }

  static addTouchListener(touchables) {
    touchables.forEach((element) => {
      element.addEventListener("touchstart", (e) => {
        if (Touchable.touched(element)) return;

        e.preventDefault();

        Touchable.touch(element);
      }, false);
    });
  }

  static addUntouchListener() {
    document.body.addEventListener("touchstart", (e) => {
      const touchableTouched = e.target.closest(Touchable.touchableClass);

      if (!touchableTouched) {
        Touchable.clearTouches();
      }
    });
  }

  static touched(element) {
    const alreadyTouched = element.classList.contains("touched");

    Touchable.clearTouches();

    return alreadyTouched;
  }

  static touch(element) {
    element.classList.add("touched");
  }

  static clearTouches() {
    const touched = DOM.all(Touchable.touchedClass) || [];

    touched.forEach((element) => {
      element.classList.remove("touched");

      if (element.classList.length === 0) {
        element.removeAttribute("class");
      }
    });
  }
}
