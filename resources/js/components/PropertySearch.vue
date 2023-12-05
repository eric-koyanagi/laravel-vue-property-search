<template>
  <div class="font-bold ml-1 mb-3 text-sm">Property Search:</div>
  <div class="relative mx-auto rounded-lg bg-gradient-to-tr from-pink-300 to-blue-300 p-0.5 shadow-lg">
    <div class="bg-white p-7 rounded-md">
      <div class="grid grid-flow-row-dense md:grid-cols-9">
        <div class="col-span-3">
          <label for="address" class="">Address: </label>
          <input id="address" class="p-2 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" v-model="address" placeholder="123 Fake St"/>
        </div>

        <div class="col-span-2">
          <label for="city" class="">City: </label>
          <input id="city" class="p-2 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" v-model="city" placeholder="Vancouver"/>
        </div>

        <div class="">
          <label for="province" class="">State: </label>
          <input id="province" class="p-2 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-10" v-model="province" placeholder="WA"/>
        </div>

        <div class="col-span-2">
          <label for="postal" class="">Postal: </label>
          <input id="postal" class="p-2 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-20" v-model="postal" placeholder="98682"/>
        </div>

        <div class="">
          <input type="submit" @click="emitValues" class="p-2 shadow-sm bg-gray-50 hover:bg-cyan-300 border border-gray-300 text-gray-900 text-sm rounded-lg" value="Search"/>
        </div>
      </div>

    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const address = ref('');
const city = ref('');
const province = ref('');
const postal = ref('');

const emit = defineEmits(['search']);

const emitValues = () => {
  emit('search', {
    address: address.value,
    city: city.value,
    province: province.value,
    postal: postal.value,
  });
};
</script>
