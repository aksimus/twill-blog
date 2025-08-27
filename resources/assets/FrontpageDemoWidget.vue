<template>

  <home-shell ref="homeShell">
    <div
      slot="image-section"
      class="front-page__demo"
    >
      <h4 class="front-page__demo-title">Try online calculator</h4>

      <div class="front-page__demo-stops">
        <div class="front-page__demo-stop">
          <h6 v-if="!isMobile"><c-icon icon="icon-stop-arrow" /> Pickup</h6>

          <c-input-group>
            <div class="front-page__city-input">
              <h6
                v-if="isMobile"
                class="front-page__demo-stop-label"
              ><c-icon icon="icon-stop-arrow" /> Pickup</h6>

              <address-input
                v-model="pickup.city"
                placeholder="City"
                selected-label="city"
                @select="selectedStop = pickup;setAddress($event)" />
            </div>
          </c-input-group>

          <div class="front-page__demo-stop-row">
            <c-input-group>
              <c-select
                v-model="pickup.state"
                :options="usStates"
                placeholder="State"
                dropdown-label="value"
                selected-label="id"
                incoming-label="id" />
            </c-input-group>
            <c-input-group>
              <address-input
                v-model="pickup.zip"
                :width-limited="isMobile"
                placeholder="Zip"
                selected-label="zip"
                @select="selectedStop = pickup;setAddress($event)" />
            </c-input-group>
          </div>

        </div>

        <div class="front-page__demo-stop">
          <h6 v-if="!isMobile">
            <c-icon
              icon="icon-stop-arrow"
              class="front-page__demo-stop-delivery-icon" />
            Delivery
          </h6>

          <c-input-group>
            <div class="front-page__city-input">
              <h6
                v-if="isMobile"
                class="front-page__demo-stop-label"
              >
                <c-icon
                  icon="icon-stop-arrow"
                  class="front-page__demo-stop-delivery-icon" />
                Delivery
              </h6>

              <address-input
                v-model="delivery.city"
                placeholder="City"
                selected-label="city"
                @select="selectedStop = delivery;setAddress($event)" />
            </div>
          </c-input-group>

          <div class="front-page__demo-stop-row">
            <c-input-group>
              <c-select
                v-model="delivery.state"
                :options="usStates"
                placeholder="State"
                dropdown-label="value"
                selected-label="id"
                incoming-label="id" />
            </c-input-group>
            <c-input-group>
              <address-input
                v-model="delivery.zip"
                :width-limited="isMobile"
                placeholder="Zip"
                selected-label="zip"
                @select="selectedStop = delivery;setAddress($event)" />
            </c-input-group>
          </div>

        </div>
      </div>

      <div class="front-page__demo-footer">
        <c-button-save
          id="recalc-step1"
          :spinner="startCalculationWaiting"
          title="Calculate"
          @click="startCalculation" />

        <div><small>* enter trip details to start IFTA calculation</small></div>
      </div>
    </div>

    <c-modal
      v-model="modalState"
      :title="modalTitle"
      :click-on-wrapper="false"
      variant="default"
    >
      <div slot="body">
        <template v-if="modalType === 'fuel-purchased'">
          <c-alert-server
            :notice="reportServerNotice"
            immediate />

          <c-input-group v-if="routeCalculationQuarter">
            <div>
              <strong>Period: </strong>
              <span>{{ routeCalculationQuarter }}</span>
            </div>
          </c-input-group>

          <c-input-group v-if="totalDistance">
            <div>
              <strong>Total miles: </strong>
              <span>{{ totalDistance }}</span>

              <c-link-icon
                icon="fa fa-map"
                text="Map"
                @click="openModalRouteMap" />&nbsp;&nbsp;&nbsp;
            </div>
          </c-input-group>


          <c-table
            :fields="stateListFields"
            :items="stateListItems || []"
            show-empty
            striped
          >
            <template
              slot="fuel_units"
              slot-scope="data"
            >
              <c-input-form
                v-model="data.item.fuel_units"
                small />
            </template>
          </c-table>
        </template>

        <template v-else>
          <c-input-group v-if="reportInfo">
            <div>
              <strong>Period: </strong>
              <span>Q{{ reportInfo.quarter }} {{ reportInfo.year }}</span>
            </div>
          </c-input-group>
          <c-input-group v-if="reportTotals && reportTotals.consumption">
            <div>
              <strong>Avg. miles per gallon: </strong>
              <span>{{ reportTotals.consumption }}</span>
            </div>
          </c-input-group>

          <c-table
            :fields="reportFields"
            :items="reportItems || []"
            show-empty
            striped
          >
            <template
              slot="state_name"
              slot-scope="data"
            >
              <div>
                <div>{{ data.value }}</div>
                <div><small>Rate: ${{ data.item.rate }}</small></div>
              </div>
            </template>

            <template
              v-if="reportTotals"
              slot="bottom-row"
              slot-scope="{ fields }"
            >
              <td
                v-for="(c, i) in fields"
                :key="i"
                :class="[
                  'front-page__col-total',
                  { 'front-page__col-total_amount': i === (fields.length - 2) }]"
              >
                <span v-if="i === 0">TOTAL:</span>
                <span v-if="i === 1">{{ reportTotals.miles }}</span>
                <span v-if="i === 2">{{ reportTotals.fuel_consumed }}</span>
                <span v-if="i === 3">{{ reportTotals.fuel_purchased }}</span>
                <span v-if="i === 4">{{ reportTotals.fuel_taxable }}</span>
                <span v-if="i === 5">{{ reportTotals.tax_amount }}</span>
              </td>
            </template>
          </c-table>
        </template>
      </div>

      <div slot="footer">
        <template v-if="modalType === 'fuel-purchased'">
          <c-button-save
            id="recalc-step2"
            :spinner="runReportWaiting"
            title="Get results "
            @click="runReportCalculation" />
          <c-button
            variant="secondary"
            @click="modalState = false"
          >Close</c-button>
        </template>

        <template v-else>
          <c-button
            id="recalc-step3"
            variant="primary"
            @click="signUp"
          >Sign up to full version</c-button>

          <c-button
            variant="secondary"
            @click="modalType = 'fuel-purchased'"
          >Back</c-button>
        </template>

      </div>

    </c-modal>
    <demo-trip-map
      v-if="modalRouteMapState"
      v-model="modalRouteMapState"
      :trip-id="tripId" />
