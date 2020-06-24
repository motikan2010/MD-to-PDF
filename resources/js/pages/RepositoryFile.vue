<template>
  <div>
    <TreeItem class="item" :item="treeData" :isInitOpen="true" @add-item="addItem" />
  </div>
</template>

<script>
  import TreeItem from '../components/TreeItem'

  export default {
    components:{
      TreeItem
    },
    props: {},
    data () {
      return {
        treeData: {}
      }
    },
    methods: {
      async fetchFileList () {
        const response = await axios.get('/api/repository/detail', {params: {r: this.$route.query.r}})
        let fileInfoList = response.data

        this.treeData = {
          name: this.$route.query.r,
          fullName: '',
          children: this.getChildren(fileInfoList)
        };
      },
      async addItem(item) {
        const response = await axios.get('/api/repository/detail', {params: {r: this.$route.query.r, f: item.fullName}})
        let fileInfoList = response.data
        item.children = this.getChildren(fileInfoList, item.fullName)
      },
      getChildren(fileInfoList, fullName = '') {
        let children = []
        for ( let i=0; i < fileInfoList.length; i++ ) {
          let file = {
            name: fileInfoList[i].name,
            fullName: fullName + '/' + fileInfoList[i].name
          }
          if ( fileInfoList[i].type === 'dir' ) {
            file.children = []
          }
          children.push(file)
        }
        return children
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
