<template>
  <v-container>
    <v-row>
      <v-col lg="8" offset-lg="2">
        <h3>Please fill up form completely</h3>
        <v-stepper v-model="e1">
          <v-stepper-header>
            <v-stepper-step :complete="e1 > 1" step="1">
              Personal Details
            </v-stepper-step>
            <v-divider></v-divider>

            <!-- <v-stepper-step
            :complete="e1 > 2"
            step="2"
        >
            Upload Document
        </v-stepper-step>

        <v-divider></v-divider>

        <v-stepper-step step="3">
            Personal Statement
        </v-stepper-step> -->
          </v-stepper-header>

          <v-stepper-items>
            <v-stepper-content step="1">
              <v-card class="mb-4 mt-4" color="white lighten-1" elevation="0">
                <v-form ref="form" v-model="valid">
                  <v-row>
                    <v-col cols="2" class="my-auto py-0">
                      <h5>Legal Full Name:</h5>
                    </v-col>
                    <v-col cols="10" class="py-0">
                      <v-text-field
                        v-model="name"
                        label="Name"
                        outlined
                        dense
                        disabled
                      ></v-text-field>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col cols="2" class="my-auto py-0">
                      <h5>Email Address:</h5>
                    </v-col>
                    <v-col cols="10" class="py-0">
                      <v-text-field
                        v-model="email"
                        outlined
                        dense
                        label="Valid Email Address"
                        disabled
                      ></v-text-field>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col cols="2" class="my-auto py-0">
                      <h5>Phone Number:</h5>
                    </v-col>
                    <v-col cols="10" class="py-0">
                      <v-text-field
                        v-model="phone"
                        :rules="phoneRules"
                        label="Your Mobile Number"
                        required
                        outlined
                        dense
                      ></v-text-field>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col cols="2" class="my-auto py-0">
                      <h5>Address:</h5>
                    </v-col>
                    <v-col cols="10" class="py-0">
                      <v-text-field
                        v-model="address"
                        :rules="addressRules"
                        label="Your Address"
                        required
                        outlined
                        dense
                      ></v-text-field>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col cols="2" class="my-auto py-0">
                      <h5>Gender:</h5>
                    </v-col>
                    <v-col cols="6" class="py-0">
                      <v-radio-group v-model="gender" row class="custom-radio">
                        <v-radio label="Male" value="male"></v-radio>
                        <v-radio label="Female" value="female"></v-radio>
                        <v-radio label="Other" value="other"></v-radio>
                      </v-radio-group>
                    </v-col>

                    <v-col cols="4" v-if="this.gender == 'other'">
                      <v-text-field
                        label="Others, Please Specify"
                        required
                        outlined
                        dense
                      ></v-text-field>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col cols="2" class="my-auto py-0">
                      <h5>Institution Name:</h5>
                    </v-col>
                    <v-col cols="10" class="py-0">
                      <v-text-field
                        v-model="institution"
                        :rules="institutionRules"
                        label="Institution Name"
                        required
                        outlined
                        dense
                      ></v-text-field>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col cols="2" class="my-auto py-0">
                      <h5>University Name:</h5>
                    </v-col>
                    <v-col cols="10" class="py-0">
                      <v-text-field
                        v-model="university"
                        :rules="universityRules"
                        label="University Name"
                        required
                        outlined
                        dense
                      ></v-text-field>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col cols="4"
                      ><h5>Upload Transcript or Recommendation letter</h5></v-col
                    >
                    <v-col cols="8">
                      <v-file-input
                        v-model="files"
                        outlined
                        required
                        :rules="[rules.document.type, documentRules]"
                        hint="DOC, PDF and DOCX only"
                        placeholder="Upload your documents"
                        label="Please upload scan copy of either your latest transcript or recommendation letter"
                        v-on:change="onAttachmentFilePicked('files', $event)"
                        prepend-icon=""
                      >
                        <template v-slot:selection="{ text }">
                          <v-chip small label color="primary">
                            {{ text }}
                          </v-chip>
                        </template>
                      </v-file-input>
                      <v-alert
                        type="error"
                        v-if="attachmentUploadErrorFiles"
                        close-text="X"
                        dismissible
                        @click.native="attachmentUploadErrorFiles = ''"
                        >{{ attachmentUploadErrorFiles }}</v-alert
                      >
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col cols="3"><h5>Personal Statemnent</h5></v-col>
                    <v-col cols="9">
                      <v-textarea
                        :rules="statementRules"
                        v-model="statement"
                        outlined
                        dense
                        label="Personal Statement"
                        required
                      ></v-textarea>
                      <p class="text-right">
                        {{ wordCount }} Words. Maximum 600 words only.
                      </p>
                    </v-col>
                  </v-row>
                  <v-checkbox
                    v-model="acknowledge"
                    :rules="acknowledgeRules"
                    color="indigo darken-3"
                    value="indigo darken-3"
                    :label="`I hereby declare, that all of the information I have provided is true and correct. I am
