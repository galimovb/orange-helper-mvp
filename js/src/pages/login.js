import { createApp } from 'vue'
import Home from '../components/pages/LoginPage.vue'
import '../assets/style.css'
import VueTheMask from 'vue-the-mask';

const el = document.getElementById('vue-login')
if (el) {
    createApp(Home).use(VueTheMask).mount(el)
}
