<!-- 
    Generic list of cards

    @author     Alan Cortes
    @version    1.0.0
-->

<template>
    <div class="card-container">
        <el-card
            v-for="item in items"
            class="card"
        >
            <template #header>
                <slot name="header" :item="item"></slot>
            </template>
            <slot name="body" :item="item"></slot>
            <template #footer>
                <slot name="footer" :item="item"></slot>
            </template>
        </el-card>
    </div>
</template>

<script setup>
const props = defineProps({
    items: {
        type: Array,
        default: () => [],
        required: false,
    },
})
</script>

<style scoped>
.card-container {
    display: flex;
}

.card-container .card {
    width: 300px;
}

.card-container .card:not(.card-container .card:first-child) {
    margin-left: 3%;
}
</style>

<style>
.card-container .el-card__header,
.card-container .el-card__body,
.card-container .el-card__footer {
    border: 0;
}
</style>