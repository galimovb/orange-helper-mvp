import { createApp } from 'vue'
import SchedulePage from "@/components/pages/SchedulePage.vue";
import '../assets/style.css'

const el = document.getElementById('vue-schedule')
if (el) {
    createApp(SchedulePage).mount(el)
}
