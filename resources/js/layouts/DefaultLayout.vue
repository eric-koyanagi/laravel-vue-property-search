<script setup>
  import AppNavigation from "../components/AppNavigation.vue";
  //import AppFooter from "../components/AppFooter.vue";
</script>

<template>
  <header>
    <AppNavigation />
  </header>
  <div class="container mx-auto">
    <main>
      <slot />
    </main>
  </div>
  <footer>

  </footer>
</template>