<template>
  <Head :title="title" />

  <btn-add
    label="Nova seção"
    :href="course.url.section.create"
  />
</template>

<script>
import Authenticated from '@/Layouts/Authenticated.vue'
import CourseLayout from '@/Layouts/CourseLayout.vue'

export default {
  layout: [Authenticated, CourseLayout]
}
</script>

<script setup>
const props = defineProps({
  title: String,
  course: Object
})
</script>
