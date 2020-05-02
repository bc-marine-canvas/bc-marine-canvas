const { dispatch } = wp.data;

class Gutenberg {

  constructor(options = {}) {
    Object.assign(this, Object.assign(Object.seal({
      panelsToRemove: ['featured-image', 'taxonomy-panel-post_tag'],
    }), options));
  }

  removePanels() {
    this.panelsToRemove.map(panel => this.removePanel(panel));
  }

  removePanel(panel) {
    dispatch('core/edit-post').removeEditorPanel(panel);
  }
}

export default Gutenberg;
