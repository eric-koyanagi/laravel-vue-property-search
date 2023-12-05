<template>
  <DefaultLayout>
    <PropertySearch @search="doSearch"/>

    <div v-if="properties" class="mt-3">
      <div v-if="properties.num_found">
        <div class="text-sm mb-3 italic">Found {{properties.records.length}} properties</div>

        <div v-if="properties.records[page.value ?? page]">
          <PropertyView :property="properties.records[page.value ?? page]" />
        </div>
        <div v-else>
          Page {{page}} Not Found
        </div>

        <PropertyPagination @changePage="changePage" :numPages="properties.num_found"/>

      </div>
      <div v-else>
        Click "Search" to find properties
      </div>
    </div>

  </DefaultLayout>
</template>
<script setup>
import { ref } from 'vue';
import DefaultLayout from "../layouts/DefaultLayout.vue";
import PropertyView from "../components/PropertyView.vue";
import PropertySearch from "../components/PropertySearch.vue";
import PropertyPagination from "../components/PropertyPagination.vue";

const properties = ref([]);
const page = ref(0);

const doSearch = async(vals) => {
  const r = await fetch("/api/v1/properties?address=" + vals.address + "&city=" + vals.city + "&province=" + vals.province + "&postal=" + vals.postal);
  properties.value = await r.json();
  changePage(0);
};

const changePage = (newPage) => {
  page.value = newPage;
};

</script>