import api from '../api';
import URIs from '../URIs';

function generateUID() {
  let firstPart = (Math.random() * 46656) | 0;
  let secondPart = (Math.random() * 46656) | 0;

  firstPart = (`000${firstPart.toString(36)}`).slice(-3);
  secondPart = (`000${secondPart.toString(36)}`).slice(-3);

  return firstPart + secondPart;
}

class FrontPage {
  constructor(url) {
    this.url = url;
    this.routeCalcUid = '';
  }

  async getTripPoints(tripId) {
    const response = await api.fetch({
      method: 'get',
      url: `${this.url}/trip/${tripId}/points`,
    });

    return response;
  }

  async getIftaReport(data) {
    const response = await api.fetch({
      method: 'post',
      url: `${this.url}/run/${this.routeCalcUid}`,
      data,
    });

    return response;
  }

  async checkRouteCalculation() {
    const response = await api.fetch({
      method: 'post',
      url: `${this.url}/check-status/${this.routeCalcUid}`,
    });

    return response;
  }

  async startRouteCalculation(route) {
    this.routeCalcUid = generateUID();

    const response = await api.fetch({
      method: 'post',
      url: `${this.url}/stops/${this.routeCalcUid}`,
      data: route,
    });

    return response;
  }

  async getRelatedData() {
    const response = await api.fetch({
      method: 'get',
      url: `${this.url}/form-data`,
    });

    return response;
  }

  async searchAddress(search, modeStr) {
    let mode = '';
    if (modeStr) mode = `&mode=${modeStr}`;

    const response = await api.fetch({
      method: 'get',
      url: `${this.url}/geo/search?term=${search}${mode}`,
    });
    return response;
  }

  async searchStreet(search) {
    const response = await api.fetch({
      method: 'get',
      url: `${this.url}/geo/address?term=${search}`,
    });

    return response;
  }

  async searchZip(search) {
    const response = await api.fetch({
      method: 'get',
      url: `${this.url}/geo/zip/find?term=${search}`,
    });
    return response;
  }
}

export default new FrontPage(URIs.frontPage);
