<!-- 
    Home page when a user is not authenticated

    @author     Alan Cortes
    @version    1.0.0
-->
<template>
    <div>
        <div class="title-container">
            <div>
                <h1>Wordscramble</h1>
                <el-button round type="primary" @click="openForm">Start</el-button>
            </div>
        </div>

        <div v-if="isLoginVisible">
            <el-dialog
                v-model="isLoginVisible"
                title="Sign In"
            >
                <Login
                    @close="close"
                />
            </el-dialog>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue"
import Login from "../components/forms/login.vue"

const isLoginVisible = ref(false)

function openForm() {
    isLoginVisible.value = true
}

function close() {
    isLoginVisible.value = false
}
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