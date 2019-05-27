<template>
  <service-layout>
    <h3>login</h3>
    <button @click="signUp">Facebook で Sign up / Sign in</button>
  </service-layout>
</template>

<script>
import http      from '@/js/services/http'
import firebase  from 'firebase'
import ajaxStore from '@/js/stores/ajaxStore'
import userStore from '@/js/stores/userStore'

export default {
  data() {
    return {
      uid  : null,
      token: null
    }
  },
  watch: {
    token: function(val) {
      if (val) {
        this.verify()
      }
    }
  },
  methods: {
    signUp() {
      if (false === ajaxStore.setStartLoad()) {
        return
      }

      const self = this

      // MEMO signInWithPopup() は別タブを開く、スマホでは signInWithRedirect() のほうがベター
      const provider = new firebase.auth.FacebookAuthProvider()
      firebase.auth().signInWithPopup(provider)
        .then(function(result) {
          // This gives you a Facebook Access Token. You can use it to access the Facebook API. now, not use
          const facebookAccessToken = result.credential.accessToken

          self.uid   = result.user.uid
          self.token = result.user['_lat']
        })
        .catch(function(error) {
          self.handleError(error)
        })
    },
    verify() {
      http.post(
        'verify',
        {
          token: this.token
        },
        res => {
          if (this.uid !== res.data.uid) {
            this.handleError({
              message: "uid is unmatch",
            })
            return
          }

          userStore.setCurrentUser(res.data.user)
          localStorage.setItem('jwt-token', this.token)
          ajaxStore.setFinishedLoad()

          this.$router.push('/')
        },
        err => {
          this.handleError(err)
        }
      )
    },
    handleError(e) {
      console.log('error')
      console.log(e)
    }
  }
}
</script>
