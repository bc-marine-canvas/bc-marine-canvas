import { DOM } from "../utils/dom";

export class Copyright {
  static copyrightSpanID = "#copyright-year";

  static setYear() {
    document.addEventListener("DOMContentLoaded", () => {
      const copyright = new this();

      copyright.setYear();
    });
  }

  constructor() {
    this.span = DOM.find(Copyright.copyrightSpanID);
    this.currentYear = (new Date()).getFullYear();
  }

  setYear() {
    if (!this.outdated()) return;

    this.span.textContent = this.currentYear;
  }

  outdated() {
    return this.html !== this.currentYear;
  }
}
