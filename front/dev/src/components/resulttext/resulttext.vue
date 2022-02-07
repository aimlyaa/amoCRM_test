<template>
  <div class="row justify-content-center">
     <div class="d-flex justify-content-center bd-highlight mb-3 w-50">
        <textarea v-model="textResult" class="form-control" readonly></textarea>
     </div>
  </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
  computed: {
     ...mapState({
          textResult: 'textResult'
      })
  }
}
</script>