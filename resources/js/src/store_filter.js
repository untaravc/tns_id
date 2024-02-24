import { defineStore } from 'pinia'
import { reactive } from "vue";

export const useFilterStore = defineStore('filter', () => {
    const app_store = reactive({
        client_id: null,
        client_name: null,
        client_logo: null,
        client_mini_logo: null,
        client_token: null,
        auto_call: false,
        station_id: null,
        role_id: null,
    })

    const category_store = reactive({
        page: 1,
        type: '',
    })

    const staff_store = reactive({
        page: 1
    })

    const department_store = reactive({
        page: 1
    })

    const role_store = reactive({
        page: 1
    })

    const menu_store = reactive({
        page: 1
    })


    const token_store = reactive({
        page: 1,
        station_id: '',
        auto_call: false,
    })

    const config_ctk = reactive({
        range: true,
        'only-date': true,
        'no-shortcuts': true,
        format: "YYYY-MM-DD",
        formatted: "ll"
    })

    return {
        staff_store,
        role_store,
        menu_store,
        category_store,
        app_store,
        config_ctk
    }
})
