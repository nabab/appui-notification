(() => {
  return {
    data(){
      return {
        root: appui.plugins['appui-notification'] + '/',
        isVisible: false,
        bottomCoord: '',
        selected: null,
        unread: 0,
        current: []
      }
    },
    computed: {
      notificationsTitle(){
        return this.unread ? bbn._('You have') + ' ' + this.unread + ' ' + bbn._('unread notifications') : bbn._('Notifications')
      }
    },
    methods: {
      openNotifications(){
        if (appui.plugins['appui-notification']){
          bbn.fn.link(appui.plugins['appui-notification'] + '/page/list');
          this.isVisible = false;
        }
      },
      readAll(){
        let ids = bbn.fn.map(this.getRef('list').filteredData, d => {
          return d.data.id;
        })
        if (ids.length) {
          this.post(this.root + 'actions/read', {ids: ids}, d => {
            if (d.success) {
              this.isVisible = false;
              appui.success();
            }
            else {
              appui.error();
            }
          })
        }
      },
      receive(data){
        let list = this.getRef('list');
        if ('web' in data) {
          if (!bbn.fn.isVue(list)) {
            bbn.fn.each(bbn.fn.order(data.web, 'creation', 'ASC'), n => appui.info({
              content: n.title ? `<div class="bbn-b">${n.title}</div><div>${n.content}</div>` : n.content,
              data: n,
              onClose: (not) => {
                this.post(this.root + 'actions/read', {id: n.id}, d => {
                  if (d.success) {
                    appui.messageChannel(appui.primaryChannel, {
                      function: (id) => {
                        let not = appui.getRegistered('notification'),
                            idx = bbn.fn.search(not.items, {'data.id': id});
                        if (idx > -1) {
                          not.close(not.items[idx].id);
                        }
                      },
                      params: [n.id]
                    });
                  }
                });
              }
            }, 120));
          }
        }
        if ('unread' in data) {
          this.unread = data.unread.length;
          this.current.splice(0, this.current.length, ...data.unread);
          if (bbn.fn.isVue(list)) {
            list.updateData();
          }
        }
      },
      _setCoord(){
        let coord = this.$el.offsetParent.getBoundingClientRect();
        this.bottomCoord = `${coord.bottom - coord.top}px`;
      }
    },
    created(){
      appui.register('appui-notification-tray', this);
    },
    mounted(){
      this.$nextTick(() => {
        this._setCoord();
      })
    },
    beforeDestroy(){
      appui.unregister('appui-notification-tray');
    },
    watch: {
      /**
       * @watch isVisible
       * @fires _setCoord
       */
      isVisible: {
        immediate: true,
        handler(newVal){
          if (newVal) {
            this._setCoord();
          }
        }
      }
    },
    components: {
      listItem: {
        template: `
<div :class="[
  'bbn-border-bottom',
  'bbn-spadding',
  'bbn-p',
  'bbn-reactive',
  'appui-notification-tray-item',
  {'bbn-state-selected': isSelected}
]">
  <div class="bbn-flex-width">
    <div class="bbn-flex-fill" @click="select">
      <div class="bbn-grid-fields">
        <i class="nf nf-md-calendar bbn-middle"></i>
        <div class="bbn-s"
              v-text="formatDateTime(source.creation)"/>
        <i class="nf nf-md-format_title bbn-middle"/>
        <div :class="['bbn-b', {'bbn-ellipsis': !isSelected}]"
              v-html="isSelected ? source.title : html2text(source.title)"
              :style="{whiteSpace: isSelected ? 'normal' : ''}"/>
        <i class="nf nf-md-tooltip_text bbn-middle"/>
        <div :class="{'bbn-ellipsis': !isSelected}"
              v-html="isSelected ? source.content : html2text(source.content)"
              :style="{whiteSpace: isSelected ? 'normal' : ''}"/>
      </div>
    </div>
    <div class="bbn-middle">
      <bbn-button icon="nf nf-md-marker_check"
                  :notext="true"
                  @click="read"
                  title="` + bbn._('Mark it as read') + `"/>
    </div>
  </div>
</div>
`,
        props: {
          source: {
            type: Object
          }
        },
        data(){
          return {
            cp: appui.getRegistered('appui-notification-tray')
          }
        },
        computed: {
          isSelected(){
            return this.cp.selected === this.source.id;
          }
        },
        methods: {
          html2text: bbn.fn.html2text,
          formatDateTime(date){
            if (date) {
              return dayjs(date).format('DD/MM/YYYY HH:mm')
            }
            return ''
          },
          select(){
            this.$set(this.cp, 'selected', this.source.id)
          },
          read(){
            if (this.source.id) {
              this.post(this.cp.root + 'actions/read', {id: this.source.id}, d => {
                if (d.success) {
                  let list = this.cp.getRef('list');
                  if (bbn.fn.isVue(list)) {
                    this.cp.getRef('list').updateData();
                  }
                  appui.success();
                }
                else {
                  appui.error();
                }
              })
            }
          }
        }
      }
    }
  }
})()