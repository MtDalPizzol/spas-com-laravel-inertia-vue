<template layout="Authenticated">
  <Head :title="title" />

  <Link :href="route('course.create')">
    <q-btn
      color="primary"
    >
      <i-mdi-plus class="tw-mr-3" />
      <span>Novo curso</span>
    </q-btn>
  </Link>
</template>

<script setup>
defineProps({
  title: String
})
</script>
