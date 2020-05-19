<template>
    <div class="tasks-table">
        <div class="field has-addons">
            <div class="control">
                <input class="input" type="text" v-model="description" placeholder="Task name">
            </div>
            <div class="control">
                <a @click="addTask()" class="button is-info">
                    Add task
                </a>
            </div>
        </div>

        <div>
            <table class="table">
                <thead>
                <tr>
                    <th><abbr title="Task Name">Name</abbr></th>
                    <th><abbr title="Deadline">Deadline</abbr></th>
                    <th>Status</th>
                    <th>Disabled</th>
                </tr>
                </thead>
                <tbody v-if="tasks.length > 0">
                <tr v-for="task in tasks">
                    <td v-text="task.description"></td>
                    <td><input
                        @change="setDeadline(task, $event)"
                        :disabled="task.disabled === 1 || isTaskExpired(task)"
                        :value="getDeadline(task.deadline)"
                        placeholder="Type Date" type="date"></td>
                    <td>
                        <input
                            @click="setStatus(task, $event)"
                            :disabled="task.disabled === 1 || isTaskExpired(task)"
                            :checked="task.status === 1"
                            type="checkbox">
                        <span v-text="task.status ? 'Done': 'In progress'"></span>
                    </td>
                    <td>
                        <input
                            @click="setDisabled(task, $event)"
                            :checked="task.disabled === 1"
                            type="checkbox">
                        <span v-text="task.disabled ? 'Disabled': 'Enabled'"></span>
                    </td>
                </tr>
                </tbody>
                <tbody v-else>
                <tr>
                    <td>No tasks</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                tasks: [],
                list_id: null,
                description: ''
            }
        },

        created() {
            this.tasks = this.$attrs.tasks;
            this.list_id = this.$attrs.id;
        },
        methods: {
            addTask() {
                axios.post(`/list/${this.list_id}/task`, {'description': this.description}).then(result => {
                    this.tasks.push({'description': this.description});
                });
            },
            getDeadline(utcDate) {
                return utcDate ? utcDate.split(' ')[0] : '';
            },
            isTaskExpired(task) {
                let deadline = this.getDeadline(task.deadline);
                if (deadline) {
                    let now = new Date();
                    let deadlineDate = new Date(deadline);
                    return now.getTime() > deadlineDate.getTime()
                }
                return false;
            },
            setDisabled(task, ev) {
                let disabled = ev.target.checked;
                axios.patch(`/task/${task.id}`, {'property': 'disabled', 'value': disabled}).then(result => {
                    task.disabled = disabled ? 1 : 0;
                }).catch(error => {
                    alert(error.message);
                });
            },
            setStatus(task, ev) {
                let status = ev.target.checked;
                axios.patch(`/task/${task.id}`, {'property': 'status', 'value': status}).then(result => {
                    task.status = status;
                }).catch(error => {
                    alert(error.message);
                });
            },
            setDeadline(task, ev) {
                axios.patch(`/task/${task.id}`, {'property': 'deadline', 'value': ev.target.value}).then(result => {
                    task.deadline = ev.target.value;
                }).catch(error => {
                    alert(error.message);
                });
            }
        }
    }
</script>


<style>
    .tasks-table {
        flex: 1;
        padding-right: 20px;
    }
</style>
