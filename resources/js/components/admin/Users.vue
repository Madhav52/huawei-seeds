<template>
<v-app>
    <v-navigation-drawer
      app
      v-model="drawer"
      :mini-variant.sync="mini"
      permanent
    >
      <v-list-item class="px-2">
        <!-- <v-list-item-avatar>
          <v-img
            src="/images/logos/applyjob-logo-icon.png"
            alt="applyjob logo"
            class="my-2"
            max-width="90"
          ></v-img>
        </v-list-item-avatar> -->

        <v-list-item-title> Seeds For Nepal</v-list-item-title>

        <v-btn icon @click.stop="mini = !mini">
          <v-icon>mdi-chevron-left</v-icon>
        </v-btn>
      </v-list-item>
      <v-divider></v-divider>

      <v-list shaped link>
        <v-list-item-group v-model="selectedItem" color="#033691">
          <v-list-item to="/admin/user-lists">
            <v-list-item-icon>
              <v-icon>mdi-account-multiple</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title>Users</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <!-- <v-list-group prepend-icon="mdi-contacts">
            <template v-slot:activator>
              <v-list-item-title>Contacts</v-list-item-title>
            </template>

            <v-list-item :to="{ name: 'company-contacts' }" class="pl-6">
              <v-list-item-icon>
                <v-icon>{ mdi-domain }</v-icon>
              </v-list-item-icon>
              <v-list-item-title>Company Contacts</v-list-item-title>
            </v-list-item>

            <v-list-item :to="{ name: 'user-contacts' }" class="pl-6">
              <v-list-item-icon>
                <v-icon>{ mdi-account-multiple }</v-icon>
              </v-list-item-icon>
              <v-list-item-title>User Contacts</v-list-item-title>
            </v-list-item>
          </v-list-group> -->

         
        </v-list-item-group>
      </v-list>
      <!-- -->
    </v-navigation-drawer>
      <!-- Provides the application the proper gutter -->
      <v-container>
         <v-card elevation="5">
      <v-card-title>
        User Lists
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-spacer></v-spacer>
        <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="Search"
          single-line
        ></v-text-field>
      </v-card-title>
      <v-data-table
        :headers="headers"
        :items="userLists"
        item-key="name"
        class="elevation-1"
        :search="search"
      >
        <template v-slot:item.files="{ item }">
               <a :href="item.files">
                  <v-btn
                small
                style="color: #fff; background: #163691"
        
              >
                Preview Document
              </v-btn>
               </a>
          </template>
        <template v-slot:item.actions="{ item }">
          <div class="d-flex align-items-center">
              
            
            <div class="d-flex justify-left align-items-center">
              <v-btn
                small
                style="color: #fff; background: #163691"
                @click="generateUserDetails()"
        
              >
                Download UserDetails
              </v-btn>
            </div>
          </div>
        </template>
      </v-data-table>
    </v-card>
      </v-container>
</v-app>
</template>

<script>
export default {
    data() {
    return {
      drawer: true,
      selectedItem: 0,
      mini: false,
      search: " ",
        users: [],
        headers: [
        { text: "S.N.", value: "sn" },

        {
          text: "User Name",
          align: "left",
          sortable: true,
          value: "name",
        },
        { text: "User Email", value: "email" },
        { text: "Document", value: "files" },
        { text: "Created At", value: "created_at" },
        { text: "Actions", value: "actions", sortable: false },
      ],

    };
  },
  computed: {
    userLists() {
      return this.users.map((req, index) => ({
        ...req,
        sn: index + 1,
      }));
    },
  },
  methods: {
      getAllUsers() {
      this.$store
        .dispatch("getAllUsers")
        .then((response) => {
          console.log(response)
          this.users = response.data.users;
        })
        .catch((error) => {
          console.log(error);
        });
    },
     generateUserDetails() {
        this.$refs.form.action = "/generatePdf"
      // this.$store
      //   .dispatch("generateUserDetails", data)
      //   .then((response) => {
      //     console.log(response.data)
      //   })
      //   .catch((error) => {
      //     console.log(error);
      //   });
    },
  },
  mounted(){
    this.getAllUsers()
  }

}
</script>

<style>

</style>