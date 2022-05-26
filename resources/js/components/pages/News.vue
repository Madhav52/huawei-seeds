<template>
  <div class="news-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-6 col-sm-12">
              <v-card>
                <v-card-text>
                  <vue-link-preview url="https://vuejs.org/" @click="handleClick">
                    <template v-slot:loader>
                      <p class="text-center">Fetching Preview...</p>
                    </template>
                    <template v-slot:default="preview">
                      <div>
                        <p>Domain: {{ preview.domain }}</p>
                        <p>Title: {{ preview.title }}</p>
                        <p>Description: {{ preview.description }}</p>
                        <img
                          height="100px"
                          width="100px"
                          :src="preview.img"
                          :alt="preview.title"
                        />
                      </div>
                    </template>
                  </vue-link-preview>
                </v-card-text>
              </v-card>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  components: {},
  methods: {
    handleClick(preview) {
      console.log(
        "click",
        preview.domain,
        preview.title,
        preview.description,
        preview.img
      );
    },
  },
};
</script>
