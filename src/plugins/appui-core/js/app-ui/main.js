(() => {
  return {
    data() {
      return {
        root: appui.plugins['appui-notification'] + '/'
      };
    },
    mounted() {
      appui.register('notification', this.getRef('notification'));
    }
  }
})();