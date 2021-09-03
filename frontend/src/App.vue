<template>
  <nav class="bg-purple-600 text-white">
    <div class="container mx-auto">
      <div class="flex items-center">


        <router-link to="/todos"
                     class="inline-block px-16 py-4 transition-colors hover:bg-purple-500 duration-300">Список дел</router-link>
        <router-link to="/logout"
                     class="inline-block px-16 py-4 transition-colors hover:bg-purple-500 duration-300"><strong>{{fio}}</strong> Выйти из системы</router-link>

      </div>
    </div>
  </nav>
  <router-view />

</template>
<script>
  import { defineComponent, reactive } from "vue";

  export default defineComponent({
    setup() {
      const state = reactive({
        fio: '',
        localstorageee: false,
      });

      return {
        state,
      };
    },
    created() {
      this.fio  = localStorage.getItem('name');
      this.authenticationn  = localStorage.getItem('authorized');

    }
  });
</script>
