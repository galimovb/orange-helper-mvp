<script setup lang="ts">
import { ref } from "vue";
import AdminHeader from "@/components/ui/AdminHeader.vue";


const materials = [
  {
    title: "Сказка о внутреннем ребенке",
    category: "Литературная колонка",
    date: "01.04.2025",
    status: "Опубликовано"
  },
  {
    title: "Музыкальная зарядка: доброе утро",
    category: "Музыкальная волна",
    date: "27.03.2025",
    status: "Скрыто"
  },
  {
    title: "Рисуем эмоции: мастер-класс для детей",
    category: "Творческая мастерская",
    date: "25.03.2025",
    status: "Опубликовано"
  },
  {
    title: "Как справляться с тревожностью?",
    category: "Видеотека",
    date: "22.03.2025",
    status: "Опубликовано"
  }
];

const isDropdownVisible = ref(false);
const categories = ref([
  "Литературная колонка",
  "Творческая мастерская",
  "Музыкальная волна",
  "Видеотека"
]);

const toggleDropdown = () => {
  isDropdownVisible.value = !isDropdownVisible.value;
};

</script>

<template>
  <AdminHeader />
  <section class="flex flex-col gap-11 px-[55px] my-[70px]">
    <div class="flex items-center justify-between">
      <h1 class="text-3xl leading-[100%]">
        Список материалов
      </h1>
      <div class="relative">
        <button
          @click="toggleDropdown"
          class="bg-orange-500 flex items-center gap-12 text-[24px] text-white rounded-md focus:outline-none px-[15px] py-1"
        >
          Фильтр по разделу
          <img
            src="../../assets/img/accordion-icon.svg"
            alt="Стрелка"
            :class="{ 'rotate-180': isDropdownVisible }"
            class="w-4 h-4 filter invert"
          />
        </button>
        <div
          v-if="isDropdownVisible"
          class="absolute bg-orange-500 shadow-lg rounded-md mt-1 w-full"
        >
          <ul class="py-2">
            <li
              v-for="category in categories"
              :key="category"
              class="text-xl text-white px-4 py-2 cursor-pointer hover:bg-gray-800"
            >
              {{ category }}
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="grid grid-cols-5 gap-x-[88px] text-3xl leading-[100%]">
      <div>Название</div>
      <div>Раздел</div>
      <div>Дата добавления</div>
      <div>Статус</div>
      <div></div>
    </div>
    <div
      v-for="(material, index) in materials"
      :key="index"
      class="grid grid-cols-5 gap-x-[88px] items-center"
    >
      <div class="p-4 border border-gray-300 rounded-lg">
        {{ material.title }}
      </div>
      <div class="p-4 border border-gray-300 rounded-lg">
        {{ material.category }}
      </div>
      <div class="p-4 border border-gray-300 rounded-lg">
        {{ material.date }}
      </div>
      <div class="p-4 border border-gray-300 rounded-lg">
        {{ material.status }}
      </div>
      <div class="flex gap-4">
        <button class="bg-orange-500 text-white px-4 py-2 rounded-md">
          Удалить материал
        </button>
      </div>

    </div>
    <div class="col-span-5 text-center">
      <button class="bg-orange-500 text-white px-6 py-3 rounded-md text-lg">Добавить материал</button>
    </div>
  </section>

</template>


<style scoped>

</style>
