import { createApp } from 'vue'
import MaterialsPage from "@/components/pages/MaterialsPage.vue";
import '../assets/style.css'

const el = document.getElementById('vue-materials')
if (el) {
    createApp(MaterialsPage).mount(el)
}
