<template>
  <nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      <router-link class="navbar-item" :to="{ path: '/' }">HOME</router-link>

      <a role="button" :class="{ 'is-active': !isActive }" class="navbar-burger burger" @click="isActive = !isActive" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
        
    </div>

    <div id="navbarBasicExample" class="navbar-menu"  :class="{ 'is-active': !isActive }">
      <div class="navbar-start">
        <router-link class="navbar-item" :to="{ name: 'customers-index' }">Customers</router-link>

        <router-link class="navbar-item" :to="{ name: 'customers-edit' }">Edit</router-link>
      </div>
    </div>
  </nav>

</template>

<script>
export default {
    data() {
        return {
            isActive: true
        }
    }
}
</script>