<template>
  <div class="row mt-5 justify-content-between align-items-end">
    <div class="col-4">
      <router-link :to="{ name: 'Create' }" class="btn btn-primary fw-bold">Create</router-link>
    </div>
    <div class="col-3">
      <div class="search d-flex align-items-center">
        <input
          type="search"
          v-model="search"
          class="form-control me-2"
          placeholder="Search by name or email"
        />
        <button @click="searching" class="btn btn-primary">Search</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();

const search = ref("");

const searching = () => {
  search.value &&
    router.push({ name: "search", params: { search: search.value } });
};
</script>

<style>
</style>