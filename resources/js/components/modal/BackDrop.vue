<template>
  <Teleport to="#portal">
    <div class="backdrop">
      <slot></slot>
    </div>
  </Teleport>
</template>

<script setup>
</script>

<style>
.backdrop {
  position: fixed;
  z-index: 100;
  width: 100%;
  height: 100vh;
  background-color: #000000b3;
}
</style>