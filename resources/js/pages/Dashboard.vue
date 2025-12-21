<!-- 
    User dashboard page

    @author     Alan Cortes
    @version    1.0.0
-->

<template>
    <div>
        <div style="text-align: right;">
            <el-button size="small" type="primary" @click="onLogout">Logout</el-button>
        </div>
    </div>
</template>

<script setup>
import { getCurrentInstance } from "vue";

const { proxy } = getCurrentInstance()

const props = defineProps({
    _csrfToken: {
        type: String,
        required: true,
    },
    user: {
        type: Object,
        required: true,
    },
})

function onLogout() {
    proxy.$ajax
        .post("/jax/user/logout", { _csrfToken: props._csrfToken })
        .then(res => {
            location.reload()
        })
        .catch(err => {

        })
        .finally(() => {

        })
}
</script>