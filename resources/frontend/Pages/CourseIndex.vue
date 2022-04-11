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
          v-if="course.cover_url"
          :src="course.cover_url"
          :alt="course.title"
          class="tw-max-w-[150px]"
        >
        <i-fa-solid-camera-retro
          v-else
          class="tw-text-4xl tw-text-black/10"
        />
      </div>
      <div class="tw-w-4/12">
        <Link :href="course.url.edit">
          <strong>{{ course.title }}</strong>
        </Link>
      </div>
      <div class="tw-w-5/12">
        {{ course.description }}
      </div>
      <div class="tw-w-1/12 tw-flex tw-justify-end">
        <Link :href="course.url.edit">
          <q-btn
            flat
            round
            color="primary"
          >
            <i-mdi-pencil />
          </q-btn>
        </Link>
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
