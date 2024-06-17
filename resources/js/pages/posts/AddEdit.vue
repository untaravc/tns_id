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
        <div class="app-content flex-column-fluid">
            <div class="app-container container-xxl">
                <div id="kt_ecommerce_add_product_form"
                    class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework">
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                        <div class="card card-flush py-4">
                            <div class="card-body pt-0">
                                <div class="mb-3">
                                    <label>Status</label>
                                    <select class="form-select mb-2" v-model="form.status">
                                        <option value="1">Aktif</option>
                                        <option value="0">Non Aktif</option>
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback"
                                        v-if="getStatus('status')">
                                        {{ getMessage('status') }}
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label>Redirect</label>
                                    <select class="form-select mb-2" v-model="form.is_affiliate">
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback"
                                        v-if="getStatus('is_affiliate')">
                                        {{ getMessage('is_affiliate') }}
                                    </div>
                                </div>
                                <div>
                                    <Loading Loading :active="form_props.image_loader" :loader="'dots'"
                                        :is-full-page="false"></Loading>
                                    <div class="form-group">
                                        <label>Foto</label>
                                        <div>
                                            <input type="file" id="photo-file"
                                                accept="image/png,image/gif,image/jpeg,application/pdf"
                                                @change="uploadProof($event)" />
                                        </div>
                                    </div>
                                    <div class="p-2" v-if="form.image">
                                        <img :src="form.image" style="width: 100%; height: auto" :alt="form.image">
                                        <div class="text-sm text-red-700 cursor-pointer" @click="removeImg()">
                                            <u>Hapus</u>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="form.is_affiliate">
                                    <label>Link Gambar</label>
                                    <textarea v-model="form.image_url" class="form-control" rows="3"></textarea>
                                    <div class="p-2">
                                        <img :src="form.image_url" style="width: 100%; height: auto"
                                            :alt="form.image_url">
                                    </div>
                                </div>
                                <div>
                                    <label>Deskripsi Gambar</label>
                                    <textarea v-model="form.image_desc" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Detail</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <form>
                                    <div class="mb-5 fv-row fv-plugins-icon-container">
                                        <label class="form-label">Judul</label>
                                        <input type="text" class="form-control mb-2" v-model="form.title">
                                        <div class="fv-plugins-message-container invalid-feedback"
                                            v-if="getStatus('title')">
                                            {{ getMessage('title') }}
                                        </div>
                                    </div>
                                    <div class="mb-5 fv-row fv-plugins-icon-container">
                                        <ckeditor :editor="editor" v-model="form.body_content"
                                            :config="editor_data.config">
                                        </ckeditor>
                                        <div class="fv-plugins-message-container invalid-feedback"
                                            v-if="getStatus('body_content')">
                                            {{ getMessage('body_content') }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-5">
                                                <label class="form-label">Kategori</label>
                                                <vue-select label="name" v-model="form.category_id"
                                                    :reduce="name => name.id"
                                                    :options="form_props.categories"></vue-select>
                                                <div class="fv-plugins-message-container invalid-feedback"
                                                    v-if="getStatus('category_id')">
                                                    {{ getMessage('category_id') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" v-if="form.is_affiliate">
                                            <div class="mb-5">
                                                <label class="form-label">Afiliasi</label>
                                                <vue-select label="name" v-model="form.resource_id"
                                                    :reduce="name => name.id"
                                                    :options="form_props.news_affiliates"></vue-select>
                                                <div class="fv-plugins-message-container invalid-feedback"
                                                    v-if="getStatus('resource_id')">
                                                    {{ getMessage('resource_id') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" v-if="form.is_affiliate">
                                            <div class="mb-5">
                                                <label class="form-label">Link Afiliasi</label>
                                                <input type="text" class="form-control mb-2"
                                                    v-model="form.resource_url">
                                                <div class="fv-plugins-message-container invalid-feedback"
                                                    v-if="getStatus('resource_url')">
                                                    {{ getMessage('resource_url') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <router-link to="/admin/posts" class="btn btn-light me-5">Batal</router-link>
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
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import VueSelect from "vue-select";

export default {
    components: { Breadcrumb, VueSelect },
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
            categories: [],
            news_affiliates: [],
            image_url: '',
            image_loader: false,
        })

        const param_id = route.params.id
        form_props.edit_mode = param_id !== 'add'

        const title = form_props.edit_mode ? "Edit Post" : "Tambah Post"
        const breadcrumb_list = ["Post", form_props.edit_mode ? "Edit" : "Tambah"];

        const form = reactive({
            id: '',
            title: '',
            subtitle: '',
            body_content: '',
            image: '',
            category_id: '',
            status: 1,
            user_id: '',
            is_affiliate: '',
            resource_id: '',
            image_url: '',
            resource_url: '',
            image_desc: '',
        })

        if (form_props.edit_mode) {
            getData('posts/' + param_id)
                .then((data) => {
                    form.id = data.result.id
                    form.title = data.result.title
                    form.subtitle = data.result.subtitle
                    form.body_content = data.result.body_content
                    form.image = data.result.image
                    form.category_id = data.result.category_id
                    form.status = data.result.status
                    form.user_id = data.result.user_id
                    form.is_affiliate = data.result.is_affiliate
                    form.resource_id = data.result.resource_id
                    form.image_url = data.result.image_url
                    form.resource_url = data.result.resource_url
                    form.image_desc = data.result.image_desc
                })
        }

        function createData() {
            form_props.is_loading = true
            postData('posts', form).then((data) => {
                form_props.is_loading = false;
                if (data.success) {
                    router.push('/admin/posts')
                    resetErrors()
                } else {
                    setErrors(data.errors)
                }
            })
        }

        function editData() {
            form_props.is_loading = true
            patchData('posts/' + param_id, form).then((data) => {
                form_props.is_loading = false;
                if (data.success) {
                    router.push('/admin/posts')
                    resetErrors()
                } else {
                    setErrors(data.errors)
                }
            })
        }

        const editor = ClassicEditor
        const editor_data = reactive({
            content: "",
            config: {
            },
        })

        function uploadProof(e) {
            let file = e.target.files[0];
            let reader = new FileReader();
            reader.onloadend = (file) => {
                form.image = reader.result;
            };
            form_props.image_url = URL.createObjectURL(file);
            reader.readAsDataURL(file)

            const form_file = document.getElementById('photo-file');
            const formData = new FormData();
            if (form_file != '') {
                formData.append('file', form_file.files[0]);
            }

            form_props.image_loader = true;
            postData('upload', formData)
                .then((data) => {
                    form_props.image_loader = false;
                    document.getElementById('photo-file').value = '';
                    form.image = data.result;
                }).catch(() => {
                    form_props.image_loader = false;
                    alert('file upload failed');
                })
        }

        function loadCategoryList() {
            getData('categories-list', { type: 'post' })
                .then((data) => {
                    form_props.categories = data.result
                })
        }

        function loadAffiliateList() {
            getData('categories-list', { type: 'news_affiliate' })
                .then((data) => {
                    form_props.news_affiliates = data.result
                })
        }

        loadAffiliateList()
        loadCategoryList()

        function removeImg() {
            if (confirm('Hapus foto?')) {
                form.image = null
            }
        }

        return {
            breadcrumb_list,
            title,
            form,
            form_props,
            app_store,
            editor,
            editor_data,
            createData,
            getStatus,
            getMessage,
            editData,
            removeImg,
            uploadProof
        }
    }
}
</script>
