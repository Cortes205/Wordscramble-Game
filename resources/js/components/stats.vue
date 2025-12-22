<!-- 
    Component to show list of user stats

    @author     Alan Cortes
    @version    1.0.0
-->

<template>
    <div style="padding: 2%">
        <CardList
            :items="items"
            height="500px"
        >
            <template #header="{ item }">
                {{ item.name }}
            </template>
            <template #body="{ item }">
                {{ item.title }}
            </template>
            <template #footer="{ item }">
                {{ item.desc }}
            </template>
        </CardList>
    </div>
</template>

<script setup>
import CardList from "@/components/ui/cardList.vue"

const props = defineProps({
    items: {
        type: Array,
        required: true,
    },
})
</script>