import sanitizeHtml from "sanitize-html";

import { Monday } from "./monday";
import { DOM } from "../utils/dom";

export class Form {
  static submitButtonID = "#form-submit-button";
  static submitButton = DOM.find(Form.submitButtonID);
  static submitButtonLabelID = "#form-submit-button-label";
  static submitButtonLabel = DOM.find(Form.submitButtonLabelID);
  static spinnerID = "#form-spinner";
  static spinner = DOM.find(Form.spinnerID);
  static successMessageID = "#form-submit-success";
  static successMessage = DOM.find(Form.successMessageID);
  static failureMessageID = "#form-submit-failure";
  static failureMessage = DOM.find(Form.failureMessageID);
  static sanitizerOptions = { allowedTags: [], allowedAttributes: {} };

  static addSubmissionListener() {
    document.addEventListener("DOMContentLoaded", () => {
      Form.addSubmitButtonListener();
    });
  }

  static addSubmitButtonListener() {
    if (!Form.submitButton) return;

    Form.submitButton.addEventListener("click", () => {
      const formID = "#form";
      const form = DOM.find(formID);

      const formData = new FormData(form);
      const entries = formData.entries();
      const rawData = Object.fromEntries(entries);
      const data = Object
        .entries(rawData)
        .reduce((props, [key, value]) => {
          const cleanValue = sanitizeHtml(value, Form.sanitizerOptions);

          return ({ ...props, [key]: cleanValue })
        }, {});

      if (!data.specialRequest && form.checkValidity()) {
        Form.spinner.classList.remove("d-none");
        Form.submitButtonLabel.textContent = "Underway...";

        const request = Monday.createFormSubmission(data);

        fetch(Monday.apiURL, request)
          .then(response => response.json())
          .then(response => {
            if (response.data.create_item.id) {
              Form.spinner.classList.add("d-none");
              Form.submitButtonLabel.textContent = "Submit";
              Form.successMessage.classList.remove("d-none");

              form.classList.remove("was-validated");
              form.reset();
            } else {
              Form.spinner.classList.add("d-none");
              Form.submitButtonLabel.textContent = "Submit";
              Form.failureMessage.classList.remove("d-none");

              form.classList.remove("was-validated");
            }
          })
          .catch(() => {
            Form.spinner.classList.add("d-none");
            Form.submitButtonLabel.textContent = "Submit";
            Form.failureMessage.classList.remove("d-none");

            form.classList.remove("was-validated");
          });
      } else {
        form.classList.add("was-validated");
      }
    });
  }
}
