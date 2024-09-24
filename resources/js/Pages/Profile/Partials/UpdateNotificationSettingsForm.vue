<script setup>
import { ref } from 'vue';
import { Link, router, useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue'

const props = defineProps({
    user: Object,
});

const form = useForm({
    _method: 'PUT',
    notifications_enabled: props.user.notifications_enabled,
    notifications_paused: props.user.notifications_paused,
});

const updateNotificationSettings = () => {
    form.post(route('user-profile-information.update'), {
        errorBag: 'updateNotificationSettings',
        preserveScroll: true,
    });
};
</script>

<template>
    <FormSection @submitted="updateNotificationSettings">
        <template #title>
            Basic notification settings
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="notifications_enabled" value="Enable notifications globally" />
                <Checkbox id="notifications_enabled" name="notifications_enabled" v-model:checked="form.notifications_enabled" />
                <InputError :message="form.errors.notifications_enabled" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <div v-if="form.notifications_paused" id="alert-border-4" class="flex items-center p-4 mb-4 text-yellow-800 border-t-4 border-yellow-300 bg-yellow-50 dark:text-yellow-300 dark:bg-gray-800 dark:border-yellow-800" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <div class="ms-3 text-sm font-medium">
                        Notifications paused till <span class="bold">{{ form.notifications_paused }}</span>
                        <p class="italic">This can be formatted, I know...</p>
                    </div>
                </div>
            </div>

        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="me-3">
                Saved.
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </PrimaryButton>
        </template>
    </FormSection>
</template>
