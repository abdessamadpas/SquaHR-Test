<template>
  <div class="flex flex-col w-full h-full overflow-hidden">
    <Header 
      @search="updateSearch"
    />
    <div class="border-b-2 border-[#F3F3F3] px-8 py-4">
      <p class="text-xl font-bold text-black">Tasks</p>
    </div>

    <div class="p-6 w-full h-full bg-[#F2F4F7]">
      <TasksList 
        :searchQuery="searchQuery"
      />
    </div>
  </div>
</template>
<script>
import Header from "../components/Header.vue";
import TasksList from "../components/taskList/TasksList.vue";

export default {
  components: {
    Header,
    TasksList,
  },
  data() {
    return {
      searchQuery: "",
    };
  },
  methods: {
    updateSearch(query) {
      console.log("query in main container", query);
      this.searchQuery = query;
    },
  },
};
</script>
