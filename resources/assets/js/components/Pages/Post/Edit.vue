<template>
  <service-layout>
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <fieldset>
          <legend>レビュー投稿</legend>
          <div class="form-group">
            <label class="col-md-2 control-label">Book</label>
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

            <div :class="errorClassObject('comment')" class="form-group">
              <label for="inputComment" class="col-md-2 control-label">コメント詳細</label>
              <div class="col-md-10">
                <textarea v-model="edit.comment" class="form-control" rows="3" id="inputComment"></textarea>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2 control-label"></label>
              <div class="col-md-10">
                <span v-for="n in 5" @click="setStar(n)"
                  ><span v-show="n >  edit.star"><i class="far fa-star"></i></span
                  ><span v-show="n <= edit.star"><i class="fas fa-star"></i></span
                ></span>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-10 col-md-offset-2">
                <button
                  @click="doSubmit"
                  :disabled=" isValid == false"
                  type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </div>

        </fieldset>
      </div>
    </div>

  </service-layout>
</template>

<script>
  import http            from '@/js/services/http'
  import ajaxStore       from '@/js/stores/ajaxStore'
  import modalBookSearch from '@/js/components/Pages/Post/BookSearch'
  import formHelper      from '@/js/components/Mixins/FormHelper'

  export default {
    data() {
      return {
        book: null,
        edit: {
          comment: "",
          star   : 0
        },
        isSearch: false
      }
    },
    computed: {
      validation() {
        const edit = this.edit
        return {
          book   : this.bookSelected,
          comment: !!edit.comment,
        }
      },
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
      },
      star() {
        return this.edit.star
      }
    },
    methods: {
      doSubmit() {
        if (false === ajaxStore.setStartLoad()) {
          return
        }

        const postData = {
          isbn   : this.book.isbn,
          comment: this.edit.comment,
          star   : this.edit.star
        }
        http.post(
          'review/post',
          postData,
          () => {
            // show dialog
            ajaxStore.setFinishedLoad()
          },
          () => {
            // handle_error
            ajaxStore.setFinishedLoad()
          }
        )
      },
      searchBook() {
        this.isSearch = true
      },
      closeSearchBook() {
        this.isSearch = false
      },
      selectBook(book) {
        this.book = book
        this.closeSearchBook()
      },
      setStar(n) {
        this.edit.star = n
      }
    },
    components: {
      'book-search': modalBookSearch,
    },
    mixins: [
      formHelper
    ]
  }
</script>

<style>
.fa-star {
  font-size: 3rem;
  font-weight: bold;
  color: darkorange;
}
</style>
