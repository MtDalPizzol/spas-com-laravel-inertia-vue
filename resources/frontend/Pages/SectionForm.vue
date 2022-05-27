<template>
  <Head :title="title" />

  <form @submit.prevent="form[method](action)">
    <div class="tw-flex-col tw-space-y-4">
      <q-input
        v-model="form.title"
        label="Título"
        outlined
        :error="!!errors.title"
        :error-message="errors.title"
      />

      <btn-save />
    </div>
  </form>
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
  course: Object,
  section: Object,
  errors: Object,
  method: String,
  action: String
})

const form = useForm(props.section)
</script>
