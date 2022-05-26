<template>
  <v-container class="fill-height" fluid>
    <v-row align="center" justify="center">
      <v-col cols="12" sm="8" md="4">
        <v-card class="elevation-12" max-width="30rem" style="border-radius: 2rem">
          <!-- <v-toolbar color="#033691" class="mx-auto">
            <v-spacer />
            <v-toolbar-title> LOGIN NOW </v-toolbar-title>
            <v-spacer />
          </v-toolbar> -->
          <v-card-text>
            <v-row>
              <v-col cols="12">
                <h2 class="text-center" style="font-weight: bold; color: #000">LOGIN</h2>
                <v-divider></v-divider>
                <!-- <div class="text-center mb-5">
                  <img
                    src="/images/huawei-cloud.png"
                    alt="Apply Job Logo"
                    class="img-fluid"
                    width="60%"
                    height="50px"
                  />
                </div> -->
                <div class="row justify-center">
                  <v-col cols="9" class="mt-4">
                    <v-form v-model="valid" @submit.prevent="loginFunc">
                      <v-text-field
                        v-model="email"
                        autocomplete="username"
                        label="Email Address"
                        :rules="[rules.required, rules.email]"
                        name="login"
                        prepend-icon="mdi-account"
                        type="text"
                      ></v-text-field>

                      <v-text-field
                        :type="show ? 'text' : 'password'"
                        id="password"
                        label="Password"
                        autocomplete="new-password"
                        v-model="password"
                        :rules="[rules.required]"
                        prepend-icon="mdi-lock"
                        @click:append="show = !show"
                        :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                      ></v-text-field>
                      <v-alert type="error" v-if="error">
                        <template v-slot:append>
                          <v-icon @click="changeErrorStatus">mdi-close</v-icon>
                        </template>
                        Email or password you entered doesn't match
                      </v-alert>
                      <!-- <div class="text-right my-5">
                        <a href="/reset-password" color="primary"
                          >Forgot Password?</a
                        >
                      </div> -->
                      <!-- <div class="text-center">
                        <small
                          >By signing in to your account, you agree to
                          Applyjob's Terms of Service and consent to our Privacy
                          Policy.</small
                        >
                      </div> -->
                      <v-btn
                        rounded
                        color="#033691"
                        block
                        class="mx-2 px-10 py-5 my-10"
                        :loading="toggleLoading"
                        type="submit"
                        >Login</v-btn
                      >
                    </v-form>
                    <div class="text-center">
                      <p class="signin-toggle">
                        Don't have an account?
                        <router-link to="/register">Register</router-link>
                      </p>
                    </div>
                    <div class="text-center pt-4">
                      <p style="font-weight: bold; font-size: 18px; color: #595959">
                        Powered by
                        <a href="https://applyjob.com" color="primary" target="_blank">
                          <img
                            src="/images/applyjob-logo.png"
                            alt="Apply Job Logo"
                            class="img-fluid"
                            width="50%"
                        /></a>
                      </p>
                      <!-- <p>Huawei © {{ new Date().getFullYear() }}</p> -->
                    </div>
                  </v-col>
                </div>
              </v-col>
            </v-row>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      show: false,
      email: null,
      password: null,
      isExist: false,
      error: false,
      valid: false,
      userDetail: [],
      toggleLoading: false,
      rules: {
        required: (value) => !!value || "Required",
        email: (value) => {
          const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          return pattern.test(value) || "Invalid e-mail.";
        },
      },
    };
  },
  methods: {
    loginFunc() {
      this.toggleLoading = true;
      let data = {
        email: this.email,
        password: this.password,
      };
      this.$store
        .dispatch("login", data)
        .then((response) => {
          if (response.data.code == 405) {
            this.error = false;
            this.toggleLoading = false;
            this.$swal(
              "Thank You!",
              "We have received your applications. You donot need to login in the system again. We will reach out to you once you are shortlisted for the final interview. We wish you the best of luck.",
              "warning"
            );
          } else {
            if (response.status == 200) {
              if (response.data.logged_in_user.role === 1) {
                this.$router.push({
                  name: "Users",
                });
              } else {
                if (response.data.logged_in_user.is_verified === 1) {
                  this.$router.push({
                    name: "Details",
                  });
                }else{
                  this.$swal(
                    "Sorry!",
                    "Please check your email and click verify button in order to proceed to login.",
                    "warning"
                  );
                }
              }

              this.toggleLoading = false;
            } else {
              this.toggleLoading = false;
            }
          }
        })
        .catch((err) => {
          this.toggleLoading = false;
          this.error = !this.error;
        });
    },
    checkUser() {
      this.$store
        .dispatch("checkUser")
        .then((response) => {
          this.isExist = true;
          console.log(response);
        })
        .catch((err) => {});
    },
    changeErrorStatus() {
      this.error = false;
    },
  },
};
</script>

<style scoped>
.v-btn--disabled {
  background-color: #ddd !important;
}
.theme--light.v-sheet {
  color: #fff !important;
}
.theme--light.v-btn {
  color: #fff !important;
}
</style>
