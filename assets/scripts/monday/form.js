import sanitizeHtml from "sanitize-html";

import { Monday } from "./monday";
import { DOM } from "../utils/dom";

export class Form {
  static formID = "#form";
  static form = DOM.find(Form.formID);
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
  static formSubmissionEndpoint = "/.netlify/functions/form-submission-create";

  static addSubmissionListener() {
    document.addEventListener("DOMContentLoaded", () => {
      Form.addSubmitButtonListener();
    });
  }

  static addSubmitButtonListener() {
    if (!Form.submitButton) return;

    Form.submitButton.addEventListener("click", () => {
      const formData = new FormData(Form.form);
      const entries = formData.entries();
      const rawData = Object.fromEntries(entries);
      const data = Object
        .entries(rawData)
        .reduce((props, [key, value]) => {
          const cleanValue = sanitizeHtml(value, Form.sanitizerOptions);

          return ({ ...props, [key]: cleanValue })
        }, {});

      Form.clearSubmissionResultMessage();

      if (!data.specialRequest && Form.form.checkValidity()) {
        Form.setSubmitButtonSubmissionStateInProgress();

        const request = Monday.createFormSubmission(data);

        fetch(Form.formSubmissionEndpoint, request)
          .then(response => response.json())
          .then(response => {
            if (response.data.create_item.id) {
              Form.submissionRequestSucceeded();
            } else {
              Form.submissionRequestFailed();
            }
          })
          .catch(() => Form.submissionRequestError());
      } else {
        Form.submissionValidityCheckFailed();
      }
    });
  }

  static clearSubmissionResultMessage() {
    Form.successMessage.classList.add("d-none");
    Form.failureMessage.classList.add("d-none");
  }

  static setSubmitButtonSubmissionStateInProgress() {
    Form.spinner.classList.remove("d-none");
    Form.submitButton.disabled = true;
    Form.submitButtonLabel.textContent = "Underway...";
  }

  static setSubmitButtonSubmissionStateReady() {
    Form.spinner.classList.add("d-none");
    Form.submitButton.disabled = false;
    Form.submitButtonLabel.textContent = "Submit";
  }

  static submissionRequestSucceeded() {
    Form.setSubmitButtonSubmissionStateReady();
    Form.showSubmissionResultSuccess();
    Form.removeFormClassWasValidated();
    Form.resetForm();
  }

  static submissionRequestFailed() {
    Form.setSubmitButtonSubmissionStateReady();
    Form.showSubmissionResultFailure();
    Form.removeFormClassWasValidated();
  }

  static submissionRequestError() {
    Form.setSubmitButtonSubmissionStateReady();
    Form.showSubmissionResultFailure();
    Form.removeFormClassWasValidated();
  }

  static submissionValidityCheckFailed() {
    Form.addFormClassWasValidated();
  }

  static showSubmissionResultSuccess() {
    Form.successMessage.classList.remove("d-none");
  }

  static showSubmissionResultFailure() {
    Form.failureMessage.classList.remove("d-none");
  }

  static addFormClassWasValidated() {
    Form.form.classList.add("was-validated");
  }

  static removeFormClassWasValidated() {
    Form.form.classList.remove("was-validated");
  }

  static resetForm() {
    Form.form.reset();
  }
}
