<template>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">タイトル</th>
        <th scope="col">内容</th>
        <th style="width: 5%"></th>
        <th style="width: 5%"></th>
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
          <button class="btn btn-primary" @click="done(todo.id)"><i class="fas fa-check-circle"></i></button>
        </td>
        <td>
          <button class="btn btn-danger" @click="todo_del(todo.id)">
           <i class="fas fa-trash-alt"></i>
          </button>
        </td>
      </tr>
    </tbody>
  </table>
</template>
<script>
import axios from "axios";
import { defineComponent } from "vue";
import { createToast } from "mosha-vue-toastify";
import "mosha-vue-toastify/dist/style.css";
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
    todo_del: function (todo_id) {
      axios.defaults.headers.common = {
        "X-Requested-With": "XMLHttpRequest",
        "X-CSRF-TOKEN": this.csrf,
      };
      axios
        .delete("/delete", {
          data: { id: todo_id },
        })
        .then(function (response) {
          createToast(
            {
              title: "通知",
              description: "削除しました",
            },
            {
              position: "top-right",
              type: "success",
              showIcon: "true",
              timeout: 3000,
            }
          );
          setTimeout(() => {
            window.location.href = "/";
          }, 3000);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>