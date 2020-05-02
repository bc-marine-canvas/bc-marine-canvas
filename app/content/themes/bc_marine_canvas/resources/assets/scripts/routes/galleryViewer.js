import 'lightgallery.js';
import 'lg-share.js';
import 'lg-hash.js';

import DOM from '../util/dom';

class GalleryViewer {

  constructor() {
    Object.assign(this, Object.assign(Object.seal({
      galleryId: '#gallery',
    })));
  }

  get gallery() {
    return DOM.find(this.galleryId);
  }

  init() {
    /* eslint-disable-next-line no-undef */
    lightGallery(this.gallery);
  }
}

export default {
  init() {
    const galleryViewer = new GalleryViewer();
    galleryViewer.init();
  },
  finalize() {},
};
