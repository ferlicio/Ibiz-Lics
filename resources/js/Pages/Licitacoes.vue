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
                lics: {},
                licsPage: 1,
                totalLicsPages: 0,
                APIBaseURL: import.meta.env.VITE_APP_URL +'/api/lics',
                fase:['Em edição','Descartada','Processada'],
                request: '',
                filtros:[],
                campoPesquisa: '',
                pesquisa: '',
                APIBaseURL: import.meta.env.VITE_APP_URL+'/api/lics',
            }
        },
        created() {
            this.request = this.APIBaseURL;
            axios.get(`${this.APIBaseURL}`)
                .then(response => {
                    this.lics = response.data.data;
                    this.licsPage = response.data.meta.current_page;
                    this.totalLicsPages = response.data.meta.last_page;
                })
                .catch(error => {
                    console.error(error);
                });
            },
        components: {
            PageLayout
        },
        methods: {
            redirect(path) {
                path = path 
                    ?path 
                    :'';
                window.location.href = `${import.meta.env.VITE_APP_URL}/${path}`;
            },
            changePage(change) {
                if (change === 'next') {
                    if (this.licsPage < this.totalLicsPages) {
                        this.licsPage++;
                    }
                } else if (change === 'prev') {
                    if (this.licsPage > 1) {
                        this.licsPage--;
                    }
                }
                this.makeRequest();
            },
            makeRequest() {
                let request = this.request
                if (this.filtros.length > 0) {
                    request += '?';
                    this.filtros.forEach(filtro => {
                        request += `${filtro}`;
                        if (filtro !== this.filtros[this.filtros.length - 1]) {
                            request += '&';
                        }
                    });
                }
                if (this.pesquisa.length > 0) {
                    this.filtros.length > 0
                        ?request += `&?${this.pesquisa}`
                        :request += `?${this.pesquisa}`;
                }
                if ((this.pesquisa.length > 0 || this.filtros.length > 0) && this.licsPage > 1) {
                    request += '&';
                }
                axios.get(`${request}${this.licsPage==1 ?'' :'?page='+this.licsPage}`)
                    .then(response => {
                        this.lics = response.data.data;
                        this.licsPage = response.data.meta.current_page;
                        this.totalLicsPages = response.data.meta.last_page;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },
            atualizarFiltro(filtroAtual){
                console.log(filtroAtual)
                const filtroExistente = this.filtros.find(filtro => filtro === filtroAtual);

                if (filtroExistente) {
                    // Se o filtro existir, removê-lo do array
                    this.filtros = this.filtros.filter(filtro => filtro !== filtroAtual);
                    console.log('Filtro removido:', filtroAtual);
                } else {
                    // Se o filtro não existir, adicionar ao array
                    this.filtros.push(filtroAtual);
                    console.log('Filtro adicionado:', filtroAtual);
                }
                this.makeRequest();
            },
            pesquisar() {
                this.licsPage = 1;
                this.pesquisa = this.propriedadeDePesquisa+'[like]='+`${this.campoPesquisa}`; 
                this.makeRequest();
            }
        }
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
            <div class="content">
                <div class="tableHeader">
                    <div>
                        <div class="mb-3 searchAndAdd">
                            <button type="button" class="btn btn-success" v-on:click="redirect('licitacoes/nova')">Adicionar</button>
                        </div>
                    </div>
                    <div class="options">
                        <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#filtros" aria-expanded="false" aria-controls="filtros" style="height: 40px;">
                            Filtros
                        </button>
                        <div class="mb-3 searchAndAdd">
                            <form @submit.prevent="pesquisar">
                                <div class="mb-3 pesquisaText">
                                    <input type="text" class="form-control" placeholder="Pesquisar..." v-model="campoPesquisa" required>
                                </div>
                                <span>EM</span>
                                <div class="mb-3">
                                    <select class="form-select" id="propriedadeDePesquisa" v-model="propriedadeDePesquisa" required>
                                        <option selected disabled>Campo a pesquisar</option>
                                        <option value="nuEdital">Edital</option>
                                        <option value="modalidade">Modalidade</option>
                                        <option value="nomeLicitador">Nome do Licitador</option>
                                        <option value="cnpjLicitador">CNPJ do Licitador</option>
                                        <option value="objeto">Objeto</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Pesquisar</button>
                            </form>
                        </div>
                    </div>
                    <div class="collapse" id="filtros">
                        <div class="card card-body">
                            <section>
                                <span>Fase:</span>
                                <div v-for="(fase, index) in ['Em edição','Descartada','Processada']" :key="fase">
                                    <label>
                                        <input
                                        type="checkbox"
                                        @change="atualizarFiltro('nuFase[eq]='+(index-1))"
                                        >
                                        {{ fase }}
                                    </label>
                                </div>
                            </section>
                            <section>
                                <span>Prioridade:</span>
                                <div class="prioridades">
                                    <div v-for="(prioridade, index) in ['1','2','3','4','5']" :key="prioridade" >
                                        <label>
                                            <input
                                            type="checkbox"
                                            @change="atualizarFiltro('prioridade[eq]='+(index-1))"
                                            >
                                            {{ prioridade }}
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <span style="">Data de abertura:</span>
                                <div style="display: flex;">
                                    <div class="mb-3">
                                        <label for="data_abertura" class="form-label">Data inicial</label>
                                        <input type="datetime-local" id="data_abertura" v-model="data_abertura" class="form-control">
                                    </div>
                                    <div class="mb-3" style="margin-left: 10px;">
                                        <label for="data_abertura" class="form-label">Data final</label>
                                        <input type="datetime-local" id="data_abertura" v-model="data_abertura" class="form-control">
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <div class="table">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Fase</th>
                                <th scope="col">Edital</th>
                                <th scope="col">Modalidade</th>
                                <th scope="col">Nome Licitador</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(licitacao, index) in lics" :key="index" v-on:click="redirect('licitacoes/'+ licitacao.id)">
                                    <th scope="row">{{ licitacao.id }}</th>
                                    <td>{{ fase[licitacao.nu_fase+1]}}</td>
                                    <td>{{ licitacao.nu_edital }}</td>
                                    <td>{{ licitacao.modalidade }}</td>
                                    <td>{{ licitacao.nome_licitador }}</td>
    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <ul class="pagination">
                        <li class="page-item" v-on:click="changePage('prev')" v-bind:class="{'disabled':licsPage==1}">
                            <a class="page-link">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">{{this.licsPage}} de {{this.totalLicsPages}}</a></li>
                        <li class="page-item" v-on:click="changePage('next')" v-bind:class="{'disabled':licsPage==totalLicsPages}">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </div>
            </div>
        </PageLayout> 
    </div>
</template>

<style lang="scss">
    div.options {
        display: flex;
        justify-content: space-between;
    }
    div.searchAndAdd {
        display: flex;
        justify-content: end;
        margin-right: 30px;
        margin-bottom: 0px;
        form {
        display: flex;
        flex-direction: row;
        align-items: baseline;
        column-gap: 10px;
        input[type="text"] {
            margin:0px
        }
        pesquisaText {
            width: auto;
        }
        button {
            align-self: auto;
        }
    }
    }
    div.table {
        overflow: auto; 
        height: 500px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
    div#filtros {
        margin-bottom: 10px;
        div.card {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            column-gap: 50px;
            section span {
                font-weight: 700;
            }
        }
    }
    div.prioridades {
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        height: 100px;
        div{
            width: 50px;
        }
        
    }
    ul.pagination {
        display: flex;
        justify-content: flex-end;
        margin-right: 30px;
    }
    tbody tr {
        cursor: pointer;
        &:hover {
            background-color: #b10b0b;
        }
    }
</style>
