import fetch from "node-fetch";

exports.handler = (event, context, callback) => {
  const headers = {
    "Content-Type": "application/json",
    "Authorization": process.env.HUGO_MONDAY_ACCESS_TOKEN,
    "API-Version": process.env.HUGO_MONDAY_API_VERSION,
  };
  const formSubmissionData = event.body;
  const request = {
    method: "post",
    headers: headers,
    body: formSubmissionData,
  };
  const apiURL = process.env.HUGO_MONDAY_API_URL;

  const handleCompletion = (response) => {
    const success = !!response.data.create_item.id;

    if (success) {
      return callback(null, {
        statusCode: 201,
        body: JSON.stringify(response),
      });
    }

    return handleError(response);
  };

  const handleError = (response) => {
    return callback(null, {
      statusCode: 500,
      body: JSON.stringify(response),
    });
  };

  return fetch(apiURL, request)
    .then(response => response.json())
    .then(response => handleCompletion(response))
    .catch(error => handleError(error));
};
