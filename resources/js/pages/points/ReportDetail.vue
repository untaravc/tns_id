<template>
    <div class="card card-flush w-[600px]">
        <div class="p-8 flex justify-between">
            <div class="text-xl font-semibold">Detail Poin</div>
            <div @click="closeModal" class="cursor-pointer text-2xl ">
                <v-icon name="bi-x" />
            </div>
        </div>
    </div>
</template>
<script>
import { closeModal } from 'jenesius-vue-modal';
export default {
    props: {
        filter: Object
    },
    setup(props){
        
        function loadData(){

        }

        loadData()

        return {
            closeModal
        }
    }
}
</script>