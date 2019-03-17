<template>
    <div>
        <h2>List</h2>
        <div class="card card-body" v-for="task in tasks" v-bind:key="task.id">
            <h3>{{ task.cat }}</h3>
            <p>{{ task.name }}</p>
            <hr>
            <button class="btn btn-success">Check</button>
        </div>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                tasks: [],
                task: {
                    id: '',
                    cat: '',
                    name: ''
                },
                task_id: '',
                pagination: {},
                edit: false
            }
        },

        created() {
            this.fetchTasks();
        },

        methods: {
            fetchTasks() {
                fetch('api/tasks')
                    .then(res => res.json())
                    .then(res => {
                        this.tasks = res.data;
                    })
            },

            deleteTask(id) {
                if (confirm('Are you sure?')) {
                    fetch(`api/task/${id}`, {
                            method: 'delete'
                        })
                        .then(res => res.json())
                        .then(data => {
                            alert('Task Removed');
                            this.fetchTasks();
                        })
                        .catch(err => console.log(err));
                }
            }
        }
    }

</script>
