<!-- 
    Home page when a user is not authenticated

    @author     Alan Cortes
    @version    1.0.0
-->
<template>
    <div class="title-container">
        <div>
            <h1>Wordscramble</h1>
            <el-button round type="primary" @click="isLoginVisible = true">Start</el-button>
        </div>
    </div>

    <div v-if="isLoginVisible">
        <el-dialog
            v-model="isLoginVisible"
            title="Sign In"
        >
            <Login
                :_csrf-token="_csrfToken"
                @close="isLoginVisible = false"
            >
            </Login>
        </el-dialog>
    </div>
</template>

<script setup>
import { ref } from "vue"
import Login from "../components/forms/login.vue"

const props = defineProps({
    _csrfToken: {
        type: String,
        required: true,
    },
})

const isLoginVisible = ref(false)
</script>

<style scoped>
.title-container {
    position: absolute;
    text-align: center;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>