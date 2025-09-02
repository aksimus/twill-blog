import { geo as api } from '~/api';
import { getField, updateField } from 'vuex-map-fields';

const initState = {
  serverNotice: null,
  addressList: [],
};

export default {
  namespaced: true,
  state: JSON.parse(JSON.stringify(initState)),
  getters: { getField },

  mutations: {
    setServerNotice(state, data) { state.serverNotice = data; },
    saveAddresses(state, data) { state.addressList = data; },

    clearState(state) { Object.assign(state, JSON.parse(JSON.stringify(initState))); },
    updateField,
  },

  actions: {
    async searchAddress({ commit }, { search, mode }) {
      const [err, res] = await api.searchAddress(search, mode);
      if (err) commit('setServerNotice', { type: 'danger', message: err.message });
      else commit('saveAddresses', res && res.data.data);
    },

    async searchStreet({ commit }, search) {
      const [err, res] = await api.searchStreet(search);
      if (err) commit('setServerNotice', { type: 'danger', message: err.message });
      else commit('saveAddresses', res && res.data.data);
    },

    async searchZip({ commit }, search) {
      const [err, res] = await api.searchZip(search);
      if (err) commit('setServerNotice', { type: 'danger', message: err.message });
      else commit('saveAddresses', res && res.data.data);
    },

    clearData({ commit }) { commit('clearState'); },
  },
};
