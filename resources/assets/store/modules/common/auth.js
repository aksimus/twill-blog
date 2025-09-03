import cookies from 'js-cookie';
import { auth as api } from '~/api';
import { getField, updateField } from 'vuex-map-fields';

let checkToken = false;

function sleep(ms) {
  return new Promise(res => setTimeout(res, ms));
}

export default {
  namespaced: true,

  state: {
    serverNotice: null,
    user: null,
    token: cookies.get('token'),
    successfulAuth: false,
  },

  getters: {
    serverNotice: state => state.serverNotice,
    user: state => state.user,
    successfulAuth: state => state.successfulAuth,
    check: state => state.user && state.token,
    token: state => state.token,
    getField,

    hasUpgradeFreeLimitsOffer: (state) => {
      if (!state.user || !state.user.offers || !Array.isArray(state.user.offers)) {
        return false;
      }
      return state.user.offers.some(offer => offer.type === 'UPGRADE_FREE_LIMITS_REQUEST');
    },
  },

  mutations: {
    setServerNotice(state, data) { state.serverNotice = data; },

    saveToken(state, { token, expiresIn }) {
      state.token = token;
      cookies.set('token', state.token);
      cookies.set('timestamp', Date.now() + expiresIn * 1000, {
        expires: expiresIn / 86400, // sec per day
      });
    },

    fetchUserSuccess(state, { user }) {
      state.user = user;
      state.successfulAuth = true;
    },

    fetchUserFailure(state) {
      state.token = null;
      cookies.remove('token');
      state.successfulAuth = false;
    },

    logout(state) {
      state.user = null;
      state.token = null;
      state.successfulAuth = false;
    },

    updateField,
  },

  actions: {


    async registration({ commit, dispatch }, {
      name,
      email,
      password,
      passwordConfirmation,
    }) {
      const [err, res] = await api.registration(name, email, password, passwordConfirmation);
      // await dispatch('login', { remember: false, email, password });
      if (err) {
        commit('setServerNotice', { type: 'danger', message: err.message });
      } else {
        await dispatch('login', { remember: false, email, password });
        // commit('saveToken', { token: res.data.access_token, expiresIn: res.data.expires_in });
        // await dispatch('fetchUser');
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
          event: 'registration',
        });
      }
    },

    async login({ commit, dispatch }, {
      remember, email, password, code,
    }) {
      let res,
        err;

      if (code) {
        [err, res] = await api.loginAuthCode(email, code);
      } else {
        [err, res] = await api.login(email, password);
      }


      if (err) {
        commit('setServerNotice', { type: 'danger', message: err.message });
      } else {
        // dispatch('saveToken', { token: res.data.access_token, remember });
        commit('saveToken', { token: res.data.access_token, expiresIn: res.data.expires_in });
        await dispatch('fetchUser');

        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
          event: 'login',
        });
      }
    },
    async passWordResetLink({ commit }, { email }) {
      const [err, res] = await api.passWordResetLink(email);
      if (err) commit('setServerNotice', { type: 'danger', message: err.message });
      else commit('setServerNotice', { type: 'success', message: res.data.message });
    },
    async passWordResetConfirm({ commit, dispatch }, {

      email,
      token,
      password,
      passwordConfirmation,
    }) {
      const [err, res] = await api.passWordResetConfirm(email, token, password, passwordConfirmation);
      if (err) {
        commit('setServerNotice', { type: 'danger', message: err.message });
      } else {
        commit('setServerNotice', { type: 'success', message: res.data.message });
        await dispatch('login', { remember: false, email, password });
      }
    },
    async reFetchUser({ commit, dispatch, state }) {
      await dispatch('checkTokenExpiration');

      if (state.token && cookies.get('timestamp')) {
        const [err, res] = await api.user();
        if (err) commit('fetchUserFailure');
        else commit('fetchUserSuccess', { user: res.data });
      }
    },
    async fetchUser({ commit, dispatch, state }) {

      await dispatch('checkTokenExpiration');

      if (!state.user && state.token && cookies.get('timestamp')) {
        const [err, res] = await api.user();
        if (err) commit('fetchUserFailure');
        else {
          commit('fetchUserSuccess', { user: res.data });
          try {
            window.$emitNativeEvent('user_initialized', { user_id: res.data.id || null });
          } catch (error) {

          }
        }
      }
    },

    async logout({ commit }) {
      if (cookies.get('token')) {
        await api.logout();
        cookies.remove('token');
        cookies.remove('timestamp');
      }

      commit('logout');
    },
    async setError({ commit }, { errorCode }) {
      let message = 'Error';
      if (errorCode == 'error_social_provider') {
        message = 'Auth Provider error';
      }
      if (errorCode == 'error_user_not_found') {
        message = 'User not found';
      }
      if (errorCode == 'error_registration_failed') {
        message = 'Registration failed';
      }


      commit('setServerNotice', { type: 'danger', message });
    },
    async getToken({ commit, dispatch, state }, sh) {
      if (!checkToken) {
        // to prevent unnecessary attempts to refresh token
        checkToken = true;

        let err = null;
        let res = null;

        if (sh) [err, res] = await api.confirm(sh);
        else if (!state.token) dispatch('logout');
        else [err, res] = await api.refresh();

        if (err) {
          if (sh) commit('setServerNotice', { type: 'danger', message: err.message });
          return true;
        }

        commit('saveToken', { token: res.data.access_token, expiresIn: res.data.expires_in });

        checkToken = false;
        return false;
      }

      while (checkToken) {
        // eslint-disable-next-line no-await-in-loop
        await sleep(500);
      }

      return false;
    },

    async checkTokenExpiration({ dispatch }) {

      if (cookies.get('token')
        && (!cookies.get('timestamp') || cookies.get('timestamp') < Date.now())) {
        //
        await dispatch('getToken');
      }
    },
  },
};
