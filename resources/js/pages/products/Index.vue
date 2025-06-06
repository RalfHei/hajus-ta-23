<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Card from '@/components/ui/card/Card.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { ShoppingCart, Trash } from 'lucide-vue-next';

const props = defineProps(['products']);

const addToCart = (product: any) => {
    router.post(route('cart.add', product), undefined, {
        preserveScroll: true,
    });
};

const clear = () => {
    router.post(route('cart.clear'));
};

const formatCurrency = (amount: number) => {
    return new Intl.NumberFormat('et', { style: 'currency', currency: 'EUR' }).format(amount);
};

</script>
<template>
    <AppLayout>
        <div class="p-12">
            <div class="flex w-full items-center justify-end gap-4 p-4">
                <Button :as="Link" :href="route('cart.checkout')" size="icon" variant="outline" class="relative">
                    <ShoppingCart class="size-5" />
                    <div
                        class="absolute -right-1 -top-1 flex min-h-5 min-w-5 items-center justify-center rounded-full bg-red-500 text-[10px] font-medium text-white"
                    >
                        {{ $page.props.cartCount }}
                    </div>
                </Button>
                <Button @click="clear" size="icon" variant="destructive" class="relative">
                    <Trash class="size-5" />
                </Button>
            </div>
            <div class="product-list flex flex-wrap gap-4">
                <Card v-for="product in products" :key="product.id" class="product-item flex w-80 flex-col p-4">
                    <div class="size-72 object-contain">
                        <img :src="product.image" :alt="product.name" />
                    </div>
                    <div class="flex-1">
                        <h2 class="mb-2 mt-4 text-lg font-semibold text-gray-100">{{ product.name }}</h2>
                        <p class="mb-4 text-gray-200">{{ product.description }}</p>
                        <p class="font-bold text-gray-400">Price: {{ formatCurrency(product.price) }}</p>
                    </div>
                    <Button class="mt-2 w-full" @click="addToCart(product)">Add to cart</Button>
                </Card>
            </div>
        </div>
    </AppLayout>
</template>
