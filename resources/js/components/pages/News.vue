<template>
  <div class="news-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-6 col-sm-12"  v-for="(link, index) in url" :key="index" >
              <v-card>
                <v-card-text>
                  <vue-link-preview url="https://sumanmali.com.np" @click="handleClick">
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
  data() {
    return {
      url: ['https://techlekh.com/huawei-nepal-seeds-for-the-future', 'https://risingnepaldaily.com/business/huawei-launches-seeds-for-the-future-in-nepal', 'https://thehimalayantimes.com/nepal/huawei-launches-seeds-for-the-future-for-undergraduate-students-in-nepal', 'https://myrepublica.nagariknetwork.com/news/huawei-launches-seeds-for-the-future-in-nepal/']
    }
  },
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
