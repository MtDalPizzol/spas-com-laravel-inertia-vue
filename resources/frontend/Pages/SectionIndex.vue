<template>
  <Head :title="title" />

  <div class="tw-flex tw-justify-between tw-mb-6">
    <btn-add
      label="Nova seção"
      :href="course.url.section.create"
    />

    <q-btn
      round
      flat
      :title="openAll ? 'Fechar todas' : 'Abrir todas'"
      @click="toggleAll"
    >
      <i-ic-round-playlist-remove
        v-if="openAll"
        class="tw-text-lg"
      />
      <i-ic-round-playlist-add
        v-else
        class="tw-text-lg"
      />
    </q-btn>
  </div>

  <div class="tw-flex tw-flex-col tw-space-y-3">
    <div
      v-for="section in sections"
      :key="section.id"
      class="tw-border tw-rounded-md"
    >
      <q-expansion-item
        v-model="section.is_open"
        header-class="text-primary"
      >
        <template #header>
          <q-item-section>
            {{ section.title }}
          </q-item-section>
          <q-item-section side>
            <div class="row items-center">
              <q-btn
                round
                flat
              >
                <i-mdi-pencil />
              </q-btn>
              <q-btn
                round
                flat
              >
                <i-mdi-trash />
              </q-btn>
            </div>
          </q-item-section>
        </template>
        <q-card>
          <q-card-section>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, eius reprehenderit eos corrupti
            commodi magni quaerat ex numquam, dolorum officiis modi facere maiores architecto suscipit iste
            eveniet doloribus ullam aliquid.
          </q-card-section>
        </q-card>
      </q-expansion-item>
    </div>
  </div>
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
  sections: Array
})

const openAll = ref(true)

const toggleAll = () => {
  openAll.value = !openAll.value

  setState()
}

const setState = () => {
  props.sections.map((section) => {
    section.is_open = openAll.value
    return section
  })
}

onMounted(() => {
  setState()
})
</script>
