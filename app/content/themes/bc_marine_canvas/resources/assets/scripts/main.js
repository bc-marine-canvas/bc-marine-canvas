import 'jquery';
import 'bootstrap';

import Router from './util/Router';
import common from './routes/common';
import gallery from './routes/gallery';
import galleryViewer from './routes/galleryViewer';

const routes = new Router({
  common,
  gallery,
  galleryViewer,
});

jQuery(document).ready(() => routes.loadEvents());
