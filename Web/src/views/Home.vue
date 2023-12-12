<template>
    <div class="bg-white h-full w-full flex flex-row">
        <LeftBar />
        <MainContainer />
    </div>
</template>
<script>
    import MainContainer from '../components/MainContainer.vue'; 
    import LeftBar from '../components/LeftBar.vue'; 

    export default {
    components: {
        MainContainer, 
        LeftBar,
    }};
</script>