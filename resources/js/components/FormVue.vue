<template>
  <div class="card mt-3">
    <div class="card-body">
      <form @submit.prevent="insertOrUpdate">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" v-model="name" class="form-control mt-1" placeholder="Enter Your Name" />
          <span
            class="mt-1 text-danger"
            v-if="errorList"
          >{{ errorList.name ? errorList.name[0] :'' }}</span>
        </div>
        <div class="form-group mt-3">
          <label for="email">Email</label>
          <input
            type="email"
            v-model="email"
            class="form-control mt-1"
            placeholder="Enter Your Email"
          />
          <span
            class="mt-1 text-danger"
            v-if="errorList"
          >{{ errorList.email ? errorList.email[0] :'' }}</span>
        </div>
        <div class="form-group mt-3">
          <button type="submit" class="btn btn-primary fw-bold text-capitalize">{{ props.action }}</button>
        </div>
      </form>
    </div>
  </div>
</template>
<script setup>
import { useStore } from "vuex";
import { ref, computed, watch } from "vue";
import axios from "axios";
import { useRouter, useRoute } from "vue-router";

const router = useRouter();

const route = useRoute();

const props = defineProps(["action"]);

const store = useStore();
const name = ref("");
const email = ref("");
const data = ref([]);
const errorList = ref(null);

const dataWatch = watch(data, () => {
  store.dispatch("store", data.value);
});

let url = "/api/students";

if (props.action === "edit") {
  const user = store.getters.find(Number(route.params.id));
  name.value = user.name;
  email.value = user.email;
  url += `/${route.params.id}`;
}

const insertOrUpdate = async () => {
  try {
    let res = await axios({
      url,
      method: "post",
      data: {
        name: name.value,
        email: email.value
      },
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
        "X-Requested-With": "XMLHttpRequest"
      }
    });
    if (res) {
      name.value = "";
      email.value = "";
      data.value = res.data;
      router.push({ name: "Home" });
    }
  } catch (e) {
    console.log(e.response.data);
    errorList.value = e.response.data.errors;
  }
};
</script>


<style>
</style>