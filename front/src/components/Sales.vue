<template>
    <div>
        <div class="row">
            <div class="col s6">
                <h5 class="left-align">Vendas</h5>
                <p class="left-align">Tela para realizar suas vendas</p>
            </div>
            <div class="col s6 right-align">
                <a class="waves-effect waves-light btn-small blue right-align" @click="show"><i
                        class="material-icons right">add</i>Nova
                    Venda</a>
            </div>
            <div class="col s12">

                <ul class="collapsible">
                    <li v-for="produto of produtos" :key="produto.id">
                        <div class="collapsible-header">{{produto.name}}</div>
                        <div class="collapsible-body">
                            <table class="highlight">
                                <thead>
                                    <tr>
                                        <th>Produto</th>
                                        <th>Qtd</th>
                                        <th>Valor Unitário</th>
                                        <th>SubTotal</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="prod of produto.pivot" :key="prod.id">
                                        <td>{{prod.name}}</td>
                                        <td>{{prod.pivot.quantity}}</td>
                                        <td>{{formatPrice(prod.pivot.unit_price)}}</td>
                                        <td>{{formatPrice((prod.pivot.quantity * prod.pivot.unit_price))}}</td>
                                        <td>
                                            <button class="waves-effect btn-small red darken-1" @click="remove(produto.id,prod.id)"><i
                                                    class="material-icons">delete_sweep</i></button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{formatPrice(produto.total)}}</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </li>

                </ul>
            </div>
            <modal :height="310" :width="730" name="vendas-form">
                <div class="row">
                    <div class="col s12">
                        <h5>{{titulo_modal}}</h5>
                        {{venda}}
                    </div>
                </div>
                <div class="row">
                    <form @submit.prevent="save">
                        <div class="row">
                            <div class="input-field col s6">
                                <label class="custom-label">Cliente</label>
                                <Select2 id="client_id" v-model="venda.client_id" :options="clients" required/>
                            </div>
                            <div class="input-field col s6">
                                <label class="custom-label" for="product_id">Produto</label>
                                <Select2 id="product_id" v-model="venda.product_id" :options="produtos_drop" required/>
                            </div>
                            <div class="input-field col s3">
                                <input id="quantity" v-model="venda.quantity" type="number" required>
                                <label for="quantity">Quantidade</label>
                            </div>
                            <div class="input-field col s3">
                                <money id="unit_price" v-model="venda.unit_price" v-bind="money"></money>
                                <label for="unit_price">Valor</label>
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
    import Sales from "../service/sales";
    import Clients from "../service/clients";
    import Products from "../service/products";
    import {Money} from 'v-money'

    export default {
        components: {Money},
        data() {
            return {
                produtos: [],
                produtos_drop: [],
                clients: [],
                titulo_modal: "Nova Venda",
                venda: {
                    client_id: "",
                    product_id: "",
                    quantity: "",
                    unit_price: ""
                },
                money: {
                    decimal: ',',
                    thousands: '.',
                    prefix: 'R$ ',
                    precision: 2,
                    masked: false
                }
            };
        },
        mounted() {
            this.listar()
            this.getClients()
            this.getProducts()
        },
        methods: {
            listar() {
                Sales.list()
                    .then(response => {
                        this.produtos = [...response.data.data];
                    })
                    .catch(error => {
                        console.log("Erro ", error);
                    });
            },
            formatPrice(value) {

                return parseFloat(value).toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'});
            },
            getClients() {
                Clients.list().then(response => {

                    response.data.data.map(e => {

                        this.clients.push({id: e.id, text: e.name})
                    })

                })
            },
            getProducts() {
                Products.list().then(response => {

                    response.data.data.map(e => {

                        this.produtos_drop.push({id: e.id, text: e.name})
                    })

                })
            },
            show() {
                this.$modal.show('vendas-form')
            },
            hide() {
                this.venda = {}
                this.$modal.hide('vendas-form')
            },
            showSweetAlert(mensagem, type, title) {
                this.$swal({
                    type: type,
                    title: title,
                    text: mensagem
                });
            },
            save() {
                if (!this.venda.id) {
                    Sales.save(this.venda).then(response => {
                        this.hide()
                        this.showSweetAlert('Venda Cadastrada', 'success', 'Oba')
                        this.listar()
                    }).catch(except => {
                        this.showSweetAlert('Ocorreu um problema ao Cadastrar', 'error', 'Que Pena')
                    })
                } else {
                    Sales.update(this.venda).then(response => {
                        this.hide()
                        this.showSweetAlert('Venda Atualizada', 'success', 'Oba')
                        this.listar()
                    }).catch(except => {
                        this.showSweetAlert('Ocorreu um problema ao Atualizar', 'error', 'Que Pena')
                    })
                }

            },
            edit(dados,venda) {

                this.titulo_modal = "Editar Venda"
                this.venda = {
                    client_id: dados.id,
                    product_id: venda.id,
                    quantity: venda.pivot.quantity,
                    unit_price: venda.pivot.unit_price
                }
                console.log(this.venda)
                this.show()
            },
            remove(client_id, product_id) {
                Sales.toRemove(client_id, product_id).then(response => {
                    this.showSweetAlert('Venda Removida', 'success', 'Oba')
                    this.listar()
                }).catch(except => {
                    this.showSweetAlert('Ocorreu um problema ao Excluir', 'error', 'Que Pena')
                })
            }
        }
    };
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style>
    select + .select2-container {
        width: 100% !important;
    }

    .select2-container--default .select2-search--dropdown .select2-search__field {
        height: 24px;
    }

</style>
<style scoped>
    .custom-label {
        margin-top: -39px;
        color: #26a69a;
    }

</style>
