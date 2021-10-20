<template>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">タイトル</th>
        <th scope="col">内容</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-bind:class="{
          'table-danger': todo.priority === 'High',
          'table-warning': todo.priority === 'Medium',
          'table-info': todo.priority === 'Low',
        }"
        v-for="todo in todos"
        :key="todo.id"
      >
        <th scope="row">{{ todo.id }}</th>
        <td>{{ todo.title }}</td>
        <td>{{ todo.content }}</td>
        <td>
          <button class="btn btn-primary" @click="done(todo.id)">DONE</button>
        </td>
        <td><button class="btn btn-danger">DELETE</button></td>
      </tr>
    </tbody>
  </table>
</template>
<script>
import axios from "axios";
export default {
  props: { todos: Array, csrf: Object },
  methods: {
    done: function (todo_id) {
      let params = {
        id: todo_id,
      };
      axios.defaults.headers.common = {
        "X-Requested-With": "XMLHttpRequest",
        "X-CSRF-TOKEN": this.csrf,
      };
      axios
        .post("/done", params)
        .then(function (response) {
          window.location.href = "/";
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>