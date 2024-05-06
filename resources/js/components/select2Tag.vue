<template>
    <div>
        <label class="typo__label">Tag</label>
        <multiselect name="tags[]" :multiple="true" v-model="tags" :options="options" :preserve-search="true" placeholder="Pick some" label="title" track-by="id" :preselect-first="true">
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
            tags: [],
            selectedValues: [],
            options: [
                { title: 'طوفان الاقصی', id: '1' },
                { title: 'تیم ملی', id: '2' },
                { title: 'رضا عطاران', id: '3' }
            ]
        }
    }
}
</script>

