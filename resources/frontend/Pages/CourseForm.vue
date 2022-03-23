<template layout="Authenticated">
  <Head :title="title" />

  <div class="row q-col-gutter-md">
    <div class="col-12 col-sm-8 tw-flex-col tw-space-y-4">
      <q-input
        v-model="form.title"
        outlined
        label="Título"
      />

      <q-editor
        v-model="form.description"
        placeholder="Descrição"
      />
    </div>
    <div class="col-12 col-sm-4 tw-flex-col tw-space-y-4">
      <q-file
        v-model="form.cover"
        outlined
        clearable
        label="Capa"
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
  </div>
</template>

<script setup>
defineProps({
  title: String
})

const form = reactive({
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
