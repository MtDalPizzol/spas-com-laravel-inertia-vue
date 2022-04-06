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

  <ul class="tw-mt-10">
    <li
      v-for="course in courses"
      :key="course.id"
      class="tw-flex tw-border tw-rounded tw-p-2 tw-my-2 tw-space-x-10 tw-items-center"
    >
      <div class="tw-w-2/12">
        <img
          v-if="course.cover"
          :src="course.cover"
          :alt="course.title"
          class="tw-max-w-[150px]"
        >
        <i-fa-solid-camera-retro
          v-else
          class="tw-text-4xl tw-text-black/10"
        />
      </div>
      <div class="tw-w-4/12">
        <strong>{{ course.title }}</strong>
      </div>
      <div class="tw-w-6/12">
        {{ course.description }}
      </div>
    </li>
  </ul>
</template>

<script setup>
defineProps({
  title: String,
  courses: Array
})
</script>