</home-shell>
</template>

<script>
import { mapActions } from 'vuex';
import { mapFields } from 'vuex-map-fields';



import demoTripMap from './components/Front/DemoTripMap.vue';
import HomeShell from './components/HomeShell.vue';


const vuexModuleFrontPage = 'frontPage';

export default {
  name: 'FrontpageDemoWidget',

  components: {
    HomeShell,
    demoTripMap,
  },

  data() {
    return {
      modalRouteMapState: false,
      startCalculationWaiting: false,
      runReportWaiting: false,

      faqList: [],

      widgets: [
        {
          title: 'Easy to use',
          content: 'In just a few clicks all necessary information for reports generation is at hand per all the equipment you have or just per one unit.',
        },
        {
          title: 'Time saving',
          content: 'No more constant tracking of miles or manual calculations - you input some basic information about your trips and fuel and we do the rest.',
        },
        {
          title: 'Report generation',
          content: 'Your quarterly tax reports are generated just in one click and can be downloaded in a necessary format at any moment.',
        },
        {
          title: 'AI data extraction',
          content: 'Upload your Rate Confirmation PDF to instantly get your trip data',
        },
      ],

      pickup: {
        city: null,
        state: null,
        zip: null,
      },

      delivery: {
        city: null,
        state: null,
        zip: null,
      },

      selectedStop: null,

      modalState: false,
      modalType: 'fuel-purchased',

      stateListFields: [
        {
          key: 'state',
          label: 'Jurisdiction',
        },
        {
          key: 'distance',
          label: 'Total miles',
        },
        {
          key: 'fuel_units',
          label: 'Total gallons',
        },
      ],

      reportFields: [
        {
          key: 'state_name',
          label: 'Jurisdiction',
        },
        {
          key: 'miles',
          label: 'Taxable miles',
        },
        {
          key: 'fuel_consumed',
          label: 'Taxable gallons',
        },
        {
          key: 'fuel_purchased',
          label: 'Tax-paid gallons',
        },
        {
          key: 'fuel_taxable',
          label: 'Net taxable gallons',
        },
        {
          key: 'tax_amount',
          label: 'Tax or Credit Due',
        },
      ],

      reportItems: [],
      reportTotals: null,
      reportInfo: null,

      viewportWidth: 0,
    };
  },

  computed: {
    ...mapFields(vuexModuleFrontPage, {
      routeServerNotice: 'routeServerNotice',
      reportServerNotice: 'reportServerNotice',

      relatedData: 'relatedData',

      routeCalculationData: 'routeCalculationData',
      tripId: 'routeCalculationData.id',
      totalDistance: 'routeCalculationData.distance',
      stateListItems: 'routeCalculationData.state_mileages',

      iftaReport: 'iftaReport',
    }),

    routeCalculationQuarter() {
      return this.routeCalculationData.info
        && `Q${this.routeCalculationData.info.quarter} ${this.routeCalculationData.info.year}`;
    },

    routeCalculationStatus() {
      return this.routeCalculationData.status;
    },

    totalDistance() {
      return this.routeCalculationData.display_distance;
    },

    stateListItems() {
      if (!this.routeCalculationData.state_mileages) return [];
      return this.routeCalculationData.state_mileages.map(item => ({
        state: item.state,
        distance: item.distance,
        fuel_units: 0,
      }));
    },

    usStates() {
      if (!this.relatedData.us_states) return [];
      return this.relatedData.us_states;
    },

    modalTitle() {
      return this.modalType === 'fuel-purchased'
        ? 'Add diesel purchase '
        : 'See your IFTA tax';
    },

    isMobile() { return this.viewportWidth < 768; },
  },

  watch: {
    modalState(state) {
      this.modalType = 'fuel-purchased';
      if (!state) this.reportServerNotice = null;
    },

    routeServerNotice: {
      immediate: true,
      handler(notice) {
        if (notice && !this.formState) {
          this.$notify.push({
            message: notice.message,
            type: notice.type,
            duration: notice.type === 'danger' ? -1 : 3000,
          });
        }
      },
    },
  },

  created() {


    this.getRelatedData();

    this.viewportWidth = window.innerWidth
      || document.documentElement.clientWidth
      || document.body.clientWidth;
  },

  methods: {
    ...mapActions(vuexModuleFrontPage, {
      startRouteCalculation: 'startRouteCalculation',
      checkRouteCalculation: 'checkRouteCalculation',
      getIftaReport: 'getIftaReport',
      getRelatedData: 'getRelatedData',
    }),


    async runReportCalculation() {
      this.runReportWaiting = true;
      this.reportServerNotice = null;

      // fbq - global function of google tag manager
      // eslint-disable-next-line no-undef
      if(0){
      fbq('track', 'ViewContent', {
        value: 1,
        content_ids: 'demo-recalc-step2',
        content_type: 'demo',
      });
    }
      const fuelPurchases = this.stateListItems
        .map(item => ({ state: item.state, fuel_units: item.fuel_units }))
        .filter(item => Number(item.fuel_units));

      await this.getIftaReport(fuelPurchases);

      if (!this.reportServerNotice || this.reportServerNotice.type !== 'danger') {
        this.reportItems = this.iftaReport.report && this.iftaReport.report.data;
        this.reportTotals = this.iftaReport.report && this.iftaReport.report.totals;
        this.reportInfo = this.iftaReport.report && this.iftaReport.report.info;

        this.modalType = 'report';
      }

      this.runReportWaiting = false;
    },

    async startCalculation() {
      this.startCalculationWaiting = true;

      // fbq - global function of google tag manager
      // eslint-disable-next-line no-undef
      if(0){
      fbq('track', 'ViewContent', {
        value: 1,
        content_ids: 'demo-recalc-step1',
        content_type: 'demo',
      });
    }
      const route = { route: [this.pickup, this.delivery] };
      await this.startRouteCalculation(route);

      if (!this.routeServerNotice || this.routeServerNotice.type !== 'danger') {
        this.check();
      } else {
        this.startCalculationWaiting = false;
      }

      this.routeServerNotice = null;
    },
    openModalRouteMap() {
      this.modalRouteMapState = true;
    },
    async check() {
      let timeoutTime = 1000; // ms

      const timeoutFunc = async () => {
        await this.checkRouteCalculation();

        timeoutTime += timeoutTime;

        if (this.routeServerNotice && this.routeServerNotice.type === 'danger') {
          this.startCalculationWaiting = false;
          return;
        }

        if (this.routeCalculationStatus === 'ok') {
          this.modalState = true;
          this.startCalculationWaiting = false;
          return;
        }

        if (timeoutTime >= 60000) {
          this.routeServerNotice = { type: 'danger', message: 'Something went wrong' };
          this.startCalculationWaiting = false;
          return;
        }

        setTimeout(timeoutFunc, timeoutTime);
      };

      setTimeout(timeoutFunc, timeoutTime);
    },

    setAddress(option) {
      if (this.selectedStop) {
        this.selectedStop.city = option.city;
        this.selectedStop.state = option.state;
        this.selectedStop.zip = option.zip;
      }

      this.selectedStop = null;
    },

    signUp() {
      this.$nextTick(() => {
        if (this.$refs.homeShell) {
          this.$refs.homeShell.signUp();
        }
      });
    },
  },
};
</script>

