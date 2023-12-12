<template>
  <div class="bg-white p-8 rounded-md shadow-md w-96 z-10">
    <span class="absolute top-2 right-2 text-gray-600 cursor-pointer" @click="closeAddTaskPopup">
      &times;
    </span>

    <form @submit.prevent="addTask">
      <p class=" text-center font-bold text-black">Add Task</p>
      <div class="mb-4">
        <label for="taskDescription" class="block text-sm font-medium text-gray-700">Task description:</label>
        <input
          v-model="newTask.description"
          type="text"
          id="taskDescription"
          required
          class="mt-1 p-2 border rounded-md w-full"
        />
      </div>

      <div class="mb-4">
        <label for="taskStatus" class="block text-sm font-medium text-gray-700">Task Status:</label>
        <select v-model="newTask.status" id="taskStatus" required class="mt-1 p-2 border rounded-md w-full">
          <option value="in_progress">InProgress</option>
          <option value="done">Done</option>
        </select>
      </div>

      <div class="mb-4">
        <label for="taskDueDate" class="block text-sm font-medium text-gray-700">Due Date:</label>
        <input
          v-model="newTask.due_date"
          type="date"
          id="taskDueDate"
          required
          class="mt-1 p-2 border rounded-md w-full"
        />
        <p v-if="isDueDateInvalid" class="text-red-500 text-sm mt-1">Due date must be in the future.</p>
      </div>

      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md w-full" :disabled="isDueDateInvalid">
        Add Task
      </button>
    </form>
  </div>
</template>

<script>
import { Icon } from '@iconify/vue';

export default {
  name: 'AddTaskPopup',
  props: ['newTask'],
  data() {
    return {
      newTask: {
        description: '',
        status: 'InProgress',
        due_date: '',
      },
    };
  },
  methods: {
    openAddTaskPopup() {
      this.$emit('open-add-task-popup');
    },
    addTask() {
      const newTask = {
        id: Math.floor(Math.random() * 1000),
        description: this.newTask.description, 
        status: this.newTask.status,
        due_date: this.newTask.due_date,
        updated_at: new Date().toLocaleDateString(),
        isEditing: false,
      };
      this.$emit('task-added', newTask);
      this.clearForm();
      this.$emit('close');

    },
    closeAddTaskPopup() {
      this.clearForm();
      this.$emit('close');
    },
    clearForm() {
      // Reset newTask to default values
      this.newTask = {
        description: '',
        status: 'InProgress',
        due_date: '',
      };
    },
  },
  computed: {
    isDueDateInvalid() {
      const dueDate = new Date(this.newTask.due_date);
      const currentDate = new Date();
      return dueDate <= currentDate;
    },
  },
  components: {
    Icon,
  },
};
</script>
