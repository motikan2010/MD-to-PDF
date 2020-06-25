<template>
  <div>
    <p><button v-on:click="convertMarkdown">変換</button></p>
    <TreeItem class="item" :item="treeData" :isInitOpen="true" @add-item="addItem" />
    <!-- <pre>{{ treeData }}</pre> -->
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
          isConvert: false,
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
            fullName: fullName + '/' + fileInfoList[i].name,
            isConvert: false
          }
          if ( fileInfoList[i].type === 'dir' ) {
            file.children = []
          }
          children.push(file)
        }
        return children
      },
      async convertMarkdown() {
        let convertFiles = this.getConvertFileList(this.treeData)
        // Start download
        const response = await axios.post('/api/repository/convert', {r: this.$route.query.r, f: convertFiles}, {
          responseType: 'arraybuffer',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/pdf'
          }})
        const url = URL.createObjectURL(new Blob([response.data]));
        const link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', 'file.pdf');
        document.body.appendChild(link);
        link.click();
        link.revokeObjectURL();
      },
      getConvertFileList(treeData) {
        if ( treeData.isConvert ) {
          return treeData.fullName;
        }
        let targetFiles = []
        for ( let i in treeData.children ) {
          targetFiles = targetFiles.concat(this.getConvertFileList(treeData.children[i]))
        }
        return targetFiles
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
