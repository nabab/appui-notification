(() => {
  return {
    data(){
      let not = appui.getRegistered('appui-notification');
      return {
        root: appui.plugins['appui-notification'] + '/',
        notifications: not,
        cfg: not.source.cfg
      }
    },
    computed: {
      users(){
        return appui.users
      }
    },
    methods: {
      remove(row){
        if (row[this.cfg.arch.notifications.id]) {
          this.confirm(bbn._('Are you sure you want to delete this notification?'), () => {
            this.post(this.root + 'actions/remove', {id: row[this.cfg.arch.notifications.id]}, d => {
              if (d.success) {
                this.getRef('table').updateData();
                appui.success();
              }
            })
          })
        }
      }
    }
  }
})();