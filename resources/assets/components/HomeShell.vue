<template>
  <div class="home-shell__image_wrapper">
    <section class="home-shell__image"><slot name="image-section" /></section>
    <slot/>
  </div>
    
</template>

<script>
import { mapGetters } from 'vuex';

const vuexModuleAuth = 'auth';

export default {
  name: 'HomeShell',

  computed: {
    ...mapGetters(vuexModuleAuth, { checkToken: 'token' }),
    ...mapGetters(vuexModuleAuth, { user: 'user' }),
  },

  methods: {

    openCalculator(){
        window.location.href = `/trips-fuel`;

    },
    /* eslint-disable no-undef */
    signIn() {
      /*
      const params = window.btoa(JSON.stringify({
        app_id: PRODUCT_ID,
        cb: '/trips-fuel',
      }));
    
      window.location.href = `${AUTH_URL}/login/${params}`;
  */
  window.location.href = `/mileage/login`;
    },

    signUp() {
      /*
      const params = window.btoa(JSON.stringify({
        app_id: PRODUCT_ID,
        cb: '/trips-fuel',
      }));

      window.location.href = `${AUTH_URL}/request-access/${params}`;
*/
      window.location.href = `/mileage/register`;
    },

    goHome() {
      window.location.href = '/';
    },
  },
};
</script>

<style lang="scss">



.home-shell__header {
  display: flex;
  justify-content: space-between;

  width: 100%;
  min-width: 320px;
  height: 55px;

  & > *:first-child {
    width: 120px;
    border: 0;
  }

  & > *:last-child {
    display: flex;
    align-items: center;
    justify-content: center;

    padding: 0;

    & > * + * {
      margin-left: 4px;
    }
  }
}

.home-shell__image {
  width: 100%;
  height: 350px;

  padding: 10px;

  background: hsl(0, 0%, 100%)
                url('/img/highway.jpg')
                no-repeat
                center / auto 100%;
}

@media (min-width: 360px) {
  .home-shell__header {
    & > *:first-child {
      width: 200px;
    }

    & > *:last-child {
      padding: 0 24px;
    }
  }
}

@media (min-width: 590px) {
  .home-shell__image {
    background: hsl(0, 0%, 100%)
                url('/img/highway.jpg')
                no-repeat
                center / 100% auto;
  }
}
</style>
