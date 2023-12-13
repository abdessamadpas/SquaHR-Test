<template>
  <div class="bg-white w-full border-b-2 border-[#F3F3F3] h-16 py-4">
    <div class="flex flex-row justify-between items-center h-full px-6">
      <div
        class="bg-[#F4F4F5] rounded-lg flex items-center p-2 gap-3 h-10 w-[300px]"
      >
        <Icon
          icon="mingcute:search-line"
          color="#989CA3"
          width="18"
          hight="18"
        />
        <input
          v-model="searchQuery"
          @input="updateSearch"
          type="text"
          placeholder="search tasks"
          class="h-8 bg-transparent focus:border-transparent text-black outline-none w-full"
        />
      </div>
      <div class="flex flex-row items-center gap-3">
        <div
          class="w-8 h-8 rounded-lg bg-[#F4F4F5] flex items-center justify-center"
        >
          <Icon
            icon="mingcute:notification-line"
            color="#989CA3"
            width="18"
            hight="18"
          />
        </div>
        <div class="border-l border-solid border-[#e4e4e4] h-5"></div>
        <div class="w-8 h-8 rounded-md">
          <img
            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
            alt="avatar"
            class="rounded-md w-full h-full"
          />
        </div>
        <div class="flex gap-2 items-center justify-center">
          <p class="text-[#444A57] font-bold">{{ user }}</p>
          <Icon
            icon="material-symbols:keyboard-arrow-down-rounded"
            color="#9C9FA6"
            width="18"
            hight="18"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Icon } from "@iconify/vue";
export default {
  components: {
    Icon,
  },
  data() {
    return {
      searchQuery: "",
      user: localStorage.getItem("user"),
    };
  },
  methods: {
    updateSearch() {
      this.$emit("search", this.searchQuery);
    },
  },
};
</script>

\
