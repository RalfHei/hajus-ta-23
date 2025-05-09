<script setup lang="ts">
import Avatar from '@/components/ui/avatar/Avatar.vue';
import AvatarFallback from '@/components/ui/avatar/AvatarFallback.vue';
import Button from '@/components/ui/button/Button.vue';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import { useInitials } from '@/composables/useInitials';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { useForm } from '@inertiajs/vue3';

const props = defineProps(['post']);

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Show post',
        href: '/posts/show',
    },
];

const form = useForm({
    comment: '',
});

const submit = () => {
    form.post(route('comments.store', props.post), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
    });
};

const { getInitials } = useInitials();
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mx-auto my-12 w-full max-w-2xl">
            <div>
                <h1 class="text-2xl font-semibold tracking-wide">{{ post.title }}</h1>
                <p>{{ post.description }}</p>
            </div>
            <div class="mt-8">
                <form @submit.prevent="submit">
                    <div class="relative">
                        <Textarea v-model="form.comment" class="h-full w-full" />
                        <Button class="absolute bottom-4 right-4 z-10">Submit</Button>
                    </div>
                </form>
            </div>
            <div class="mt-8"></div>
            <h2 class="text-xl font-semibold">Comments</h2>
            <ul class="mt-6 space-y-6">
                <li v-for="comment in post.comments" :key="comment.id" class="border-b p-2 pb-6 hover:bg-muted/40">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-1">
                            <Avatar class="h-8 w-8 overflow-hidden rounded-lg">
                                <AvatarFallback class="rounded-lg text-black dark:text-white">
                                    {{ getInitials(comment.user.name) }}
                                </AvatarFallback>
                            </Avatar>
                            <p class="font-semibold">{{ comment.user.name }}</p>
                        </div>
                        <span class="text-sm text-muted-foreground">{{ comment.created_at_for_humans }}</span>
                    </div>
                    <p class="mt-2 text-muted-foreground">{{ comment.comment }}</p>
                </li>
            </ul>
        </div>
    </AppLayout>
</template>
