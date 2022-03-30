<template>
  <div class="card mt-3">
    <div class="card-body">
      <form @submit.prevent="insertOrUpdate">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" v-model="name" class="form-control mt-1" placeholder="Enter Your Name" />
          <span class="mt-1 text-danger" v-if="errorList">
            {{
            errorList.name ? errorList.name[0] : ""
            }}
          </span>
        </div>
        <div class="form-group mt-3">
          <label for="email">Email</label>
          <input
            type="text"
            v-model="email"
            class="form-control mt-1"
            placeholder="Enter Your Email"
          />
          <span class="mt-1 text-danger" v-if="errorList">
            {{
            errorList.email ? errorList.email[0] : ""
            }}
          </span>
        </div>
        <div class="form-group mt-3">
          <label for="for">Image</label>
          <input type="file" @input="storeImage" class="form-control mt-1" />
          <span class="mt-1 text-danger" v-if="errorList">
            {{
            errorList.image ? errorList.image[0] : ""
            }}
          </span>
        </div>
        <div class="form-group mt-3">
          <button type="submit" class="btn btn-primary fw-bold text-capitalize">{{ props.action }}</button>
        </div>
      </form>
    </div>
  </div>
</template>
<script setup>
import { ref, computed } from "vue";
import { useStore } from "vuex";
import axios from "axios";
import { useRouter, useRoute } from "vue-router";

const router = useRouter();
const route = useRoute();

const props = defineProps(["action"]);

const store = useStore();
const name = ref("");
const email = ref("");
const image = ref("");
const errorList = ref(null);

let url = "/api/students";

const storeImage = e => {
  image.value = e.target.files[0];
};

const findUser = async () => {
  try {
    const user = await axios.get("/api/students/" + route.params.id);
    name.value = user.data.name;
    email.value = user.data.email;
  } catch (e) {
    console.log(e);
  }
};

if (props.action === "edit") {
  url = "/api/students/" + route.params.id;
  findUser();
}

const insertOrUpdate = async () => {
  let formData = new FormData();
  formData.append("name", name.value);
  formData.append("email", email.value);
  formData.append("image", image.value);
  try {
    let res = await axios({
      url,
      method: "post",
      data: formData,
      headers: {
        Accept: "application/json",
        "X-Requested-With": "XMLHttpRequest"
      }
    });
    if (res) {
      name.value = "";
      email.value = "";
      store.dispatch("store", res.data.data);
      router.push({ name: "home" });
    }
  } catch (e) {
    errorList.value = e.response.data.errors;
  }
};
</script>


<style>
</style>
