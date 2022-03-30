<template>
  <div class="container">
    <Bar />
    <Table :data="users.data" />
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from "vue";
import DeleteModal from "../components/modal/DeleteModal.vue";
import Table from "../components/Table.vue";
import Bar from "../components/Bar.vue";
import { useStore } from "vuex";

import axios from "axios";
import { useRoute, useRouter } from "vue-router";

const store = useStore();

const route = useRoute();

const router = useRouter();

let url = "/api/students";

onMounted(() => {
  showPage(route.params.name);
});

const showPage = async name => {
  const res = await axios.get(`${url}/${route.params.search}/search`);
  console.log(res);
  const data = res.data;
  store.dispatch("store", data);
};

const showModal = (e, val) => {
  modal.value = val;
};

const reply = async emit => {
  if (emit === "Yes") {
    const { id } = modal.value;
    let res = await axios.delete("api/students/" + id);
    store.dispatch("destroy", id);
    store.dispatch("store", res.data);
  }

  modal.value = null;
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
