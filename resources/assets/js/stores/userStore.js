import http from '@/js/services/http'

export default {
  state: {
    user         : {},
    loaded       : false,
    authenticated: false
  },
  init() {
    this.fetchAuth()
  },
  fetchAuth() {
    if (null === localStorage.getItem('jwt-token')) {
      this.toLoaded()
      return;
    }

    http.get(
      'me',
      res => {
        this.setCurrentUser(res.data.user)
        this.toLoaded()
      },
      () => {
        this.toLoaded()
      }
    )
  },
  setCurrentUser(user) {
    this.state.user          = user
    this.state.authenticated = !!user.id
  },
  toLoaded() {
    this.state.loaded = true
  },
}
