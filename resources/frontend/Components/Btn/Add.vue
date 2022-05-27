<template>
  <Link>
    <q-btn
      color="primary"
    >
      <i-mdi-plus class="tw-mr-3" />
      <span>
        {{ label }}
      </span>
    </q-btn>
  </Link>
</template>

<script setup>
const props = defineProps({
  label: String
})
</script>
