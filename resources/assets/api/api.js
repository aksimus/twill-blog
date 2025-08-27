import axios from 'axios';
import handleResponse from './utils/handle-response';

function of(promise) {
  return Promise.resolve(promise)
    .then(result => [null, result])
    .catch((e) => {
      let error = e;
      if (e === undefined || e === null) {
        error = new Error('Rejection with empty value');
        error.originalValue = e;
      }
      return [error];
    });
}

export default {
  requestInterceptors: [],
  responseInterceptors: [],

  async fetch(options) {
    await Promise.all(this.requestInterceptors.map(callback => (
      new Promise(async (resolve) => {
        await callback(options);
        resolve();
      })
    )));

    let response = await of(axios(options));
    response = handleResponse(response);

    await Promise.all(this.responseInterceptors.map(callback => (
      new Promise(async (resolve) => {
        await callback(response);
        resolve();
      })
    )));

    return response;
  },

  setRequestInterceptor(callback) {
    this.requestInterceptors.push(callback);
  },

  setResponseInterceptor(callback) {
    this.responseInterceptors.push(callback);
  },
};
