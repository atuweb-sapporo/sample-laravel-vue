<template>
  <footer id="footer" class="navbar navbar-default navbar-fixed-bottom">
    <div class="container">
      <div class="navbar-collapse collapse" id="navbar-main">
        <ul class="nav navbar-nav">
          <li>
            <router-link to="/about">サイト説明</router-link>
          </li>
          <li>
            <router-link to="/privacy">プライバシーポリシー</router-link>
          </li>
          <li>
            <router-link to="/rule">利用規約</router-link>
          </li>
          <li>
            <router-link to="/inquiry">お問い合わせ</router-link>
          </li>
        </ul>
      </div>
    </div>
    <p>&#169; atuweb サンプルサイト</p>
  </footer>
</template>

<style>
#footer {
  margin: 0px;
  padding:0px;
  background-color:#707060;
  color:#FFF;
  text-align:center;
  height:70px;
  bottom:0px;
  tont-size: 10px;
}
#footer a,
#footer a span {
  color:#FFF;
}
</style>