<style lang="scss">
.front-page__demo {
  max-width: 356px;
  margin: 0 auto;
  padding: 10px;

  background-color: hsla(0, 0%, 99%, .85);
}

.front-page__demo-title {
  margin-bottom: 8px;
  text-align: center;
}

.front-page__demo-stops {
  width: 100%;
}

.front-page__demo-stop {
  width: 100%;

  h6 {
    display: inline-block;
    padding: 4px;

    & > *:first-child {
      color: var(--teal-green);
    }
  }

  &-label {
    width: 120px;
  }

  &-delivery-icon {
    display: inline-block;
    transform: rotate(180deg);
  }

  .c-input {
    background-color: hsla(0, 0%, 99%, .85);
  }
}

.front-page__city-input {
  display: flex;
  align-items: center;

  width: 100%;
}

.front-page__demo-stop-row {
  display: flex;

  & > * + * {
    margin-left: 4px;
  }
}

.front-page__demo-footer {
  text-align: center;
}

.front-page__widgets {
  display: flex;
  flex-direction: column;
  align-items: center;

  width: 100%;
  margin: 0 auto;
  padding: 50px;

  & > * + * {
    margin-top: 16px;
  }
}

.front-page__video {
  width: 100%;
  max-width: 532px;

  margin: 0 auto;
  padding: 50px 10px 0;

  text-align: center;

  & > * + * {
    margin-top: 16px;
  }
}

