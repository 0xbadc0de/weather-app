<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import ActionSection from '@/Components/ActionSection.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    cities: Array,
});

const form = useForm({
    password: '',
});
</script>

<template>
    <ActionSection>
        <template #title>
            Cities
        </template>

        <template #description>
            Manage cities you want to receive weather notifications
        </template>

        <template #content>
            <div v-if="cities.length > 0" class="mt-5 space-y-6">
                <table class="min-w-full border border-gray-100 dark:border-gray-700">
                    <thead>
                        <tr class="w-full text-gray-700 dark:text-gray-300 text-left">
                            <th class="px-4 py-2 border border-gray-100 dark:border-gray-700">City</th>
                            <th class="px-4 py-2 border border-gray-100 dark:border-gray-700 w-1/4">UV Index Threshold</th>
                            <th class="px-4 py-2 border border-gray-100 dark:border-gray-700 w-1/4">Precipitation Threshold</th>
                            <th class="px-4 py-2 border border-gray-100 dark:border-gray-700 w-1/6">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(city, i) in cities" :key="i" class="border-b text-gray-700 dark:text-gray-300">
                            <td class="px-4 py-2 border border-gray-100 dark:border-gray-700">{{ city.name }}</td>
                            <td class="px-4 py-2 border border-gray-100 dark:border-gray-700 w-1/4">
                                <input
                                    v-model.number="city.uv_threshold"
                                    type="number"
                                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                                    min="0"
                                />
                            </td>
                            <td class="px-4 py-2 border border-gray-100 dark:border-gray-700 w-1/4">
                                <input
                                    v-model.number="city.precipitation_threshold"
                                    type="number"
                                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                                    min="0"
                                />
                            </td>
                            <td class="px-4 py-2 border border-gray-100 dark:border-gray-700 w-1/6">
                                <button type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-50 transition ease-in-out duration-150">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>



        </template>
    </ActionSection>
</template>
