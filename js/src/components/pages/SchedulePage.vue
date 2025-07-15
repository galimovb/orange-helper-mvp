<script setup lang="ts">
import { ref } from "vue";
import AdminHeader from "@/components/ui/AdminHeader.vue";


const schedule = ref([
  {
    specialist: "Смирнова О.И.",
    position: "Педагог",
    monday: ["10:00 Фазлиев И. Назначена", "12:00 Донов И. Отменена"],
    tuesday: ["10:00 Довяков Р. Ждёт ответа"],
    wednesday: ["10:00 Фазлиев И. Назначена"],
    thursday: [],
    friday: ["10:00-14:00"],
    saturday: ["16:00-20:00"],
    sunday: ["16:00-20:00"]
  },
  {
    specialist: "Корнилова Н.С.",
    position: "Педагог",
    monday: [],
    tuesday: [],
    wednesday: [],
    thursday: ["16:00-20:00"],
    friday: [],
    saturday: ["16:00-20:00"],
    sunday: ["16:00-20:00"]
  },
  {
    specialist: "Мельникова Е.В.",
    position: "Педагог",
    monday: ["11:00-15:00"],
    tuesday: ["12:00 Фазлиев И. Назначена"],
    wednesday: ["13:00 Довяков Р. Ждёт ответа"],
    thursday: [],
    friday: [],
    saturday: [],
    sunday: []
  },
  {
    specialist: "Белов А.В.",
    position: "Психолог",
    monday: ["17:00-21:00"],
    tuesday: ["17:00-21:00"],
    wednesday: ["17:00-21:00"],
    thursday: [],
    friday: [],
    saturday: [],
    sunday: []
  }
]);

</script>

<template>
  <AdminHeader />
  <section class="px-[55px] my-[70px]">
    <div class="bg-orange-500 grid grid-cols-8 border border-gray-600">
      <div class="text-lg border-r border-gray-600 px-4 py-2">Специалист</div>
      <div class="text-lg border-r border-gray-600 px-4 py-2">ПН</div>
      <div class="text-lg border-r border-gray-600 px-4 py-2">ВТ</div>
      <div class="text-lg border-r border-gray-600 px-4 py-2">СР</div>
      <div class="text-lg border-r border-gray-600 px-4 py-2">ЧТ</div>
      <div class="text-lg border-r border-gray-600 px-4 py-2">ПТ</div>
      <div class="text-lg border-r border-gray-600 px-4 py-2">СБ</div>
      <div class="text-lg px-4 py-2">ВС</div>
    </div>
    <div class="bg-gray-200 border-r border-l border-gray-600">
      <div
        v-for="(item, index) in schedule"
        :key="index"
        class="grid grid-cols-8 border-b border-gray-600"
      >
        <div class="p-4 border-r border-gray-600">
          <div>
            {{ item.specialist }}
          </div>
          <div class="text-sm text-gray-500">
            {{ item.position }}
          </div>
        </div>
        <div v-for="(day, idx) in ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']"
             :key="idx" class="p-4 border-r border-gray-600">
          <div
            v-for="(meeting, i) in item[day]"
            :key="i"
            :class="{
            'p-2 text-white rounded-lg mb-2 bg-green-500': meeting.includes('Назначена'),
              'p-2 text-white rounded-lg mb-2 bg-orange-500': !meeting.includes('Отменена'),
              'p-2 text-white rounded-lg mb-2 bg-gray-400': meeting.includes('Отменена')
            }"
          >
            {{ meeting }}
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>

</style>
