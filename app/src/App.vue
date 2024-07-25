<script setup lang="ts">
  import ImportForm from './components/ImportForm.vue'  
  import ReportProximasFolgas from './components/ReportProximasFolgas.vue'  

  
  
</script>

<template>
  <div class="container">
    <h1>Folgas dos Colaboradores</h1><br><br>
    
    <ImportForm /><br><br>
    
    <ReportProximasFolgas />
  </div>
</template>

<style scoped>
header {
  line-height: 1.5;
}

.logo {
  display: block;
  margin: 0 auto 2rem;
}

h1{
  text-align: center;
  font-weight: bold;
}

@media (min-width: 1024px) {

  header {
    display: flex;
    place-items: center;
    padding-right: calc(var(--section-gap) / 2);
  }

  .logo {
    margin: 0 2rem 0 0;
  }

  header .wrapper {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;
  }
}
</style>
