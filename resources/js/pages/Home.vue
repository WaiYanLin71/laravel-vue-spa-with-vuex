<template>
  <div class="container">
    <Bar />
    <Table :data="users.data" />
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from "vue";
import Table from "../components/Table.vue";
import Bar from "../components/Bar.vue";
import { useStore } from "vuex";

import axios from "axios";
import { useRoute, useRouter } from "vue-router";

const store = useStore();

const modal = ref(null);

const route = useRoute();

const router = useRouter();

let url = "/api/students";

onMounted(() => {
  showPage(route.query.page);
});

const showPage = async (count = null) => {
  const res = await axios.get(url + (count ? "?page=" + count : ""));
  const data = res.data;
  store.dispatch("store", data);
};

const users = computed(() => store.getters.index);
</script>

<style>
td {
  vertical-align: middle;
}

.paginator {
  margin-top: 100px;
}
</style>
