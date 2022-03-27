<template>
  <div class="container">
    <Teleport to="#portal">
      <DeleteModal :modal="modal" @reply="reply" />
    </Teleport>
    <div class="row mt-5 justify-content-between align-items-end">
      <div class="col-4">
        <router-link :to="{name:'Create'}" class="btn btn-primary fw-bold">Create</router-link>
      </div>
      <div class="col-3">
        <div class="search d-flex align-items-center">
          <input type="search" class="form-control me-2" placeholder="Search by name or email" />
          <button class="btn btn-primary fw-bold">Search</button>
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
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(user,i) in users" :key="user.id">
              <td>{{ i+1 }}</td>
              <td>{{ user.name }}</td>
              <td>{{ user.email }}</td>
              <td>
                <div class="d-flex justify-content-center">
                  <router-link
                    :to="{name:'Edit',params:{id:user.id}}"
                    class="btn btn-warning me-3"
                  >Edit</router-link>
                  <button
                    class="btn btn-danger"
                    @click="showModal($event,{type:'delete',id:user.id})"
                  >Delete</button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from "vue";
import DeleteModal from "../components/modal/DeleteModal.vue";
import { useStore } from "vuex";

import axios from "axios";

const store = useStore();

const modal = ref(null);

const showModal = (e, val) => {
  modal.value = val;
};

const reply = async emit => {
  if (emit === "Yes") {
    const { id } = modal.value;
    let res = await axios.delete("api/students/" + id);
    res.status === 200 && store.dispatch("destroy", id);
  }

  modal.value = null;
};

const users = computed(() => store.getters.index);
</script>

<style>
</style>