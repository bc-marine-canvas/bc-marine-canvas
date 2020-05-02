import Gutenberg from './lib/gutenberg';

class Admin {
  constructor(options = {}) {
    Object.assign(this, Object.assign(Object.seal({
      gutenberg: new Gutenberg(),
    }), options));
  }

  gutenbergListener() {
    window.addEventListener('load', () => this.gutenberg.removePanels());
  }
}

const admin = new Admin();
admin.gutenbergListener();
