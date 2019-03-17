<template>
    <div>
        <h2>Manage</h2>

        <form @submit.prevent="addTask" class="mb-3">
            <div class="form-group">

                <select name="category" v-model="task.cat">
                    <option value="Frozen">Frozen</option>
                    <option value="Bread">Bread</option>
                    <option value="Drinks">Drinks</option>
                </select>

                <input type="text" class="form-control" placeholder="Add Item" v-model="task.name">

                <button type="submit" class="btn btn-light btn-block">Toevoegen</button>

            </div>
        </form>

        <div class="card card-body" v-for="task in tasks" v-bind:key="task.id">
            <h3>{{ task.cat }}</h3>
            <p>{{ task.name }}</p>
            <hr>
            <button @click="editTask(task)" class="btn btn-warning mb-2">Edit</button>
            <button @click="deleteTask(task.id)" class="btn btn-danger">Delete</button>
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
                            alert('Item Removed');
                            this.fetchTasks();
                        })
                        .catch(err => console.log(err));
                }
            },
            
            addTask(){
                if(this.edit === false){
                    //Add
                    fetch('api/task',{
                        method: 'post',
                        body: JSON.stringify(this.task),
                        headers:{
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.task.cat = '';
                        this.task.name = '';
                        alert('Item added');
                        this.fetchTasks();
                    })
                    .catch(err => console.log(err));
                } else {
                   fetch('api/task',{
                        method: 'put',
                        body: JSON.stringify(this.task),
                        headers:{
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.task.cat = '';
                        this.task.name = '';
                        alert('Item updated');
                        this.fetchTasks();
                    })
                    .catch(err => console.log(err));
                }
            },
            
            editTask(task){
                this.edit = true;
                this.task.id = task.id;
                this.task.task_id = task.id;
                this.task.cat = task.cat;
                this.task.name = task.name;
            }
        }
    }

</script>
