<template>
  <Head :title="title" />
  <Authenticated>
    <h1 class="tw-text-5xl">
      {{ title }}
    </h1>
  </Authenticated>
</template>

<script setup>
defineProps({
  title: String
})
</script>
