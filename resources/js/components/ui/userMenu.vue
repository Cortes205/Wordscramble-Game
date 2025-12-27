<!-- 
    Aligned right menu for user options

    @author     Alan Cortes
    @version    1.0.0
-->
<template>
    <div class="user-menu">
        <el-popover
            v-if="!isErrorPage"
            placement="bottom"
            width="500"
        >
            <template #reference>
                <el-icon size="25px" v-if="hasNotifications"><BellFilled /></el-icon>
                <el-icon size="25px" v-else><Bell /></el-icon>
            </template>
            <div>
                <NotificationWidget 
                    @change="onNotificationChange"
                />
            </div>
        </el-popover>
        <el-popover
            placement="bottom"
        >
            <template #reference>
                <el-icon size="25px" class="filled-icon"><MoreFilled /></el-icon>
            </template>
            <div class="al-center">
                <el-button v-loading="loggingOut" size="small" @click="onLogout">Logout</el-button>
            </div>
        </el-popover>
    </div>
</template>

<script setup>
import { getCurrentInstance, ref } from 'vue'
import { Bell, BellFilled, MoreFilled } from '@element-plus/icons-vue'
import NotificationWidget from './notificationWidget.vue'
const { proxy } = getCurrentInstance()

const props = defineProps({
    isErrorPage: {
        type: Boolean,
        default: false,
        required: false,
    },
})

const hasNotifications = ref(false)
const loggingOut = ref(false)

function onNotificationChange(change) {
    hasNotifications.value = change !== "clear"
}

function onLogout() {
    if (loggingOut.value) {
        return
    }

    loggingOut.value = true

    proxy.$ajax
        .post("/jax/user/logout")
        .then(res => {
            window.open("/", "_self")
        })
        .catch(err => {
            ElMessageBox.alert(
                err.response?.data?.message ?? err.message ?? "Request Failed", 
                "Error", 
            {
                confirmButtonText: "Ok",
            })
        })
        .finally(() => {
            loggingOut.value = false
        })
}
</script>

<style scoped>
.user-menu {
    padding: 1% 1% 0 0;
    text-align: right;
}

.filled-icon:hover {
    cursor: pointer;
}
</style>

<style>
.user-menu .el-icon:not(.user-menu .el-icon:last-child) {
    padding-right: 1.5%;
}
</style>