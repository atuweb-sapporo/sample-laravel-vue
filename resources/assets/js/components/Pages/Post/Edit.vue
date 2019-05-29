<template>
  <service-layout>
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <fieldset>
        <legend>レビュー投稿</legend>
          <div class="form-group">
            <label for="inputTitle" class="col-md-2 control-label">Book</label>
            <div class="col-md-10">
              <div v-show="bookSelected">
                <div>
                  <img :src="bookImage" style="width:10%;">
                </div>
                <div>
                  {{ bookTitle }}
                </div>
              </div>

              <button
                v-show=" ! isSearch"
                @click="searchBook"
                type="submit" class="btn btn-primary">書籍を選択する</button>

              <book-search
                transition="modal"
                v-show="isSearch"
                @select="selectBook"
                @close="closeSearchBook"
              ></book-search>
            </div>
          </div>

        </fieldset>
      </div>
    </div>

  </service-layout>
</template>

<script>
import modalBookSearch from '@/js/components/Pages/Post/BookSearch'

export default {
  data() {
    return {
      book: null,
      isSearch: false
    }
  },
  created() {
  },
  computed: {
    bookSelected() {
      const book = this.book
      return !!book
    },
    bookTitle() {
      const book = this.book
      return (!!book && !!book.title) ? book.title : ''
    },
    bookImage() {
      const book = this.book
      return (!!book && !!book.image_link) ? book.image_link : ''
    }
  },
  methods: {
    searchBook() {
      this.isSearch = true
    },
    closeSearchBook() {
      this.isSearch = false
    },
    selectBook(book) {
      this.book = book
      this.closeSearchBook()
    }
  },
  components: {
    'book-search': modalBookSearch,
  }
}
</script>
