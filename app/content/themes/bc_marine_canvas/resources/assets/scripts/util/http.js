class HTTP {

  constructor(options = {}) {
    Object.assign(this, Object.assign(Object.seal({
      url: '',
      headers: { 'Content-Type': 'application/json' },
      body: '',
    }), options));
  }

  post() {
    return fetch(this.url, {
      method: 'POST',
      headers: this.headers,
      body: JSON.stringify(this.body),
    })
    .then(response => this.handleResponse(response));
  }

  handleResponse(response) {
    const contentType = response.headers.get('content-type');

    if (contentType.includes('application/json')) {
      return this.handleJSONResponse(response);
    } else if (contentType.includes('text/html')) {
      return this.handleTextResponse(response);
    } else {
      throw new Error(`content-type '${contentType}' not supported`);
    }
  }

  handleJSONResponse(response) {
    return response.json()
    .then(json => {
      if (response.ok) {
        return json;
      } else {
        return Promise.reject(Object.assign({}, json, {
          status: response.status,
          statusText: response.statusText,
        }));
      }
    })
  }

  handleTextResponse(response) {
    return response.text()
    .then(text => {
      if (response.ok) {
        return text;
      } else {
        return Promise.reject({
          status: response.status,
          statusText: response.statusText,
          err: text,
        });
      }
    })
  }
}

export default HTTP;
