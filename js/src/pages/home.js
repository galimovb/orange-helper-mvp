import { createApp } from 'vue'
import Home from '../components/pages/Home.vue'
import '../assets/style.css'

const el = document.getElementById('vue-home')
if (el) {
    createApp(Home).mount(el)
}
