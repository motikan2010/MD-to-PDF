<template>
  <li class="list-group-item">
    <div :class="{bold: isFolder}">
      <span v-if="!isFolder"><input type="checkbox" v-model="item.isConvert" /></span>
      <label>{{ item.name }}</label>
      <span v-if="isFolder"><button class="btn btn-light btn-sm" @click="toggle(item)">{{ isOpenState ? '-' : '+' }}</button></span>
    </div>
    <ul class="list-group" v-show="isOpenState" v-if="isFolder">
      <TreeItem class="item" v-for="(child, index) in item.children" :key="index"
                :item="child" :fullName="item.fullName + '/' + child.name" :isInitOpen="false" @add-item="$emit('add-item', $event)" />
    </ul>
  </li>
</template>

<script>
  import TreeItem from './TreeItem'

  export default {
    components: {
      TreeItem
    },
    name: 'TreeItem',
    props: {
      item: Object,
      fullName: String,
      isInitOpen: Boolean
    },
    data: function() {
      return {
        isOpen: false
      };
    },
    computed: {
      isFolder: function() {
        return this.item.children
      },
      isOpenState() {
        return (this.isInitOpen || this.isOpen)
      }
    },
    methods: {
      toggle: function(item) {
        this.$emit("add-item", item);
        if (this.isFolder) {
          this.isOpen = !this.isOpen;
        }
      }
    }
  }
</script>
