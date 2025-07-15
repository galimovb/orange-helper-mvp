import { createApp } from 'vue'
import Home from '../components/pages/LoginPage.vue'
import '../assets/style.css'

const el = document.getElementById('vue-login')
if (el) {
    createApp(Home).mount(el)
}
