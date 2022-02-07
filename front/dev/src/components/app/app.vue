<template>
  <div id="app">
    <DropDown/>
    <ResultText/>
  </div>
</template>

<script>
import DropDown from '../dropdown/dropdown.vue'
import ResultText from '../resulttext/resulttext.vue'

export default {
  name: 'App',
  components: {
    DropDown,
    ResultText
  }
}
</script>
