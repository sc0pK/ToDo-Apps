<template>
  <div class="form-container container" id="app">
    <form method="post" action="/create">
      <div class="form-group">
        <label for="titleLabel">タイトル</label>
        <div class="form-row">
          <div class="col">
            <input
              v-model="form.title"
              type="text"
              class="form-control"
              placeholder="タイトル"
              name="title"
            />
            <small
              v-show="!validation.title "
              class="form-text text-info"
              >{{ errorMessage.title }}</small
            >
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="contentLabel">内容</label>
        <div class="form-row">
          <div class="col">
            <textarea
              v-model="form.content"
              type="text"
              class="form-control"
              placeholder="内容"
              name="content"
            />
            <small
              v-show="!validation.content "
              class="form-text text-info"
              >{{ errorMessage.content }}</small
            >
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="priorityLabel">優先順位</label>
        <div class="form-row">
          <div class="col">
            <select v-model="form.priority" name="priority">
              <option disabled value="">選択してください</option>
              <option>High</option>
              <option>Medium</option>
              <option>Low</option>
            </select>
            <small
              v-show="!validation.priority "
              class="form-text text-info"
              >{{ errorMessage.priority }}</small
            >
          </div>
        </div>
      </div>
      <div class="btn-container">
        <button
          type="submit"
          v-bind:disabled="!isValid"
          class="btn btn-primary"
        >
          送信
        </button>
      </div>
      <input type="hidden" name="_token" v-bind:value="csrf">
    </form>
  </div>
</template>

<script>
export default {
  props:['csrf'],
  data() {
    return {
      form: {
        title: "",
        content: "",
        priority:"",
      },
      errorMessage: {
        title: "タイトルを入力してください",
        content: "内容を入力してください",
        priority:"優先順位を選択してください"
      },
    };
  },

  computed: {
    validation() {
      const form = this.form;
      return {
        title: !!form.title,
        content: !!form.content,
        priority: !!form.priority,
      };
    },
    isValid() {
      var validation = this.validation;
      return Object.keys(validation).every(function (key) {
        return validation[key];
      });
    },
  },
};
</script>
