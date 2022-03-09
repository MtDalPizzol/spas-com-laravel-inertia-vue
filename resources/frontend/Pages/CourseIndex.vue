<template>
  <Head :title="title" />
  <Authenticated>
    <Link :href="route('course.create')">
      <q-btn
        color="primary"
      >
        <i-mdi-plus class="tw-mr-3" />
        <span>Novo curso</span>
      </q-btn>
    </Link>
  </Authenticated>
</template>

<script setup>
defineProps({
  title: String
})
</script>
