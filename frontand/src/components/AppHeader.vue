<template>
  <div class="menu">
    <div class="menu_row">
        <div class="menu_block">
            <div class="menu_logo" >
              <router-link to="/">
                <img src="../assets/images.png" width="200" />
              </router-link>
            </div>
            <div class="menu_content" >
              <div class="menu_content_box">
                <ul>
                  <li>
                    <router-link to="">Category</router-link>
                    <div class="tab_category">
                      <ol class="tab_category_ol" v-for="item in getMenu" :key="item.id"> 
                        <li class="tab_category_head">
                          <router-link to="">{{ item.name }}</router-link>
                        </li>
                        <li class="tab_category_body" v-for="it in item.category" :key="it.id">
                          <router-link to="">{{ it.name }}</router-link>
                        </li>
                      </ol>  
                    </div>
                  </li>
                  <li>
                    <router-link to="">Abaut us</router-link>
                  </li>
                  <li>
                    <router-link to="">Contact us</router-link>
                  </li>
                </ul>
              </div>
              <div class="menu_content_box">
                <ul>
                  <li>
                    <router-link to="">
                      <i class="fas fa-search"></i>
                    </router-link>
                  </li>
                  <li>
                    <router-link to="">
                      <i class="fas fa-user"></i>
                    </router-link>
                  </li>
                  <li>
                    <router-link to="">
                      <i class="fas fa-shopping-bag"></i>
                    </router-link>
                  </li>
                </ul>
              </div>
            </div>
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
