<template>
    <nav>
        <div>
            <img src="https://ibiz.com.br/wp-content/uploads/2017/12/logo-ibiz-preto.png" alt="">
            <!-- <div style="height: 50px;">
                
                <img src="../../../storage/app/public/arrow_drop_down_FILL0_wght400_GRAD0_opsz48.svg" alt="">
            </div> -->
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" id="userButton" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../../../storage/app/public/person_FILL0_wght400_GRAD0_opsz48.svg" alt="">
                </button>
                <ul class="dropdown-menu dropdown-menu-light">
                    <li><a class="dropdown-item" href="#">Minha Conta</a></li>
                    <li><a class="dropdown-item" href="#">Configurações</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<style lang="scss">
    button#userButton {
        background-color: transparent;
        color: rgb(97, 97, 97);
        padding: 3px 10px;
        border: none;
        scale: 1.3;
        &:hover{
            background-color: #0000000f;
        }
    }

    nav{
        background-color: rgba(197, 197, 197, 0.256);
        height: 60px;
        padding: 10px 0px;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.69);
        display: flex;
        flex-direction: column;
        justify-content: center;
        div {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px 40px;
            div{
                img {
                width: 30px;
                }   
            }
            img {
                width: 70px;
            }
        }
        p{
            color: rgb(97, 97, 97);
        }
    }

</style>