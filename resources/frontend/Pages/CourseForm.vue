<template>
  <Head :title="title" />

  <form
    class="row q-col-gutter-md"
    @submit.prevent="submit"
  >
    <div class="col-12 col-sm-8 tw-flex-col tw-space-y-4">
      <q-input
        v-model="form.title"
        outlined
        label="Título"
        :error="!!errors.title"
        :error-message="errors.title"
      />

      <div>
        <div
          :class="{
            'tw-border-2 tw-border-red-600 tw-rounded': !!errors.description
          }"
        >
          <q-editor
            v-model="form.description"
            placeholder="Descrição"
          />
        </div>
        <div
          v-if="!!errors.description"
          class="tw-text-red-600 tw-text-xs tw-pl-3 tw-pt-1"
        >
          {{ errors.description }}
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-4 tw-flex-col tw-space-y-4">
      <q-file
        v-model="coverFile"
        outlined
        clearable
        label="Capa"
        :error="!!errors.cover"
        :error-message="errors.cover"
        @update:model-value="preview"
      >
        <template #prepend>
          <i-fa-solid-camera-retro />
        </template>
      </q-file>

      <div class="tw-border tw-p-2 tw-rounded tw-w-full tw-h-max tw-flex tw-justify-center tw-items-center">
        <img
          v-if="form.cover_url"
          :src="form.cover_url"
          alt="Capa do curso"
        >
        <i-fa-solid-camera-retro
          v-else
          class="tw-text-6xl tw-text-gray-200"
        />
      </div>

      <div class="tw-flex tw-justify-end">
        <q-btn
          v-if="form.cover_url"
          flat
          size="sm"
          @click="resetCover"
        >
          <i-mdi-delete class="tw-mr-3" />
          <span>Remover capa</span>
        </q-btn>
      </div>
    </div>
    <div>
      <q-btn
        color="primary"
        type="submit"
      >
        <i-mdi-content-save class="tw-mr-3" />
        <div>Salvar</div>
      </q-btn>
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
  action: String,
  method: String,
  title: String,
  course: Object,
  errors: Object
})

const form = useForm(props.course)

const coverFile = ref(null)

const currentCover = {
  cover: form.cover,
  cover_url: form.cover_url
}

const preview = (file) => {
  if (!coverFile.value) {
    form.cover_url = (currentCover.cover_url)
      ? currentCover.cover_url
      : null

    form.cover = (currentCover.cover)
      ? currentCover.cover
      : null

    return
  }

  form.cover_url = URL.createObjectURL(coverFile.value)
}

const resetCover = () => {
  coverFile.value = null
  form.cover_url = null
  form.cover = null
}

const submit = () => {
  form.transform((data) => ({
    ...data,
    cover_file: coverFile.value,
    _method: props.method
  })).post(props.action)
}
</script>