aware that false or incomplete information, whether deliberate or the result of negligence,
may exclude me from the training.`"
                    hide-details
                  ></v-checkbox>
                </v-form>
              </v-card>

              <v-btn
                color="primary"
                @click="userProfilehandleSubmit"
                :disabled="!valid && wordCount < 600"
              >
                Submit
              </v-btn>
            </v-stepper-content>

            <!-- <v-stepper-content step="2">
            <v-card
            class="mb-12"
            color="white lighten-1"
            height="200px"
            elevation="0"
            >
            <h5>Upload your latest transcript or recommendation letter from institution/university</h5> 
            <v-file-input
                    v-model="files"
                    outlined
                    placeholder="Upload your documents"
                    label="Please upload scan copy of either your latest transcript or recommendation letter"
                    multiple
                    prepend-icon=""
                >
                    <template v-slot:selection="{ text }">
                    <v-chip
                        small
                        label
                        color="primary"
                    >
                        {{ text }}
                    </v-chip>
                    </template>
                </v-file-input>
            </v-card>

            <v-btn
            color="primary"
            @click="e1 = 3"
            >
            Continue
            </v-btn>

            <v-btn  @click="e1 = 1">
            Back
            </v-btn>
        </v-stepper-content>

        <v-stepper-content step="3">
            <v-card
            class="mb-12"
            color="white lighten-1"
            height="200px"
            elevation="0"
            >
            <h5>Please write presonal statement in details. (Not more than 600 words)</h5>
            <v-textarea
                counter
                v-model="statement"
                outlined
                 maxlength="600"
                label="Personal Statement"
                :rules="rules"
                ></v-textarea>
            </v-card>

            <v-btn
            color="primary"
            @click="e1 = 1"
            >
            Submit
            </v-btn>
        </v-stepper-content> -->
          </v-stepper-items>
        </v-stepper>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      e1: 1,
      valid: false,
      row: null,
      name: "",
      phone: "",
      statement: "",
      maxrules: [(v) => v.length <= 600 || "Max 600 characters only"],
      phoneRules: [(v) => !!v || "Phone number is required"],
      addressRules: [(v) => !!v || "Address is required"],
      genderRules: [(v) => !!v || "Gender is required"],
      institutionRules: [(v) => !!v || "Institution name is required"],
      universityRules: [(v) => !!v || "University name is required"],
      documentRules: [(v) => !!v || "Document is required"],
      statementRules: [(v) => !!v || "Statement is required"],
      acknowledgeRules: [(v) => !!v || "You need to acknowledge before submit your data"],
      acknowledge: "",
      institution: "",
      university: "",
      gender: null,
      address: "",
      files: null,
      attachmentUploadError: "",
      attachmentUploadErrorFiles: "",
      rules: {
        document: {
          type: (val) => {
            if (
              val.type === "application/pdf" ||
              val.type === "application/doc" ||
              val.type === "application/docx" ||
              !!val
            ) {
              return true;
            }
            return "Please upload pdf, doc or docx";
          },
        },
      },
      nameRules: [
        (v) => !!v || "Name is required",
        (v) => (v && v.length <= 10) || "Name must be less than 10 characters",
      ],
      email: "",
      emailRules: [
        (v) => !!v || "E-mail is required",
        (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
      ],
      userDetail: {},
    };
  },
  computed: {
    wordCount() {
      var vm = this,
        filecont = vm.statement;
      return (
        vm.skip_html && (filecont = filecont.replace(/<\S[^><]*>/gi, "")),
        vm.statement.match(/\w+/g) ? vm.statement.match(/\w+/g).length : 0
      );
    },
  },
  mounted() {
    this.getUserData();
    let user = localStorage.getItem('access-token')
    console.log(user)
    if(this.user == null){
          this.$router.push({
              path: "/",
            });
        }
  },
  methods: {
    onAttachmentFilePicked(val, e) {
      this.attachmentUploadError = "";
      this.attachmentUploadErrorFiles = "";

      if (val === "files") {
        this.files = e;
      }
      this.fileValidation();
    },

    fileValidation() {
      let file;
      if (this.files) {
        file = this.files;
      }
      if (file) {
        let extension = file.name.split(".").pop();
        if (file.size <= 10500000) {
          if (this.files) {
            if (extension === "pdf" || extension === "doc" || extension === "docx") {
              this.uploadedFile = file;
              //   this.userProfilehandleSubmit();
            } else {
              this.attachmentUploadErrorFiles = "File must be of type pdf, doc or docx.";
            }
          }
        } else {
          if (this.files) {
            this.attachmentUploadErrorFiles = "File must be 10MB max";
          } else {
            this.attachmentUploadError = "File must be 10MB max";
          }
        }
      }
      return;
    },
    clearForm() {
      (this.name = ""),
        (this.email = ""),
        (this.phone = ""),
        (this.address = ""),
        (this.files = null),
        (this.gender = ""),
        (this.university = ""),
        (this.institution = ""),
        (this.statement = "");
    },
    userProfilehandleSubmit(e) {
      var formData = new FormData();
      formData.append("files", this.files, this.files.name);
      formData.append("statement", this.statement);
      formData.append("name", this.name);
      formData.append("user_id", this.userDetail.id);
      formData.append("email", this.email);
      formData.append("address", this.address);
      formData.append("phone", this.phone);
      formData.append("gender", this.gender);
      formData.append("institution", this.institution);
      formData.append("university", this.university);
      //   this.formHasErrors = false;
      //   Object.keys(this.form).forEach((f) => {
      //     if (!this.form[f]) this.formHasErrors = true;
      //     this.$refs[f].validate(true);df
      //   });
      this.$store
        .dispatch("storeUserProfile", formData)
        .then((response) => {
          this.$swal(
            "Success",
            "Your data is successfully saved. We will get back to you soon.",
            "success"
          );
          //   this.clearForm();
        })
        .catch((error) => {});
    },
    getUserData() {
      this.$store.dispatch("getUser").then((res) => {
        this.userDetail = res.data;
        this.name = this.userDetail.name;
        this.email = this.userDetail.email;
        if (this.userDetail.userdetail) {
          this.statement = this.userDetail.userdetail.statement;

          this.address = this.userDetail.userdetail.address;
          this.phone = this.userDetail.userdetail.phone;
          this.gender = this.userDetail.userdetail.gender;
          this.institution = this.userDetail.userdetail.institution;
          this.university = this.userDetail.userdetail.university;
        }
      });
    },
  },
};
</script>

<style></style>
