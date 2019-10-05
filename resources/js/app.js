import './bootstrap';
import Vue from 'vue'
import Buefy from 'buefy'
import router from './router'
import store from './store'
import App from './App.vue'
import 'buefy/dist/buefy.css'

import upperFirst from 'lodash/upperFirst'
import camelCase from 'lodash/camelCase'

Vue.use(Buefy)

/******************************************
 ** Autoload BaseComponent in Base Folder using regexp
 require.context(directory, useSubdirectories = true, regExp = /^\.\/.*$/, mode = 'sync');
 ******************************************/
const requireComponent = require.context(
    './components/Base',
    false,
    /Base[A-Z]\w+\.(vue|js)$/
)
  
requireComponent.keys().forEach(fileName => {
    // Get component config
    const componentConfig = requireComponent(fileName)
    console.log(componentConfig);
    // transfer file name to PascalCase without extension
    const componentName = upperFirst(camelCase(fileName.split('/').pop().replace(/\.\w+$/, ''))
)

// Register the base components globally
Vue.component(
    componentName,
    componentConfig.default || componentConfig // export default or fallback to module's root
)
});


new Vue({
    el: '#app',
    components: { 
        'app-main' : App 
    },
    router,
    store
})
