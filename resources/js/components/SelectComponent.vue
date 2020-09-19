<template>
<div class="form-group">
    <label>言語複数選択</label>
    <v-select
        multiple
        taggable
        :options="options"
        v-model="selected"
    >
    </v-select>
    <input type="hidden" multiple v-model="selected" name="technologies">
</div>
</template>

<script>
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
Vue.component('v-select', vSelect)

    export default {
        mounted() {
            this.options = this.technologies;
            this.selected = this.selected;
        },
        props: ['technologies', 'selected'],
        data() {
            return {
                selected: null,
                options: []
            }
        }
    }
</script>
