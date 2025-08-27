import { frontPage as api } from '~/api';
import { getField, updateField } from 'vuex-map-fields';

const initState = {
  addressServerNotice: null,

  routeServerNotice: null,
  reportServerNotice: null,

  addressList: [],

  relatedData: {},

  routeCalculationData: {},
  iftaReport: {},
};

export default {
  namespaced: true,
  state: JSON.parse(JSON.stringify(initState)),
  getters: { getField },

  mutations: {
    setRouteServerNotice(state, data) { state.routeServerNotice = data; },
    setAdressServerNotice(state, data) { state.addressServerNotice = data; },
    setReportServerNotice(state, data) { state.reportServerNotice = data; },

    saveAddresses(state, data) { state.addressList = data; },

    setRelatedData(state, data) { state.relatedData = data; },

    setIftaReport(state, data) { state.iftaReport = data; },

    updateRouteCalculationData(state, data) {
      state.routeCalculationData = {
        id: data.id,
        status: data.status,
        info: data.info,
        distance: data.trip && data.trip.distance,
        display_distance: data.trip && data.trip.display_distance,
        state_mileages: data.trip && data.trip.state_mileages,
        warnings: data.warnings || [],
      };
    },

    clearState(state) { Object.assign(state, JSON.parse(JSON.stringify(initState))); },
    updateField,
  },

  actions: {
    async startRouteCalculation({ commit }, route) {
      const [err] = await api.startRouteCalculation(route);
      if (err) commit('setRouteServerNotice', { type: 'danger', message: err.message });
    },

    async checkRouteCalculation({ commit }, route) {
      const [err, res] = await api.checkRouteCalculation(route);
      if (err) commit('setRouteServerNotice', { type: 'danger', message: err.message });
      else {
        commit('updateRouteCalculationData', res && res.data);

        if (res.data.warnings && res.data.warnings.length) {
          commit('setReportServerNotice', { type: 'warning', message: res.data.warnings[0] });
        }
      }
    },

    async getIftaReport({ commit }, fuelPurchases) {
      const [err, res] = await api.getIftaReport({ fuel_purchases: fuelPurchases });

      if (err) commit('setReportServerNotice', { type: 'danger', message: err.message });
      else {
        commit('setIftaReport', res && res.data);

        if (res.data.report.warnings && res.data.report.warnings.length) {
          commit('setReportServerNotice', { type: 'warning', message: res.data.report.warnings[0] });
        }
      }
    },

    async getRelatedData({ commit }) {
      const [err, res] = await api.getRelatedData();

      if (err) commit('setRouteServerNotice', { type: 'danger', message: err.message });
      else {
        const relatedData = {};
        if (res) {
          Object.keys(res.data).forEach((key) => {
            relatedData[key] = res.data[key].data;
          });
        }

        commit('setRelatedData', relatedData);
      }
    },

    async searchAddress({ commit }, { search, mode }) {
      const [err, res] = await api.searchAddress(search, mode);
      if (err) commit('setAdressServerNotice', { type: 'danger', message: err.message });
      else commit('saveAddresses', res && res.data.data);
    },

    async searchStreet({ commit }, search) {
      const [err, res] = await api.searchStreet(search);
      if (err) commit('setAdressServerNotice', { type: 'danger', message: err.message });
      else commit('saveAddresses', res && res.data.data);
    },

    async searchZip({ commit }, search) {
      const [err, res] = await api.searchZip(search);
      if (err) commit('setAdressServerNotice', { type: 'danger', message: err.message });
      else commit('saveAddresses', res && res.data.data);
    },

    clearData({ commit }) { commit('clearState'); },
  },
};
