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

      </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
      <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card card-flush">
          <div class="p-8">
            <div class="row">
              <div class="col-md-4">
                <label class="form-label">Kategori</label>
                <select @change="loadDataContent" class="form-control form-control-solid"
                  v-model="filter.player_category_code">
                  <option :value="cat.code" v-for="cat in filter_props.player_categories">{{ cat.name }}</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label">Tahun</label>
                <select class="form-control form-control-solid" v-model="filter.year" @change="loadDataContent">
                  <option :value="2024 - i + 1" v-for="i in 10">{{ 2024 - i + 1 }}</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label">Nama</label>
                <div>
                  <input type="text" class="form-control form-control-solid" v-model="filter.name"
                    @keyup.enter="loadDataContent">
                </div>
              </div>
            </div>
          </div>
          <div class="card-body pt-0">
            <div class="dataTables_wrapper dt-bootstrap4 no-footer">
              <div class="table-responsive">
                <Loading :active="is_loading" :loader="'dots'" :is-full-page="false" />
                <table class="table align-middle table-row-dashed fs-6 gy-5">
                  <thead>
                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                      <th>No</th>
                      <th>Nama</th>
                      <th>Poin</th>
                      <th class="text-end">Aksi</th>
                    </tr>
                  </thead>
                  <tbody class="fw-semibold text-gray-600">
                    <tr v-if="response.result.length === 0">
                      <td colspan="6" class="text-center"><i>Tidak ada data.</i></td>
                    </tr>
                    <tr v-for="(data, d) in response.result">
                      <td>{{ d + 1 }}</td>
                      <td>
                        {{ data.player_name }}
                      </td>
                      <td>
                        <span v-if="data.points">{{ data.points }}</span>
                      </td>
                      <td class="text-end">
                        <div class="dropdown">
                          <button class="btn btn-light dropdown-toggle btn-sm" data-toggle="dropdown">
                            Aksi
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <div @click="detailModel(data)" class="dropdown-item">
                              Detail
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <widget-container-modal />
  </div>
</template>
<script>
import Breadcrumb from "../../components/Breadcrumb";
import PerPage from '../../components/PerPage'
import useAxios from "../../src/service";
import { reactive, ref } from "vue";
import { useFilterStore } from "../../src/store_filter";
import VueSelect from "vue-select";
import { openModal, container, config } from 'jenesius-vue-modal';
import ReportDetail from './ReportDetail.vue'

export default {
  components: { Breadcrumb, PerPage, VueSelect, WidgetContainerModal: container },
  setup() {
    const title = "Report Point"
    const breadcrumb_list = ["Poin", "Report"];
    const { getData } = useAxios()
    const is_loading = ref(false)
    const { app_store } = useFilterStore()

    const filter = reactive({
      page: 1,
      name: '',
      year: '',
      player_category_code: 'U10',
      player_id: ''
    })

    config({
      escClose: true,
      backgroundClose: false
    })

    const filter_props = reactive({
      player_categories: []
    })

    function loadDataContent() {
      is_loading.value = true
      getData('point-reports', filter)
        .then((data) => {
          if (data.success) {
            response.result = data.result
          }
          is_loading.value = false
        })
    }

    loadDataContent()

    const response = reactive({
      result: []
    })

    function loadCategoryList() {
      getData('categories-list', { type: 'player' })
        .then((data) => {
          filter_props.player_categories = data.result
        })
    }

    loadCategoryList()

    function detailModel(data) {
      filter.player_id = data.player.id

      openModal(ReportDetail, { filter: filter });
    }

    function setCat(val) {
      filter.player_category_code = val
      loadDataContent()
    }
    return {
      breadcrumb_list,
      title,
      response,
      filter,
      is_loading,
      app_store,
      filter_props,
      loadDataContent,
      detailModel,
      setCat
    }
  }
}
</script>
<style>
.modal-container {
  display: flex;
  align-items: flex-start;
  justify-content: center;
  padding-top: 100px;

  background-color: #3e3e3e21;
}
</style>