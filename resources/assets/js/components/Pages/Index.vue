<template>
  <service-layout>
    <div v-for="item in items" :key="item.id" id="reviews">
      <article class="item-card">
        <div class="cover"></div>
        <div class="inner">
          <div>{{ item.isbn }}</div>
          <div>{{ item.user_id }}</div>
          <div>{{ item.comment }}</div>
        </div>
      </article>
    </div>
  </service-layout>
</template>

<script>
import http from '@/js/services/http'

export default {
  data () {
    return {
      items : [],
      page  : 1
    }
  },
  created() {
    this.fetch();
  },
  mounted() {
    this.watchScroll();
  },
  destroyed() {
    this.unwatchScroll();
  },
  methods: {
    fetch() {
      this.$store.commit('loading/start');

      http.get(
        'reviews/page/'+ this.page,
        res => {
          this.page++;

          const response = res.data;
          if (response.status == 200) {
            this.items.push(...res.data.contents.items);
          }
        },
        null,
        () => {
          this.$store.commit('loading/finish');
        }
      )
    },
    watchScroll() {
      window.onscroll = _.debounce(this.fetchIfReachBottom, 300)
    },
    unwatchScroll() {
      window.onscroll = null;
    },
    fetchIfReachBottom() {
      const scrollingY = document.documentElement.scrollTop + window.innerHeight;
      const bottomY    = document.getElementById('reviews').offsetHeight;
      if (scrollingY >= bottomY) {
        this.fetch();
      }
    }
  }
}
</script>

<style>
.item-card {
  margin: 2rem 0;
  padding: 12rem;
  height: 4rem;
  width: 100%;
  box-sizing: border-box;
  border: 1px solid #ddd;
  border-radius: 4px;
  background-color: #fff;
}
</style>
