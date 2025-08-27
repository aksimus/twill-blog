<template>
  <modal-route-map
    v-if="mutableState"
    v-model="mutableState"
    :trip-id="tripId"
    :points="points"
    :routes="routes"
  />
</template>

<script>

import { frontPage as api } from '~/api';


export default {
  name: 'DemoTripMap',

  components: {

  },
  model: {
    prop: 'state',
    event: 'close',
  },

  props: {
    state: {
      type: Boolean,
      required: true,
    },

    tripId: {
      type: [String, Number],
      required: true,
    },
  },
  data() {
    return {
      points: [],
      routes: [],
    };
  },
  computed: {
    mutableState: {
      get() { return this.state; },
      set(state) {
        this.$emit('close', state);
      },
    },
  },
  async created() {
    const [err, res] = await api.getTripPoints(this.tripId);
    if (err) {
      this.points = [];
      this.routes = [];
    } else {
      this.points = res.data.points;
      this.routes = res.data.routes;
    }
  },

  methods: {

  },
};
</script>
