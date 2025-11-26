<script setup>
import { useForm, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'
const page = usePage()
const category = computed(() => page.props.category)
const form = useForm({
    code: category.value.code,
    name: category.value.name,
    description: category.value.description ?? '',
    image: null,
})
const submit = () => {
    form.post(route('categories.update', category.value.id), {
        forceFormData: true,
        _method: 'put',
    })
}
const handleImageChange = (event) => {
    form.image = event.target.files[0] ?? null
}
</script>
