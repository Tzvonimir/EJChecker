<script>
import Vue from 'vue'
import Notification from 'vue-bulma-notification'

const NotificationComponent = Vue.extend(Notification)

export default {

  openNotification(propsData = {
    title: '',
    message: '',
    type: '',
    direction: 'right',
    duration: 4500,
    container: '.notifications'
  }) {
    return new NotificationComponent({
      el: document.createElement('div'),
      propsData
    })
  },

  openSuccessNotification(props) {
    props.type = 'success'
    props.direction = 'Right'
    this.openNotification(props);
  },

  openErrorNotification(props) {
    props.type = 'danger'
    props.direction = 'Right'
    this.openNotification(props);

  }

}
</script>

<style>
  .notifications {
    top: 6px !important;
  }
  .notification {
    margin: 10px !important;
  }
</style>
