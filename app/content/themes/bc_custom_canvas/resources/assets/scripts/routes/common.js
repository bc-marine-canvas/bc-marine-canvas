import DOM from '../util/dom';

class Common {

  static removePreload() {
    window.addEventListener('load', () => {
      document.body.classList.remove('preload');

      if (document.body.classList.length === 0) {
        document.body.removeAttribute('class');
      }
    });
  }

  constructor() {
    Object.assign(this, Object.assign(Object.seal({
      searchButtonId: '#toggle-search-button',
      searchButton: DOM.find('#toggle-search-button'),
      searchInputId: '#navbar-reveal-search-input',
      searchInput: DOM.find('#navbar-reveal-search-input'),
    })));
  }

  searchRevealListeners() {
    this.searchButton.addEventListener('click', () => {
      this.toggleSearchState();
    });

    document.body.addEventListener('click', (event) => {
      this.collapseSearch(event.target);
    });
  }

  toggleSearchState() {
    this.searchInput.classList.toggle('collapsed');
    this.searchInput.classList.toggle('revealed');

    if (this.searchInput.classList.contains('revealed')) {
      this.searchInput.focus();
    }
  }

  collapseSearch(eventTarget) {
    if (this.clickedOutsideSearch(eventTarget)) {
      this.searchInput.classList.add('collapsed');
      this.searchInput.classList.remove('revealed');

      this.searchInput.blur();
    }
  }

  clickedOutsideSearch(clickTarget) {
    const buttonClicked = clickTarget.closest(this.searchButtonId);
    const inputClicked = clickTarget.closest(this.searchInputId);

    return !buttonClicked && !inputClicked;
  }
}

export default {
  init() {
    const common = new Common();
    common.searchRevealListeners();
  },
  finalize() {
    Common.removePreload();
  },
};
