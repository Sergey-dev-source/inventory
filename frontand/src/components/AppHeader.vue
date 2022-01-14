<template>
  <div class="menu">
    <div class="menu_row">
      <div class="menu_block">
        <div class="menu_content" >

        </div>
        <div class="menu_content" ></div>
      </div>
      <div class="menu__search"> </div>
    </div>
  </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
  name: "AppHeader",
  mounted() {
    this.actionMenu();
  },
  computed: {
    ...mapGetters(['getMenu'])
  },
  methods: {
    ...mapActions(['actionMenu']),
  }
}
</script>
