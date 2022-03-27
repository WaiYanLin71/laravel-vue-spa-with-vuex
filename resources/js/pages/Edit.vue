<template>
  <div class="container">
    <div class="row mt-5 justify-content-center align-items-center">
      <div class="col-md-5">
        <FormVue action="edit"></FormVue>
      </div>
    </div>
  </div>
</template>

<script setup>
import FormVue from "../components/FormVue.vue";
import { ref, computed } from "vue";
</script>

<style>
</style>