import { createApp } from 'vue'
import RequestsPage from "@/components/pages/RequestsPage.vue";
import '../assets/style.css'

const el = document.getElementById('vue-requests')
if (el) {
    createApp(RequestsPage).mount(el)
}
