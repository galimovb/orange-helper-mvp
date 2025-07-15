<script setup lang="ts">
import { ref } from "vue";
import AdminHeader from "@/components/ui/AdminHeader.vue";


const parents = [
  {
    fullName: "Ирина Фазылова Шавхатовна"
  },
  {
    fullName: "Алексей Шавхатов"
  },
  {
    fullName: "Анастасия  Волкова Константиновна "
  },
  {
    fullName: "Константин Триногин Алексеевич "
  },
  {
    fullName: "Игорь Дуков Влалимирович "
  },
  {
    fullName: "Игорь Донов Сергеевич "
  },
  {
    fullName: "Роман Давыдов Семенович"
  },
  {
    fullName: "Альбина Цукова Далиловна "
  },
  {
    fullName: "Анастасия  Волкова Константиновна "
  },
  {
    fullName: "Ирина Фазылова Шавхатовна"
  }
];

const specialists = [
  {
    fullName: "Белов Артем Викторович ",
    post: "Психолог",
    experience: "8 лет",
    education: "СПбГУ, клиническая психология ",
    specialization: "Подростковый возраст, самооценка",
    rating: "4,7"
  },
  {
    fullName: "Козлова Мария Алексеевна  ",
    post: "Психолог",
    experience: "5 лет ",
    education: "МГУ, семейная психология",
    specialization: "Эмоциональная регуляция, тревожность, работа с родителями",
    rating: "5,0"
  },
  {
    fullName: "Шевченко Ирина Петровна ",
    post: "Психолог",
    experience: "15 лет",
    education: "ЮФУ, детская и подростковая психология ",
    specialization: "Страхи, агрессия, адаптация в школе ",
    rating: "5,0"
  },
  {
    fullName: "Белов Артем Викторович ",
    post: "Психолог",
    experience: "8 лет",
    education: "СПбГУ, клиническая психология ",
    specialization: "Подростковый возраст, самооценка",
    rating: "4,7"
  },
  {
    fullName: "Шевченко Ирина Петровна ",
    post: "Психолог",
    experience: "15 лет",
    education: "ЮФУ, детская и подростковая психология ",
    specialization: "Страхи, агрессия, адаптация в школе ",
    rating: "5,0"
  }
];
</script>

<template>
  <AdminHeader />
  <div class="usersPage flex flex-col gap-11 px-[55px] mt-[70px]">
    <section class="parents bg-orange-100 p-[20px] max-h-[80vh] overflow-y-auto">
      <div class="flex flex-col gap-6 text-4xl leading-[100%]">
        <h1>
          Список родителей
        </h1>
        <div class="flex flex-col gap-6 text-3xl leading-[100%]">
          <template
            v-for="(parent, index) in parents"
            :key="index"
          >
            <div class="flex justify-between items-center border-b-2 border-black pb-6 pr-5">
              <label>
                {{ parent.fullName }}
              </label>
              <Button
                label="Назначить консультацию"
                color="orange"
                :style="{ fontSize: '20px', padding: '8px 30px' }"
              />
            </div>
          </template>
        </div>
      </div>
    </section>
    <section class="flex flex-col gap-6 text-4xl leading-[100%] p-[20px]">
      <h1>
        Список специалистов
      </h1>
      <div class="grid grid-cols-2 gap-6">
        <template
          v-for="(specialist, index) in specialists"
          :key="index"
        >
          <div class="flex flex-col gap-6 border-b-2 border-black pb-6">
            <div class="flex flex-col gap-4 text-2xl">
              <div class="flex flex-col gap-2">
                <label>
                  ФИО
                </label>
                <Input
                  v-model="specialist.fullName"
                  :readonly="true"
                />
              </div>
              <div class="flex flex-col gap-3">
                <label>
                  Должность
                </label>
                <Input
                  v-model="specialist.post"
                  :readonly="true"
                />
              </div>
              <div class="flex flex-col gap-3">
                <label>
                  Стаж
                </label>
                <Input
                  v-model="specialist.experience"
                  :readonly="true"
                />
              </div>
              <div class="flex flex-col gap-3">
                <label>
                  Образование
                </label>
                <Input
                  v-model="specialist.education"
                  :readonly="true"
                />
              </div>
              <div class="flex flex-col gap-3">
                <label>
                  Специаллизация
                </label>
                <Input
                  v-model="specialist.specialization"
                  :readonly="true"
                />
              </div>
              <div class="flex flex-col gap-3">
                <label>
                  Отзывы
                </label>
                <Input
                  v-model="specialist.rating"
                  :readonly="true"
                />
              </div>
            </div>
            <Button
              label="Поставить консультацию"
              color="orange"
              size="medium"
            />
          </div>
        </template>
      </div>
    </section>
  </div>
</template>


<style scoped>

</style>
