<template>
  <div>
    <q-tabs
      v-model="tab"
      inline-label
      align="left"
      class="tw-bg-black/5 tw-text-primary-500 tw-rounded tw-mb-6"
    >
      <Link :href="course.url.edit">
        <q-tab
          name="course.edit"
        >
          <i-mdi-information-variant class="tw-text-xl tw-mr-1" />
          <span>Informações Gerais</span>
        </q-tab>
      </Link>
      <Link :href="course.url.section.index">
        <q-tab
          name="course.section"
        >
          <i-mdi-format-list-text class="tw-text-xl tw-mr-1" />
          <span>Seções</span>
        </q-tab>
      </Link>
    </q-tabs>
    <slot />
  </div>
</template>

<script setup>
import { usePage } from '@inertiajs/inertia-vue3'

const $page = usePage()

const course = computed(() => $page.props.value.course)

const tab = computed(() => {
  if ([
    'course.section.index',
    'course.section.create',
    'course.section.edit'
  ].includes($page.props.value.current_route_name)) {
    return 'course.section'
  }

  return $page.props.value.current_route_name
})
</script>
