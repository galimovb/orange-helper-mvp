import { createApp } from 'vue'
import UsersPage from "@/components/pages/UsersPage.vue";
import '../assets/style.css'

const el = document.getElementById('vue-users')
if (el) {
    createApp(UsersPage).mount(el)
}
