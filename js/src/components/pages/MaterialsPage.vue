<script setup lang="ts">
import { ref } from "vue";
import AdminHeader from "@/components/ui/AdminHeader.vue";

const categories = ref([
  "Литературная колонка",
  "Творческая мастерская",
  "Музыкальная волна",
  "Видеотека"
]);

const selectedCategory = ref("");
const materialTitle = ref("");
const materialLink = ref("");
const materialStatus = ref("Опубликовано");
const materialContent = ref("");

const isDropdownVisible = ref(false);

const toggleDropdown = () => {
  isDropdownVisible.value = !isDropdownVisible.value;
};

const addMaterial = () => {
  console.log({
    title: materialTitle.value,
    category: selectedCategory.value,
    link: materialLink.value,
    status: materialStatus.value,
    content: materialContent.value
  });
};
</script>

<template>
  <AdminHeader />
  <section class="flex flex-col gap-11 px-[55px] my-[70px]">
    <div class="flex items-center justify-between">
      <h1 class="text-3xl leading-[100%]">
        Добавить материал
      </h1>
    </div>

    <div class="relative">
      <button
          @click="toggleDropdown"
          class="bg-orange-500 flex items-center gap-12 text-[24px] text-white rounded-md focus:outline-none px-[15px] py-1"
      >
        Выберите раздел
        <img
            src="../../assets/img/accordion-icon.svg"
            alt="Стрелка"
            :class="{ 'rotate-180': isDropdownVisible }"
            class="w-4 h-4 filter invert"
        />
      </button>
      <div v-if="isDropdownVisible" class="absolute bg-orange-500 shadow-lg rounded-md mt-1 w-full">
        <ul class="py-2">
          <li
              v-for="category in categories"
              :key="category"
              @click="selectedCategory = category"
              class="text-xl text-white px-4 py-2 cursor-pointer hover:bg-gray-800"
          >
            {{ category }}
          </li>
        </ul>
      </div>
    </div>

    <div class="mt-4">
      <label for="title" class="block text-lg">Название материала</label>
      <input
          id="title"
          v-model="materialTitle"
          type="text"
          class="w-full px-4 py-2 border border-gray-300 rounded-md"
          placeholder="Введите название материала"
      />
    </div>

    <div v-if="selectedCategory === 'Музыкальная волна' || selectedCategory === 'Видеотека'">
      <div class="mt-4">
        <label for="link" class="block text-lg">Ссылка на видео/музыку</label>
        <input
            id="link"
            v-model="materialLink"
            type="url"
            class="w-full px-4 py-2 border border-gray-300 rounded-md"
            placeholder="Введите ссылку"
        />
      </div>
    </div>

    <div v-if="selectedCategory === 'Литературная колонка' || selectedCategory === 'Творческая мастерская'">
      <div class="mt-4">
        <label for="content" class="block text-lg">Содержание материала</label>
        <textarea
            id="content"
            v-model="materialContent"
            rows="6"
            class="w-full px-4 py-2 border border-gray-300 rounded-md"
            placeholder="Введите текст материала"
        ></textarea>
      </div>
    </div>

    <div class="mt-4">
      <label for="status" class="block text-lg">Статус</label>
      <select
          id="status"
          v-model="materialStatus"
          class="w-full px-4 py-2 border border-gray-300 rounded-md"
      >
        <option value="Опубликовано">Опубликовано</option>
        <option value="Скрыто">Скрыто</option>
      </select>
    </div>

    <div class="mt-6 text-center">
      <button
          @click="addMaterial"
          class="bg-orange-500 text-white px-6 py-3 rounded-md text-lg"
      >
        Добавить материал
      </button>
    </div>
  </section>
</template>

<style scoped>
/* Можете добавить стили по необходимости */
</style>
