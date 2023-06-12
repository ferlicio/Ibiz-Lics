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
    data() {
        return {
        id: 'Gerado Automaticamente',
        nu_fase: '',
        nu_edital: '',
        modalidade: '',
        data_abertura: '',
        nome_licitador: '',
        cnpj_licitador: '',
        prioridade: '',
        objeto: '',
        isEditPage: false,
        APIBaseURL: import.meta.env.VITE_APP_URL+'/api/lics',
        };
    },
    created(){
        const currentUrl = window.location.pathname
        this.isEditPage = currentUrl.search(/(\/licitacoes\/\d)/) == 0 ? true : false
        if (this.isEditPage){
            const licId = currentUrl.replace(/(\/licitacoes\/)/, '')
            axios.get(`${this.APIBaseURL}/${licId}`)
                .then(response => {
                    console.log(response.data);
                    this.id = response.data.data.id;
                    this.nu_fase = response.data.data.nu_fase;
                    this.nu_edital = response.data.data.nu_edital;
                    this.modalidade = response.data.data.modalidade;
                    this.data_abertura = response.data.data.data_abertura;
                    this.nome_licitador = response.data.data.nome_licitador;
                    this.cnpj_licitador = response.data.data.cnpj_licitador;
                    this.prioridade = response.data.data.prioridade;
                    this.objeto = response.data.data.objeto;
                })
                .catch(error => {
                    console.error(error);
                });
        }
    },
    methods: {
        submitForm() {
            const licData = {
                    nu_fase: this.nu_fase,
                    nu_edital: this.nu_edital,
                    modalidade: this.modalidade,
                    data_abertura: this.data_abertura,
                    nome_licitador: this.nome_licitador,
                    cnpj_licitador: this.cnpj_licitador,
                    prioridade: this.prioridade,
                    objeto: this.objeto
                };

            if(this.isEditPage){
                const licId = window.location.pathname.replace(/(\/licitacoes\/)/, '')
                axios.put(`${this.APIbaseURL}/${licId}`, licData)
                    .then(response => {
                        console.log(response.data);
                        window.location.href = '/';
                    })
                    .catch(error => {
                        console.error(error);
                    });
            } else{    
                axios.post(`${this.APIbaseURL}`, licData)
                    .then(response => {
                        console.log(response.data);
                        window.location.href = '/';
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        }
    }
};
</script>

<template>
    <div>
        <head>
            <title>
                Licitações
            </title>
        </head>
        
        <PageLayout>
            <div>
                <h2>Criar nova Licença</h2>
                <form @submit.prevent="submitForm">
                    <div class="mb-3">
                        <label for="id" class="form-label">Id da Licitação:</label>
                        <input type="text" id="id" v-model="id" class="form-control" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="nu_fase" class="form-label">Fase:</label>
                        <select class="form-select" id="nu_fase" v-model="nu_fase" aria-label="nu_edital" required>
                            <option selected disabled>Selecione uma fase</option>
                            <option value="-1">Em edição</option>
                            <option value="0">Descartada</option>
                            <option value="1">Processada</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nu_edital" class="form-label">Edital:</label>
                        <input type="text" id="nu_edital" v-model="nu_edital" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="modalidade" class="form-label">Modalidade:</label>
                        <input type="text" id="modalidade" v-model="modalidade" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="data_abertura" class="form-label">Data de Abertura:</label>
                        <input type="datetime-local" id="data_abertura" v-model="data_abertura" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="nome_licitador" class="form-label">Nome do Licitação:</label>
                        <input type="text" id="nome_licitador" v-model="nome_licitador" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="cnpj_licitador" class="form-label">CNPJ do Licitação:</label>
                        <input type="text" id="cnpj_licitador" v-model="cnpj_licitador" class="form-control" placeholder="00.000.000/0000-00" required>
                    </div>
                    <div class="mb-3">
                        <label for="prioridade" class="form-label">Prioridade:</label>
                        <input type="number" id="prioridade" v-model="prioridade" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="objeto" class="form-label">Objeto:</label>
                        <textarea id="objeto" v-model="objeto" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">
                        <span v-if="isEditPage">Editar Licitação</span>
                        <span v-else>Criar Licitação</span>
                    </button>
                </form>
            </div>
        </PageLayout> 
    </div>
  </template>

<style lang="scss">
form{
    display: flex;
    flex-direction: column;
    div {
        width: 100%;
    }
    button{
        width: 200px;
        align-self: end;
    }
}
</style>