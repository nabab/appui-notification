<bbn-table :source="root + 'data/all'"
           :pageable="true"
           :showable="true"
           class="bbn-overlay"
           ref="table"
>
  <bbns-column :field="cfg.arch.notifications.id"
               label="<?= _('ID') ?>"
               :invisible="true"
  ></bbns-column>
  <bbns-column :field="cfg.arch.notifications.id_content"
               label="<?= _('ID Content') ?>"
               :invisible="true"
  ></bbns-column>
  <bbns-column :field="cfg.arch.content.id_option"
               label="<?= _('ID Option') ?>"
               :invisible="true"
  ></bbns-column>
  <bbns-column :field="cfg.arch.content.creation"
               label="<?= _('Creation') ?>"
               type="datetime"
               cls="bbn-c"
  ></bbns-column>
  <bbns-column :field="cfg.arch.notifications.id_user"
               label="<?= _('User') ?>"
               :source="users"
  ></bbns-column>
  <bbns-column :field="cfg.arch.content.title"
               label="<?= _('Title') ?>"
  ></bbns-column>
  <bbns-column :field="cfg.arch.content.content"
               label="<?= _('Content') ?>"
  ></bbns-column>
  <bbns-column :field="cfg.arch.notifications.read"
               label="<?= _('Read') ?>"
               type="datetime"
               cls="bbn-c"
  ></bbns-column>
  <bbns-column :field="cfg.arch.notifications.web"
               label="<?= _('In-App') ?>"
               type="datetime"
               cls="bbn-c"
  ></bbns-column>
  <bbns-column :field="cfg.arch.notifications.browser"
               label="<?= _('Browser') ?>"
               type="datetime"
               cls="bbn-c"
  ></bbns-column>
  <bbns-column :field="cfg.arch.notifications.mail"
               label="<?= _('Mail') ?>"
               type="datetime"
               cls="bbn-c"
  ></bbns-column>
  <bbns-column :field="cfg.arch.notifications.mobile"
               label="<?= _('Mobile') ?>"
               type="datetime"
               cls="bbn-c"
  ></bbns-column>
  <bbns-column :buttons="[{
                  text: '<?= _('Delete') ?>',
                  notext: true,
                  action: remove,
                  icon: 'nf nf-fa-trash'
                }]"
                cls="bbn-c"
                width="50"
  ></bbns-column>
</bbn-table>