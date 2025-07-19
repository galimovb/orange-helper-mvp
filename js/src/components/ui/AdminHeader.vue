<script setup lang="ts">
import { ref } from "vue";

const isDropdownOpen = ref(false);

const toggleDropdown = () => {
  isDropdownOpen.value = !isDropdownOpen.value;
};
</script>

<template>
  <header class="bg-gray-400 px-[55px] py-[30px]">
    <div class="flex flex-col gap-8">
      <div class="flex items-center justify-between">
        <button>
          <img src="../../assets/img/logo-bg__orange.svg" alt="logo">
        </button>
        <div class="text-2xl leading-none">
          <label>
            Администратор
          </label>
        </div>
      </div>
      <div class="text-xl text-white leading-[100%] opacity-70">
        <ul class="flex flex-col gap-4">
          <li
              @click="toggleDropdown"
              class="cursor-pointer hover:text-black text-lg"
          >
            Редактирование информации
          </li>
          <ul
              v-if="isDropdownOpen"
              class="flex flex-col gap-2 text-lg leading-[100%] text-white opacity-70"
          >
            <li>
              <a href="/" class="hover:text-black">
                Главная
              </a>
            </li>
            <li>
              <a href="/diagnostics" class="hover:text-black">
                Диагностика
              </a>
            </li>
            <li>
              <a href="/news" class="hover:text-black">
                Новости
              </a>
            </li>
            <li>
              <a href="/useful-materials" class="hover:text-black">
                Полезные материалы
              </a>
            </li>
            <li>
              <a href="/consultation" class="hover:text-black">
                Консультация
              </a>
            </li>
          </ul>
          <li class="text-lg">
            <a href="/admin/dashboard" class="hover:text-black">
              Дашборд
            </a>
          </li>
          <li class="text-lg">
            <a href="/admin/users" class="hover:text-black">
              Пользователи
            </a>
          </li>
          <li class="text-lg">
            <a href="/admin/requests" class="hover:text-black">
              Заявки и обращения
            </a>
          </li>
          <li class="text-lg">
            <a href="/admin/materials" class="hover:text-black">
              Материалы платформы
            </a>
          </li>
          <li class="text-lg">
            <a href="/admin/schedule" class="hover:text-black">
              Расписание и встречи
            </a>
          </li>
        </ul>
      </div>
    </div>
  </header>
</template>

<style scoped>

</style>
