<template>
    <div>
        <div class="field">
            <div class="control">
                <label class="label">Rename List:</label>
                <input class="input"
                       v-bind:class="{'is-danger': hasError }"
                       type="text" v-model="list.name">
                <div v-if="hasError">Name must be at least 3 chars.</div>
            </div>
        </div>
        <div class="field is-grouped">
            <div class="control">
                <button @click="save()" class="button is-link">Save</button>
                <a href="/" class="button is-link">Back</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                list: {},
                hasError: false
            }
        },
        created() {
            this.list = this.$attrs.list;
        },
        methods: {
            save() {
                if (this.list.name.length < 3) {
                    this.hasError = true;
                    return;
                }
                axios.patch(`/list/${this.list.id}`, {'name': this.list.name}).then(response => {
                    window.location = '/';
                });
            }
        }
    }
</script>
