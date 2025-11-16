<template>
    <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">
            Todo List (Vue Component)
        </h2>
        
        <div class="mb-4 flex gap-2">
            <input 
                v-model="newTodo"
                @keyup.enter="addTodo"
                type="text"
                placeholder="Add a new todo..."
                class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white"
            />
            <button 
                @click="addTodo"
                class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors"
            >
                Add
            </button>
        </div>

        <ul class="space-y-2">
            <li 
                v-for="(todo, index) in todos"
                :key="index"
                class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg"
            >
                <span 
                    :class="{'line-through text-gray-400': todo.completed}"
                    class="flex-1 text-gray-800 dark:text-white"
                >
                    {{ todo.text }}
                </span>
                <div class="flex gap-2">
                    <button 
                        @click="toggleTodo(index)"
                        class="px-3 py-1 text-sm rounded"
                        :class="todo.completed ? 'bg-green-500 text-white' : 'bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-white'"
                    >
                        {{ todo.completed ? 'Done' : 'Complete' }}
                    </button>
                    <button 
                        @click="removeTodo(index)"
                        class="px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600 transition-colors"
                    >
                        Delete
                    </button>
                </div>
            </li>
        </ul>

        <p v-if="todos.length === 0" class="text-gray-500 dark:text-gray-400 text-center py-4">
            No todos yet. Add one above!
        </p>
    </div>
</template>

<script>
export default {
    name: 'TodoListComponent',
    data() {
        return {
            newTodo: '',
            todos: [
                { text: 'Learn Vue.js with Laravel', completed: false },
                { text: 'Build amazing applications', completed: false }
            ]
        }
    },
    methods: {
        addTodo() {
            if (this.newTodo.trim()) {
                this.todos.push({
                    text: this.newTodo.trim(),
                    completed: false
                });
                this.newTodo = '';
            }
        },
        toggleTodo(index) {
            this.todos[index].completed = !this.todos[index].completed;
        },
        removeTodo(index) {
            this.todos.splice(index, 1);
        }
    }
}
</script>

