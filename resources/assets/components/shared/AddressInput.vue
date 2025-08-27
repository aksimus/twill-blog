<template>
  <c-select
    v-model="mutableValue"
    :options="addressList"
    :on-search="search"
    :help-mode="helpMode"
    :selected-label="selectedLabel"
    :incoming-label="selectedLabel"
    :small="small"
    :can-be-removed="canBeRemoved"
    :disabled="disabled"
    :placeholder="placeholder"
    :width-limited="widthLimited"
    dropdown-label="value"
    @select="handleSelectedValue" />
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import { mapFields } from 'vuex-map-fields';

const vuexModuleAuth = 'auth';
const vuexModuleAdress = 'address';
const vuexModuleFrontPage = 'frontPage';

export default {
  name: 'AddressInput',

  model: {
    prop: 'value',
    event: 'change',
  },

  props: {
    value: {
      type: String,
      default: null,
    },

    selectedLabel: {
      type: String,
      default: 'zip',
    },

    small: {
      type: Boolean,
      default: false,
    },

    helpMode: {
      type: Boolean,
      default: true,
    },

    addressMode: {
      type: String,
      default: null,
    },

    canBeRemoved: {
      type: Boolean,
      default: true,
    },

    disabled: {
      type: Boolean,
      default: false,
    },

    placeholder: {
      type: String,
      default: null,
    },

    widthLimited: {
      type: Boolean,
      default: false,
    },
  },

  computed: {
    ...mapGetters(vuexModuleAuth, { checkToken: 'token' }),

    ...mapFields(vuexModuleAdress, {
      authServerNotice: 'serverNotice',
      authAddressList: 'addressList',
    }),

    ...mapFields(vuexModuleFrontPage, {
      guestServerNotice: 'addressServerNotice',
      guestAddressList: 'addressList',
    }),

    serverNotice() { return this.checkToken ? this.authServerNotice : this.guestServerNotice; },

    addressList: {
      get() { return this.checkToken ? this.authAddressList : this.guestAddressList; },
      set(val) {
        if (this.checkToken) this.authAddressList = val;
        else this.guestAddressList = val;
      },
    },

    mutableValue: {
      get() { return this.value; },
      set(value) { this.$emit('change', value); },
    },
  },

  watch: {
    serverNotice: {
      immediate: true,
      handler(notice) {
        if (notice && !this.formState) {
          this.$notify.push({
            message: notice.message,
            type: notice.type,
            duration: notice.type === 'danger' ? -1 : 3000,
          });

          this.serverNotice = null;
        }
      },
    },
  },

  methods: {
    ...mapActions(vuexModuleAdress, {
      authSearchAddress: 'searchAddress',
      authSearchStreet: 'searchStreet',
      authSearchZip: 'searchZip',
    }),
    ...mapActions(vuexModuleFrontPage, {
      guestSearchAddress: 'searchAddress',
      guestSearchStreet: 'searchStreet',
      guestSearchZip: 'searchZip',
    }),

    searchAddress(...args) {
      return this.checkToken
        ? this.authSearchAddress(...args)
        : this.guestSearchAddress(...args);
    },

    searchStreet(...args) {
      return this.checkToken
        ? this.authSearchStreet(...args)
        : this.guestSearchStreet(...args);
    },

    searchZip(...args) {
      return this.checkToken
        ? this.authSearchZip(...args)
        : this.guestSearchZip(...args);
    },


    async search(search) {
      if (search) {
        switch (this.selectedLabel) {
          case 'city':
            await this.searchAddress({ search, mode: this.addressMode });
            break;
          case 'street':
            await this.searchStreet(search);
            break;
          case 'zip':
            await this.searchZip(search);
            break;
          default:
            break;
        }
      } else {
        this.addressList = [];
      }
    },

    handleSelectedValue(address) {
      this.addressList = [];
      this.$emit('select', address);
    },
  },
};
</script>
