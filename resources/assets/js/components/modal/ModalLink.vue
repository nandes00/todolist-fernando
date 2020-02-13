<template>
    <span>
        <span v-if="task">
            <button v-on:click="fillFormulary()" v-if="!type || (type != 'button') && type != 'link'" type="button" v-bind:class="css || 'btn btn-primary'" data-toggle="modal" v-bind:data-target="'#' + name">{{title}}</button>
            <button v-on:click="fillFormulary()" v-if="type == 'button'" type="button" v-bind:class="css || 'btn btn-primary'" data-toggle="modal" v-bind:data-target="'#' + name">{{title}}</button>
            <a  v-on:click="fillFormulary()" v-if="type == 'link'" href="#" v-bind:class="css || ''" data-toggle="modal" v-bind:data-target="'#' + name">{{title}}</a>
        </span>

        <span v-if="!task">
            <button v-if="!type || (type != 'button') && type != 'link'" type="button" v-bind:class="css || 'btn btn-primary'" data-toggle="modal" v-bind:data-target="'#' + name">{{title}}</button>
            <button v-if="type == 'button'" type="button" v-bind:class="css || 'btn btn-primary'" data-toggle="modal" v-bind:data-target="'#' + name">{{title}}</button>
            <a v-if="type == 'link'" href="#"  v-bind:class="css || ''" data-toggle="modal" v-bind:data-target="'#' + name">{{title}}</a>
        </span>


    </span>

</template>

<script>
    export default {
        props:['type', 'name', 'title', 'css', 'task', 'url'],
        methods:{
            fillFormulary:function () {
                axios.get(this.url + this.task.id).then(res => {
                    // console.log(res.data);
                    this.$store.commit('setTask', res.data);
                });
            }
        }
    }
</script>

<style scoped>

</style>