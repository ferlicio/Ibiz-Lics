<template>
    <!-- <div class="sideBarButton">
        
    </div> -->
    <div class="sidebar">
        <div class="sidebarContent">
            <div class="sidebarItem" v-on:click="redirect()">
                <img src="../../../storage/app/public/dashboard_FILL0_wght400_GRAD0_opsz48.svg" alt="">
                <p>Dashboard</p>
            </div>
            <div class="sidebarItem" v-on:click="redirect('licitacoes')">
                <img src="../../../storage/app/public/description_FILL0_wght400_GRAD0_opsz48.svg" alt="">
                <p>Licitações</p>
            </div>
        </div>
        <div class="sidebarFooter" v-on:click="redirect()">
            <div class="sidebarItem">
                <p>Configurações</p>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
    div.sidebar {
        background-color: #a9d1f8;
        width: 270px;
        box-shadow: 2px 0px 2px 0px rgba(0, 0, 0, 0.305);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: calc(100vh - 60px);
        div.sidebarItem {
            display: flex;
            padding: 10px 20px;
            box-shadow: 0px 2px 0px 0px rgba(0, 0, 0, 0.152);
            height: 55px;
            cursor: pointer;
            img {
                width: 30px;
                margin-right: 10px;
            }
            p {
                color: rgb(0, 0, 0);
                font-size: 20px;
            }
            &:hover{
                background-color: #0000000f;
            }
        }
        div.sidebarFooter {
            display: flex;
            align-items: center;
            box-shadow: 0px 2px 0px 0px rgba(0, 0, 0, 0.152);
            div.sidebarItem {
                justify-content: center;
                height: 70px;
                width: 100%;
            }
            p {
                color: rgb(0, 0, 0);
                font-size: 20px;
            }
        }
    }
</style>

<script>
    export default {
        name: "Sidebar",
        methods: {
            redirect(path) {
                path = path 
                    ?path 
                    :'';
                window.location.href = `${import.meta.env.VITE_APP_URL}/${path}`;
            },
        }
    }
</script>
