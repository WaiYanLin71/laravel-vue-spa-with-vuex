<template>
  <div class="container-fluid p-0">
    <div id="nav" class="bg-dark">
      <div class="container py-3 d-flex justify-content-between align-items-center">
        <div class="nav-logo">
          <h1 class="m-0">W.Y.L</h1>
        </div>
        <ul class="d-flex m-0">
          <li class="router mx-4">
            <router-link :to="{name:'Home'}">Home</router-link>
          </li>
          <li class="router">
            <router-link :to="{name:'Login'}">Login</router-link>
          </li>
        </ul>
      </div>
    </div>
    <router-view v-if="data.length > 0" />
  </div>
</template>

<script setup>
import { onMounted, computed } from "vue";
import { useStore } from "vuex";
import axios from "axios";

const store = useStore();

const data = computed(() => store.getters.index);

onMounted(async () => {
  let res = await axios.get("/api/students");
  store.dispatch("store", res.data);
});
</script>

<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.nav-logo {
  color: #07ffd6;
}

.nav-logo h1 {
  font-size: 30px;
}

.router a {
  text-decoration: none;
  color: #07ffd6;
  font-weight: bold;
}

.router a:hover {
  color: #ffffff;
}

ul {
  list-style: none;
}
</style>