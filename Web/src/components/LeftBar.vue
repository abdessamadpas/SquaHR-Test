<template>
  <div
    class="w-16 bg-white border-r-2 border-[#F3F3F3] flex justify-center h-full"
  >
    <!-- logo -->
    <div class="flex justify-between py-3 flex-col">
      <div class="option-nav flex flex-col gap-5">
        <div
          class="w-8 h-8 rounded-lg bg-[#F4F4F5] flex items-center justify-center"
        >
          <Icon
            icon="tabler:layout-list"
            color="#989CA3"
            width="18"
            hight="18"
          />
        </div>
        <div
          class="w-8 h-8 rounded-lg bg-[#F4F4F5] flex items-center justify-center"
        >
          <Icon
            icon="fluent:mail-inbox-24-regular"
            color="#989CA3"
            width="18"
            hight="18"
          />
        </div>
        <div
          class="w-8 h-8 rounded-lg bg-[#2C55FB] flex items-center justify-center"
        >
          <Icon icon="bx:task" color="white" width="18" hight="18" />
        </div>
        <div
          class="w-8 h-8 rounded-lg bg-[#F4F4F5] flex items-center justify-center"
        >
          <Icon
            icon="icon-park-outline:analysis"
            color="#989CA3"
            width="18"
            hight="18"
          />
        </div>
        <div
          class="w-8 h-8 rounded-lg bg-[#F4F4F5] flex items-center justify-center"
        >
          <Icon
            icon="ion:md-notifications-outline"
            color="#989CA3"
            width="18"
            hight="18"
          />
        </div>
        <div
          class="w-8 h-8 rounded-lg bg-[#F4F4F5] flex items-center justify-center"
        >
          <Icon icon="ri:group-line" color="#989CA3" width="18" hight="18" />
        </div>
      </div>
      <div class="flex py-3 flex-col gap-5">
        <div
          class="w-8 h-8 rounded-lg bg-[#F4F4F5] flex items-center justify-center"
        >
          <Icon
            icon="solar:settings-broken"
            color="#989CA3"
            width="18"
            hight="18"
          />
        </div>
        <div
          class="w-8 h-8 rounded-lg bg-[#F4F4F5] flex items-center justify-center"
          @click="logout"
        >
          <Icon
            icon="lets-icons:sign-out-circle"
            color="#989CA3"
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
  methods: {
    logout() {
      localStorage.removeItem("user");
      localStorage.removeItem("token");
      this.$router.push("/login");
    },
  },
};
</script>
