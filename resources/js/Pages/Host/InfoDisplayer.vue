<template>
    <div class="bg-gray-400 min-w-screen relative z-0">
        <div class="">
            <div class="min-h-screen flex items-stretch text-white">
                <div id="picrueBackground" class="lg:flex w-1/2 hidden bg-gray-500 bg-no-repeat bg-cover relative items-center"
                     v-bind:style="{ backgroundImage: 'url(' + imageUrl()+ ')' }">
                    <div class="absolute bg-black opacity-60 inset-0 z-10" v-if="isLoaded"></div>
                    <div class="w-full px-24 z-10" v-if="isLoaded">
                        <h1 class="text-5xl font-bold text-left tracking-wide">{{ this.titel }}</h1>
                        <p class="text-3xl my-4">{{ this.subtitel }}</p>
                    </div>
                </div>
                <img v-if="!isLoaded && this.question === 0" :src="imageUrl()" @load="imageLoaded()" alt="">
                <div class="lg:w-1/2 w-full flex items-center justify-center text-center md:px-16 px-0 z-0"
                     style="background-color: #064b4f;" >
                    <div class="w-full py-6 z-20">
                        <slot></slot>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute inset-0 z-10 bg-white opacity-80" v-if="!isLoaded">
            <div class="z-30 items-center justify-center pt-12">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="top-1/2" style="margin: auto; background: none; display: block; shape-rendering: auto;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                    <path fill="none" stroke="#000000" stroke-width="8" stroke-dasharray="42.76482137044271 42.76482137044271" d="M24.3 30C11.4 30 5 43.3 5 50s6.4 20 19.3 20c19.3 0 32.1-40 51.4-40 C88.6 30 95 43.3 95 50s-6.4 20-19.3 20C56.4 70 43.6 30 24.3 30z" stroke-linecap="round" style="transform:scale(0.8);transform-origin:50px 50px">
                        <animate attributeName="stroke-dashoffset" repeatCount="indefinite" dur="1s" keyTimes="0;1" values="0;256.58892822265625"></animate>
                    </path>
                </svg>

            </div>
        </div>
    </div>

</template>

<script>
export default {
  name: 'InfoDisplayer',
  props:['titel','subtitel','imgSrc','question'],
  methods:{
    imageUrl(){
        return this.imgSrc||this.defaultImgSrc;
    },
    imageLoaded(){
        this.isLoaded = true;
    }
  },
  data() {
    return {
        defaultImgSrc: "https://picsum.photos/800/1200/",
        isLoaded: false,
    }
  },
  watch:{
      question: function (){
          this.isLoaded = false;
      }
  },
  created() {
      setTimeout(() => {
          if (!this.isLoaded){
              this.imgSrc = "https://picsum.photos/800/1000/";
              this.defaultImgSrc = "https://picsum.photos/800/1000/";
          }
      },5000);
  }
}
</script>


