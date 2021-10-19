<template>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">タイトル</th>
      <th scope="col">内容</th>

    </tr>
  </thead>
  <tbody>
    <tr v-bind:class="{'table-danger':todo.priority === 'High','table-warning':todo.priority === 'Medium','table-info':todo.priority==='Low'}" v-for="todo in todos" :key="todo.id">
      <th scope="row">{{todo.id}}</th>
      <td>{{ todo.title }}</td>
      <td>{{ todo.content }}</td>
    </tr>
  </tbody>
</table>
</template>
<script>
export default {
    props:['todos'],
}
</script>