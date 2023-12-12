<template>
  <div class="w-screen h-screen flex justify-center items-center bg-slate-50 flex-col gap-4">
    <p class="text-black">LOGIN</p>
    <form class="flex flex-col gap-5" @submit.prevent="login">
      <input v-model="username" type="text" placeholder="username" class="border-2 border-gray-300 rounded-lg p-2 text-black" required />
      <input v-model="password" type="password" placeholder="password" class="border-2 border-gray-300 rounded-lg p-2" required />
      <button type="submit" class="bg-blue-500 text-white rounded-lg p-2">Login</button>
    </form>
  </div>
</template>

<script>
export default {
  name: 'Login',
  data() {
    return {
      username: '',
      password: '',
    };
  },
  created() {
    const token = localStorage.getItem('token');
    if (token) {
      this.$router.push('/');
    }
  },
  methods: {
    
    async login() {
      try {
        const response = await fetch('http://127.0.0.1:8000/api/login', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            email: this.username, 
            password: this.password,
          }),
        });

        const data = await response.json();

        if (response.ok) {
          console.log('Login successful', data);
          localStorage.setItem('token', data.token);
          localStorage.setItem('user', data.name);
          this.$router.push('/');
        } else {
          if (response.status === 401 && data.error === 'Unauthenticated.') {
            console.error('Token expired or invalid');
          } else {
            console.error('Login failed', data);
          }
        }
      } catch (error) {
        console.error('An error occurred during login', error);
      }
    },
  
  },
};
</script>
