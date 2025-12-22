<!-- 
    Aligned right menu for user options

    @author     Alan Cortes
    @version    1.0.0
-->
<template>
    <div class="button-menu">
        <el-popover
            placement="bottom"
        >
            <template #reference>
                <el-icon><MoreFilled /></el-icon>
            </template>
            <div class="al-center">
                <el-button v-loading="loggingOut" size="small" @click="onLogout">Logout</el-button>
            </div>
        </el-popover>
    </div>
</template>

<script setup>
import { getCurrentInstance, ref } from 'vue'
import { MoreFilled } from '@element-plus/icons-vue'
const { proxy } = getCurrentInstance()

const props = defineProps({
    _csrfToken: {
        type: String,
        required: true,
    },
})

const loggingOut = ref(false)

function onLogout() {
    if (loggingOut.value) {
        return
    }

    loggingOut.value = true

    proxy.$ajax
        .post("/jax/user/logout", { _csrfToken: props._csrfToken })
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
.button-menu {
    padding: 1% 1% 0 0;
    text-align: right;
}
</style>