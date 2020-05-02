import Filters from '../lib/filters';

class Gallery {

  constructor() {
    Object.assign(this, Object.assign(Object.seal({
      filters: new Filters(),
    })));
  }

  clearFiltersListener() {
    this.filters.clearButton.addEventListener('click', () => {
      this.filters.clear();
    });
  }
}

export default {
  init() {
    const gallery = new Gallery();
    gallery.clearFiltersListener();
  },
  finalize() {},
};
