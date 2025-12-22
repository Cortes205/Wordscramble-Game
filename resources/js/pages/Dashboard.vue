<!-- 
    User dashboard page

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

        <div style="padding: 0 2%">
            <h1>{{ user.name.toUpperCase() }}</h1>
        </div>

        <div>
            <Stats
                :items="items"
            />
        </div>

        <div class="al-center">
            <el-button type="success" @click="onPlay">Play Game</el-button>
        </div>
    </div>
</template>

<script setup>
import { getCurrentInstance, onMounted, ref } from "vue";
import UserMenu from "@/components/ui/userMenu.vue";
import Stats from "@/components/stats.vue"

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

const items = ref([])

onMounted(() => {
    getStats()
})

function getStats() {
    // TODO: Get Stats
}

function onPlay() {
    window.open("/play", "_self");
}
</script>

<style>
.al-center {
    text-align: center;
}
</style>