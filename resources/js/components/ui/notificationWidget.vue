<!-- 
    List of recent notifications (ones that aren't hidden)

    @author     Alan Cortes
    @version    1.0.0
-->
<template>
    <div class="widget-container">
        <span class="widget-header">
            <el-icon v-loading="loading" class="delete-icon" size="20" @click="onClear(null)"><Delete /></el-icon>
        </span>
        <div
            v-for="notification in notifications" 
            class="widget-content"
        >
            <div style="display: flex;">
                <h4>{{ notification.header }}</h4>&nbsp;
                <el-icon v-loading="loading" class="delete-icon single-delete" size="15" @click="onClear(notification)"><Close /></el-icon>
            </div>
            <div v-html="notification.body"></div>
        </div>
        <div v-if="!notifications.length" class="widget-content">
            <div>
                <h4>No Notifications!</h4>
            </div>
        </div>
        <infinite-loading
            :identifier="loadId"
            @infinite="getNotifications"
        >
            <template #complete>
                <span></span>
            </template>
        </infinite-loading>
    </div>
</template>

<script setup>
import { getCurrentInstance, ref } from 'vue';
import { Delete, Close } from '@element-plus/icons-vue';
import { getUserNotifications, perPage } from "@/composables/notifications"
import InfiniteLoading from "v3-infinite-loading";

const { proxy } = getCurrentInstance()
const emit = defineEmits(["change"])

const loadId = +(new Date())
const notifications = ref([])
const loading = ref(false)

function getNotifications($state) {
    const page = Math.ceil(notifications.value.length / perPage) + 1

    getUserNotifications(proxy.$ajax, page, (res) => {
        if (res.data.response.length <= 0) {
            $state.complete()
        } else {
            notifications.value.push(...res.data.response)
            emit("change", "notis")
            $state.loaded()
        }
    }, () => {
        $state.complete()
    })
}

function onClear(item = null) {
    if (loading.value || !notifications.value.length) {
        return
    }

    loading.value = true

    const id = item ? item.id : 0

    proxy.$ajax
        .put("/jax/notification/hide", { id: id })
        .then(res => {
            notifications.value = id ? notifications.value.filter(el => el.id !== id)
                : []

            if (!id) {
                emit("change", "clear")
            }
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
            loading.value = false
        })
}
</script>

<style scoped>
.widget-container {
    max-height: 250px;
    overflow: auto;
    padding-bottom: 2%;
}

.widget-header {
    position: absolute;
    width: 90%;
    background-color: white;
    text-align: right; 
}

.widget-content:first-of-type {
    padding-top: 3%;
}

.single-delete {
    margin-top: 4.33%;
    padding-left: 0.5%;
}

.delete-icon:hover {
    cursor: pointer;
}
</style>