<template layout="Authenticated">
  <Head :title="title" />

  <form
    class="row q-col-gutter-md"
    @submit.prevent="form.post(route('course.store'))"
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
        v-model="form.cover"
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
          v-if="coverUrl"
          :src="coverUrl"
          alt="Capa do curso"
        >
        <i-fa-solid-camera-retro
          v-else
          class="tw-text-6xl tw-text-gray-200"
        />
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

<script setup>
defineProps({
  title: String,
  errors: Object
})

const form = useForm({
  title: null,
  description: '',
  cover: null
})

const coverUrl = ref(null)

const preview = (file) => {
  if (!form.cover) {
    coverUrl.value = null
    return
  }

  coverUrl.value = URL.createObjectURL(form.cover)
}
</script>
