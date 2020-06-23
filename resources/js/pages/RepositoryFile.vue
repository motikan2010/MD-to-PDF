<template>
<!--
  <div>
    <li v-for="fileInfo in fileInfoList" :key="fileInfo.name">
      <span v-if="fileInfo.type === 'dir'"><button v-on:click="openFileList(fileInfo)">{{ fileInfo.name }}</button></span>
      <span v-if="fileInfo.type === 'file'">{{ fileInfo.name }}</span>
    </li>
  </div>
-->
  <TreeItem class="item" :item="treeData" @make-folder="makeFolder" @add-item="addItem" />
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
        fileInfoList: [],
        treeData: {}
      }
    },
    methods: {
      async fetchFileList () {
        const response = await axios.get('/api/repository/detail', {
          params: {
            r: this.$route.query.r
          }
        })
        this.fileInfoList = response.data

        let children = []
        for (let i=0; i < this.fileInfoList.length; i++) {
          children.push({name: this.fileInfoList[i].name})
        }
        this.treeData = {
          name: this.$route.query.r,
          children: children
        };

        console.log({
          name: this.$route.query.r,
          children: children
        })

      },
      async openFileList(fileInfo) {
        const response = await axios.get('/api/repository/detail', {
          params: {
            r: this.$route.query.r,
            f: fileInfo.name
          }
        })
      },
      makeFolder: function(item) {
        Vue.set(item, "children", []);
        this.addItem(item);
      },
      addItem: function(item) {
        item.children.push({
          name: "new stuff"
        });
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
