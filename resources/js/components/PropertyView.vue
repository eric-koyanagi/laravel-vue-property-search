<template>
  <div class="bg-slate-50 p-3 rounded">
    <div class="text-underline text-cyan-800">
      <span v-if="isOnWishlist">
          <button @click="removeFromWishlist">Remove From Wishlist</button>
      </span>
      <span v-else>
          <button @click="addToWishlist">Add To Wishlist</button>
      </span>
    </div>

    <div class="font-bold">Address: {{ props.property.address }}</div>
    <div class="">Categories: {{ Array.isArray(props.property.categories) ? props.property.categories?.join(', ') : props.property.categories }}</div>
    <div class="">Added: {{ props.property.dateAdded }}</div>
    <div class="">Updated: {{ props.property.dateUpdated }}</div>

  </div>

</template>

<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
  property: Object,
  defaultWishlistStatus: Boolean
});

const isOnWishlist = ref(props.defaultWishlistStatus ?? false);
const addToWishlist = async() => {
  const requestOptions = {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
      address: props.property.address,
      city: props.property.city,
      province: props.property.province,
      postal: props.property.postalCode ?? props.property.postal,
      categories: props.property.categories?.join(', '),
      dateAdded: props.property.dateAdded,
      dateUpdated: props.property.dateUpdated,
    })
  };

  const r = await fetch('/api/v1/wishlist-properties ', requestOptions);
  isOnWishlist.value = true;
}

const removeFromWishlist = async() => {
  const requestOptions = {
    method: 'DELETE',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
      address: props.property.address,
      city: props.property.city,
      province: props.property.province,
      postal: props.property.postalCode ?? props.property.postal
    })
  };

  const r = await fetch('/api/v1/wishlist-properties ', requestOptions);
  isOnWishlist.value = false;
}

</script>