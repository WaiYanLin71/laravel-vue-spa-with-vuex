<template>
  <div class="container-fluid p-0">
    <div id="nav" class="bg-dark">
      <div class="container py-3 d-flex justify-content-between align-items-center">
        <div class="nav-logo">
          <router-link :to="{name:'Home'}" class="router-link">
            <h1 class="m-0">W.Y.L</h1>
          </router-link>
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
    <router-view />
  </div>
</template>

<script setup>


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

.router-link {
  text-decoration: none;
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
