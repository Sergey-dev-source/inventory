<template>
  <div>
    <AppHeader />

    <div id="login">
      <div class="login">
        <input type="text" v-model="email" id="email" >
      </div>
      <div class="login">
        <input type="password" v-model="password" id="password">
      </div>
      <button type="button" @click="sendLogin()" >Log in</button>
    </div>
  </div>
</template>

<script>
import AppHeader from "@/components/AppHeader";
import { mapActions } from 'vuex'
export default {
  name: "Login",
  components: {AppHeader},

  data() {
    return {
      email: "",
      password: ''
    }
  },
  methods: {
    ...mapActions(['loginAction']),
    sendLogin() {
      this.loginAction({
        email: this.email,
        password: this.password
      })
    }
  }
}
</script>

<style lang="scss" scoped>
#login {
  width: 500px;
  margin: 50px auto;
  padding: 50px;
  background-color: #f1f1f1;
}
</style>
