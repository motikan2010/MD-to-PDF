<template>
  <div>
    Hello World!!
  </div>
</template>

<script>
  export default {
    props: {

    },
    data () {
      return {

      }
    },
    methods: {
      async fetchFileList () {
        console.log(this.$route.query.r) // TODO
        const response = await axios.get('/api/repository/detail', {
          params: {
            r: this.$route.query.r
          }
        })

        console.log(response.data)
      }
    },
    watch: {
      $route: {
        async handler () {
          await this.fetchFileList()
        },
        immediate: true
      }
    }
  }
</script>
