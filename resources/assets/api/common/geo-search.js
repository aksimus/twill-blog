import api from '../api';
import URIs from '../URIs';

class Geo {
  constructor(uri) {
    this.uri = uri;
  }

  async searchAddress(search, modeStr) {
    let mode = '';
    if (modeStr) mode = `&mode=${modeStr}`;

    const response = await api.fetch({
      method: 'get',
      url: `${this.uri.search}?term=${search}${mode}`,
    });
    return response;
  }

  async searchStreet(search) {
    const response = await api.fetch({
      method: 'get',
      url: `${this.uri.street}?term=${search}`,
    });

    return response;
  }

  async searchZip(search) {
    const response = await api.fetch({
      method: 'get',
      url: `${this.uri.zip}/find?term=${search}`,
    });
    return response;
  }
}

export default new Geo(URIs.geo);
