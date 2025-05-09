import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import axiosInstance from './Axios.api'
import globalVariables from './GlobalVariables'
import router from './router'


// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
    components,
    directives,
  })

createApp(App)
// use an alias as 'http'
.use(axiosInstance)
.use(globalVariables)
.use(router)
.use(vuetify)
.mount('#app')
