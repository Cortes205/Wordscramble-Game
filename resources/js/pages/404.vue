<!-- 
    Page not found page

    @author     Alan Cortes
    @version    1.0.0
-->
<template>
    <div>
        <div>
            <UserMenu 
                :_csrf-token="_csrfToken"
            />
        </div>

        <div class="container">
            <h1>Page That Oops Found Be Not Could!</h1>
            <el-button @click="onReturn">Return Home</el-button>
        </div>
    </div>
</template>

<script setup>
import UserMenu from "@/components/ui/userMenu.vue";

const props = defineProps({
    _csrfToken: {
        type: String,
        required: true,
    },
})

function onReturn() {
    window.open("/", "_self");
}
</script>

<style scoped>
.container {
    position: absolute;
    text-align: center;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>

<style>
.al-center {
    text-align: center;
}
</style>