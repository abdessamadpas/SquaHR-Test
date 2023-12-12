<template>
    <div class=" flex items-center justify-between  py-3">
        <div class="flex gap-3">
            <div class="relative" @click="toggleFilterDropdown">
                <div class="flex items-center px-2 py-1 gap-1 border border-[#EAEAEB] rounded-lg cursor-pointer">
                    <Icon icon="solar:sort-linear" color="#A0A3AA" width="18" height="18" />
                    <p class="text-sm text-[#424954]">Filter</p>
                </div>
                <div v-if="showFilterDropdown" class="absolute top-full left-0 mt-1 bg-white border border-[#EAEAEB] rounded-lg shadow-md">
                    <div class="p-2">Filter 1</div>
                    <div class="p-2">Filter 2</div>
                </div>
            </div>
        </div>
        <div class=" flex gap-4 items-center">
            <div class="w-8 h-8 rounded-lg bg-[#F4F4F5] flex items-center justify-center">
                <Icon icon="ic:baseline-keyboard-arrow-left" color="#989CA3" width="18" hight="18"/>
            </div>
            <p class="text-[#373E4A] font-bold text-lg">December</p>
            <div class="w-8 h-8 rounded-lg bg-[#F4F4F5] flex items-center justify-center">
                <Icon icon="ic:baseline-keyboard-arrow-right" color="#989CA3" width="18" hight="18"/>
            </div>
        </div>
        <div class="flex gap-2 items-center">
            <div class="bg-[#2C55FB] rounded-md flex justify-center items-center px-3 py-1 gap-2" @click="openAddTaskPopup">
                <Icon icon="ic:outline-plus" color="#E9EDFD" width="18" hight="18"/>
                <p class="text-[#E9EDFD] text-sm">Add Task</p>
            </div>
            <div class="border-l border-solid border-[#e4e4e4] h-5"></div>
            <div v-if="showAddTaskPopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <AddTaskForm  @close="closeAddTaskPopup" @task-added="handleTaskAdded" />
            </div>
            <div class="w-8 h-8 rounded-lg bg-[#F4F4F5] flex items-center justify-center">
                <Icon icon="pajamas:settings" color="#989CA3" width="18" hight="18"/>
            </div>
            <div class="w-8 h-8 rounded-lg bg-[#F4F4F5] flex items-center justify-center">
                <Icon icon="material-symbols-light:chat-outline-rounded" color="#989CA3" width="18" hight="18"/>
            </div>
        </div>
    </div>
</template>

<script>
import { Icon } from '@iconify/vue';
import AddTaskForm from "./AddTaskPopoup.vue";


export default {
    name: 'HeaderOptions',
    props:{
        showFilterDropdown: Boolean,
        toggleFilterDropdown : Function,
    },
    data() {
    return {
      showAddTaskPopup: false,
    };
  },
  methods: {
    handleTaskAdded(newTask) {
      this.$emit('task-added', newTask);
    },
    openAddTaskPopup() {
      this.showAddTaskPopup = true;
    },
    closeAddTaskPopup() {
      this.showAddTaskPopup = false;
    },
   
    },
    components: {
        Icon,
        AddTaskForm
    },
    }
</script>

