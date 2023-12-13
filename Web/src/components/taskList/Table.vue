<template>
  <div class="mt-2 rounded-lg shadow overflow-x-auto">
    <table class="w-full">
      <thead class="bg-[#F4F4F5]">
        <tr>
          <th class="p-3 text-xs text-[#979AA1] tracking-wide text-left">
            <Icon
              icon="ic:round-radio-button-unchecked"
              color="#989CA3"
              width="18"
              hight="18"
            />
          </th>
          <th class="w-2/6 p-3 text-xs text-[#979AA1] tracking-wide text-left">
            TASK
          </th>
          <th class="w-1/6 p-3 text-xs text-[#979AA1] tracking-wide text-left">
            <div class="flex gap-1">
              <p>DUE DATE</p>
              <Icon
                icon="solar:sort-from-bottom-to-top-bold"
                @click="sortByDate"
                class="cursor-pointer"
                color="#989CA3"
                width="18"
                height="18"
              />
            </div>
          </th>
          <th class="w-1/6 p-3 text-xs text-[#979AA1] tracking-wide text-left">
            <div class="flex gap-1">
              <p>STATUS</p>
              <Icon
                icon="solar:sort-from-bottom-to-top-bold"
                @click="sortByStatus"
                class="cursor-pointer"
                color="#989CA3"
                width="18"
                height="18"
              />
            </div>
          </th>
          <th class="w-2/6 p-3 text-xs text-[#979AA1] tracking-wide text-left">
            <div class="flex gap-1">
              <p>LAST UPDATE</p>
              <Icon
                icon="solar:sort-from-bottom-to-top-bold"
                @click="sortByDate"
                class="cursor-pointer"
                color="#989CA3"
                width="18"
                height="18"
              />
            </div>
          </th>
          <th class="w-4/6 p-3 text-xs text-[#828b9e] tracking-wide text-left">
            Actions
          </th>
        </tr>
      </thead>
      <tbody class="">
        <tr v-for="task in tasks" :key="task.id">
          <td
            class="whitespace-nowrap p-3 text-xs text-[#979AA1] tracking-wide text-left"
          >
            <Icon
              icon="ic:round-radio-button-unchecked"
              color="#989CA3"
              width="18"
              height="18"
            />
          </td>
          <td class="whitespace-nowrap p-3 text-xs text-gray-700">
            <template v-if="!task.isEditing">{{ task.description }}</template>
            <input
              v-if="task.isEditing"
              v-model="task.description"
              class="border focus:border-blue-500 border-green-400 p-1 rounded-lg text-xs text-gray-700"
            />
          </td>
          <td class="whitespace-nowrap p-3 text-xs text-gray-700">
            <template v-if="!task.isEditing">{{
              formatDueDate(task.due_date)
            }}</template>
            <input
              v-if="task.isEditing"
              v-model="task.due_date"
              type="date"
              id="taskDueDate"
              class="mt-1 p-2 border rounded-md w-full"
            />
          </td>
          <td class="whitespace-nowrap p-3 text-xs text-gray-700">
            <template v-if="!task.isEditing">
              <span
                class="px-3 py-1 text-xs font-bold tracking-wider border-2 rounded-full bg-opacity-50"
                :class="{
                  'border-[#A7E1B1] text-[#45C25A] bg-[#F4FBF5]':
                    task.status !== 'in_progress',
                  'border-[#FFA500] text-[#F2BA79] bg-[#FDF3E8]':
                    task.status === 'in_progress',
                }"
              >
                {{ task.status === "in_progress" ? "In progress" : "Done" }}
              </span>
            </template>
            <select
              v-if="task.isEditing"
              v-model="task.status"
              class="border focus:border-blue-500 border-green-400 p-1 rounded-lg text-xs text-gray-700"
            >
              <option value="InProgress">In Progress</option>
              <option value="Done">Done</option>
            </select>
          </td>
          <td class="whitespace-nowrap p-3 text-xs text-gray-700">
            {{ formatLastUpdate(task.updated_at) }}
          </td>
          <td class="whitespace-nowrap p-3 text-xs text-gray-700">
            <div class="flex gap-2">
              <div
                class="w-8 h-8 rounded-lg bg-[#F4F4F5] flex items-center justify-center"
              >
                <Icon
                  color="#6B88FA"
                  width="18"
                  hight="18"
                  @click="toggleEditing(task)"
                  :icon="
                    task.isEditing ? 'ic:baseline-check' : 'radix-icons:update'
                  "
                />
              </div>
              <div
                class="w-8 h-8 rounded-lg bg-[#F4F4F5] flex items-center justify-center"
              >
                <Icon
                  icon="basil:trash-outline"
                  color="red"
                  width="18"
                  hight="18"
                  @click="removeTask(task.id)"
                />
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { Icon } from "@iconify/vue";

export default {
  props: {
    tasks: Array,
    toggleEditing: Function,
    removeTask: Function,
  },
  data() {
    return {
      sortOrder: "asc",
      sortOrderLastUpdate: "asc",
    };
  },
  components: {
    Icon,
  },
  methods: {
    formatDueDate(dueDate) {
      const date = new Date(dueDate);
      const day = date.getDate();
      const month = date.getMonth() + 1;
      const year = date.getFullYear();
      return `${day}/${month}/${year}`;
    },
    formatLastUpdate(lastUpdate) {
      const reformed = lastUpdate.split("T")[0];
      console.log(lastUpdate.split("T")[0]);

      // return reformed
      // 2023-12-12
      return reformed.split("-").reverse().join("/");
    },
    sortByStatus() {
      const sortOrder = this.sortOrder === "asc" ? "desc" : "asc";
      this.tasks.sort((a, b) => {
        const statusOrder = ["in_progress", "Done"];
        const indexA = statusOrder.indexOf(a.status);
        const indexB = statusOrder.indexOf(b.status);
        return sortOrder === "asc" ? indexA - indexB : indexB - indexA;
      });

      this.sortOrder = sortOrder;
    },
    sortByDate() {
      const sortOrder = this.sortOrder === "asc" ? "desc" : "asc";
      this.tasks.sort((a, b) => {
        const dateA = new Date(a.due_date);
        const dateB = new Date(b.due_date);
        return sortOrder === "asc" ? dateA - dateB : dateB - dateA;
      });

      this.sortOrder = sortOrder;
    },
  },
};
</script>

<style lang="scss" scoped></style>
