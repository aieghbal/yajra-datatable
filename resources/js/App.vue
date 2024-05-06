<script>
import axios from "axios";
import { watch } from 'vue';
import "jquery/dist/jquery.min.js";
import "bootstrap/dist/css/bootstrap.min.css";
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import $ from "jquery";

export default {
    props: ['edited'],
    data() {
        return {
            id: '',
            articleData : [],
            edited : this.edited
        }
    },
    mounted() {
        this.getData()
    },

    watch: {
        edited(newValue){
            alert(newValue);
        }
    },
    methods:{
        confirmation(id){
            this.$emit('articleIdSubmit',id)
        },
        parent(){
            this.getData();
        },
        getData(){
            fetch("/article/data")
                .then((response) => response.json())
                .then((data) => {
                    this.articleData = data.data;
                    setTimeout(() => {
                        $("#example").DataTable({
                            lengthMenu: [
                                [5,10, 25, 50, -1],
                                [5,10, 25, 50, "All"],
                            ],
                            pageLength: 5,
                            destroy: true,
                            retrieve: true,
                        });
                    });
                });
        }
    }
}

</script>

<template><button @click="getData" style="display: none">reload</button>
    <table id="example" class="display table table-striped" style="width:100%">
        <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="data in articleData">
            <td>{{ data.id }}</td>
            <td>{{ data.title }}</td>
            <td>{{ data.description }}</td>
            <td>
                <button :data-id="data.id" @click="confirmation(data.id)" onclick="editFunction(this);" class="btn btn-sm btn-success "><i class="fa-solid fa-pen-to-square"></i></button>
                <button :data-id="data.id"  onclick="jqueryConfirm(this);" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
            </td>
        </tr>
        </tbody>
    </table>
    <style>
        @import 'datatables.net-dt';
    </style>
</template>

