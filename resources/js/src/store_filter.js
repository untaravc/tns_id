import { defineStore } from 'pinia'
import { reactive } from "vue";

export const useFilterStore = defineStore('filter', () => {
    const app_store = reactive({

    })

    const category_store = reactive({
        page: 1,
        type: '',
    })

    const role_store = reactive({
        page: 1
    })

    const match_store = reactive({
        page: 1,
        name: '',
        per_page: 25,
        player_id: '',
        competition_id: '',
        round_category_id: '',
        player_category_code: '',
    })

    const player_store = reactive({
        page: 1,
        per_page: 25,
        name: '',
        city: '',
        gender: '',
        status: '',
    })

    const config_ctk = reactive({
        range: true,
        'only-date': true,
        'no-shortcuts': true,
        format: "YYYY-MM-DD",
        formatted: "ll"
    })

    return {
        role_store,
        category_store,
        app_store,
        config_ctk,
        match_store,
        player_store,
    }
})
