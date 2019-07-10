import axios from 'axios'

export default {
  request(method, url, data, successCallback = null, errorCallback = null, finallyCallback = null) {
    axios
      .request({
        url,
        data,
        method: method.toLowerCase()
      })
      .then(successCallback)
      .catch(errorCallback)
      .finally(finallyCallback);
  },

  get(url, successCallback = null, errorCallback = null, finallyCallback = null) {
    return this.request('get', url, {}, successCallback, errorCallback, finallyCallback);
  },

  post(url, data, successCallback = null, errorCallback = null, finallyCallback = null) {
    return this.request('post', url, data, successCallback, errorCallback, finallyCallback);
  },

  put(url, data, successCallback = null, errorCallback = null, finallyCallback = null) {
    return this.request('put', url, data, successCallback, errorCallback, finallyCallback);
  },

  delete(url, data = {}, successCallback = null, errorCallback = null, finallyCallback = null) {
    return this.request('delete', url, data, successCallback, errorCallback, finallyCallback);
  },

  /**
   * Init the service.
   */
  init() {
    axios.defaults.baseURL = '/api';

    // Intercept the request to make sure the token is injected into the header.
    axios.interceptors.request.use(config => {
      config.headers['X-CSRF-TOKEN']     = document.getElementsByName('csrf-token')[0].content;
      config.headers['X-Requested-With'] = 'XMLHttpRequest';
      config.headers['Authorization']    = `Bearer ${localStorage.getItem('jwt-token')}`;
      return config;
    })
  }
}
