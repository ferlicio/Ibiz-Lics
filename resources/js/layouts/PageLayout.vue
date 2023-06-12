<script>
    import Header from '@/Components/Header.vue'
    import Sidebar from '@/Components/Sidebar.vue'

    export default {
        components: {
            Header,
            Sidebar
        }     
    }
</script>

<template>
    <div>
      <Header />
      <div class="flex-container page">
        <Sidebar />
        <div class="content">
          <slot></slot>
        </div>
      </div>
    </div>
  </template>

<style>

.flex-container {
    display: flex;
}

.page {
    display: flex;
    flex-direction: row;
    height: calc(100vh - 60px);
}

.content {
  margin: 10px;
  width: 100%;
}
</style>