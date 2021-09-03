<template>
  <div class="container mx-auto">
    <h1 class="mt-8 text-2xl">Регистрация</h1>

    <div class="mt-3">
      <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12 space-y-4 px-1"
             style="height: 500px">

          <input type="text"
                 v-model="name"
                 placeholder="Ваше имя"
                 class="p-2 mt-4 border rounded w-full">
          <input type="text"
                 v-model="email"
                 placeholder="Ваша электронная почта"
                 class="p-2 mt-4 border rounded w-full">

          <input type="password"
                 v-model="password"
                 placeholder="Пароль"
                 class="p-2 mt-4 border rounded w-full">

          <button
                  class="px-2 text-green-600"
                  v-on:click="sendLogin()"
                  title="Произвести авторизацию">Войти</button>
          <a href="/registration"><button
                  style="float:right"
                  class="px-2 text-green-600"
                  href="/sd"
                  title="Произвести авторизацию">Регистрация</button>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
  import axios from "axios";
  import { defineComponent, reactive } from "vue";

  export default defineComponent({
    setup() {
      const state = reactive({
        email: '',
        password: '',
        name: '',
      });

      function sendLogin() {
        axios.post('http://testapi/api/register', {
          email: this.email,
          password: this.password,
          name: this.name
        })
                .then(response => {
                  console.log(response)
                  alert('Регистрация прошла успешно');
                  checkAuth();
                })
                .catch(error=>{
                  console.log(error.message)
                  alert('Ошибка авторизации, пожалуйста, перепроверьте ваши данные и попробуйте снова!')
                }
        )
      }
      function checkAuth() {
          document.location.href='/login';
      }

      return {
        state,
        sendLogin,
        checkAuth,
      };
    },
    created() {
      this.checkAuth()
    }
  });
</script>
