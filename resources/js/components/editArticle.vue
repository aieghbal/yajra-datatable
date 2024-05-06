<template>
    <form method="post" @mouseenter="getParentData" @submit.prevent="submitForm">
        <input type="hidden" name="_token" v-bind:value="csrf">
        <div class="row">
            <label for="title" class="col-form-label" >Title:</label>
            <input type="text" id="titleTab" name="title" v-model="title">
        </div>
        <div class="row">
            <label for="description" class="col-form-label">Description:</label>
            <input type="text" name="description" id="descriptionTab" v-model="description">
        </div>
        <div class="row">
            <label for="category" class="col-form-label">Category:</label>
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
            <label for="tagEdit" class="col-form-label">Tag:</label>
            <Multiselect
                v-model="tags"
                :options="optionsTag"
                :multiple="true"
                :taggable="true"
                @tag="addTag"
                label="title"
                track-by="id"
                :limit="3">
                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
            </Multiselect>
        </div>
        <div class="row">
            <label for="isActive">Is Active</label>
            <select v-model="isActive" id="isActiveTab" name="isActive" style="width: 100%">
                <option value="0">no</option>
                <option value="1">yes</option>
            </select>
        </div>

        <input type="hidden" name="id" id="tab_article_vue_id" v-model="id">
        <input type="hidden" name="categoryHidden" id="categoryHidden">
        <button type="submit">Submit</button>
    </form>
</template>

<script>

import axios from 'axios';
import Multiselect from "vue-multiselect";
export default {
    components: {
        Multiselect
    },
    data() {
        return {
            id: '',
            title: '',
            description: '',
            category: '',
            categoryHidden: '',
            isActive: '',
            categories: null,
            tags: null,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            optionsCategory: ['1'],
            optionsTag: ['1']
        };
    },
    mounted() {
        this.fetchCategoryOptions(),
            this.fetchTagOptions()
    },
    methods: {
        submitForm() {
            var id = this.id;
            var title = this.title;
            var description = this.description;
            var categories = this.categories;
            var tags = this.tags;
            var isActive = this.isActive;
            this.$emit('form-edit-submitted', {
                id: id,
                categories: categories,
                tags: tags,
                isActive: isActive,
                title: title,
                description: description,
            });
            this.title = '';
            this.description = '';
            this.categories = '';
            this.tags = '';
            this.isActive = '';
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
                    this.optionsTag = response.data;
                })
                .catch(error => {
                    console.error(error)
                })
        },
        getParentData(){
            this.id = this.$parent.articleId;
            const postData = {
                id: this.id,
            };

            const headers = {
                'Content-Type': 'application/json',
            };

            axios.post('/getArticleData', postData, { headers })
                .then((response) => {
                    const tags = response.data.tag;console.log(tags);
                    this.title = response.data.title;
                    this.description = response.data.description;
                    this.isActive = response.data.isActive;
                    this.categories =  { id: response.data.category, title:response.data.categoryTitle};
                    //this.tags =  tags;
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }
    }
}

</script>
