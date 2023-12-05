<template>
  <ul class="my-5 bt-1 flex flex-wrap items-center justify-center">

    <li class="text-cyan-800 px-2 font-bold underline" v-for="p in props.numPages">
      <span v-if="p-1 == page">
        {{ p }}
      </span>
      <button v-else @click="setPage(p-1)">
        {{ p }}
      </button>
    </li>

  </ul>
</template>
<script setup>
import { ref } from 'vue';

const page = ref(0);
const emit = defineEmits(['changePage']);

const props = defineProps({
  numPages: Number
});

const pageUp = () => {
  page.value++;
  emitValues();
}

const pageDown = () => {
  page.value--;
  emitValues();
}

const setPage = (val) => {
  page.value = parseInt(val);
  emitValues();
}

const emitValues = () => {
  emit('changePage', page);
};
</script>