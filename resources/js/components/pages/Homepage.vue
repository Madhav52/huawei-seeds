<template>
  <v-app>
    <v-app-bar app color="#033691" dark class="px-4">
      <v-toolbar-title>Application Portal</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-menu offset-y>
        <template v-slot:activator="{ on }">
          <div v-on="on" class="pl-3" style="cursor: pointer !important">
            <!-- <v-avatar size="32px" color="primary">
              <v-icon>mdi-account</v-icon>
            </v-avatar> -->
            <span
              class="px-2"
              style="font-weight: bold; font-family: 'DM Sans', sans-serif !important"
            >
              PROGRAM DETAILS
              <v-icon>mdi-chevron-down</v-icon>
            </span>
          </div>
        </template>

        <v-list>
          <v-list-item link>
            <v-list-item-title>
              <a href="/pdf/Application-Call.pdf" class="pdf-viewer" target="_blank"
                ><v-icon class="pr-4" small>mdi-logout</v-icon>Program Application Call</a
              >
            </v-list-item-title>
          </v-list-item>
          <v-list-item link>
            <v-list-item-title>
              <a href="/pdf/Program-Introduction.pdf" class="pdf-viewer" target="_blank"
                ><v-icon class="pr-4" small>mdi-logout</v-icon>Program Introduction</a
              >
            </v-list-item-title>
          </v-list-item>
          <v-list-item link>
            <v-list-item-title>
              <a href="https://www.facebook.com/HuaweiTechNP/videos/1079201635953765" class="pdf-viewer" target="_blank"
                ><v-icon class="pr-4" small>mdi-logout</v-icon>2021 Introduction Video</a
              >
            </v-list-item-title>
          </v-list-item>
           <v-list-item link>
            <v-list-item-title>
              <a href="https://fb.watch/dgoi4FPUvH/" class="pdf-viewer" target="_blank"
                ><v-icon class="pr-4" small>mdi-logout</v-icon>2021 Summary Video</a
              >
            </v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
       <v-btn text to="/news"> News </v-btn>
      <v-btn text to="/faq"> FAQs </v-btn>
      <v-btn text to="/" v-if="!loggedIn"> Login </v-btn>

      <v-btn text to="/register" v-if="!loggedIn"> SignUp </v-btn>

      <v-btn text @click="logout" v-if="loggedIn"> Logout </v-btn>

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

    <v-footer dark padless>
      <v-card flat tile class="indigo lighten-1 white--text text-center" width="100%">
        <v-card-text>
           <div class="container">
            <div class="row">
              <div class="col-lg-6">
                <div class="text-left white--text">
                  <h4 class="pb-2" style="color: #fff">Follow Us</h4>
            <a href="https://www.facebook.com/HuaweiTechNP/" target="_blank" class="px-2"><v-icon size="24px">mdi-facebook</v-icon></a>
            <a href="https://www.huawei.com/minisite/seeds-for-the-future/program.html" target="_blank" class="px-2"><v-icon size="24px">mdi-earth</v-icon></a>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="text-right">
                   <h4 style="color: #fff !important">For Support/Enquiry</h4>
              <p style="color: #fff !important; font-size: 18px">Email Us: help@seedsnepal.com</p>
                </div>
              </div>
            </div>
          </div>
          
          <!-- <a href="" class="px-2"><v-icon size="24px">mdi-instagram</v-icon></a>
          <a href="" class="px-2"><v-icon size="24px">mdi-linkedin</v-icon></a>
          <a href="" class="px-2"><v-icon size="24px">mdi-youtube</v-icon></a> -->
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
                  © {{ new Date().getFullYear() }} — <strong>All Rights Reserved</strong>
                </p>
              </div>
              <div class="col-lg-6">
                <p class="text-right">
                  Powered by
                  <a href="https://applyjob.com" style="color: #fff">Applyjob.com</a> and <span><a href="https://soft9.org" style="color: #fff">Soft9.org</a></span>
                </p>
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
    loggedIn: false,
    icons: ["mdi-facebook", "mdi-twitter", "mdi-linkedin", "mdi-instagram"],
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
    getUserData() {
      this.$store.dispatch("getUser").then(() => {
        this.loggedIn = true;
      });
    },
  },
  mounted() {
    // let user = localStorage.getItem('access-token')
    // console.log(user)
    // if(this.user == null){
    //       this.$router.push({
    //           path: "/",
    //         });
    //     }
    this.getUserData();
  },
  updated() {
    this.getUserData();
  },
};
</script>

<style>
a {
  color: #033691;
}
a:hover {
  text-decoration: none;
}
.pdf-viewer i {
  color: #033691 !important;
}
.pdf-viewer:hover {
  color: blue !important;
  text-decoration: none;
}
.pdf-viewer:hover i {
  color: blue !important;
}
</style>
