export class DOM {
  static find(selector) {
    return document.querySelector(selector);
  }

  static all(selector, scoped = true) {
    const query = scoped ? `:scope ${selector}` : selector;

    return Array.from(document.querySelectorAll(query));
  }
}
