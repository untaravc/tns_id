<template>
    <div class="d-flex flex-column flex-column-fluid" style="min-height: calc(100vh - 130px)">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        {{ title }}
                    </h1>
                    <Breadcrumb :list="breadcrumb_list"></Breadcrumb>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <router-link to="/admin/competitions/add" class="btn btn-sm fw-bold btn-primary">
                        Tambah Data
                    </router-link>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card card-flush">
                    <div class="px-8 pt-8 pb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <label>Nama</label>
                                <input class="rounded-md py-3 px-2 border focus:ring-1 block mt-1 w-full" type="text"
                                    v-model="filter_name">
                            </div>
                            <div class="col-md-3">
                                <label>Kota</label>
                                <input class="rounded-md py-3 px-2 border focus:ring-1 block mt-1 w-full" type="text"
                                    v-model="filter_city">
                            </div>
                            <div class="col-md-3">
                                <label>Tahun</label>
                                <input class="rounded-md py-3 px-2 border focus:ring-1 block mt-1 w-full" type="number"
                                    @keyup="filterYear" v-model="filter.year">
                            </div>
                            <div class="col-md-3">
                                <label>Status</label>
                                <select class="rounded-md py-3 px-2 border focus:ring-1 block mt-1 w-full"
                                    v-model="filter.status" @change="loadDataContent">
                                    <option value="">Semua</option>
                                    <option value="aktif">Aktif</option>
                                    <option value="non-aktif">Non Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="table-responsive">
                                <Loading :active="is_loading" :loader="'dots'" :is-full-page="false" />
                                <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                                    id="kt_ecommerce_products_table">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th>No</th>
                                            <th></th>
                                            <th>Nama</th>
                                            <th>Kota</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th class="text-end">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr v-if="response.data_content.total === 0">
                                            <td colspan="6" class="text-center"><i>Tidak ada data.</i></td>
                                        </tr>
                                        <tr v-for="(data, d) in response.data_content.data">
                                            <td>
                                                {{ response.data_content.per_page *
                                                    (response.data_content.current_page - 1) + d + 1 }}
                                            </td>
                                            <td style="width: 80px;">
                                                <a :href="data.image" v-if="data.image" target="_blank">
                                                    <div class="bg-thumbnail"
                                                        :style="'width: 50px; height: 50px;background: url(' + data.image + ');'">
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                {{ data.name }}
                                                <br>
                                                <i>{{ data.capital }}</i>
                                            </td>
                                            <td>
                                                {{ data.address }}
                                            </td>
                                            <td>
                                                <div>{{ $filter.formatDate(data.date_start) }}</div>
                                                <div v-if="data.date_end">s/d {{ $filter.formatDate(data.date_end) }}
                                                </div>
                                            </td>
                                            <td>
                                                <StatusDefault :status="data.status" />
                                            </td>
                                            <td class="text-end">
                                                <div class="dropdown">
                                                    <button class="btn btn-light dropdown-toggle btn-sm"
                                                        data-toggle="dropdown">
                                                        Aksi
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <router-link :to="'/admin/competitions/' + data.id"
                                                            class="dropdown-item">
                                                            Edit
                                                        </router-link>
                                                        <button class="dropdown-item text-danger"
                                                            @click="deleteModal(data.id)">
                                                            Hapus
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div
                                    class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                                    <PerPage :value="filter.per_page" @change-per-page="changePerPage" />
                                </div>
                                <div
                                    class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                                    <Bootstrap4Pagination :data="response.data_content" :limit="2"
                                        @pagination-change-page="loadDataContent"></Bootstrap4Pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <WidgetContainerModal />
        </div>
    </div>
</template>
<script>
import Breadcrumb from "../../components/Breadcrumb";
import PerPage from '../../components/PerPage'
import StatusDefault from '../../components/StatusDefault'
import useAxios from "../../src/service";
import DeleteModal from "./DeleteModal"
import { reactive, ref } from "vue";
import { container, promptModal } from "jenesius-vue-modal";
import SwalToast from '../../src/swal_toast'
import { useFilterStore } from "../../src/store_filter";
import { watchDebounced } from "@vueuse/core"

export default {
    components: { Breadcrumb, PerPage, WidgetContainerModal: container, StatusDefault },
    setup() {
        const title = "Data Kompetisi"
        const breadcrumb_list = ["Kompetisi", "Data"];
        const { getData, deleteData } = useAxios()
        const is_loading = ref(true)
        const { app_store } = useFilterStore()

        const filter = reactive({
            page: 1,
            name: '',
            status: '',
            year: '',
            city: '',
            per_page: 25,
        })

        const filter_name = ref('')
        const filter_city = ref('')

        function loadDataContent(page = 1) {
            is_loading.value = true
            filter.page = page
            getData('competitions', filter)
                .then((data) => {
                    if (data.success) {
                        response.data_content = data
                    }
                    is_loading.value = false
                })
        }

        function filterYear() {
            if (filter.year > 1000) {
                loadDataContent()
            }
        }

        loadDataContent()

        const response = reactive({
            data_content: {
                data: []
            }
        })

        function changePerPage(per_page) {
            filter.per_page = per_page
            loadDataContent()
        }

        async function deleteModal(id) {
            const delete_modal = await promptModal(DeleteModal, { title: "Hapus data?" })
            if (delete_modal) {
                deleteData('competitions/' + id)
                    .then((data) => {
                        SwalToast('Berhasil menghapus data.')
                        loadDataContent(filter.page)
                    })
            }
        }

        watchDebounced(
            filter_name,
            () => {
                filter.name = filter_name
                loadDataContent()
            },
            { debounce: 700 },
        )

        watchDebounced(
            filter_city,
            () => {
                filter.city = filter_city
                loadDataContent()
            },
            { debounce: 700 },
        )

        return {
            breadcrumb_list,
            title,
            response,
            filter,
            is_loading,
            app_store,
            filter_name,
            filter_city,
            loadDataContent,
            changePerPage,
            deleteModal,
            filterYear
        }
    }
}
</script>
