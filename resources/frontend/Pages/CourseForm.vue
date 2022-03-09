<template>
  <Head :title="title" />
  <Authenticated>
    <h1>{{ title }}</h1>
  </Authenticated>
</template>

<script setup>
defineProps({
  title: String
})
</script>
