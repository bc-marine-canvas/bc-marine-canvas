import { params } from "../utils/params";

export class Monday {
  static boardID = params("mondayBoardID", true);

  static createFormSubmission(formData) {
    const monday = new this(formData);

    return monday.request();
  }

  constructor(formData = {}) {
    this.firstName = formData.firstName;
    this.lastName = formData.lastName;
    this.email = formData.email;
    this.phone = formData.phone;
    this.message = formData.message;
    this.specialRequest = formData.specialRequest;

    this.date = new Date();
  }

  get fullName() {
    return `${this.firstName} ${this.lastName}`.trim();
  }

  get submissionName() {
    return [this.firstName, this.lastName].join(" ").trim();
  }

  get submissionDate() {
    return this.date.toISOString().split("T").first();
  }

  get submissionTime() {
    return this.date.toISOString()
      .split("T").last()
      .split(".").first();
  }

  get query() {
    return "mutation ($submissionName: String!, $columnValues: JSON!, " +
      "$boardID: ID!) { create_item (board_id: $boardID, " +
      "item_name: $submissionName, column_values: $columnValues) { id } }";
  }

  get columnValues() {
    return JSON.stringify({
      date4: {
        date: `${this.submissionDate}`,
        time: `${this.submissionTime}`,
      },
      text: `${this.firstName}`,
      text6: `${this.lastName}`,
      text3: `${this.email}`,
      text2: `${this.phone}`,
      // eslint-disable-next-line camelcase
      long_text: `${this.message}`,
    });
  }

  get variables() {
    return {
      "submissionName": this.submissionName,
      "boardID": Monday.boardID,
      "columnValues": this.columnValues,
    };
  }

  request() {
    return {
      method: "post",
      body: JSON.stringify({
        "query": this.query,
        "variables": this.variables,
      }),
    };
  }
}
