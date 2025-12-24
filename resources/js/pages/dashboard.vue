<!-- 
    User dashboard page

    @author     Alan Cortes
    @version    1.0.0
-->

<template>
    <div v-if="!loading">
        <div>
            <UserMenu />
        </div>

        <div style="padding: 0 2%; display: flex;">
            <h1>
                {{ user.name.toUpperCase() }}&nbsp;
                <el-button style="margin-bottom: 2%;" type="success" @click="onPlay">Play Game</el-button>&nbsp;
                <el-popover
                    placement="bottom"
                >
                    <template #reference>
                        <el-icon class="setting-icon" size="25px"><Setting /></el-icon>
                    </template>
                    <div class="al-center">
                        
                    </div>
                </el-popover>
            </h1>
        </div>

        <div>
            <Stats
                :items="form.stats"
            />
        </div>

        <div>
            <div>

            </div>
            <div>

            </div>
        </div>
    </div>
    <div v-else style="padding: 2% 0 0 2%;">
        Loading...
    </div>
</template>

<script setup>
import { getCurrentInstance, onMounted, reactive, ref } from "vue";
import { Setting } from "@element-plus/icons-vue";
import UserMenu from "@/components/ui/userMenu.vue";
import Stats from "@/components/stats.vue"

const { proxy } = getCurrentInstance()

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
})

const loading = ref(false)
const form = reactive({})

onMounted(() => {
    getUserProfile()
})

function getUserProfile() {
    if (loading.value) {
        return
    }

    loading.value = true

    proxy.$ajax
        .get("/jax/user/profile")
        .then(res => {
            form.value = res.data
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

function onPlay() {
    window.open("/play", "_self");
}
</script>

<style scoped>
.setting-icon {
    margin-top: 2%;
}

.setting-icon:hover {
    cursor: pointer;
}
</style>

<style>
.al-center {
    text-align: center;
}
</style>