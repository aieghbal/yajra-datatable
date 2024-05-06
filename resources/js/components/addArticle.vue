<template>
    <form @submit.prevent="validationForm">
        <input type="hidden" name="_token" v-bind:value="csrf">
        <div class="row">
            <p class="alert alert-danger alert-dismissible fade show" style="display: none">{{ titleMessage }}</p>
            <label for="title" class="col-form-label">Title:</label>
            <input type="text" name="title" id="title"  v-model="title">
        </div>
        <div class="row">
            <label for="description" class="col-form-label">Description:</label>
            <input type="text" name="description" id="description"  v-model="description">
            <p v-if="errors.length">
                <b>Please correct the following error(s):</b>
                <ul>
                    <li v-for="error in errors">{{ error }}</li>
                </ul>
            </p>
        </div>
        <div class="row">
            <label class="typo__label">Category</label>
            <multiselect
                v-model="categories"
                :options="optionsCategory"
                :loading="isLoading"
                label="title"
                track-by="id"
                :limit="3">
            </multiselect>
        </div>
        <div class="row">
            <div>
                <label class="typo__label">Tag</label>
                <Multiselect
                    v-model="tags"
                    :options="optionsTag"
                    :multiple="true"
                    label="title"
                    track-by="id"
                    :limit="3">
                    <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                </Multiselect>
            </div>
        </div>
        <div class="row">
            <lable for="isActive">Is Active</lable>
            <select id="isActive" class="isActive" name="isActive" v-model="isActive" style="width: 100%">
                <option value="0">no</option>
                <option value="1">yes</option>
            </select>
        </div>


        <button type="submit">Submit</button>
    </form>
</template>

<script>

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
import axios from 'axios';
import Multiselect from 'vue-multiselect'
import { inject } from 'vue'

export default {
    components: {

        Multiselect
    },
    data() {
        return {
            errors:[],
            title: '',
            description: '',
            category: '',
            isActive: '',
            titleMessage: '',
            categories: null,
            tags: [],
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            selected: null,
            optionsCategory: ['1'],
            optionsTag: [
                { title: 'طوفان الاقصی', id: '1' },
                { title: 'تیم ملی', id: '2' },
                { title: 'رضا عطاران', id: '3' }
            ]
        }
    },
    watch: {
        title: {
            handler: function(val) {

                if (this.title.length >= 20){
                    this.titleMessage = 'title should not more than 20';
                    $('p').show();
                }
                if (this.title.length <= 20){
                    $('p').hide();
                }
            },
            immediate: true
        }
    },
    mounted() {
        this.fetchCategoryOptions(),
        this.fetchTagOptions()

    },
    methods: {
        validationForm:function(e){
            this.errors = [];
            if(!this.description) this.errors.push("Description required.");
            if(this.description.length >= 15) this.errors.push("Description should not more than 15.");
            e.preventDefault();

            if (this.errors.length === 0){
                this.submitForm();
            }
        },
        submitForm:function(e){
            var id = $('#article_id').val();
            var title = this.title;
            var description = this.description;
            var categories = this.categories;
            var tags = this.tags;
            var isActive = $('#isActive').val();
            this.$emit('form-add-submitted', {
                id: id,
                categories: categories,
                tags: tags,
                isActive: isActive,
                title: title,
                description: description,
            });
            e.preventDefault();
        },
        fetchCategoryOptions() {
            axios.get('/article/categories')
                .then(response => {
                    this.optionsCategory = response.data;
                })
                .catch(error => {
                    console.error(error)
                })
        },
        fetchTagOptions() {
            axios.get('/article/tags')
                .then(response => {
                    this.optionsCategory = response.data;
                })
                .catch(error => {
                    console.error(error)
                })
        }
    }
}
</script>
