<template>
  <v-app>
      <v-app-bar app color="#033691" dark class="px-4">
        <v-toolbar-title>Huawei Seeds Program</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn text>
        Download Brochure
      </v-btn>
      <v-btn text to="/faq">
        FAQs
      </v-btn>
       <v-btn text to="/">
        Login
      </v-btn>

      <v-btn text to="/register">
        SignUp
      </v-btn>

      <!-- -->
    </v-app-bar>

    <!-- Sizes your content based upon application components -->
    <v-main>
      <!-- Provides the application the proper gutter -->
      <v-container fluid class="mt-4 p-0">
        <!-- If using vue-router -->
       <router-view></router-view>
      </v-container>
    </v-main>

    <v-footer
    dark
    padless
  >
    <v-card
      flat
      tile
      class="indigo lighten-1 white--text text-center"
    width="100%"

    >
      <v-card-text>
        <h4 class="pb-2" style="color: #fff">Follow Us</h4>
        <a href="" class="px-2"><v-icon size="24px">mdi-facebook</v-icon></a>
        <a href="" class="px-2"><v-icon size="24px">mdi-instagram</v-icon></a>
        <a href="" class="px-2"><v-icon size="24px">mdi-linkedin</v-icon></a>
        <a href="" class="px-2"><v-icon size="24px">mdi-youtube</v-icon></a>
        <!-- <router-link ></router-link> -->
        <!-- <v-btn
          v-for="icon in icons"
          :key="icon"
          class="mx-4 white--text"
          icon
        >
          <v-icon size="24px">
            {{ icon }}
          </v-icon>
        </v-btn> -->
      </v-card-text>

      <!-- <v-card-text class="white--text pt-0">
        Praesent ut risus eget metus luctus accumsan id ultrices nunc. Sed at orci sed massa consectetur dignissim a sit amet dui. Duis commodo vitae velit et faucibus. Morbi vehicula lacinia malesuada. Nulla placerat augue vel ipsum ultrices, cursus iaculis dui sollicitudin. Vestibulum eu ipsum vel diam elementum tempor vel ut orci. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
      </v-card-text> -->

      <v-divider class="my-0"></v-divider>

      <v-card-text class="white--text py-0">
        <div class="container">
          <div class="row">
          <div class="col-lg-6">
            <p class="text-left">
              {{ new Date().getFullYear() }} — <strong>Huawei Cloud</strong>
            </p>
          </div>
          <div class="col-lg-6">
            <p class="text-right">Powered by <a href="https://applyjob.com" style="color: #fff">Applyjob.com</a></p>
          </div>
        </div>
        </div>
        
      </v-card-text>
    </v-card>
  </v-footer>
  </v-app>
</template>

<script>
export default {
    data: () => ({
      icons: [
        'mdi-facebook',
        'mdi-twitter',
        'mdi-linkedin',
        'mdi-instagram',
      ],
    }),
    methods: {
    logout() {
      this.$store
        .dispatch("logout")
        .then((response) => {
          if (response.status == 200) {
            this.$router.push({
              path: "/",
            });
            location.reload();
            localStorage.clear();
          }
        })
        .catch((error) => {
          //   this.$swal("Error", error.message, "error");
        });
    },
    },
     mounted() {},

}
</script>

<style>

</style>