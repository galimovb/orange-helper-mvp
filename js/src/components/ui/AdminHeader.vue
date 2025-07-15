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
        <div class="text-4xl leading-none">
          <label>
            Админитратор
          </label>
        </div>
      </div>
      <div class="text-4xl text-white leading-[100%] opacity-70">
        <ul class="flex flex-col gap-6 ">
          <li
            @click="toggleDropdown"
            class="cursor-pointer hover:text-black"
          >
            Редактирование информации
          </li>
          <ul
            v-if="isDropdownOpen"
            class="flex flex-col gap-4 text-2xl leading-[100%] text-white opacity-70"
          >
            <li>
              <router-link
                to="/"
                class="hover:text-black"
              >
                Главная
              </router-link>
            </li>
            <li>
              <router-link
                to="/diagnostics"
                class="hover:text-black"
              >
                Диагностика
              </router-link>
            </li>
            <li>
              <router-link
                to="/news"
                class="hover:text-black"
              >
                Новости
              </router-link>
            </li>
            <li>
              <router-link
                to="/useful-materials"
                class="hover:text-black"
              >
                Полезные материалы
              </router-link>
            </li>
            <li>
              <router-link
                to="/consultation"
                class="hover:text-black"
              >
                Консультация
              </router-link>
            </li>
          </ul>
          <li>
            <router-link
              to="/admin/dashboard"
              class="hover:text-black"
            >
              Дашборд
            </router-link>
          </li>
          <li>
            <router-link
              to="/admin/users"
              class="hover:text-black"
            >
              Пользователи
            </router-link>
          </li>
          <li>
            <router-link
              to="/admin/requests"
              class="hover:text-black"
            >
              Заявки и обращения
            </router-link>
          </li>
          <li>
            <router-link
              to="/admin/materials"
              class="hover:text-black"
            >
              Материалы платформы
            </router-link>
          </li>
          <li>
            <router-link
              to="/admin/schedule"
              class="hover:text-black"
            >
              Расписание и встречи
            </router-link>
          </li>
        </ul>
      </div>
    </div>
  </header>
</template>

<style scoped>
.router-link-active {
  color: black;
}
</style>
