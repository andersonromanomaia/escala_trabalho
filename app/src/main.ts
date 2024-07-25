import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import axios from 'axios'
import VueAxios from 'vue-axios'

// createApp(App).mount('#app')

// const app = createApp(App).use(Storage)
const app = createApp(App).use(VueAxios, axios)
app.provide('axios', app.config.globalProperties.axios)  // provide 'axios'
app.mount('#app')
