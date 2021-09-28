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
                <div class="text-center mb-5">
                  <img
                    src="/images/huawei-cloud.png"
                    alt="Apply Job Logo"
                    class="img-fluid"
                    width="60%"
                    height="50px"
                  />
                </div>
                <div class="row justify-center">
                  <v-col cols="9">
                    <v-form v-model="valid" @submit.prevent="loginFunc">
                      <v-text-field
                        v-model="email"
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
                      <div class="text-right my-5">
                        <a href="/reset-password" color="primary"
                          >Forgot Password?</a
                        >
                      </div>
                      <!-- <div class="text-center">
                        <small
                          >By signing in to your account, you agree to
                          Applyjob's Terms of Service and consent to our Privacy
                          Policy.</small
                        >
                      </div> -->
                      <v-btn
                        rounded
                        to="/user-details"
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
                            Don't have an account? <router-link to="/register">Register</router-link>
                        </p>
                    </div>
                    <div class="text-center pt-4">
                      <p style="font-weight: bold; font-size: 18px; color: #595959">
                        Powered by
                        <a
                          href="https://applyjob.com"
                          color="primary"
                          target="_blank"
                          >
                          <img
                    src="/images/applyjob-logo.png"
                    alt="Apply Job Logo"
                    class="img-fluid"
                    width="30%"
                    height="30px"
                  /></a
                        >
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
      error: false,
      valid: false,
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
          if (response.status == 200) {
            this.$router.push({
              name: "dashboard",
            });
            this.toggleLoading = false;
          } else {
            this.toggleLoading = false;
            this.error = !this.error;
          }
        })
        .catch((err) => {
          this.toggleLoading = false;
          this.error = !this.error;
          this.$swal("Error", err.message, "error");
        });
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
