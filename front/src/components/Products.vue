<template>
    <div>
        <div class="row">
            <div class="col s6">
                <h5 class="left-align">Produtos</h5>
                <p class="left-align">Tela para gerencias seus Produtos</p>
            </div>
            <div class="col s6 right-align">
                <a class="waves-effect waves-light btn-small blue right-align" @click="show"><i
                        class="material-icons right">add</i>Novo
                    Produto</a>
            </div>
            <div class="col s12">
                <table class="highlight">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="produto of produtos" :key="produto.id">
                        <td>{{produto.name}}</td>
                        <td>{{produto.description}}</td>
                        <td>
                            <button class="waves-effect btn-small blue darken-1" @click="edit(produto)"><i
                                    class="material-icons">create</i>
                            </button>&nbsp;
                            <button class="waves-effect btn-small red darken-1" @click="remove(produto.id)"><i
                                    class="material-icons">delete_sweep</i></button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <modal :height="310" name="produtos-form">
                <div class="row">
                    <div class="col s12">
                        <h5>{{titulo_modal}}</h5>
                    </div>
                </div>
                <div class="row">
                    <form @submit.prevent="save">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="name"v-model="produto.name" type="text" maxlength="150" class="validate" required>
                                <label for="name">Nome do Produto</label>
                            </div>
                            <div class="input-field col s12">
                                <textarea id="desc" v-model="produto.description" class="materialize-textarea validate"
                                          maxlength="255" required="required"></textarea>
                                <label for="desc">Descrição</label>
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
    import Products from '../service/products'

    export default {
        name: "Products",
        data() {
            return {
                produto: {
                    id: "",
                    name: "",
                    description: ""
                },
                produtos: [],
                titulo_modal: "Novo Produto"

            }
        },
        mounted() {
            this.listar()
        },
        methods: {
            listar() {
                Products.list().then(response => {
                    this.produtos = response.data.data
                }).catch(expect => {
                    console.log(expect)
                });
            },
            show() {
                this.$modal.show('produtos-form')
            },
            hide() {
                this.produto = {}
                this.$modal.hide('produtos-form')
            },
            showSweetAlert(mensagem, type, title) {
                this.$swal({
                    type: type,
                    title: title,
                    text: mensagem
                });
            },
            save() {
                if (!this.produto.id) {
                    Products.save(this.produto).then(response => {
                        this.hide()
                        this.showSweetAlert('Produto Cadastrado', 'success', 'Oba')
                        this.listar()
                    }).catch(except => {
                        this.showSweetAlert('Ocorreu um problema ao Cadastrar', 'error', 'Que Pena')
                    })
                } else {
                    Products.update(this.produto).then(response => {
                        this.hide()
                        this.showSweetAlert('Produto Atualizado', 'success', 'Oba')
                        this.listar()
                    }).catch(except => {
                        this.showSweetAlert('Ocorreu um problema ao Atualizar', 'error', 'Que Pena')
                    })
                }

            },
            edit(product) {
                this.titulo_modal = "Editar Produto"
                this.produto = product
                this.show()
            },
            remove(product_id) {
                Products.toRemove(product_id).then(response => {
                    this.showSweetAlert('Produto Removido', 'success', 'Oba')
                    this.listar()
                }).catch(except => {
                    this.showSweetAlert('Ocorreu um problema ao Excluir', 'error', 'Que Pena')
                })
            }
        }
    }
</script>

<style scoped>
</style>