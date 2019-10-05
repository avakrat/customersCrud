<template>
    <div>
        <top-nav></top-nav>
        <div class="container">
            <h1 class="title">Customers CRUD</h1>
            <div class="row">
                <div class="col-md-12">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>

    
</template>



<script>

import TopNav from './components/TopNav.vue'

export default {
    components: {
        TopNav
    }   
}
</script>