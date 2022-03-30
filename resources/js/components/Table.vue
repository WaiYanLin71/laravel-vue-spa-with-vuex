<template>
  <div class="mt-5">
    <DeleteModal :modal="modal" @reply="reply" />
    <table class="table table-striped table-hover bg-white text-center">
      <thead>
        <tr>
          <th>No</th>
          <th>Name</th>
          <th>Email</th>
          <th>image</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(user, i) in props.data" :key="user.id">
          <td class>{{ i + 1 }}</td>
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>
            <img :src="`/storage/img/${user.image}`" width="100" />
          </td>
          <td>
            <div class="d-flex justify-content-center">
              <router-link
                :to="{ name: 'Edit', params: { id: Number(user.id) } }"
                class="btn btn-warning me-3"
              >Edit</router-link>
              <button
                class="btn btn-danger"
                @click="showModal($event, { type: 'delete', id: user.id })"
              >Delete</button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="d-flex justify-content-center mt-5">
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li v-for="(link,i) in users.links" :key="i" class="page-item">
            <router-link
              class="page-link bg-dark"
              :class="link.active ? 'text-primary' : 'text-white' "
              :data-url="link.url"
              aria-label="Previous"
              :to="{name:'home',
                query:{page:link.url !== null && link.label,}}"
            >
              <span
                aria-hidden="true"
              >{{ link.label.includes("Previous") ? '&laquo' : link.label.includes('Next') ? '&raquo' : link.label }}</span>
            </router-link>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</template>

<script setup>
import DeleteModal from "./modal/DeleteModal.vue";
import { useStore } from "vuex";

import axios from "axios";

import { computed, defineProps, ref } from "vue";

const store = useStore();

const props = defineProps(["data"]);

const users = computed(() => store.getters.index);

const modal = ref(null);

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
</script>

<style>
</style>