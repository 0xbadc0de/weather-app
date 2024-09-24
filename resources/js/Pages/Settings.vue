<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SectionBorder from '@/Components/SectionBorder.vue';
import UpdateNotificationSettingsForm from '@/Pages/Profile/Partials/UpdateNotificationSettingsForm.vue'
import UpdateWeatherCitiesForm from '@/Pages/Profile/Partials/UpdateWeatherCitiesForm.vue'

defineProps({
    cities: Array,
});
</script>

<template>
    <AppLayout title="Notification settings">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Notification settings
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <UpdateNotificationSettingsForm :user="$page.props.auth.user" />

                <SectionBorder />

                <UpdateWeatherCitiesForm :cities="cities" class="mt-10 sm:mt-0" />
            </div>
        </div>
    </AppLayout>
</template>
