<template>
  <div class="container">
    <div class="row mt-5 justify-content-center align-items-center">
      <div class="col-md-4">
        <FormVue action="edit" :param="param"></FormVue>
      </div>
    </div>
  </div>
</template>

<script setup>
import FormVue from "../components/FormVue.vue";
import { useRoute } from "vue-router";
import { ref } from "vue";

const route = useRoute();
const param = ref("");
param.value = route.params.id;
</script>

<style>
</style>