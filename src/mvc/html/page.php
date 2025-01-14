<!-- HTML Document -->
<bbn-router class="appui-notfications"
            :autoload="false"
            :nav="true"
>
  <bbns-container url="list"
                  label="<?= _("Notifications list") ?>"
                  :fixed="true"
                  :load="true"
                  component="appui-notification-list"
                  icon="nf nf-fa-home"
                  :notext="true"
                  v-if="source.permissions.list"
  ></bbns-container>
  <bbns-container url="settings"
                  label="<?= _("Settings") ?>"
                  :fixed="true"
                  :load="true"
                  component="appui-notification-settings"
                  icon="nf nf-mdi-settings"
                  :notext="true"
                  v-if="source.permissions.settings"
  ></bbns-container>
  <bbns-container url="all"
                  label="<?= _("All notifications") ?>"
                  :fixed="true"
                  :load="true"
                  icon="nf nf-mdi-table"
                  :notext="true"
                  v-if="source.permissions.all"
  ></bbns-container>
</bbn-router>