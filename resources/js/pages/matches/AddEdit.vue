<template>
    <div class="d-flex flex-column flex-column-fluid" style="min-height: calc(100vh - 130px)">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        {{ title }}</h1>
                    <Breadcrumb :list="breadcrumb_list"></Breadcrumb>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div class="app-container container-xxl">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-flush">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Detail</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <form>
                                    <div class="mb-5">
                                        <label class="required form-label">Kopetisi</label>
                                        <vue-select label="name" v-model="form.competition_id" :reduce="name => name.id"
                                            :options="form_props.competitions"></vue-select>
                                        <div class="fv-plugins-message-container invalid-feedback"
                                            v-if="getStatus('competition_id')">
                                            {{ getMessage('competition_id') }}
                                        </div>
                                    </div>
                                    <div class="mb-5">
                                        <label class="required form-label">Kategori</label>
                                        <vue-select label="name" v-model="form.player_category_code"
                                            :reduce="name => name.code" :options="form_props.categories"></vue-select>
                                        <div class="fv-plugins-message-container invalid-feedback"
                                            v-if="getStatus('player_category_code')">
                                            {{ getMessage('player_category_code') }}
                                        </div>
                                    </div>
                                    <div class="mb-5 fv-row fv-plugins-icon-container">
                                        <label class="required form-label">Tanggal</label>
                                        <input type="date" class="form-control mb-2" v-model="form.date">
                                        <div class="fv-plugins-message-container invalid-feedback" v-if="getStatus('date')">
                                            {{ getMessage('date') }}
                                        </div>
                                    </div>
                                    <div class="mb-5">
                                        <label class="required form-label">Pemenang</label>
                                        <select class="form-select mb-2" v-model="form.winner">
                                            <option value="home">Home</option>
                                            <option value="away">Away</option>
                                        </select>
                                        <div class="fv-plugins-message-container invalid-feedback"
                                            v-if="getStatus('winner')">
                                            {{ getMessage('winner') }}
                                        </div>
                                    </div>
                                    <div class="mb-5">
                                        <label class="required form-label">Status</label>
                                        <select class="form-select mb-2" v-model="form.status">
                                            <option value="1">Aktif</option>
                                            <option value="0">Non Aktif</option>
                                        </select>
                                        <div class="fv-plugins-message-container invalid-feedback"
                                            v-if="getStatus('status')">
                                            {{ getMessage('status') }}
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="card mb-3 card-flush">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>HOME</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="mb-5">
                                    <label class="required form-label">Pemain 1</label>
                                    <vue-select label="full_name" v-model="form.home_first_player_id"
                                        :reduce="full_name => full_name.id" :options="form_props.players"></vue-select>
                                    <div class="fv-plugins-message-container invalid-feedback"
                                        v-if="getStatus('home_first_player_id')">
                                        {{ getMessage('home_first_player_id') }}
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <label class="required form-label">Pemain 2</label>
                                    <vue-select label="full_name" v-model="form.home_second_player_id"
                                        :reduce="full_name => full_name.id" :options="form_props.players"></vue-select>
                                    <div class="fv-plugins-message-container invalid-feedback"
                                        v-if="getStatus('home_second_player_id')">
                                        {{ getMessage('home_second_player_id') }}
                                    </div>
                                </div>
                                <div class="mb-5 fv-row fv-plugins-icon-container">
                                    <label class="required form-label">Skor</label>
                                    <input type="number" min="0" class="form-control mb-2" v-model="form.home_final_score">
                                    <div class="fv-plugins-message-container invalid-feedback"
                                        v-if="getStatus('home_final_score')">
                                        {{ getMessage('home_final_score') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-flush mb-3">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>AWAY</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="mb-5">
                                    <label class="required form-label">Pemain 1</label>
                                    <vue-select label="full_name" v-model="form.away_first_player_id"
                                        :reduce="full_name => full_name.id" :options="form_props.players"></vue-select>
                                    <div class="fv-plugins-message-container invalid-feedback"
                                        v-if="getStatus('away_first_player_id')">
                                        {{ getMessage('away_first_player_id') }}
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <label class="required form-label">Pemain 2</label>
                                    <vue-select label="full_name" v-model="form.away_second_player_id"
                                        :reduce="full_name => full_name.id" :options="form_props.players"></vue-select>
                                    <div class="fv-plugins-message-container invalid-feedback"
                                        v-if="getStatus('away_second_player_id')">
                                        {{ getMessage('away_second_player_id') }}
                                    </div>
                                </div>
                                <div class="mb-5 fv-row fv-plugins-icon-container">
                                    <label class="required form-label">Skor</label>
                                    <input type="number" min="0" class="form-control mb-2" v-model="form.away_final_score">
                                    <div class="fv-plugins-message-container invalid-feedback"
                                        v-if="getStatus('away_final_score')">
                                        {{ getMessage('away_final_score') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <router-link to="/admin/matches" class="btn btn-light me-5">Batal</router-link>
                            <button id="kt_ecommerce_add_product_submit" v-if="!form_props.edit_mode"
                                :disabled="form_props.is_loading" @click="createData" class="btn btn-primary">
                                <span v-if="!form_props.is_loading">Tambah</span>
                                <span v-if="form_props.is_loading">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                            <button id="kt_ecommerce_add_product_submit" v-if="form_props.edit_mode"
                                :disabled="form_props.is_loading" @click="editData" class="btn btn-primary">
                                <span v-if="!form_props.is_loading">Simpan</span>
                                <span v-if="form_props.is_loading">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Breadcrumb from "../../components/Breadcrumb";
import { reactive } from "vue";
import useAxios from "../../src/service";
import useValidation from "../../src/validation";
import { useRouter, useRoute } from "vue-router";
import { useFilterStore } from "../../src/store_filter";
import VueSelect from "vue-select";

export default {
    components: { VueSelect, Breadcrumb },
    setup() {
        const { postData, getData, patchData } = useAxios()
        const router = useRouter()
        const { setErrors, getStatus, getMessage, resetErrors } = useValidation()
        const route = useRoute()
        const { app_store } = useFilterStore()

        // Cek Mode
        const form_props = reactive({
            is_loading: false,
            errors: [],
            edit_mode: false,
            competitions: [],
            categories: [],
            players: [],
        })

        const param_id = route.params.id
        form_props.edit_mode = param_id !== 'add'

        const title = form_props.edit_mode ? "Edit Pertandingan" : "Tambah Pertandingan"
        const breadcrumb_list = ["Pertandingan", form_props.edit_mode ? "Edit" : "Tambah"];

        const form = reactive({
            id: '',
            competition_id: '',
            competition_name: '',
            player_category_code: '',
            home_first_player_id: '',
            home_first_player_name: '',
            home_second_player_id: '',
            home_second_player_name: '',
            home_final_score: '',
            away_first_player_id: '',
            away_first_player_name: '',
            away_second_player_id: '',
            away_second_player_name: '',
            away_final_score: '',
            winner: '',
            date: '',
            user_id: '',
            status: 1,
        })

        if (form_props.edit_mode) {
            getData('matches/' + param_id)
                .then((data) => {
                    form.id = data.result.id
                    form.competition_id = data.result.competition_id
                    form.competition_name = data.result.competition_name
                    form.player_category_code = data.result.player_category_code
                    form.home_first_player_id = data.result.home_first_player_id
                    form.home_first_player_name = data.result.home_first_player_name
                    form.home_second_player_id = data.result.home_second_player_id
                    form.home_second_player_name = data.result.home_second_player_name
                    form.home_final_score = data.result.home_final_score
                    form.away_first_player_id = data.result.away_first_player_id
                    form.away_first_player_name = data.result.away_first_player_name
                    form.away_second_player_id = data.result.away_second_player_id
                    form.away_second_player_name = data.result.away_second_player_name
                    form.away_final_score = data.result.away_final_score
                    form.winner = data.result.winner
                    form.date = data.result.date
                    form.user_id = data.result.user_id
                    form.status = data.result.status
                })
        }

        function createData() {
            // form_props.is_loading = true
            postData('matches', form).then((data) => {
                form_props.is_loading = false;
                if (data.success) {
                    router.push('/admin/matches')
                    resetErrors()
                } else {
                    setErrors(data.errors)
                }
            }).catch(() => {
                form_props.is_loading = false
            })
        }

        function editData() {
            form_props.is_loading = true
            patchData('matches/' + param_id, form).then((data) => {
                form_props.is_loading = false;
                if (data.success) {
                    router.push('/admin/matches')
                    resetErrors()
                } else {
                    setErrors(data.errors)
                }
            })
        }

        function loadPlayerList() {
            getData('players-list')
                .then((data) => {
                    form_props.players = data.result
                })
        }

        loadPlayerList()

        function loadCompetitionList() {
            getData('competitions-list')
                .then((data) => {
                    form_props.competitions = data.result
                })
        }

        loadCompetitionList()

        function loadCompetitionCategoryList() {
            getData('categories-list', { type: 'player' })
                .then((data) => {
                    form_props.categories = data.result
                })
        }

        loadCompetitionCategoryList()

        return {
            breadcrumb_list,
            title,
            form,
            form_props,
            app_store,
            createData,
            getStatus,
            getMessage,
            editData
        }
    }
}
</script>
