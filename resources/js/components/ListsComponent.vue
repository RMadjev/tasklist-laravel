<template>
    <div class="task-list">
        <div class="column">
            <ul v-if="lists.length > 0" class="list">
                <li v-for="(list,index) in lists" class="list-item task-item">
                    <div><a :href="/list/+list.id">{{list.name}}</a></div>
                    <div>
                        <span v-text="'Status: ' + listStatus(list.status)"></span>
                        <a :href="/list/+list.id">Edit</a>
                        <a href="" @click.prevent="deleteList(list.id, index)">Delete</a>
                    </div>
                </li>
            </ul>
            <p v-else>
                No todo lists created
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                lists: []
            }
        },
        created() {
            this.lists = this.$attrs.lists;
        },
        methods: {
            deleteList(listId, index) {
                axios.delete(`/list/${listId}`).then(response => {
                    this.$delete(this.lists, index);
                });
            },
            listStatus(status) {
                return status ? 'Done' : 'In progress';
            }
        }
    }
</script>
