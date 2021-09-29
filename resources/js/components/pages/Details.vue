<template>
  <v-container>
      <h3>Please fill up form completely</h3>
      <v-stepper v-model="e1">
        <v-stepper-header>
        <v-stepper-step
            :complete="e1 > 1"
            step="1"
        >
            Personal Details
        </v-stepper-step>

        <v-divider></v-divider>

        <v-stepper-step
            :complete="e1 > 2"
            step="2"
        >
            Upload Document
        </v-stepper-step>

        <v-divider></v-divider>

        <v-stepper-step step="3">
            Personal Statement
        </v-stepper-step>
        </v-stepper-header>

        <v-stepper-items>
        <v-stepper-content step="1">
            <v-card
                class="mb-12 mt-4"
                color="white lighten-1"
                elevation="0"
            >
            <v-form
                ref="form"
                v-model="valid"
                lazy-validation
            >
             <v-row>
                <v-col cols="2" class="my-auto py-0">
                    <h5>Legal Full Name:</h5>
                </v-col>
                <v-col cols="10"  class="py-0">
                    <v-text-field
                    v-model="fullname"
                    :rules="nameRules"
                    label="Name"
                    outlined
                    dense
                    required
                    ></v-text-field>
                </v-col>
             </v-row>
            <v-row>
                <v-col cols="2" class="my-auto py-0">
                    <h5>Email Address:</h5>
                </v-col>
                <v-col cols="10"  class="py-0">
                    <v-text-field
                    v-model="email"
                    :rules="emailRules"
                    outlined
                    dense
                    label="Valid Email Address"
                    required
                    ></v-text-field>
                </v-col>
             </v-row>
             <v-row>
                <v-col cols="2" class="my-auto py-0">
                    <h5>Phone Number:</h5>
                </v-col>
                <v-col cols="10"  class="py-0">
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
                <v-col cols="10"  class="py-0">
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
                 <v-col cols="2" class="py-0">
                     <v-radio-group
                v-model="row"
                row
                >
                <v-radio
                    label="Male"
                    value="male"
                ></v-radio>
                <v-radio
                    label="Female"
                    value="female"
                ></v-radio>
            </v-radio-group>
                             </v-col>

            <v-col cols="4">
                <v-text-field
                    v-model="gender"
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
                <v-col cols="10"  class="py-0">
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
                <v-col cols="10"  class="py-0">
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

                </v-form>
            </v-card>

            <v-btn
            color="primary"
            @click="e1 = 2"
            >
            Continue
            </v-btn>

            <v-btn text>
            Cancel
            </v-btn>
        </v-stepper-content>

        <v-stepper-content step="2">
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

            <v-btn text>
            Cancel
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
            Continue
            </v-btn>

            <v-btn text>
            Cancel
            </v-btn>
        </v-stepper-content>
        </v-stepper-items>
  </v-stepper>
  </v-container>
</template>

<script>
export default {
    data () {
      return {
            e1: 1,
            valid: true,
            row: null,
            fullname: '',
            phone: '',
            statement: '',
            rules: [v => v.length <= 600 || 'Max 600 characters only'],
            phoneRules: [v => !!v || 'Phone number is required'],
            addressRules: [v => !!v || 'Address is required'],
            genderRules: [v => !!v || 'Gender is required'],
            institutionRules: [v => !!v || 'Institution name is required'],
            universityRules: [v => !!v || 'University name is required'],
            institution: '',
            university: '',
            gender: '',
            address: '',
            files: [],
            nameRules: [
                v => !!v || 'Name is required',
                v => (v && v.length <= 10) || 'Name must be less than 10 characters',
            ],
            email: '',
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
            ],
        }
    },
}
</script>

<style>

</style>