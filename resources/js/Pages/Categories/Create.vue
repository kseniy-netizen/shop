<script setup>
import { useForm } from '@inertiajs/vue3'
const form = useForm({
    code: '',
    name: '',
    description: '',
    image: null,
})
const submit = () => {
    form.post(route('categories.store'), {
        forceFormData: true,
    })
}
const handleImageChange = (event) => {
    form.image = event.target.files[0] ?? null
}
</script>
<template>
    <main class="container">
        <h1>Создание категории</h1>
        <form @submit.prevent="submit" enctype="multipart/form-data">
            <div>
                <label for="code">Код</label>
                <input id="code" v-model="form.code" type="text" autocomplete="off">
                <div v-if="form.errors.code" class="error">
                    {{ form.errors.code }}
                </div>
            </div>
            <div>
                <label for="name">Название</label>
                <input id="name" v-model="form.name" type="text">
                <div v-if="form.errors.name" class="error">
                    {{ form.errors.name }}
                </div>
            </div>
            <div>
                <label for="description">Описание</label>
                <textarea id="description" v-model="form.description" rows="4" />
                <div v-if="form.errors.description" class="error">
                    {{ form.errors.description }}
                </div>
            </div>
            <div>
                <label for="image">Изображение (необязательно)</label>
                <input id="image" type="file" accept="image/*" @change="handleImageChange">
                <div v-if="form.errors.image" class="error">
                    {{ form.errors.image }}
                </div>
            </div>
            <button type="submit" :disabled="form.processing">
                {{ form.processing ? 'Сохраняю...' : 'Создать категорию' }}
            </button>
        </form>
    </main>
</template>