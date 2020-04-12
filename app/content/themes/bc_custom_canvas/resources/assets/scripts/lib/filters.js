import DOM from '../util/dom';

class Filters {

  constructor() {
    Object.assign(this, Object.assign(Object.seal({
      formId: 'filter',
      submitButtonId: 'filter-submit',
      clearButtonId: 'filter-clear',
    })));

    this.submitFormListener();
  }

  get form() {
    return DOM.find(`#${this.formId}`);
  }

  get submitButton() {
    return DOM.find(`#${this.submitButtonId}`);
  }

  get clearButton() {
    return DOM.find(`#${this.clearButtonId}`);
  }

  get fields() {
    return DOM.findAll(`#${this.formId} select`);
  }

  submitFormListener() {
    this.form.addEventListener('submit', () => {
      const fields = Array.from(this.fields);

      fields.filter(field => !field.value).map(field => field.disabled = true);
    });
  }

  clear() {
    const url = window.location;

    window.location = `${url.origin}${url.pathname}`;
  }
}

export default Filters;
