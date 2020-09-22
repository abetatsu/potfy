<template>
<div class="form-group">
    <label>使用した技術（複数選択可能）</label>
    <v-select
        multiple
        taggable
        :options="options"
        v-model="selected"
        placeholder="使用した技術を選択、もしくは入力してください"
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
            if (this.oldTechnologies) {
                const oldValueArray = this.oldTechnologies.split(',');
                this.selected = oldValueArray;
            } else {
                this.selected = this.selectedTechs;
            }
        },
        props: ['technologies', 'selectedTechs', 'oldTechnologies'],
        data() {
            return {
                selected: null,
                options: []
            }
        }
    }
</script>
