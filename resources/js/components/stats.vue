<!-- 
    Component to show list of user stats

    @author     Alan Cortes
    @version    1.0.0
-->
<template>
    <div v-if="items?.length" class="card-container">
        <CardList
            :items="items"
            height="500px"
        >
            <template #header="{ item }">
                {{ item.name }}
            </template>
            <template #body="{ item }">
                <!-- If item.latest doesn't exist, no divs will be created -->
                <div v-if="item.latest">
                    <div v-for="value, key in item.latest.info">
                        <i>{{ key }}:</i>&nbsp;
                        {{ value }}
                    </div>
                </div>
                <div v-else>
                    No stats yet!
                </div>
            </template>
            <template #footer="{ item }">
                {{ item.latest ? "Last Updated: " + item.latest.createdAt : "" }}
            </template>
        </CardList>
    </div>
    <div v-else style="padding: 2%">
        <h3>
            No stats yet
        </h3>
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

<style scoped>
.card-container {
    padding: 2%;
    width: 100%;
    overflow-x: auto;
}
</style>