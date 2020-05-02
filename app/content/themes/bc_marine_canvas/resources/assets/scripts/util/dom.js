class DOM {

  static findAll(selector, scoped = true) {
    const query = scoped ? `:scope ${selector}` : selector;

    return document.querySelectorAll(query);
  }

  static find(selector) {
    return document.querySelector(selector);
  }

  static strip(text) {
    const parsedText = new DOMParser().parseFromString(text, 'text/html');

    return parsedText.body.textContent || text;
  }

  static newTextNode(text) {
    return document.createTextNode(text);
  }

  static newElement(type) {
    return document.createElement(type);
  }
}

export default DOM;