.front-page__video-container {
  position: relative;
  padding-bottom: 56.25%;
  height: 0;

  & iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  }
}

.front-page__widget {
  flex-shrink: 0;
  width: 288px;

  font-size: 18px;
  line-height: 30px;
  text-align: center;

  & > * + * {
    margin-top: 16px;
  }
}

.front-page__rates-link {
  text-align: center;
}

.front-page__faq {
  max-width: 640px;
  margin: 50px auto;
  padding: 0 10px;

  & > *:first-child {
    text-align: center;
  }
}

.front-page__faq-item {
  margin-top: 16px;

  & > *:last-child {
    margin-top: 8px;

    ul, ol {
      padding-left: 24px;
    }
  }
}

.front-page__col-total {
  padding: 6px 4px;
  border-top: 1px solid hsl(201, 19%, 70%);
  background-color: hsl(45, 100%, 86%);
}

@media (min-width: 768px) {
  .front-page__demo {
    max-width: 532px;
  }

  .front-page__demo-stops {
    display: flex;

    & > * + * {
      margin-left: 16px;
    }
  }

  .front-page__widget {
    flex-shrink: 0;
    width: 640px;
  }
}

@media (min-width: 1040px) {
  .front-page__widgets {
  align-items: flex-start;
    flex-direction: row;
    justify-content: center;

    & > * + * {
      margin-top: 0;
      margin-left: 16px;
    }
  }

  .front-page__widget {
    width: 320px;
  }
}

@import '~/styles/main';

</style>
