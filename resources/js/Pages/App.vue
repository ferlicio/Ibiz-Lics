<script setup>
    import {Head} from '@inertiajs/vue3'
    import * as bootstrap from 'bootstrap'
    const props = defineProps({
        page: Object
    })
</script>
<script>
    import axios from 'axios';
    import PageLayout from '../layouts/PageLayout.vue'

    export default {
        components: {
            PageLayout
        },
        data() {
            return {
                lics: {
                    'total': 0,
                    'processadas': 0,
                    'descartadas': 0,
                },
                appName: import.meta.env.VITE_APP_NAME,
            };
        },
        created() {
            this.fetchData()
        },
        methods: {
            fetchData() {
                axios.get(`${import.meta.env.VITE_APP_URL}/api/lics`)
                    .then(response => {
                        console.log(response.data.meta.total)
                    this.lics.total = response.data.meta.total;
                    })
                axios.get(`${import.meta.env.VITE_APP_URL}/api/lics?nuFase[eq]=1`)
                    .then(response => {
                    this.lics.processadas = response.data.meta.total;
                    })
                axios.get(`${import.meta.env.VITE_APP_URL}/api/lics?nuFase[eq]=0`)
                    .then(response => {
                    this.lics.descartadas = response.data.meta.total;
                    })
            },
        },
    }
</script>

<template>

    <div>
        <head>
            <title>
                {{page.name}}
            </title>
        </head>
        
        <PageLayout>
            <div class="header">
                <p>Bem vindo ao {{ this.appName }}</p>
            </div>
        </PageLayout> 
    </div>
</template>

<style lang="scss">
    div.header {
        background-color: aliceblue;
        border-radius: 5px;
        padding: 20px;
        p {
            margin-bottom: 0px;
        }
    }
</style>
