(() => {
  return {
    data() {
      return {
        root: appui.plugins['appui-notification'] + '/',
        container: document.querySelector('.bbn-appui-center')
      };
    },
    mounted() {
      appui.register('notification', this.getRef('notification'));
    },
    beforeDestroy() {
      appui.unregister('notification');
    }
  }
})();