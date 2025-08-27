<template>
  <c-modal
    v-model="mutableState"
    title="Route"
    size="large"
  >
    <div
      id="map"
      slot="body"
      class="modal-route-map" />
    <div slot="footer">
      <c-button-close @click="close" />
    </div>
  </c-modal>
</template>

<script>

export default {
  name: 'ModalRouteMap',

  model: {
    prop: 'state',
    event: 'close',
  },

  props: {
    state: {
      type: Boolean,
      required: true,
    },
    points: {
      type: Array,
      required: true,
    },
    routes: {
      type: Array,
      required: true,
    },
  },

  data() {
    return {
      google: window.google,
      pathCoordinates: [],
      milesColor: '#00b400',
      emptyMilesColor: '#ff8c8c',

      polylineOptions: {
        strokeColor: '#000000',
        strokeOpacity: 1,
        strokeWeight: 4,
      },
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

  watch: {

    points: {
      handler(points) {
        if (points) {
          this.initMap();
        }
      },

    },
  },

  methods: {
    close() { this.mutableState = false; },

    initMap() {
      const map = new google.maps.Map(document.getElementById('map'), {
        zoom: 3,
        center: { lat: 0, lng: 0 },
      });
      map.data.loadGeoJson("/usa.json"); //usa
      map.data.loadGeoJson("/canada.json"); //canada

      map.data.setStyle({
          fillColor: 'transparent',
          strokeColor: 'blue',
          strokeWeight: 1
        });
      


      // Устанавливаем границы карты по всем точкам
      const bounds = new google.maps.LatLngBounds();
      this.points.forEach(point => bounds.extend(point.position));
      map.fitBounds(bounds);

      this.routes.forEach((route, index)=>{
      const hue = (index * 30) % 360; // Change 30 to control color step
      const strokeColor = `hsl(${hue}, 100%, 50%)`;
      const path = new google.maps.Polyline({
        path: route.points,
        geodesic: true,
        strokeColor: strokeColor,
        strokeOpacity: 1.0,
        strokeWeight: 3,
      });

      path.setMap(map);
    });


      this.points.forEach((point)=>{
        const p = Object.assign({
          map:map
        }, point);
        new google.maps.Marker(p);

      });




      if(0){
      // Добавляем маркер начала пути
      if (this.points.length > 0) {
        new google.maps.Marker({
          position: this.points[0],
          map,
          label: '1', // или icon: '...' для кастомной иконки
          title: 'Start',
        });
      }

      // Добавляем маркер конца пути
      if (this.points.length > 1) {
        new google.maps.Marker({
          position: this.points[this.points.length - 1],
          map,
          label: '2',
          title: 'End',
        });
      }
    }

    },
    /*
    initMap() {
      const directionsService = new this.google.maps.DirectionsService();
      const directionsDisplay = new this.google.maps.DirectionsRenderer({
        suppressPolylines: true,
        suppressMarkers: true,
      });
      const map = new this.google.maps.Map(document.querySelector('#map'));

      directionsDisplay.setMap(map);

      this.calculateAndDisplayRoute(directionsService, directionsDisplay, map);
    },

    calculateAndDisplayRoute(directionsService, directionsDisplay, map) {
      const request = {
        waypoints: [],
        travelMode: 'DRIVING',
      };

      let emptyMiles = false;

      if (this.stops.length > 1) {
        if (this.stops[0].type === 'last') emptyMiles = true;

        this.stops
          .map(stop => stop.geo_address)
          .forEach((stop, i, arr) => {
            if (i === 0) request.origin = stop;
            else if (i === arr.length - 1) request.destination = stop;
            else request.waypoints.push({ location: stop, stopover: true });
          });
      }

      directionsService.route(request, (response, status) => {
        if (status === 'OK') {
          this.renderDirectionsPolylines(response, map, emptyMiles);
          this.renderMarkers(response, map);

          directionsDisplay.setDirections(response);
        } else {
          // console.log('Directions request failed due to ', status);
        }
      });
    },

    renderMarkers(response, map) {
      const { legs } = response.routes[0];

      for (let i = 0, l = legs.length; i < l; i++) {
        const color = this.getMarkerColor(this.stops[i].type);
        const stopId = this.stops[i].stop_no || 'P';
        const address = this.stops[i].display_address || '';
        this.createMarker(legs[i].start_location, map, color, stopId, address);

        if (i === (l - 1)) {
          const endColor = this.getMarkerColor(this.stops[l].type);
          const endStopId = this.stops[l].stop_no || 'D';
          const endAddress = this.stops[i + 1].display_address || '';

          this.createMarker(legs[i].end_location, map, endColor, endStopId, endAddress);
        }
      }
    },

    createMarker(position, map, color, id, address) {
      const marker = new this.google.maps.Marker({
        position,
        map,
        icon: `https://chart.googleapis.com/chart?chst=d_map_spin&chld=0.7|0|${color}|11|${id ? '_' : 'b'}|${id ? '%23' : 'D'}${id}`,
      });

      const infowindow = new this.google.maps.InfoWindow({
        content: '<a href="http://www.google.com">A link to google</a>',
      });

      marker.addListener('click', () => {
        infowindow.setContent(`<div><strong>${address}</strong></div>`);
        infowindow.open(map, marker);
      });

      return marker;
    },

    getMarkerColor(stopType) {
      const driverPositionColor = 'ff8989';
      const pickupColor = '00b400';
      const deliveryColor = '3c78e6';

      switch (stopType) {
        case 'last':
          return driverPositionColor;
        case 'pickup':
          return pickupColor;
        case 'delivery':
          return deliveryColor;
        default:
          break;
      }
      return 0;
    },

    renderDirectionsPolylines(response, map, emptyMiles) {
      const bounds = new this.google.maps.LatLngBounds();

      for (let i = 0; i < this.polylines.length; i++) {
        this.polylines[i].setMap(null);
      }

      const paintingMiles = (steps, color) => {
        for (let i = 0; i < steps.length; i++) {
          const nextSegment = steps[i].path;
          const stepPolyline = new this.google.maps.Polyline(this.polylineOptions);
          stepPolyline.setOptions({
            strokeColor: color,
          });
          for (let j = 0; j < nextSegment.length; j++) {
            stepPolyline.getPath().push(nextSegment[j]);
            bounds.extend(nextSegment[j]);
          }

          this.polylines.push(stepPolyline);
          stepPolyline.setMap(map);
        }
      };

      const { legs } = response.routes[0];

      legs.forEach(leg => paintingMiles(leg.steps, this.milesColor));
      if (emptyMiles) paintingMiles(legs[0].steps, this.emptyMilesColor);
    },
    */
  },
};
</script>

<style lang="scss">
.modal-route-map {
  height: 500px;
}
</style>
