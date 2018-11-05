<template>
    <div>
        <div class="row">
            <div class="col s6">
                <h5 class="left-align">Clientes</h5>
                <p class="left-align">Tela para gerencias seus Clientes</p>
            </div>
            <div class="col s6 right-align">
                <a class="waves-effect waves-light btn-small blue right-align" @click="show"><i class="material-icons right" >add</i>Novo
                    Cliente</a>
            </div>
            <div class="col s12">
                <table class="highlight">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Endereço</th>
                        <th>Cep</th>
                        <th>Cidade</th>
                        <th>Uf</th>
                        <th>Bairro</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="cliente of clients" :key="cliente.id">
                        <td>{{cliente.name}}</td>
                        <td>{{cliente.email}}</td>
                        <td>{{cliente.address}}</td>
                        <td>{{cliente.cep}}</td>
                        <td>{{cliente.city}}</td>
                        <td>{{cliente.state}}</td>
                        <td>{{cliente.neighborhood}}</td>
                        <td>
                            <button class="waves-effect btn-small blue darken-1" @click="edit(cliente)"><i
                                    class="material-icons">create</i>
                            </button>&nbsp;
                            <button class="waves-effect btn-small red darken-1" @click="remove(cliente.id)"><i
                                    class="material-icons">delete_sweep</i></button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <modal :height="508" :width="770" name="client-form">
                <div class="row">
                    <div class="col s12">
                        <h5>{{titulo_modal}}</h5>
                    </div>
                </div>
                <div class="row">

                    <form @submit.prevent="save">
                        <div class="row">
                            <div class="col s12">
                                <div class="input-field col s12">
                                    <input id="name"v-model="cliente.name" type="text" maxlength="150" class="validate" required>
                                    <label for="name">Nome do Cliente</label>
                                </div>
                            </div>
                            <div class="col s12">
                                <div class="input-field col s12">
                                    <input id="email"v-model="cliente.email" type="email" maxlength="100" class="validate" required>
                                    <label for="email">E-mail do Cliente</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s3">
                                <div class="input-field col s12">
                                   <!-- <input id="cep" v-model="cliente.cep" @blur="consultaCep(cliente.cep)" type="text" maxlength="12" class="validate" required>-->
                                    <the-mask id="cep" :mask="['#####-###']" @blur.native="consultaCep" v-model="cliente.cep" class="validate" />
                                    <label for="cep">Cep</label>
                                </div>
                            </div>
                            <div class="col s5">
                                <div class="input-field col s12">
                                    <input id="address" v-model="cliente.address"  type="text" maxlength="12" class="validate" required>
                                    <label for="address">Endereço</label>
                                </div>
                            </div>
                            <div class="col s3">
                                <div class="input-field col s12">
                                    <input id="neighborhood" v-model="cliente.neighborhood"  type="text" maxlength="12" class="validate" required>
                                    <label for="neighborhood">Bairro</label>
                                </div>
                            </div>
                            <div class="col s3">
                                <div class="input-field col s12">
                                    <input id="city" v-model="cliente.city"  type="text" maxlength="12" class="validate" required>
                                    <label for="city">Cidade</label>
                                </div>
                            </div>
                            <div class="col s2">
                                <div class="input-field col s12">
                                    <input id="state" v-model="cliente.state"  type="text" maxlength="12" class="validate" required>
                                    <label for="state">UF</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s6 left">
                                <button class="btn waves-effect waves-light orange" @click="hide()">Cancelar
                                    <i class="material-icons right">close</i>
                                </button>
                            </div>
                            <div class="col s6 right-align">
                                <button class="btn waves-effect waves-light blue" type="submit" name="action">Salvar
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </modal>
        </div>
    </div>
</template>

<script>
    import Clients from "../service/clients";
    import axios from 'axios'
    export default {
        name: "Clients",
        data() {
            return {
                titulo_modal: 'Novo Cliente',
                clients: [],
                cliente: {
                    id:'',
                    name:'',
                    email:'',
                    cep:'',
                    city:'',
                    state:'',
                    neighborhood:'',
                    address:''
                }
            };
        },
        mounted() {
            this.listar();
        },
        methods: {

            listar() {
                Clients.list()
                    .then(response => {
                        this.clients = [...response.data.data];

                    })
                    .catch(error => {
                        console.log("Erro ", error);
                    });
            },
            save() {
                if (!this.cliente.id) {
                    Clients.save(this.cliente).then(response => {
                        this.hide()
                        this.showSweetAlert('Cliente Cadastrado', 'success', 'Oba')
                        this.listar()

                    }).catch(except => {
                        let responseError = except.response;

                        if(responseError.status == 422)
                        {
                            console.log(this.errors)
                        }
                        this.showSweetAlert('Ocorreu um problema ao Cadastrar', 'error', 'Que Pena')
                    })
                } else {
                    Clients.update(this.cliente).then(response => {
                        this.hide()
                        this.showSweetAlert('Cliente Atualizado', 'success', 'Oba')
                        this.listar()
                    }).catch(except => {
                        console.log(except)
                        this.showSweetAlert('Ocorreu um problema ao Atualizar', 'error', 'Que Pena')
                    })
                }

            },
            edit(cliente) {
                this.titulo_modal = "Editar Cliente"
                this.cliente = cliente
                this.show()
            },
            remove(cliente_id) {
                Clients.toRemove(cliente_id).then(response => {
                    this.showSweetAlert('Cliente Removido', 'success', 'Oba')
                    this.listar()
                }).catch(except => {
                    this.showSweetAlert('Ocorreu um problema ao Excluir', 'error', 'Que Pena')
                })
            },
            show() {
                this.$modal.show('client-form')
            },
            hide() {
                this.cliente = {}
                this.$modal.hide('client-form')
            },
            showSweetAlert(mensagem, type, title) {
                this.$swal({
                    type: type,
                    title: title,
                    text: mensagem
                });
            },
            consultaCep() {

                axios.get('https://viacep.com.br/ws/'+this.cliente.cep+'/json/').then(response=>{

                    this.cliente.address = response.data.logradouro
                    this.cliente.neighborhood = response.data.bairro
                    this.cliente.city = response.data.localidade
                    this.cliente.state = response.data.uf

                }).catch(except => {
                    console.log(except);
                })
            }
        }
    }
</script>

<style scoped>

</style>