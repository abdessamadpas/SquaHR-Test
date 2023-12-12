<template>
    <div class=" rounded-lg bg-white w-full h-full text-red-400 px-5">
        <HeaderOptions 
            :showFilterDropdown="showFilterDropdown"
            :toggleFilterDropdown="toggleFilterDropdown"
            @task-added="handleTaskAdded"
        />
        <div class="border-b border-[#EDEDEF] "></div>
        
          <Table 
            :tasks ="tasks" 
            :toggleEditing="toggleEditing" 
            :removeTask="removeTask"    
        />        
    </div>
</template>

<script>
    import HeaderOptions from './header-options.vue';
    import Table from './Table.vue';
    import { Icon } from '@iconify/vue';

    
    export default {
        data() {
    return {
      tasks: [],
      showFilterDropdown: false,
    };
  },
  mounted() {
    this.fetchTasks();
  },

  methods: {
    async handleTaskAdded(newTask) {
      console.log('newTask', newTask);

      this.tasks.push(newTask);
      try {
        const token =  localStorage.getItem('token');
        const response = await fetch(`http://127.0.0.1:8000/api/tasks`, {
          method: 'POST',
          headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            description: newTask.description,
            status: newTask.status,
            due_date: newTask.due_date.split('-').reverse().join('/'),
          }),
        });

        const data = await response.json();

        if (response.ok) {
          console.log('message', data.message);
        } else {
          if (response.status === 401 && data.error === 'Unauthenticated.') {
            console.error('Token expired or invalid 🤌');
            this.$router.push('/login');

          } else {
            console.error('request failed 😅', data);
          }
        }
      } catch (error) {
        console.error('An error occurred during request 👀', error);
      }
    },

    toggleEditing(task) {
      task.isEditing = !task.isEditing;
    },

    async removeTask(taskId) {
      this.tasks = this.tasks.filter(task => task.id !== taskId);
      try {
        const token =  localStorage.getItem('token');
        const response = await fetch(`http://127.0.0.1:8000/api/tasks/${taskId}`, {
          method: 'DELETE',
          headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json',
          },
        });

        const data = await response.json();

        if (response.ok) {
          console.log('message', data.message);
          this.$router.push('/');
        } else {
          if (response.status === 401 && data.error === 'Unauthenticated.') {
            console.error('Token expired or invalid 🤌');
            this.$router.push('/login');

          } else {
            console.error('request failed 😅', data);
          }
        }
      } catch (error) {
        console.error('An error occurred during request 👀', error);
      }
    },

    toggleFilterDropdown() {
      this.showFilterDropdown = !this.showFilterDropdown;
    },

    async fetchTasks() {
      try {
        const token =  localStorage.getItem('token');
        const response = await fetch('http://127.0.0.1:8000/api/tasks', {
          headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json',
          },
        });

        if (response.ok) {
          const data = await response.json();
          this.tasks = data;
        } else {
          const errorData = await response.json();
          console.error('Error fetching tasks:🛟', errorData);
        }
      } catch (error) {
        console.error('An error occurred during fetching tasks:👀', error);
      }
    },
  },
 
    components: {
        HeaderOptions,
        Icon,
        Table
    
    }};
</script>

<style scoped>
input.editing {
  border: 1px solid #4CAF50; 
}
</style>