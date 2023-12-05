<template>
  <DefaultLayout>
    <div v-if="properties.length">
      <div v-for="property in properties" class="border">
        <PropertyView :property="property" :defaultWishlistStatus="true"/>
      </div>
    </div>
    <div v-else>
      No wishlist items found
    </div>
  </DefaultLayout>
</template>
<script setup>
import DefaultLayout from "../layouts/DefaultLayout.vue";
import PropertyView from "../components/PropertyView.vue";
import {ref, onMounted} from "vue";

const properties = ref([]);

onMounted(() => {
  getWishlist();
})

async function getWishlist()
{
  const r = await fetch("/api/v1/wishlist-properties");
  properties.value = await r.json();
}


</script>