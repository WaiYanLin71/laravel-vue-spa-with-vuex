<template>
  <div class="container">
    <Teleport to="#portal">
      <DeleteModal :modal="modal" @reply="reply" />
    </Teleport>
    <div class="row mt-5 justify-content-between align-items-end">
      <div class="col-4">
        <router-link :to="{ name: 'Create' }" class="btn btn-primary fw-bold"
          >Create</router-link
        >
      </div>
      <div class="col-3">
        <div class="search d-flex align-items-center">
          <input
            type="search"
            class="form-control me-2"
            placeholder="Search by name or email"
          />    
        </div>
      </div>
    </div>
    <div class="mt-5" v-if="users.length > 0">
      <div class="col-12">
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
            <tr v-for="(user, i) in users" :key="user.id">
              <td class="">{{ i + 1 }}</td>
              <td>{{ user.name }}</td>
              <td>{{ user.email }}</td>
              <td>
                <img :src="`storage/img/${user.image}`" alt="" width="100" />
              </td>
              <td>
                <div class="d-flex justify-content-center">
                  <router-link
                    :to="{ name: 'Edit', params: { id: user.id } }"
                    class="btn btn-warning me-3"
                    >Edit</router-link
                  >
                  <button
                    class="btn btn-danger"
                    @click="showModal($event, { type: 'delete', id: user.id })"
                  >
                    Delete
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="d-flex justify-content-center paginator text-wite">
      <ul class="pagination" v-if="users.length > 0">
        <li class="page-item">
          <router-link
            :to="{
              name: 'Home',
              query: { page: Number(page) > 1 ? Number(page) - 1 : 1 },
            }"
            class="page-link bg-dark text-primary"
            >Previous</router-link
          >
        </li>
        <li
          v-for="link in links.filter((link, index) => {
            if (
              index >= current &&
              index <= to &&
              !link.label.includes('Next') &&
              !link.label.includes('Previous')
            ) {
              return link;
            }
          })"
          class="page-item"
          :key="link.label"
        >
          <router-link
            :to="{ name: 'Home', query: { page: link.label } }"
            class="page-link bg-dark"
            :class="link.active ? 'text-white' : 'text-primary'"
            >{{ link.label }}</router-link
          >
        </li>
        <li class="page-item">
          <router-link
            :to="{
              name: 'Home',
              query: {
                page:
                  Number(page) == links.length - 2
                    ? links.length - 2
                    : page == null
                    ? 2
                    : Number(page) + 1,
              },
            }"
            class="page-link bg-dark text-primary"
            >Next</router-link
          >
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from "vue";
import DeleteModal from "../components/modal/DeleteModal.vue";
import { useStore } from "vuex";
import { useRoute,useRouter } from "vue-router";

import axios from "axios";

const store = useStore();

const modal = ref(null);

const route = useRoute();

const page = ref(null);

const queryPage = computed(() => route.query.page);



watch(queryPage, () => {
  page.value = route.query.page;
  start(page.value, "page");
});


const start = async (query = null, key = null) => {
  let url = "/api/students";
  if (query && key) {
    url += `?${key}=${query}`;
  } else if (query) {
    url = query;
  }
  let res = await axios.get(url);
  if (res) {
    console.log(res.data);
    store.dispatch("data", res.data);
    store.dispatch("store", res.data.data);
  }
};

onMounted(() => {
  let url = "/api/students";
  if (route.query.page) {
    return start(url + `?page=${route.query.page}`);
  }
  start();
});

const showModal = (e, val) => {
  modal.value = val;
};

const reply = async (emit) => {
  if (emit === "Yes") {
    const { id } = modal.value;
    let res = await axios.delete("api/students/" + id);
    res.status === 200 && store.dispatch("destroy", id);
  }

  modal.value = null;
};

const users = computed(() => store.getters.index);
const links = computed(() => store.state.links);
const current = computed(() => store.state.current);
const to = computed(() => store.state.to);
</script>

<style>
td {
  vertical-align: middle;
}

.paginator {
  margin-top: 100px;
}
</style>
