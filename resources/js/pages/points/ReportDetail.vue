<template>
    <div class="card card-flush w-[600px]">
        <div class="p-8 flex justify-between">
            <div class="text-xl font-semibold">Detail Poin</div>
            <div @click="closeModal" class="cursor-pointer text-2xl">
                <v-icon name="bi-x" />
            </div>

        </div>
        <div class="px-8">
            <table class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th>No</th>
                        <th>Kompetisi</th>
                        <th>Tanggal</th>
                        <th>Poin</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, i) in response.data">
                        <td>{{ i + 1 }}</td>
                        <td>{{ item.competition_name }}</td>
                        <td>{{ $filter.formatDate(item.date) }}</td>
                        <td>{{ item.point }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
import { closeModal } from 'jenesius-vue-modal';
import useAxios from "../../src/service";
import { ref, reactive } from 'vue';
import { onBeforeRouteLeave } from 'vue-router'
export default {
    props: {
        filter: Object
    },
    setup(props) {
        const { getData } = useAxios()
        const is_loading = ref(true)

        const response = reactive({
            data: []
        })
        function loadData() {
            is_loading.value = true
            getData('match-points', props.filter)
                .then((data) => {
                    if (data.success) {
                        response.data = data.result
                    }
                    is_loading.value = false
                }).catch(() => [
                    is_loading.value = true
                ])
        }

        loadData()

        onBeforeRouteLeave((to, from) => {
            closeModal()
        })

        return {
            closeModal,
            response
        }
    }
}
</script>