<template>
  <div class="row">
     <div class="d-flex justify-content-center bd-highlight my-3">
      <select v-model="selected" @change="onChange($event)">
        <option v-for="option in options" v-bind:value="option.value">
          {{ option.text }}
        </option>
      </select>
      <button v-on:click="post" :disabled='isButtonDisabled' class="btn ms-1" type="button" :class="btnTheme" enabled>
        <span v-html="buttonInner"></span>
      </button>
     </div>
  </div>
</template>

<script>
import Axios from 'axios';
export default {
  data() {
    return {
      selected: '-1',
      isButtonDisabled: true,
      btnTheme: 'btn-light',
      buttonInner: 'Создать',
      options: [
        { text: 'Сделка',   value: '1' },
        { text: 'Контакт',  value: '2' },
        { text: 'Компания', value: '3' },
      ]
    };
  },
  methods: {
    onChange(event) {
      this.isButtonDisabled = false
      this.btnTheme = 'btn-primary'
      let entId = event.target.value
      this.$store.commit('setEntId', entId)
      this.$store.commit('setEntName', event.target.options[entId-1].text)
    },
    post(event) {
      this.isButtonDisabled = true
      this.buttonInner = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>\
                          <span class="sr-only"></span>'
      let axiosConfig = {
        headers : {
            'Content-Type': 'application/json',
          }
      }
      let postData = {
            id: this.selected,
          };
      Axios
        .post('http://localhost:8080/v1/create', postData, axiosConfig)
        .then(response => {
          this.$store.commit('appendTextResult', response.data);
          this.isButtonDisabled = false
          this.buttonInner = 'Создать'
        })
        .catch(error => {
          console.log(error);
          this.isButtonDisabled = false
          this.buttonInner = 'Создать'
        });
    }
  },
}
</script>