<template>
  <li>
    <div :class="{bold: isFolder}" @click="toggle" @dblclick="makeFolder">
      {{ item.name }}
      <span v-if="isFolder">[{{ isOpen ? '-' : '+' }}]</span>
    </div>
    <ul v-show="isOpen" v-if="isFolder">
      <TreeItem class="item" v-for="(child, index) in item.children" :key="index" :item="child"
                @make-folder="$emit('make-folder', $event)" @add-item="$emit('add-item', $event)" />
      <li class="add" @click="$emit('add-item', item)">+</li>
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
      item: Object
    },
    data: function() {
      return {
        isOpen: true
      };
    },
    computed: {
      isFolder: function() {
        return this.item.children && this.item.children.length;
      }
    },
    methods: {
      toggle: function() {
        if (this.isFolder) {
          this.isOpen = !this.isOpen;
        }
      },
      makeFolder: function() {
        if (!this.isFolder) {
          this.$emit("make-folder", this.item);
          this.isOpen = true;
        }
      }
    }
  }
</script>
