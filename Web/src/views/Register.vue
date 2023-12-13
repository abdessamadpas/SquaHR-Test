<template>
  <div
    class="w-screen h-screen flex flex-row justify-around items-center bg-slate-50 gap-4"
  >
    <div class="">
      <img src="../assets/manager.png" alt="logo" />
    </div>

    <div class="p-5 flex flex-col gap-10">
      <p class="text-black font-bold text-lg">Create to your Account</p>
      <form class="flex flex-col gap-5" @submit.prevent="login">
        <input
          v-model="name"
          type="text"
          placeholder="name"
          class="border-2 border-gray-300 rounded-lg p-2 text-black"
          required
        />
        <input
          v-model="email"
          type="text"
          placeholder="email"
          class="border-2 border-gray-300 rounded-lg p-2 text-black"
          required
        />
        <input
          v-model="password"
          type="password"
          placeholder="password"
          class="border-2 border-gray-300 rounded-lg p-2 text-black"
          required
        />
        <button
          type="submit"
          class="bg-blue-500 text-white font-semibold rounded-lg px-2 py-1"
        >
          Register
        </button>
      </form>
      <div class="border-b border-[#EDEDEF]"></div>
      <div class="flex flex-row justify-between items-center">
        <p class="text-black font-small">You have an account?</p>
        <router-link to="/login" class="text-blue-500 font-semibold"
          >Login</router-link
        >
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Login",
  data() {
    return {
      name: "",
      email: "",
      password: "",
    };
  },
  created() {
    const token = localStorage.getItem("token");
    if (token) {
      this.$router.push("/");
    }
  },
  methods: {
    async login() {
      try {
        const response = await fetch("http://127.0.0.1:8000/api/register", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            name: this.name,
            email: this.email,
            password: this.password,
          }),
        });

        const data = await response.json();

        if (response.ok) {
          console.log("Login successful", data);
          localStorage.setItem("token", data.token);
          localStorage.setItem("user", data.name);
          this.$router.push("/");
        } else {
          if (response.status === 401 && data.error === "Unauthenticated.") {
            console.error("Token expired or invalid");
          } else {
            console.error("Login failed", data);
          }
        }
      } catch (error) {
        console.error("An error occurred during login", error);
      }
    },
  },
};
</script>
