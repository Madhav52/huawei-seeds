<template>
  <v-container class="fill-height" fluid>
    <v-row align="center" justify="center">
      <v-col cols="12" sm="8" md="4">
        <v-card class="elevation-12" max-width="30rem" style="border-radius: 2rem">
          <!-- <v-toolbar color="#033691" class="mx-auto">
            <v-spacer />
            <v-toolbar-title> REGISTER </v-toolbar-title>
            <v-spacer />
          </v-toolbar> -->
          <v-card-text>
            <v-row>
              <v-col cols="12">
                <h2 class="text-center" style="font-weight: bold; color: #000">REGISTER</h2>
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
                  <v-col cols="9">
                    <v-form v-model="valid">
                        <v-text-field
                        v-model="name"
                        label="Legal Full Name"
                        :rules="[rules.required, rules.fullName]"
                        name="login"
                        prepend-icon="mdi-account"
                        type="text"
                      ></v-text-field>
                      <v-text-field
                        v-model="email"
                        label="Email Address"
                        :rules="[rules.required, rules.email]"
                        name="login"
                        prepend-icon="mdi-email"
                        type="text"
                      ></v-text-field>

                      <v-text-field
                        :type="show ? 'text' : 'password'"
                        id="password"
                        label="Password"
                        v-model="password"
                        :rules="[rules.required, rules.passwordPattern]"
                        prepend-icon="mdi-lock"
                        @click:append="show = !show"
                        :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                      ></v-text-field>
                      
                     
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
                        @click="register"
                        >Register</v-btn
                      >
                        <!-- :disabled="!valid" -->
                      
                    </v-form>
                    <div class="text-center">
                        <p class="signin-toggle">
                            Already have an account? <router-link to="/">Login</router-link>
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
                    width="50%"
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
      email: '',
      password: '',
      name: '',
      error: false,
      valid: false,
      toggleLoading: false,
      rules: {
        required: (value) => !!value || "Required",
        passwordPattern: (value) => {
          const pattern = /(?=.*?[A-Z])(?=.*?[#?!@$%^&*-]).{8,}/;
          return (
            pattern.test(value) ||
            "8 characters long and 1 Uppercase and 1 special character"
          );
        },
        email: (value) => {
          const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          return (
            pattern.test(value) || "Invalid e-mail. Please enter valid email address"
          );
        },
        fullName: (value) => {
          const pattern = /^[a-zA-Z ]*$/;
          return pattern.test(value) || "Please enter only alphabets (A-Z or a-z)";
        },
      },
    };
  },
  methods: {
    register(e) {
      this.toggleLoading = true;
      this.$store
        .dispatch("register", {
          name: this.name,
          email: this.email,
          password: this.password,
        })
        .then((response) => {
          if(response.data.status = 200){
            this.toggleLoading = false;
            this.$swal(
            "Success",
            "You have been successfully registered. Please check your email and verify it was you before proceed to login",
            "success"
          );
            this.$router.push({ name: "Login" });
          }else{
            this.$swal(
              "Error",
              "Something went wrong. Please try again later.",
              "error"
            );
            this.toggleLoading = false;
          }  
          }
        )
        .catch((error) => {
          this.password = "";
          this.toggleLoading = false;

        });
      // } else {
      //   this.$swal(
      //     "Error",
      //     "Please fill out the captcha before you proceed ahead..",
      //     "error"
      //   );
      // }
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
