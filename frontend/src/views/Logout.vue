<template>
  <div class="container mx-auto">
    <h1 class="mt-8 text-2xl">Вы действительно хотите выйти из системы?</h1>
    <button
          class="lg:resize text-red-600"
          @click="logout()"
          title="Произвести авторизацию">Да, я хочу выйти</button>

    <button
            class="px-2 text-green-600"
            @click="noLogout()"
            title="Произвести авторизацию">Нет, я хочу остаться</button>


  </div>
</template>


<script>
  import { defineComponent, reactive } from "vue";

  export default defineComponent({
    setup() {
      const state = reactive({
        email: '',
        password: '',
      });


      function logout() {
        localStorage.clear();
        document.location.href='/login'
      }

      function noLogout() {
        document.location.href='/todos'
      }


      return {
        state,
        logout,
        noLogout,
      };
    },
    beforeCreate() {
      if (!localStorage.getItem('authorized')){
        document.location.href='/login'
      }
    }
  });
</script>
