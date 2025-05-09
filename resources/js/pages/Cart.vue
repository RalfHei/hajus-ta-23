<script setup lang="ts">
import Card from '@/components/ui/card/Card.vue';
import CardContent from '@/components/ui/card/CardContent.vue';
import CardDescription from '@/components/ui/card/CardDescription.vue';
import CardFooter from '@/components/ui/card/CardFooter.vue';
import CardHeader from '@/components/ui/card/CardHeader.vue';
import CardTitle from '@/components/ui/card/CardTitle.vue';
import Input from '@/components/ui/input/Input.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3';

const formatCurrency = (amount: number) => {
    return new Intl.NumberFormat('et', { style: 'currency', currency: 'EUR' }).format(amount);
};

const updateCart = (id: number, quantity: number | string) => {
    router.post(route('cart.update'), {
        id: id,
        quantity: quantity,
    });
};

</script>

<template>
    <AppLayout>
        <div class="p-12">
            <Card>
                <CardHeader>
                    <CardTitle>Cart</CardTitle>
                    <CardDescription>Your shopping cart contains the items you have selected for purchase.</CardDescription>
                </CardHeader>
                <CardContent>
                    <ul class="divide-y divide-border">
                        <li v-for="(item, id) in $page.props.cart" :key="id" class="py-2">
                            <div class="grid grid-cols-12 gap-2">
                                <div class="col-span-8 flex items-center gap-4 overflow-hidden md:col-span-6">
                                    <div class="size-12 shrink-0 overflow-hidden rounded-full border border-muted-foreground object-contain">
                                        <img :src="item.image" :alt="item.name" />
                                    </div>
                                    <div>
                                        <p>{{ item.name }}</p>
                                        <p class="max-w-[30ch] truncate text-xs text-muted-foreground md:max-w-[70ch]">{{ item.description }}</p>
                                    </div>
                                </div>
                                <div class="col-span-2 inline-flex items-center justify-end md:col-span-3">
                                    <Input
                                        class="w-full max-w-24 text-right"
                                        type="number"
                                        @update:model-value="(value) => updateCart(id, value)"
                                        :min="0"
                                        :model-value="item.quantity"
                                    />
                                </div>
                                <div class="col-span-2 inline-flex items-center justify-end md:col-span-3">
                                    <span>{{ formatCurrency(item.price) }}</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="flex items-center justify-end">
                        <p class="text-2xl font-medium">
                            <span class="text-muted-foreground">Total:</span> {{ formatCurrency($page.props.cartTotal) }}
                        </p>
                    </div>
                </CardContent>
                <CardFooter></CardFooter>
            </Card>
        </div>
    </AppLayout>
</template>
