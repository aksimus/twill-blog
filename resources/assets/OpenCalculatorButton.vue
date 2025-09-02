  <template>
    <div class="calculator-button-wrapper">
      <!-- User not logged in - show Sign In and Sign Up buttons -->
      <template v-if="!user">
        <a 
        :class="cssClass"
          :href="href"
          :target="target"
          :rel="rel"
          @click="signIn"
        >
          <i class="fa fa-sign-in" v-if="showIcons"></i>
          <span v-if="showSpace && showIcons">&nbsp;&nbsp;</span>
          {{ signInText }}
        </a>

      </template>

      <!-- User logged in - show Open Calculator button -->
      <template v-else>
        <a 
          :class="cssClass"
          :href="href"
          :target="target"
          :rel="rel"
          @click="handleClick"
        >
          <i :class="iconClass" v-if="iconClass"></i>
          <span v-if="showSpace">&nbsp;</span>
          {{ buttonText }}
        </a>
      </template>
    </div>
  </template>
  
  <script>
  import { mapGetters } from 'vuex';
  const vuexModuleAuth = 'auth';
  
  export default {
    name: 'OpenCalculatorButton',
    
    props: {
      // CSS classes
      cssClass: {
        type: String,
        default: 'btn btn-primary'
      },
      
      // Link attributes
      href: {
        type: String,
        default: '#'
      },
      target: {
        type: String,
        default: '_self'
      },
      rel: {
        type: String,
        default: ''
      },
      
      // Content
      buttonText: {
        type: String,
        default: 'Open Calculator'
      },
      iconClass: {
        type: String,
        default: 'bx bx-user fs-5 lh-1 me-1'
      },
      showSpace: {
        type: Boolean,
        default: true
      },
      
      // Auth button props
      showIcons: {
        type: Boolean,
        default: true
      },
      signInText: {
        type: String,
        default: 'Sign In'
      },
      signUpText: {
        type: String,
        default: 'Sign Up'
      },
      signInCssClass: {
        type: String,
        default: 'btn btn-success'
      },
      signUpCssClass: {
        type: String,
        default: 'btn btn-primary'
      }
    },
    computed: {
    ...mapGetters(vuexModuleAuth, { checkToken: 'token' }),
    ...mapGetters(vuexModuleAuth, { user: 'user' }),
    },
    methods: {
      handleClick(event) {
        event.preventDefault();
        this.openCalculator();
      },
      
      openCalculator() {
        window.location.href = `/mileage/trips-fuel`;
      },
      
      signIn(event) {
        event.preventDefault();
        // Navigate to sign in page
        window.location.href = '/mileage/login';
      },
      
      signUp(event) {
        event.preventDefault();
        // Navigate to sign up page
        window.location.href = '/mileage/register';
      }
    },
    mounted() {

    }
  }
  </script>

  <style scoped>
  .calculator-button-wrapper {
    display: inline-block;
  }
  </style>