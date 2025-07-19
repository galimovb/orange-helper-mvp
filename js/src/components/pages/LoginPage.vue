<template>
  <RegisterAndLoginLayout :max-width="680" :min-width="320">
    <div class="px-5 py-3 space-y-6 w-full">

      <div class="flex items-center flex-col">
        <h1
            class="text-3xl md:text-[32px] text-orange-500 font-medium"
        >
          Авторизация
        </h1>
      </div>

      <form
          class="space-y-7"
          @submit.prevent="handleSubmit"
      >
        <div>
          <label class="block text-sm md:text-xl text-orange-500 mb-2.5">Телефон</label>
          <Input
              v-model="formData.phoneNumber"
              type="phone"
              placeholder="+7 912 345 67 89"
              class="w-full"
          />
        </div>

        <div>
          <label class="block text-sm md:text-xl text-orange-500 mb-2.5">Пароль</label>
          <Input
              v-model="formData.password"
              type="password"
              placeholder="Введите пароль"
              required
              class="w-full"
          />
        </div>

        <button
            type="submit"
            class="w-full bg-orange-500 hover:bg-orange-600 text-white font-medium py-3 px-4 rounded-lg transition duration-200 text-lg md:text-xl"
        >
          Войти
        </button>

      </form>
    </div>
  </RegisterAndLoginLayout>
</template>

<script setup>
import {reactive} from 'vue';
import RegisterAndLoginLayout from "@/components/ui/RegisterAndLoginLayout.vue";
import Button from "@/components/ui/Button.vue";
import Input from "@/components/ui/Input.vue";
import axios from "axios";

/*const authStore = useAuthStore();*/

const formData = reactive({
  phoneNumber: '',
  password: ''
});

const handleSubmit = async () => {
  try {
    // Оставляем только цифры и плюс
    let cleanedPhone = formData.phoneNumber.replace(/[^\d+]/g, '');

    // Гарантируем, что номер начинается с +7
    if (!cleanedPhone.startsWith('+')) {
      cleanedPhone = '+7' + cleanedPhone.replace(/^[78]?/, '');
    } else if (cleanedPhone.startsWith('+') && !cleanedPhone.startsWith('+7')) {
      cleanedPhone = '+7' + cleanedPhone.slice(1).replace(/\D/g, '');
    }

    // Удаляем возможные дубли плюсов
    cleanedPhone = cleanedPhone.replace(/\++/g, '+');

    // Проверяем минимальную длину (например, +79123456789 - 12 символов)
    if (cleanedPhone.length < 12) {
      throw new Error('Номер телефона слишком короткий');
    }

    const requestData = {
      ...formData,
      phoneNumber: cleanedPhone
    };

    // 1. Выполняем запрос на авторизацию
    await axios.post('/admin/login/check', requestData);

  } catch (err) {
    console.error('Ошибка:', err.message);
  }
};
</script>
