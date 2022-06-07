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
        v-model="openSections[section.id]"
        header-class="text-primary"
      >
        <template #header>
          <q-item-section>
            {{ section.title }}
          </q-item-section>
          <q-item-section side>
            <div class="row items-center">
              <Link :href="section.url.edit">
                <q-btn
                  round
                  flat
                >
                  <i-mdi-pencil />
                </q-btn>
              </Link>
              <q-btn
                round
                flat
                @click.stop="deleteSection(section)"
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
import { merge, mapValues } from 'lodash'

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

  openSections.value = mapValues(openSections.value, o => openAll.value)
}

const openSections = ref({})

const setOpenSections = () => {
  const incomingSections = {}

  props.sections.forEach((section) => {
    incomingSections[section.id] = openAll.value
  })

  openSections.value = merge(incomingSections, openSections.value)
}

const deleteSection = (section) => {
  if (!window.confirm(`Deseja excluir a seção "${section.title}"`)) {
    return
  }

  Inertia.delete(section.url.edit, {
    onSuccess: setOpenSections
  })
}

onBeforeMount(setOpenSections)
</script>
