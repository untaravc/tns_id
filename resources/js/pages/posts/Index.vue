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
                    <router-link to="/admin/posts/add" class="btn btn-sm fw-bold btn-primary">
                        Tambah Data
                    </router-link>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card card-flush">
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5"
                        data-select2-id="select2-data-124-lq0k">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                    <v-icon name="bi-search" />
                                </span>
                                <input type="text" v-model="filter.name" @keyup.enter="loadDataContent"
                                    class="form-control form-control-solid w-250px ps-14" placeholder="Cari..">
                            </div>
                        </div>
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5"
                            data-select2-id="select2-data-123-4p2n">
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
                                            <th>Judul</th>
                                            <th>Kategori</th>
                                            <th>Status</th>
                                            <th class="text-end">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr v-if="response.data_content.total === 0">
                                            <td colspan="5" class="text-center"><i>Tidak ada data.</i></td>
                                        </tr>
                                        <tr v-for="(data, d) in response.data_content.data">
                                            <td>
                                                {{ response.data_content.per_page *
                                                    (response.data_content.current_page - 1) + d + 1 }}
                                            </td>
                                            <td style="width: 80px;">
                                                <a v-if="data.image" :href="data.image" target="_blank">
                                                    <div class="bg-thumbnail"
                                                        :style="'width: 50px; height: 50px;background: url(' + data.image + ');'">
                                                    </div>
                                                </a>
                                                <a v-if="data.image_url" :href="data.image_url" target="_blank">
                                                    <div v-if="data.image_url" class="bg-thumbnail"
                                                        :style="'width: 50px; height: 50px;background: url(' + data.image_url + ');'">
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                <div v-if="data.resource">
                                                    <img :src="data.resource.image" style="height: 15px;" alt="">
                                                </div>
                                                {{ data.title }}
                                                <div>
                                                    <small>{{ $filter.formatDate(data.created_at) }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <span v-if="data.category"> {{ data.category.name }}</span>
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
                                                        <router-link :to="'/admin/posts/' + data.id"
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

export default {
    components: { Breadcrumb, PerPage, WidgetContainerModal: container, StatusDefault },
    setup() {
        const title = "Data Post"
        const breadcrumb_list = ["Post", "Data"];
        const { getData, deleteData } = useAxios()
        const is_loading = ref(true)
        const { app_store } = useFilterStore()

        const filter = reactive({
            page: 1,
            name: '',
            per_page: 25,
        })

        function loadDataContent(page = 1) {
            is_loading.value = true
            filter.page = page
            getData('posts', filter)
                .then((data) => {
                    if (data.success) {
                        response.data_content = data
                    }
                    is_loading.value = false
                })
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
                deleteData('posts/' + id)
                    .then((data) => {
                        SwalToast('Berhasil menghapus data.')
                        loadDataContent(filter.page)
                    })
            }
        }

        return {
            breadcrumb_list,
            title,
            response,
            filter,
            is_loading,
            app_store,
            loadDataContent,
            changePerPage,
            deleteModal
        }
    }
}
</script>
