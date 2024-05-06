<template>
    <div>
        <label class="typo__label">Category</label>
        <multiselect v-model="categories" :options="options" :preserve-search="true" placeholder="Pick some" label="title" track-by="id" :preselect-first="true">
            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
        </multiselect>
    </div>
</template>

<script>
import Multiselect from 'vue-multiselect'
import axios from 'axios';
export default {
    components: {
        Multiselect
    },
    data () {
        return {
            categories: null,
            selected: null,
            options: [
                { title: 'ورزشی', id: '1' },
                { title: 'سیاسی', id: '2' },
                { title: 'هنر', id: '3' }
            ]
        }
    },
    methods: {

    }
}
</script>

