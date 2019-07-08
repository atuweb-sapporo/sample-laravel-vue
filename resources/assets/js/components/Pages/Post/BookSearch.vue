<template>
  <transition name="modal">
    <div class="modal-mask modal">
      <div class="modal-dialog modal-lg" role="form">
        <div class="modal-content form-group">
          <div class="modal-header">
            書籍を検索します
            <button type="button" class="close" @click="$emit('close')" data-dismiss="modal" aria-label="Close">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body form-horizontal">
            <div :class="errorClassObject('search_value')" class="form-group">
              <label for="input_search_value" class="col-md-2 control-label">検索語句</label>
              <div class="col-md-10">
                <input v-model="searchValue" type="text" class="form-control" id="input_search_value" placeholder="検索語句を入力してください">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-10 col-md-offset-2">
                <button
                  @click="doSearch"
                  :disabled=" ! isValid"
                  type="submit" class="btn btn-primary">検索する</button>
              </div>
              <hr>
              <ul v-for="(book, index) in books" :key="index">
                <li>
                  {{ book.title }}
                  <button
                    @click="select(book)"
                    class="btn btn-primary">この書籍を選択する</button>
                </li>
              </ul>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
import formHelper from '@/js/components/Mixins/FormHelper'
import http       from '@/js/services/http'

export default {
  data() {
    return {
      searchValue: "",
      books      : []
    }
  },
  computed: {
    validation() {
      const searchValue = this.searchValue;
      return {
        search_value: !!searchValue
      }
    }
  },
  methods: {
    doSearch() {
      this.$store.commit('loading/start');
      http.post(
        'book/search',
        {
          value: this.searchValue
        },
        res => {
          this.books = res.data.books;
        },
        () => {
          // handle_error
        },
        () => {
          this.$store.commit('loading/finish');
        }
      )
    },
    select(book) {
      this.$emit('select', book);
    },
    close() {
      this.$emit('close');
    }
  },
  mixins: [
    formHelper
  ]
}
</script>

<style type="scss">
.types {
  span {
    padding-right: .25rem;
  }
}
</style>
