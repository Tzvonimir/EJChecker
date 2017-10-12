<script>
import router from '../router'

export default {

  responseResolver (response, callback) {
    if (response.data && response.data.success && response.data.success === true &&
        callback && typeof callback === 'function') {
      callback(response)
    }
    else {
      console.log(response)
      console.log('success = false')
    }
  },

  errorResolver (error) {
    if (error.response && error.response.data && error.response.data.error && error.response.data.error === 'token_not_provided') {
      console.log('token_not_provided - please login')
    }
    else if (error.response && error.response.data && error.response.data.error && error.response.data.error === 'invalid_credentials') {
      console.log('invalid_credentials - please login')
    }
    else if (error.response && error.response.data && error.response.data.error && error.response.data.error === 'token_expired') {
      console.log('error - token expired')
      router.go('/')
    }
  }

}
</script>
