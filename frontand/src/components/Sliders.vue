<template>
  <div>
    <carousel :items-to-show="1" :autoplay="5000"  :wrapAround="true" >
      <slide v-for="slide in getSliders" :key="slide.id">
        <div class="carousel__item"  v-for="(i,index) in JSON.parse(slide['name'])" :key="index">
          <img :src="`http://inventory.loc/storage/${i.download_link}`" alt="rr">
        </div>
      </slide>
    </carousel>
  </div>
</template>

<script>
import {mapActions} from "vuex";
import {mapGetters} from "vuex";
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide } from 'vue3-carousel';
export default {
  name: "Sliders",
  components: {
    Carousel,
    Slide,
  },
  data(){
    return {
      slides: []
    }
  },
  mounted () {
    this.slider();
  },
  computed: {
    ...mapGetters(['getSliders']),
  },
  methods: {
    ...mapActions(['slider'])
  }
}
</script>

<style scoped>

</style>
