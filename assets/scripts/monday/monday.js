import { params } from "../utils/params"

export class Monday {
  static boardID = params("mondayBoardID", true);
  static token = params("mondayToken");
  static apiURL = params("mondayURL");

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
  }

  get fullName() {
    return `${this.firstName} ${this.lastName}`.trim();
  }

  get submissionName() {
    return this.fullName;
  }

  get query() {
    return "mutation ($submissionName: String!, $columnValues: JSON!, " +
      "$boardID: Int!) { create_item (board_id:$boardID, " +
      "item_name:$submissionName, column_values: $columnValues) { id } }";
  }

  get variables() {
    return JSON.stringify({
      "submissionName": this.submissionName,
      "boardID": Monday.boardID,
      "columnValues": `{
        "text": "${this.firstName}",
        "text6": "${this.lastName}",
        "text3": "${this.email}",
        "text2": "${this.phone}",
        "long_text": "${this.message}"
      }`,
    });
  }

  request() {
    return {
      method: "post",
      headers: {
        "Content-Type": "application/json",
        "Authorization": Monday.token,
      },
      body: JSON.stringify({
        "query": this.query,
        "variables": this.variables,
      }),
    };
  }
}
