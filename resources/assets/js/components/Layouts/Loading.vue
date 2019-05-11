<template>
  <div>
    <div id="circleG" class="center-middle">
      <div id="circleG_1" class="circleG"></div>
      <div id="circleG_2" class="circleG"></div>
      <div id="circleG_3" class="circleG"></div>
    </div>
    <div style="width:100%;height:100%;"></div>
  </div>
</template>

<style>
.center-middle {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  margin: auto;
  width: 100px;
  height: 100px;
}

/*
 *　http://cssload.net/en/horizontal-bars
 */
#circleG {
  width: 45px;
  margin: auto;
}

.circleG {
  background-color: rgb(255,255,255);
  float: left;
  height: 10px;
  margin-left: 5px;
  width: 10px;
  animation-name: bounce_circleG;
    -o-animation-name: bounce_circleG;
    -ms-animation-name: bounce_circleG;
    -webkit-animation-name: bounce_circleG;
    -moz-animation-name: bounce_circleG;
  animation-duration: 0.6775s;
    -o-animation-duration: 0.6775s;
    -ms-animation-duration: 0.6775s;
    -webkit-animation-duration: 0.6775s;
    -moz-animation-duration: 0.6775s;
  animation-iteration-count: infinite;
    -o-animation-iteration-count: infinite;
    -ms-animation-iteration-count: infinite;
    -webkit-animation-iteration-count: infinite;
    -moz-animation-iteration-count: infinite;
  animation-direction: normal;
    -o-animation-direction: normal;
    -ms-animation-direction: normal;
    -webkit-animation-direction: normal;
    -moz-animation-direction: normal;
  border-radius: 6px;
    -o-border-radius: 6px;
    -ms-border-radius: 6px;
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
}

#circleG_1 {
  animation-delay: 0.1395s;
    -o-animation-delay: 0.1395s;
    -ms-animation-delay: 0.1395s;
    -webkit-animation-delay: 0.1395s;
    -moz-animation-delay: 0.1395s;
}

#circleG_2 {
  animation-delay: 0.3155s;
    -o-animation-delay: 0.3155s;
    -ms-animation-delay: 0.3155s;
    -webkit-animation-delay: 0.3155s;
    -moz-animation-delay: 0.3155s;
}

#circleG_3 {
  animation-delay: 0.4085s;
    -o-animation-delay: 0.4085s;
    -ms-animation-delay: 0.4085s;
    -webkit-animation-delay: 0.4085s;
    -moz-animation-delay: 0.4085s;
}

@keyframes bounce_circleG {
  0% {}

  50% {
    background-color: rgba(217,217,217,0.8);
  }

  100% {}
}

@-o-keyframes bounce_circleG {
  0% {}

  50% {
    background-color: rgba(217,217,217,0.8);
  }

  100% {}
}

@-ms-keyframes bounce_circleG{
  0% {}

  50% {
    background-color: rgba(217,217,217,0.8);
  }

  100% {}
}

@-webkit-keyframes bounce_circleG{
  0% {}

  50% {
    background-color: rgba(217,217,217,0.8);
  }

  100% {}
}

@-moz-keyframes bounce_circleG{
  0% {}

  50% {
    background-color: rgba(217,217,217,0.8);
  }

  100% {}
}
</style>
