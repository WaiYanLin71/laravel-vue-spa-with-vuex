<template>
  <BackDrop v-if="props.modal  !== null && modal.type==='delete'">
    <div class="row mt-5 justify-content-center">
      <div class="col-md-4 col-6">
        <div class="card">
          <div class="card-header">Are You Sure?</div>
          <div class="card-body">
            <p>Are you want to delete this user?.You can't view anynore if you delete.</p>
            <div class="d-flex justify-content-end">
              <button class="btn btn-danger me-2" @click="reply($event,'Yes')">Yes</button>
              <button class="btn btn-primary" @click="reply($event,'Cancel')">Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </BackDrop>
</template>

<script setup>
import { defineProps, computed } from "vue";
import BackDrop from "./BackDrop.vue";

const emit = defineEmits(["reply"]);

const props = defineProps(["modal"]);

const modal = computed(() => {
  if (props) {
    return props.modal;
  }
});

const reply = (e, val) => {
  emit("reply", val);
};
</script>

<style>
</style>