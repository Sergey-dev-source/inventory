<template>
  <div class="home">
    <AppHeader />
    <div style="margin-top:20px">
      <Sliders />
    </div>
  </div>
</template>

<script>
// @ is an alias to /src

import AppHeader from "@/components/AppHeader";
import Sliders from "@/components/Sliders";
export default {
  name: 'Home',
  components: {
    Sliders,
    AppHeader
  }
}
</script>
